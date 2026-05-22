@extends('layouts.app', [
    'transparentOnTop' => true,
])

@section('content')

<style>
    /* Force Info Cards 3-column layout - overrides any Tailwind issue */
    @media (min-width: 1000px) {
        .info-cards-grid {
            display: grid !important;
            grid-template-columns: repeat(3, 1fr) !important;
        }
    }
</style>

{{-- SEO: Primary h1 for the homepage --}}
<h1 class="sr-only">Custom Stickers & Labels – MeisaiPrinting</h1>

{{-- ====================================================================
   1. HERO CAROUSEL
   ==================================================================== --}}

<x-hero-carousel :slides="$heroSlides" />

{{-- ====================================================================
   2. FIVE MAIN CATEGORIES GRID
   ==================================================================== --}}

<section class="py-16 bg-white">
    <div class="max-w-[1200px] mx-auto px-6">
        <h2 class="section-heading text-center mb-10">What Are You Looking For?</h2>

        <div class="grid grid-cols-1 tablet:grid-cols-5 gap-6">
            {{-- Material --}}
            <a href="/materials" class="group block">
                <div class="relative overflow-hidden rounded-lg shadow-light hover:shadow-medium transition-all duration-300 h-full">
                    <div class="aspect-square bg-bg-form">
                        <img src="/images/category-material.jpg"
                             alt="Material Categories"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                             loading="lazy"
                             onerror="this.src='/images/category-placeholder.jpg'">
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-4 text-center">
                        <h2 class="text-white text-lg font-bold">Material</h2>
                        <p class="text-white/80 text-xs mt-1">Vinyl, PET, Kraft, Foil...</p>
                    </div>
                </div>
            </a>

            {{-- Industry --}}
            <a href="/industries" class="group block">
                <div class="relative overflow-hidden rounded-lg shadow-light hover:shadow-medium transition-all duration-300 h-full">
                    <div class="aspect-square bg-bg-form">
                        <img src="/images/category-industry.jpg"
                             alt="Industry Solutions"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                             loading="lazy"
                             onerror="this.src='/images/category-placeholder.jpg'">
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-4 text-center">
                        <h2 class="text-white text-lg font-bold">Industry</h2>
                        <p class="text-white/80 text-xs mt-1">Breweries, Cosmetics...</p>
                    </div>
                </div>
            </a>

            {{-- Shape --}}
            <a href="/shapes" class="group block">
                <div class="relative overflow-hidden rounded-lg shadow-light hover:shadow-medium transition-all duration-300 h-full">
                    <div class="aspect-square bg-bg-form">
                        <img src="/images/category-shape.jpg"
                             alt="Shape Categories"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                             loading="lazy"
                             onerror="this.src='/images/category-placeholder.jpg'">
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-4 text-center">
                        <h2 class="text-white text-lg font-bold">Shape</h2>
                        <p class="text-white/80 text-xs mt-1">Die Cut, Circle...</p>
                    </div>
                </div>
            </a>

            {{-- Custom Stickers --}}
            <a href="/pages/custom-stickers" class="group block">
                <div class="relative overflow-hidden rounded-lg shadow-light hover:shadow-medium transition-all duration-300 h-full">
                    <div class="aspect-square bg-bg-form">
                        <img src="/images/category-stickers.jpg"
                             alt="Custom Stickers"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                             loading="lazy"
                             onerror="this.src='/images/category-placeholder.jpg'">
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-4 text-center">
                        <h2 class="text-white text-lg font-bold">Custom Stickers</h2>
                        <p class="text-white/80 text-xs mt-1">Die Cut, Vinyl...</p>
                    </div>
                </div>
            </a>

            {{-- Blank Labels --}}
            <a href="/pages/blank-labels" class="group block">
                <div class="relative overflow-hidden rounded-lg shadow-light hover:shadow-medium transition-all duration-300 h-full">
                    <div class="aspect-square bg-bg-form">
                        <img src="/images/category-blank-labels.jpg"
                             alt="Blank Labels"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                             loading="lazy"
                             onerror="this.src='/images/category-placeholder.jpg'">
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-4 text-center">
                        <h2 class="text-white text-lg font-bold">Blank Labels</h2>
                        <p class="text-white/80 text-xs mt-1">Roll, Sheet...</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</section>

