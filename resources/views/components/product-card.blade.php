@props(['product'])

@php
    $productSlug = $product->slug ?: \Str::slug($product->name);
    $productImage = $product->image;
    if ($productImage && !str_starts_with($productImage, '/') && !str_starts_with($productImage, 'http')) {
        $productImage = '/' . ltrim($productImage, '/');
    }
    if (!$productImage) {
        $productImage = '/images/product-placeholder.jpg';
    }
@endphp

<a href="/products/{{ $productSlug }}" class="group block">
    <div class="overflow-hidden rounded-lg bg-white shadow-light hover:shadow-medium transition-all duration-300">
        {{-- Image with hover zoom --}}
        <div class="relative overflow-hidden aspect-square bg-bg-form">
            <img src="{{ $productImage }}"
                 alt="{{ $product->name }}"
                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                 onerror="this.src='/images/product-placeholder.jpg'"
                 loading="lazy">
        </div>

        {{-- Title --}}
        <div class="p-4">
            <h3 class="product-title text-center truncate">{{ $product->name }}</h3>
        </div>
    </div>
</a>
