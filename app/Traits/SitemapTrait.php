<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;

trait SitemapTrait
{
    /**
     * Generate the sitemap XML and save it to the public folder.
     */
    public function generateSitemapFile()
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

        // Static Pages
        $staticPages = [
            '',          // Home page
            'products'   // Products page
        ];

        $baseUrl = rtrim(config('app.url'), '/');

        foreach ($staticPages as $page) {
            $xml .= '    <url>' . PHP_EOL;
            $xml .= '        <loc>' . $baseUrl . ($page ? '/' . $page : '') . '</loc>' . PHP_EOL;
            $xml .= '        <lastmod>' . now()->toAtomString() . '</lastmod>' . PHP_EOL;
            $xml .= '        <changefreq>weekly</changefreq>' . PHP_EOL;
            $xml .= '        <priority>' . ($page === '' ? '1.0' : '0.8') . '</priority>' . PHP_EOL;
            $xml .= '    </url>' . PHP_EOL;
        }

        $xml .= '</urlset>';

        try {
            File::put(public_path('sitemap.xml'), $xml);
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('Could not write sitemap.xml: ' . $e->getMessage());
        }

        return [
            'static_count' => count($staticPages),
            'total_count' => count($staticPages)
        ];
    }
}