{{-- ====================================================================
   3. QUOTE FORM
   ==================================================================== --}}

<x-quote-form pageSource="homepage" />

{{-- ====================================================================
   4. WHY CHOOSE US / TRUST BADGES
   ==================================================================== --}}

<x-trust-badges />

{{-- ====================================================================
   5. INFO CARDS SECTION
   ==================================================================== --}}

<section class="py-16 bg-bg-form">
    <div class="max-w-[1200px] mx-auto px-6">
        <div class="grid grid-cols-1 tablet:grid-cols-3 gap-6 info-cards-grid">
            {{-- Card 1: Custom Stickers --}}
            <div class="bg-white rounded-lg overflow-hidden shadow-light hover:shadow-medium transition-all duration-300 group">
                <div class="relative overflow-hidden aspect-[16/10]">
                    <img src="/images/info-custom-stickers.jpg"
                         alt="Custom Stickers"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                         loading="lazy">
                </div>
                <div class="p-6">
                    <h3 class="text-feature font-bold text-box-title mb-3">Custom Stickers</h3>
                    <p class="text-body text-sm leading-relaxed mb-4">Create unique die-cut stickers, vinyl stickers, and more. Fully customizable shapes, sizes, and finishes to match your brand perfectly.</p>
                    <a href="/pages/custom-stickers" class="inline-flex items-center gap-1 text-accent text-sm font-semibold hover:gap-2 transition-all duration-300">
                        Learn More
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Card 2: Industry Solutions --}}
            <div class="bg-white rounded-lg overflow-hidden shadow-light hover:shadow-medium transition-all duration-300 group">
                <div class="relative overflow-hidden aspect-[16/10]">
                    <img src="/images/info-industry.jpg"
                         alt="Industry Solutions"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                         loading="lazy">
                </div>
                <div class="p-6">
                    <h3 class="text-feature font-bold text-box-title mb-3">Industry Solutions</h3>
                    <p class="text-body text-sm leading-relaxed mb-4">Tailored label solutions for breweries, cosmetics, food & beverage, pharmaceuticals, and more. Compliance-ready for any industry.</p>
                    <a href="/industries" class="inline-flex items-center gap-1 text-accent text-sm font-semibold hover:gap-2 transition-all duration-300">
                        Explore Industries
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Card 3: Blank Labels --}}
            <div class="bg-white rounded-lg overflow-hidden shadow-light hover:shadow-medium transition-all duration-300 group">
                <div class="relative overflow-hidden aspect-[16/10]">
                    <img src="/images/info-blank-labels.jpg"
                         alt="Blank Labels"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                         loading="lazy">
                </div>
                <div class="p-6">
                    <h3 class="text-feature font-bold text-box-title mb-3">Blank Labels</h3>
                    <p class="text-body text-sm leading-relaxed mb-4">Wholesale blank labels on rolls and sheets. Perfect for thermal printing, barcode, shipping, and more.</p>
                    <a href="/pages/blank-labels" class="inline-flex items-center gap-1 text-accent text-sm font-semibold hover:gap-2 transition-all duration-300">
                        Learn More
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ====================================================================
   6. CERTIFICATES
   ==================================================================== --}}

<x-certificates-carousel :certificates="$certificates" />

{{-- ====================================================================
   7. VIDEO + ABOUT SECTION  (Admin Configurable)
   ==================================================================== --}}

