# Sitemap.xml Issue Resolution & Deployment Architecture Fix

## 1. Problem Summary
When requesting `https://nagaldhamfarm.shop/sitemap.xml`, the response was returning `http://localhost:8080/` (or `http://localhost:8085/`) URLs instead of the live production domain `https://nagaldhamfarm.shop/`:

```xml
<!-- Previous problematic output -->
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>http://localhost:8080/</loc>
        <lastmod>2026-10-27T16:02:48+00:00</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>http://localhost:8080/products</loc>
        <lastmod>2026-10-27T16:02:48+00:00</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
</urlset>
```

---

## 2. Root Cause Analysis (Why This Happened)

Four interconnected issues caused this behavior:

### Root Cause 1: Static File Serving by Nginx
In `docker-compose.yml`, the host directory `./public` is bind-mounted directly into Nginx:
```yaml
web:
  volumes:
    - ./public:/var/www/html/public:ro
```
In `docker/nginx/default.conf`, Nginx uses standard front-controller routing:
```nginx
location / {
    try_files $uri $uri/ /index.php?$query_string;
}
```
When a browser or crawler requests `/sitemap.xml`, Nginx checks if `/var/www/html/public/sitemap.xml` exists on disk. Because a stale `sitemap.xml` file existed on the EC2 host from an earlier setup, Nginx served this static file directly from disk and **never passed the request to Laravel / PHP**.

### Root Cause 2: Server `.env` Contained `APP_URL=http://localhost:8080`
On the remote AWS EC2 server, `/opt/nagaldhamfarm/.env` had `APP_URL=http://localhost:8080` preserved from initial container bootstrapping. The previous deployment script only checked:
```bash
if ! grep -qE '^APP_URL=' "$ENV_FILE"; then ...
```
Because `APP_URL` already existed in the file, it was **never corrected** to the production domain. When `php artisan config:cache` was executed, Laravel cached `http://localhost:8080` into `bootstrap/cache/config.php`.

### Root Cause 3: Inflexible Domain Detection in `SitemapTrait.php`
The existing trait only performed:
```php
$baseUrl = rtrim(config('app.url') ?: env('APP_URL'), '/');
```
When `config('app.url')` was cached with `localhost`, it unconditionally generated URLs starting with `http://localhost:8080/`, regardless of the incoming HTTP request host.

### Root Cause 4: Silent Git Pull Failure in GitHub Actions Deployment (`deploy.yml`)
In `.github/workflows/deploy.yml`, the SSH deployment script contained:
```bash
if [ ! -d ".git" ]; then
  git clone "https://${GHCR_USER}:${GHCR_TOKEN}@github.com/Aryanbhuva/nagaldhamfarm.git" .
else
  GIT_SSH_COMMAND="ssh -o StrictHostKeyChecking=no" git pull origin main || true
fi
```
The EC2 server had no GitHub SSH key configured. Consequently, `git pull origin main` failed with `Permission denied (publickey)`. Because of `|| true`, the failure was swallowed, and the files in `/opt/nagaldhamfarm` on EC2 were never updated to recent commits. As a result, the old `deploy.sh` script ran, the old `.env` remained, and the old `sitemap.xml` file stayed on disk.

---

## 3. Files Modified & Explanation

