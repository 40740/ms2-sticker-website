@extends('layouts.app', [
    'seoTitle' => 'Blank Labels – MeisaiPrinting',
    'seoDescription' => 'Wholesale blank labels on rolls and sheets. Perfect for thermal printing, barcode labels, shipping labels, and more.',
    'transparentOnTop' => false,
])

@section('content')
    {{-- 1. Breadcrumb --}}
    <div class="max-w-[1200px] mx-auto px-6">
        <x-breadcrumb :items="[
            ['title' => 'Blank Labels'],
        ]" />
    </div>

    {{-- 2. Hero Banner --}}
    <section class="relative w-full h-[400px] mobile:h-[500px] overflow-hidden">
        <div class="absolute inset-0">
            <img src="/images/blank-labels-hero.jpg"
                 alt="Blank Labels"
                 class="w-full h-full object-cover"
                 loading="eager">
            <div class="absolute inset-0 bg-black/45"></div>
        </div>

        <div class="relative z-10 h-full flex items-center justify-center text-center">
            <div class="max-w-[800px] mx-auto px-6">
                <h1 class="text-white text-3xl mobile:text-4xl tablet:text-hero font-bold leading-tight mb-4">
                    Wholesale Blank Labels for Every Application
                </h1>
                <p class="text-white/85 text-lg mobile:text-xl mb-6 max-w-xl mx-auto">
                    High-quality blank labels on rolls and sheets. Perfect for thermal printers, inkjet printers, and direct printing.
                </p>
                <a href="#quote-form" class="btn-primary inline-block text-base px-10 py-4">
                    Request Wholesale Quote
                </a>
            </div>
        </div>
    </section>

    {{-- 3. Intro Text --}}
    <section class="py-8 bg-white">
        <div class="max-w-[1200px] mx-auto px-6">
            <p class="text-body text-base leading-relaxed max-w-3xl mx-auto text-center">
                At MeisaiPrinting, we offer a comprehensive range of blank labels designed for various printing methods and applications. Whether you need thermal labels for shipping, barcode labels for inventory management, or blank product labels for your own printing needs, we have the perfect solution. Our blank labels are available in multiple materials, sizes, and formats including rolls and sheets to fit your specific equipment and workflow.
            </p>
        </div>
    </section>

    {{-- 4. Trust Badges --}}
    <x-trust-badges />

    {{-- 5. Product Grid --}}
    <section class="py-16 bg-bg-form">
        <div class="max-w-[1200px] mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="section-heading mb-4">Choose Your Blank Label Type</h2>
                <p class="text-body text-base max-w-2xl mx-auto">
                    Browse our selection of blank labels for various applications and printing methods.
                </p>
            </div>

            <div class="grid grid-cols-2 tablet:grid-cols-4 gap-6">
                @foreach($categories->filter(fn($cat) => $cat->products->count() > 0) as $category)
                    @php
                        $firstProduct = $category->products->first();
                        $linkUrl = '/products/' . $firstProduct->slug;
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
                            <div class="relative overflow-hidden aspect-square bg-bg-form">
                                <img src="{{ $categoryImage }}"
                                     alt="{{ $category->name }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                     loading="lazy">
                            </div>

                            {{-- Category Title --}}
                            <div class="p-4">
                                <h3 class="text-[24px] font-semibold text-black text-center truncate">
                                    {{ $category->name }}
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
                    Wholesale Pricing for Bulk Orders
                </h2>
                <a href="#quote-form" class="btn-primary inline-block text-base px-10 py-4">
                    Get a Quote Now
                </a>
            </div>
        </div>
    </section>

    {{-- 7. Quote Form --}}
    <x-quote-form pageSource="blank-labels" />

    {{-- 8. FAQ Accordion --}}
    @if($faqs->count() > 0)
        <x-faq-accordion :faqs="$faqs" :title="'Blank Labels FAQ'" />
    @endif
@endsection
