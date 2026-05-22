@extends('layouts.app', ['transparentOnTop' => false])

@section('content')
    <div class="max-w-[1200px] mx-auto px-6">
        {{-- Breadcrumb --}}
        <x-breadcrumb :items="[['title' => 'Search Results']]" />

        {{-- Search Header --}}
        <div class="py-10">
            <h1 class="text-page-title font-bold text-box-title mb-3">Search Results</h1>
            @if($query)
                <p class="text-body text-base">
                    Showing results for "<strong class="text-box-title">{{ $query }}</strong>"
                    &mdash; {{ $products->count() }} product(s), {{ $posts->count() }} article(s)
                </p>
            @else
                <p class="text-body text-base">Please enter a search term to find products and articles.</p>
            @endif
        </div>

        @if($query)
            {{-- Products Section --}}
            @if($products->count() > 0)
                <section class="pb-12">
                    <h2 class="section-heading mb-8">Products</h2>
                    <div class="grid grid-cols-2 tablet:grid-cols-4 gap-6">
                        @foreach($products as $product)
                            <a href="/products/{{ $product->slug }}" class="group block">
                                <div class="overflow-hidden rounded-lg bg-white shadow-light hover:shadow-medium transition-all duration-300">
                                    <div class="relative overflow-hidden aspect-square bg-bg-form">
                                        @if($product->image)
                                            @php
                                                $productImage = $product->image;
                                                if (!str_starts_with($productImage, '/') && !str_starts_with($productImage, 'http')) {
                                                    $productImage = Storage::disk('uploads')->url($productImage);
                                                }
                                            @endphp
                                            <img src="{{ $productImage }}"
                                                 alt="{{ $product->name }}"
                                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                                 loading="lazy">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                                <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5a2.25 2.25 0 002.25-2.25V5.25a2.25 2.25 0 00-2.25-2.25H3.75a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 003.75 21z"/>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="p-4">
                                        <h3 class="text-base font-semibold text-box-title text-center truncate group-hover:text-brand transition-colors duration-300">
                                            {{ $product->name }}
                                        </h3>
                                        @if($product->category)
                                            <p class="text-sm text-gray-400 text-center mt-1">{{ $product->category->name }}</p>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </section>
            @endif

            {{-- Blog Posts Section --}}
            @if($posts->count() > 0)
                <section class="pb-16">
                    <h2 class="section-heading mb-8">Articles</h2>
                    <div class="grid grid-cols-1 mobile:grid-cols-2 tablet:grid-cols-3 gap-6">
                        @foreach($posts as $post)
                            <x-blog-card :post="$post" />
                        @endforeach
                    </div>
                </section>
            @endif

            {{-- No Results --}}
            @if($products->isEmpty() && $posts->isEmpty())
                <div class="py-16 text-center">
                    <svg class="w-20 h-20 text-gray-200 mx-auto mb-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <h3 class="text-xl font-semibold text-box-title mb-2">No results found</h3>
                    <p class="text-body text-base max-w-md mx-auto mb-6">
                        We couldn't find any products or articles matching "<strong>{{ $query }}</strong>". Try a different search term or browse our catalog.
                    </p>
                    <div class="flex items-center justify-center gap-4">
                        <a href="/pages/custom-stickers" class="btn-primary">Browse Stickers</a>
                        <a href="/pages/custom-labels" class="btn-primary">Browse Labels</a>
                    </div>
                </div>
            @endif
        @endif
    </div>

    {{-- Quote Form --}}
    <x-quote-form pageSource="search" />
@endsection
