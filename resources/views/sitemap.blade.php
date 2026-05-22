<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    {{-- Homepage --}}
    <url>
        <loc>{{ url('/') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
    </url>

    {{-- About Page --}}
    <url>
        <loc>{{ url('/pages/MeisaiPrinting') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>

    {{-- Product Catalog Pages --}}
    <url>
        <loc>{{ url('/pages/custom-stickers') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
    <url>
        <loc>{{ url('/pages/custom-labels') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
    <url>
        <loc>{{ url('/pages/blank-labels') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>

    {{-- Static Pages --}}
    <url>
        <loc>{{ url('/pages/free-samples') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc>{{ url('/pages/material-sample-pack') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
    <url>
        <loc>{{ url('/pages/size-chart') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
    <url>
        <loc>{{ url('/pages/moq-pricing') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
    <url>
        <loc>{{ url('/pages/artwork-guidelines') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
    <url>
        <loc>{{ url('/pages/eco-friendly') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
    <url>
        <loc>{{ url('/pages/compliance') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
    <url>
        <loc>{{ url('/pages/privacy-policy') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>

    {{-- Blog Index --}}
    <url>
        <loc>{{ url('/blog') }}</loc>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>

    {{-- Products --}}
    @foreach($products as $product)
    <url>
        <loc>{{ url('/products/' . $product->slug) }}</loc>
        @if($product->updated_at)
        <lastmod>{{ $product->updated_at->toIso8601String() }}</lastmod>
        @endif
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach

    {{-- Blog Posts --}}
    @foreach($posts as $post)
    <url>
        <loc>{{ url('/blog/' . $post->slug) }}</loc>
        @if($post->published_at)
        <lastmod>{{ $post->published_at->toIso8601String() }}</lastmod>
        @endif
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    @endforeach
</urlset>
