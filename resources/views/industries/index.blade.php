@extends('layouts.app', [
    'seoTitle' => 'Industry Solutions – MeisaiPrinting',
    'seoDescription' => 'Tailored label and sticker solutions for breweries, cosmetics, food & beverage, pharmaceuticals, and more industries.',
    'transparentOnTop' => false,
])

@section('content')
    {{-- 1. Breadcrumb --}}
    <div class="max-w-[1200px] mx-auto px-6">
        <x-breadcrumb :items="[
            ['title' => 'Industries'],
        ]" />
    </div>

    {{-- 2. Hero Banner --}}
    <section class="relative w-full h-[400px] mobile:h-[500px] overflow-hidden">
        <div class="absolute inset-0">
            <img src="/images/industries-hero.jpg"
                 alt="Industry Solutions"
                 class="w-full h-full object-cover"
                 loading="eager">
            <div class="absolute inset-0 bg-black/45"></div>
        </div>

        <div class="relative z-10 h-full flex items-center justify-center text-center">
            <div class="max-w-[800px] mx-auto px-6">
                <h1 class="text-white text-3xl mobile:text-4xl tablet:text-hero font-bold leading-tight mb-4">
                    Labels & Stickers for Every Industry
                </h1>
                <p class="text-white/85 text-lg mobile:text-xl mb-6 max-w-xl mx-auto">
                    Industry-specific solutions designed to meet your unique requirements and compliance standards.
                </p>
                <a href="#quote-form" class="btn-primary inline-block text-base px-10 py-4">
                    Find Your Solution
                </a>
            </div>
        </div>
    </section>

    {{-- 3. Intro Text --}}
    <section class="py-16 bg-white">
        <div class="max-w-[1200px] mx-auto px-6">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-[58px] font-bold text-[#222] leading-tight mb-6">
                    Industry-Specific Solutions
                </h2>
                <p class="text-body text-base leading-relaxed mb-8">
                    At MeisaiPrinting, we understand that different industries have unique labeling requirements. Whether you need food-safe labels for the food & beverage industry, waterproof labels for breweries, or compliant labels for pharmaceuticals, we have the expertise and materials to deliver solutions that meet your specific needs. Our team works closely with businesses across various sectors to provide custom label and sticker solutions that enhance product appeal and ensure regulatory compliance.
                </p>
                <a href="#quote-form" class="btn-primary inline-block text-base px-10 py-4">
                    Get Industry-Specific Quote
                </a>
            </div>
        </div>
    </section>

    {{-- 4. Trust Badges --}}
    <x-trust-badges />

    {{-- 5. Industry Categories Grid --}}
    <section class="py-16 bg-bg-form">
        <div class="max-w-[1200px] mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="section-heading mb-4">Browse by Industry</h2>
                <p class="text-body text-base max-w-2xl mx-auto">
                    Find the perfect label or sticker solution for your specific industry.
                </p>
            </div>

            <div class="grid grid-cols-2 tablet:grid-cols-3 gap-6">
                @foreach($categories as $category)
                    @php
                        $firstProduct = $category->products->first();
                        $linkUrl = '/industries/' . $category->slug;
                        $categoryImage = $category->image;
                        if ($categoryImage && !str_starts_with($categoryImage, '/') && !str_starts_with($categoryImage, 'http')) {
                            $categoryImage = '/' . ltrim($categoryImage, '/');
                        }
                        if (!$categoryImage && $firstProduct && $firstProduct->image) {
                            $categoryImage = $firstProduct->image;
                            if (!str_starts_with($categoryImage, '/') && !str_starts_with($categoryImage, 'http')) {
                                $categoryImage = '/' . ltrim($categoryImage, '/');
                            }
                        }
                        if (!$categoryImage) {
                            $categoryImage = '/images/category-placeholder.jpg';
                        }
                    @endphp
                    <a href="{{ $linkUrl }}"
                       class="group block" id="{{ $category->slug }}">
                        <div class="overflow-hidden rounded-lg bg-white shadow-light hover:shadow-medium transition-all duration-300">
                            {{-- Category Image --}}
                            <div class="relative overflow-hidden aspect-[4/3] bg-bg-form">
                                <img src="{{ $categoryImage }}"
                                     alt="{{ $category->name }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                     loading="lazy">
                            </div>

                            {{-- Category Title --}}
                            <div class="p-4">
                                <h3 class="text-xl font-semibold text-black text-center truncate">
                                    {{ $category->hero_title ?? $category->name }}
                                </h3>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- 6. Global Reach Banner --}}
    <section class="relative w-full h-[350px] mobile:h-[400px] overflow-hidden">
        <div class="absolute inset-0">
            <img src="/images/global-reach-banner.jpg"
                 alt="Global Reach"
                 class="w-full h-full object-cover"
                 loading="lazy">
            <div class="absolute inset-0 bg-black/50"></div>
        </div>

        <div class="relative z-10 h-full flex items-center justify-center text-center">
            <div class="max-w-[700px] mx-auto px-6">
                <h2 class="text-white text-3xl mobile:text-4xl tablet:text-page-title font-bold leading-tight mb-6">
                    Trusted by Industry Leaders Worldwide
                </h2>
                <a href="#quote-form" class="btn-primary inline-block text-base px-10 py-4">
                    Get a Quote Now
                </a>
            </div>
        </div>
    </section>

    {{-- 7. Quote Form --}}
    <x-quote-form pageSource="industries" />

@endsection