<section class="py-16 bg-white">
    <div class="max-w-[1200px] mx-auto px-6">
        <div class="grid grid-cols-1 tablet:grid-cols-2 gap-10 items-center">
            {{-- Left: Text --}}
            <div>
                <h2 class="text-page-title font-bold text-box-title mb-6">{{ $expertiseTitle ?? 'Expertise Is More Than Just Words' }}</h2>
                @php
                    $paragraphs = array_filter(explode("\n", $expertiseContent ?? ''), fn($line) => trim($line) !== '');
                    $lastIndex = count($paragraphs) - 1;
                @endphp
                @foreach($paragraphs as $i => $paragraph)
                    <p class="text-body leading-relaxed {{ $i < $lastIndex ? 'mb-6' : 'mb-8' }}">
                        {{ trim($paragraph) }}
                    </p>
                @endforeach
                @if($expertiseButtonText ?? 'More About Us')
                    <a href="{{ $expertiseButtonLink ?? '/pages/MeisaiPrinting' }}" class="btn-primary inline-block px-8 py-3">
                        {{ $expertiseButtonText ?? 'More About Us' }}
                        <svg class="w-4 h-4 inline-block ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                        </svg>
                    </a>
                @endif
            </div>

            {{-- Right: Video --}}
            <div class="relative aspect-video bg-black/5 rounded-lg overflow-hidden shadow-medium">
                @if($expertiseVideoEmbed ?? '')
                    {{-- YouTube embed (lazy-loaded iframe) --}}
                    <iframe src="{{ $expertiseVideoEmbed }}"
                            class="w-full h-full"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen
                            loading="lazy"
                            title="YouTube Video"></iframe>
                @else
                    {{-- Default placeholder when no video URL is set --}}
                    <div class="absolute inset-0 flex items-center justify-center bg-box-title/5">
                        <div class="text-center">
                            <div class="w-20 h-20 rounded-full bg-brand/90 flex items-center justify-center mx-auto mb-4 hover:bg-brand-hover transition-all duration-300 cursor-pointer shadow-medium">
                                <svg class="w-8 h-8 text-white ml-1" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z"/>
                                </svg>
                            </div>
                            <p class="text-body text-sm font-semibold">Watch Our Factory Tour</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- ====================================================================
   8. BLOG SECTION
   ==================================================================== --}}

<section class="py-16 bg-bg-form">
    <div class="max-w-[1200px] mx-auto px-6">
        <div class="text-center mb-10">
            <h2 class="section-heading mb-3">More Information About Stickers?</h2>
            <p class="text-body text-base max-w-2xl mx-auto">Stay updated with the latest tips, trends, and insights in the custom sticker and label industry.</p>
        </div>

        <div class="relative" x-data="{}" x-init="
            document.addEventListener('DOMContentLoaded', function() {
                if (typeof window.initSwiper === 'function' && document.querySelector('#blog-carousel')) {
                    window.initSwiper('#blog-carousel', {
                        loop: true,
                        autoplay: {
                            delay: 5000,
                            disableOnInteraction: false,
                        },
                        slidesPerView: 1,
                        spaceBetween: 24,
                        navigation: {
                            nextEl: '#blog-carousel .swiper-button-next',
                            prevEl: '#blog-carousel .swiper-button-prev',
                        },
                        pagination: {
                            el: '#blog-carousel .swiper-pagination',
                            clickable: true,
                        },
                        breakpoints: {
                            480: { slidesPerView: 2 },
                            768: { slidesPerView: 3 },
                        },
                    });
                }
            });
        ">
            <div class="swiper" id="blog-carousel">
                <div class="swiper-wrapper">
                    @foreach($latestPosts as $post)
                        <div class="swiper-slide">
                            <x-blog-card :post="$post" />
                        </div>
                    @endforeach
                </div>

                {{-- Navigation --}}
                <div class="swiper-button-prev !text-brand !left-0"></div>
                <div class="swiper-button-next !text-brand !right-0"></div>

                {{-- Pagination --}}
                <div class="swiper-pagination !relative mt-8"></div>
            </div>
        </div>
    </div>
</section>

{{-- ====================================================================
   9. BEST-SELLING STICKERS
   ==================================================================== --}}

<section class="py-16 bg-white">
    <div class="max-w-[1200px] mx-auto px-6">
        <div class="text-center mb-10">
            <h2 class="section-heading mb-3">Best-Selling Products</h2>
            <p class="text-body text-base max-w-2xl mx-auto">Discover our most popular custom stickers and labels, trusted by businesses worldwide for quality and reliability.</p>
        </div>

        <div class="grid grid-cols-2 tablet:grid-cols-4 gap-4 mobile:gap-6">
            @foreach($bestSellers->take(4) as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>

        <div class="text-center mt-10">
            <a href="/pages/custom-stickers" class="btn-primary inline-block px-10 py-4 text-base">View All Products</a>
        </div>
    </div>
</section>

@endsection
