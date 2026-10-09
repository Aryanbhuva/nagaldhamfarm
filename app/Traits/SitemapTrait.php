<?php

namespace App\Traits;

trait SitemapTrait
{
    /**
     * Generate the sitemap XML string dynamically.
     */
    public function generateSitemapXml()
    {
        $staticPages = [
            '',          // Home page
            'products'   // Products page
        ];

        if (request() && request()->getHost() && !in_array(request()->getHost(), ['localhost', '127.0.0.1'])) {
            $baseUrl = rtrim(request()->schemeAndHttpHost(), '/');
        } else {
            $baseUrl = rtrim(config('app.url', 'https://nagaldhamfarm.shop'), '/');
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

        foreach ($staticPages as $page) {
            $xml .= '    <url>' . PHP_EOL;
            $xml .= '        <loc>' . $baseUrl . ($page ? '/' . $page : '') . '</loc>' . PHP_EOL;
            $xml .= '        <lastmod>' . now()->toAtomString() . '</lastmod>' . PHP_EOL;
            $xml .= '        <changefreq>weekly</changefreq>' . PHP_EOL;
            $xml .= '        <priority>' . ($page === '' ? '1.0' : '0.8') . '</priority>' . PHP_EOL;
            $xml .= '    </url>' . PHP_EOL;
        }

        $xml .= '</urlset>';

        return $xml;
    }
}
