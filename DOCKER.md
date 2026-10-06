# 🐳 Nagaldham Farm — Production Docker Deployment Guide

> **Stack:** PHP 8.4-FPM Alpine · Nginx 1.27 Alpine · Laravel 10 · Vite Assets
> **Ports:** App runs on `HTTP_PORT` (default `8085`), configurable in `.env`

---

## 📋 Table of Contents
1. [Prerequisites](#prerequisites)
2. [First-Time Setup](#first-time-setup)
3. [Verify Deployment](#verify-deployment)
4. [Updating the App](#updating-the-app)
5. [Rollback Procedure](#rollback-procedure)
6. [Useful Commands](#useful-commands)
7. [Host-Level Reverse Proxy & TLS](#host-level-reverse-proxy--tls)
8. [Troubleshooting](#troubleshooting)

---

## Prerequisites

- Docker Engine **20.10+**
- `docker-compose` **v1.29+** or `docker compose` plugin v2
- Git access to the repo

---

## First-Time Setup

### 1. Clone & Switch to Production Branch
```bash
git clone git@github.com:Aryanbhuva/nagaldhamfarm.git
cd nagaldhamfarm
git checkout main
```

### 2. Configure Environment
```bash
cp .env.production.example .env
```

Edit `.env` if needed — key variables:

| Variable | Default | Notes |
|---|---|---|
| `APP_KEY` | _(blank)_ | **Must be generated** (Step 3) |
| `APP_URL` | `http://localhost:8085` | Change to your domain in production |
| `HTTP_PORT` | `8085` | Change if port is already in use on host |
| `APP_DEBUG` | `false` | Keep `false` in production |

### 3. Generate Application Key
```bash
make key
```
This writes `APP_KEY=base64:...` directly into your `.env` file.

### 4. Build Docker Images
```bash
make build
```
> ⏳ First build takes **5–15 minutes** (compiles PHP extensions from source on Alpine).
> Subsequent builds use Docker layer cache and finish in ~30 seconds.

### 5. Start Production Containers
```bash
make up
```

### 6. Verify Containers Are Running
```bash
docker-compose ps
```
Expected output:
```
    Name              Command          State          Ports
------------------------------------------------------------------
nagaldham_app   /usr/local/bin/...   Up (healthy)   9000/tcp
nagaldham_web   /docker-entrypoint   Up (healthy)   0.0.0.0:8085->80/tcp
```

---

## Verify Deployment

```bash
# Test homepage
curl -I http://localhost:8085/

# Test products page
curl -I http://localhost:8085/products

# Both should return: HTTP/1.1 200 OK
```

Open in browser: **http://localhost:8085**

---

## Updating the App

Deployments to production are **fully automated** via GitHub Actions CI/CD.

### Automated Deployment (Recommended)
1. Commit and push changes to `staging` (or your feature branch).
2. Create a Pull Request into `main` and merge it.
3. GitHub Actions automatically:
   - Builds the Docker image on GitHub runners (saving EC2 CPU & RAM).
   - Pushes the image to GitHub Container Registry (`ghcr.io`).
   - SSHes into the EC2 server and triggers `./deploy/deploy.sh <sha>`.
   - Runs health checks against `/` and `/products`.
   - Auto-rolls back to the previous tag if the health check fails.

### Manual Workflow Trigger
To re-run a deployment manually without pushing new code:
1. Go to **GitHub Repo → Actions → Deploy to Production**.
2. Click **Run workflow** → Select branch `main` → Click **Run workflow**.

---

## Rollback Procedure

### Automatic Rollback
If a deployment fails health checks during CI/CD, `deploy/deploy.sh` automatically reverts `.env` to `PREVIOUS_TAG`, restarts the container stack, and verifies system health before exiting with failure.

### Manual Rollback (to a specific image SHA)
If a bug is discovered after deployment, run the manual rollback script directly on the server:

```bash
# Connect to EC2 server
ssh deploy@<EC2_IP>
cd /opt/nagaldhamfarm

# Rollback to a specific image tag (e.g. previous Git short SHA)
./deploy/rollback.sh 8a1b2c3d
```

The script will update `IMAGE_TAG` in `.env`, pull the image, restart containers, and verify health checks.


---

## Useful Commands

| Command | Action |
|---|---|
| `make help` | Show all available Makefile commands |
| `make build` | Rebuild production Docker images |
| `make up` | Start production stack |
| `make down` | Stop and remove stack |
| `make logs` | Stream container logs |
| `make shell` | Access bash prompt inside app container |
| `make artisan CMD="about"` | Run any artisan command |
| `make clean-cache` | Rebuild Laravel config/route/view caches |
| `docker-compose ps` | Check container health status |
| `docker-compose rm -f web` | Remove stale web container (fixes recreation bug) |

---

## Host-Level Reverse Proxy & TLS

Since `nagaldham_web` only listens on HTTP, put a host-level proxy in front for HTTPS/TLS in production.

### Nginx (Certbot / Let's Encrypt)

```nginx
server {
    listen 80;
    server_name nagaldhamfarm.com www.nagaldhamfarm.com;
    return 301 https://$host$request_uri;
}

server {
    listen 443 ssl http2;
    server_name nagaldhamfarm.com www.nagaldhamfarm.com;

    ssl_certificate /etc/letsencrypt/live/nagaldhamfarm.com/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/nagaldhamfarm.com/privkey.pem;

    location / {
        proxy_pass http://127.0.0.1:8085;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
    }
}
```

Then update `.env`:
```env
APP_URL=https://nagaldhamfarm.com
```

---

## Troubleshooting

### `ContainerConfig` KeyError on `docker-compose up`
**Cause:** `docker-compose` v1.29.2 bug with images built by newer Docker engine.
**Fix:** Remove the stale container before starting:
```bash
docker-compose rm -f web
docker-compose up -d
```

### Port already in use (`address already in use`)
**Fix:** Change `HTTP_PORT` in `.env` to a free port (e.g. `8085`, `8090`):
```env
HTTP_PORT=8085
```

### `Composer detected issues — PHP >= 8.4.1 required`
**Cause:** Composer resolved latest packages requiring PHP 8.4 but image was PHP 8.2.
**Fix:** Already resolved — Dockerfile now uses `php:8.4-fpm-alpine`.

### Build stuck at GCC / PHP extension compilation
**Cause:** This is normal on Alpine — PHP extensions compile from source.
**Expected time:** 5–15 minutes on first build. ☕ Just wait.

### `APP_KEY` not set — 500 error
**Fix:** Run `make key` to auto-generate and write the key to `.env`.

---

*Last updated: October 2026 · Maintained by Aryanbhuva / vishamay123*
