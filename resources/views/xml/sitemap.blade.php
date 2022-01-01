<?xml version="1.0" encoding="UTF-8"?>
<urlset
    xmlns="https://www.sitemaps.org/schemas/sitemap/0.9"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="https://www.sitemaps.org/schemas/sitemap/0.9
            https://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
    <!-- created with Sitemap Generator by Norman Huth https://huth.it -->
@foreach($pages as $page)
    <url>
        <loc>{{ \Illuminate\Support\Facades\Route::has($page->route) ? route($page->route) : route($page->route.'.index') }}</loc>
        <lastmod>{{ $page->updated_at->format(DateTimeInterface::ATOM) }}</lastmod>
    </url>
@endforeach
</urlset>