### 1. `.github/workflows/deploy.yml`
- **Location:** [`.github/workflows/deploy.yml`](file:///home/vishmay/Desktop/project/.github/workflows/deploy.yml)
- **Why it was edited:** Fixed the git synchronization on EC2 by using authenticated HTTPS credentials (`GHCR_USER` & `GHCR_TOKEN`) instead of unconfigured SSH. Added `git reset --hard origin/main` to guarantee the EC2 host files stay 100% in sync with the repository. Added server-side remediation commands to scrub `localhost` from `.env` and remove any stale `public/sitemap.xml` on each deploy.

### 2. `app/Traits/SitemapTrait.php`
- **Location:** [`app/Traits/SitemapTrait.php`](file:///home/vishmay/Desktop/project/app/Traits/SitemapTrait.php)
- **Why it was edited:** Added bulletproof domain resolution in `getSitemapUrls()`:
  - If `app()->environment('local')`, it respects local settings.
  - In production, it checks `request()->getHost()`. If valid and not localhost, it dynamically uses the incoming domain (`https://nagaldhamfarm.shop`).
  - If `config('app.url')` or `env('APP_URL')` contains `localhost`, it discards it and falls back to `https://nagaldhamfarm.shop`.
  - Added `@chmod($targetPath, 0666)` after writing `public/sitemap.xml` so Nginx and container processes always have read/write access.

### 3. `deploy/deploy.sh`
- **Location:** [`deploy/deploy.sh`](file:///home/vishmay/Desktop/project/deploy/deploy.sh)
- **Why it was edited:**
  - Added automated regex replacement `sed -i 's|^APP_URL=.*|APP_URL=https://nagaldhamfarm.shop|' "$ENV_FILE"` to automatically fix `.env` on deploy.
  - Added `rm -f "${PROJECT_DIR}/public/sitemap.xml"` before starting the stack.
  - Added `php artisan config:clear`, `config:cache`, `route:clear`, and `route:cache`.
  - Added automated CLI sitemap generation: `php artisan sitemap:generate`.
  - Enhanced `health_check()` to query `/sitemap.xml` and verify it contains `https://nagaldhamfarm.shop`.

### 4. `docker/entrypoint.sh`
- **Location:** [`docker/entrypoint.sh`](file:///home/vishmay/Desktop/project/docker/entrypoint.sh)
- **Why it was edited:** Added automatic `php artisan sitemap:generate --no-interaction || true` right after config and route caching during container initialization, ensuring fresh sitemaps whenever containers restart.

### 5. `routes/web.php`
- **Location:** [`routes/web.php`](file:///home/vishmay/Desktop/project/routes/web.php)
- **Why it was edited:** Added dedicated route `Route::get('/sitemap.xml', [PageController::class, 'sitemapXml'])->name('sitemap.xml');` so that requests routed through Laravel dynamically return the XML response with proper `text/xml` MIME type headers.

### 6. `app/Http/Controllers/Front/PageController.php`
- **Location:** [`app/Http/Controllers/Front/PageController.php`](file:///home/vishmay/Desktop/project/app/Http/Controllers/Front/PageController.php)
- **Why it was edited:** Added `sitemapXml()` method returning `response($xml, 200)->header('Content-Type', 'text/xml')`.

### 7. `routes/console.php`
- **Location:** [`routes/console.php`](file:///home/vishmay/Desktop/project/routes/console.php)
- **Why it was edited:** Registered the `php artisan sitemap:generate` Artisan command for CLI and deployment automation.

### 8. `public/sitemap.xml`
- **Location:** [`public/sitemap.xml`](file:///home/vishmay/Desktop/project/public/sitemap.xml)
- **Why it was edited:** Committed with production URLs (`https://nagaldhamfarm.shop/` and `https://nagaldhamfarm.shop/products`) to prevent any initial deployment gap.

---

## 4. Live Verification Output

Testing the live production URL returns HTTP 200 with the production domain:

```bash
$ curl -sSL -i https://nagaldhamfarm.shop/sitemap.xml
HTTP/2 200 
server: nginx/1.27.5
date: Tue, 03 Nov 2026 09:46:06 GMT
content-type: text/xml; charset=utf-8
content-length: 504
last-modified: Tue, 03 Nov 2026 09:45:39 GMT
etag: "6ae9ad43-1f8"

<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>https://nagaldhamfarm.shop/</loc>
        <lastmod>2026-11-03T09:45:39+00:00</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>https://nagaldhamfarm.shop/products</loc>
        <lastmod>2026-11-03T09:45:39+00:00</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
</urlset>
```
