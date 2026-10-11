<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

trait SitemapTrait
{
    /**
     * Get all indexed URL items with metadata.
     *
     * @return array<int, array{name:string, loc:string, priority:string, changefreq:string, lastmod:string}>
     */
    public function getSitemapUrls(): array
    {
        $baseUrl = rtrim(config('app.url') ?: env('APP_URL'), '/');
        $now     = now()->toAtomString();

        return [
            [
                'name'       => 'Home',
                'loc'        => $baseUrl . '/',
                'priority'   => '1.0',
                'changefreq' => 'daily',
                'lastmod'    => $now,
            ],
            [
                'name'       => 'Products Catalog',
                'loc'        => $baseUrl . '/products',
                'priority'   => '0.8',
                'changefreq' => 'weekly',
                'lastmod'    => $now,
            ],
        ];
    }

    /**
     * Build the raw XML string for the sitemap.
     */
    public function generateSitemapXml(): string
    {
        $urls = $this->getSitemapUrls();

        $xml  = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($urls as $item) {
            $xml .= $this->buildUrl($item['loc'], $item['lastmod'], $item['changefreq'], $item['priority']);
        }

        $xml .= '</urlset>';

        return $xml;
    }

    /**
     * Generate sitemap XML and safely write it to public/sitemap.xml if permitted.
     *
     * @return array{static_count:int, total_count:int, urls:array, xml:string, file_saved:bool, file_error:?string}
     */
    public function generateSitemapFile(): array
    {
        $urls = $this->getSitemapUrls();
        $xml  = $this->generateSitemapXml();

        $fileSaved = false;
        $fileError = null;

        try {
            $targetPath = public_path('sitemap.xml');
            File::put($targetPath, $xml);
            $fileSaved = true;
        } catch (\Throwable $e) {
            $fileError = $e->getMessage();
            Log::warning('SitemapTrait: could not write sitemap.xml to public directory: ' . $fileError);
        }

        return [
            'static_count' => count($urls),
            'total_count'  => count($urls),
            'urls'         => $urls,
            'xml'          => $xml,
            'file_saved'   => $fileSaved,
            'file_error'   => $fileError,
        ];
    }

    /**
     * Build a single <url> XML block.
     */
    private function buildUrl(string $loc, string $lastmod, string $changefreq, string $priority): string
    {
        $block  = "    <url>\n";
        $block .= "        <loc>" . htmlspecialchars($loc, ENT_XML1, 'UTF-8') . "</loc>\n";
        $block .= "        <lastmod>" . $lastmod . "</lastmod>\n";
        $block .= "        <changefreq>" . $changefreq . "</changefreq>\n";
        $block .= "        <priority>" . $priority . "</priority>\n";
        $block .= "    </url>\n";
        return $block;
    }
}
