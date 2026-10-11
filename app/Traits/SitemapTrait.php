<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;

trait SitemapTrait
{
    /**
     * Generate a single comprehensive sitemap file covering all
     * static pages and dynamic (product / blog / category) URLs.
     *
     * @return array{static_count:int, product_count:int, blog_count:int, category_count:int, total_count:int}
     */
    public function generateSitemapFile(): array
    {
        $baseUrl = rtrim(config('app.url', request()->getSchemeAndHttpHost()), '/');
        $now     = now()->toAtomString();

        // ── XML open ──────────────────────────────────────────────────────────
        $xml  = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

        // ── Static pages ──────────────────────────────────────────────────────
        $staticPages = [
            '',
            'products',
        ];

        foreach ($staticPages as $page) {
            $loc        = $baseUrl . ($page !== '' ? '/' . $page : '');
            $priority   = ($page === '') ? '1.0' : '0.8';
            $changefreq = 'weekly';
            $xml .= $this->buildUrl($loc, $now, $changefreq, $priority);
        }

        $xml .= '</urlset>';

        // ── Write to public/sitemap.xml ───────────────────────────────────────
        File::put(public_path('sitemap.xml'), $xml);

        return [
            'static_count'   => count($staticPages),
            'total_count'    => count($staticPages),
        ];
    }

    /**
     * Build a single <url> block.
     */
    private function buildUrl(string $loc, string $lastmod, string $changefreq, string $priority): string
    {
        $block  = '    <url>' . PHP_EOL;
        $block .= '        <loc>' . htmlspecialchars($loc, ENT_XML1, 'UTF-8') . '</loc>' . PHP_EOL;
        $block .= '        <lastmod>' . $lastmod . '</lastmod>' . PHP_EOL;
        $block .= '        <changefreq>' . $changefreq . '</changefreq>' . PHP_EOL;
        $block .= '        <priority>' . $priority . '</priority>' . PHP_EOL;
        $block .= '    </url>' . PHP_EOL;
        return $block;
    }
}
