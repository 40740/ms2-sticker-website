@extends('layouts.app', [
    'seoTitle' => "Custom {$typeLabel}s – MeisaiPrinting",
    'seoDescription' => "Professional custom {$typeLabel} printing. 24 years of experience. FSC, UL, CSA certified. Factory direct pricing. Browse our {$typeLabel} catalog.",
    'transparentOnTop' => false,
])

@section('content')
    {{-- 1. Breadcrumb --}}
    <div class="max-w-[1200px] mx-auto px-6">
        <x-breadcrumb :items="[
            ['title' => "Custom {$typeLabel}s"],
        ]" />
    </div>

    {{-- 2. Hero Banner --}}
    <section class="relative w-full h-[400px] mobile:h-[500px] overflow-hidden">
        <div class="absolute inset-0">
            @if($type === 'sticker')
                <img src="/images/sticker-catalog-hero.jpg"
                     alt="Custom Stickers"
                     class="w-full h-full object-cover"
                     loading="eager">
            @else
                <img src="/images/label-catalog-hero.jpg"
                     alt="Custom Labels"
                     class="w-full h-full object-cover"
                     loading="eager">
            @endif
            <div class="absolute inset-0 bg-black/45"></div>
        </div>

        <div class="relative z-10 h-full flex items-center justify-center text-center">
            <div class="max-w-[800px] mx-auto px-6">
                <h1 class="text-white text-3xl mobile:text-4xl tablet:text-hero font-bold leading-tight mb-4">
                    A {{ $typeLabel }} Manufacturer You Can Trust For OEM &amp; ODM!
                </h1>
                <p class="text-white/85 text-lg mobile:text-xl mb-6 max-w-xl mx-auto">
                    24 years of professional {{ strtolower($typeLabel) }} manufacturing experience. Quality, speed, and reliability you can count on.
                </p>
                <a href="#quote-form" class="btn-primary inline-block text-base px-10 py-4">
                    Learn More
                </a>
            </div>
        </div>
    </section>

    {{-- 3. Intro Text --}}
    <section class="py-8 bg-white">
        <div class="max-w-[1200px] mx-auto px-6">
            <p class="text-body text-base leading-relaxed max-w-3xl mx-auto text-center">
                @if($type === 'sticker')
                    As a leading custom sticker manufacturer with over 24 years of experience, MeisaiPrinting delivers premium adhesive solutions for businesses worldwide. From die-cut stickers to vinyl decals, we offer a full range of custom sticker products with OEM &amp; ODM services. Our FSC, UL, and CSA certifications ensure every sticker meets the highest quality and safety standards. Whether you need product labels, promotional stickers, or specialty adhesive solutions, our factory-direct pricing and fast delivery make us the trusted choice.
                @else
                    As a leading custom label manufacturer with over 24 years of experience, MeisaiPrinting delivers premium labeling solutions for businesses worldwide. From food labels to pharmaceutical labels, we offer a full range of custom label products with OEM &amp; ODM services. Our FSC, UL, and CSA certifications ensure every label meets the highest quality and safety standards. Whether you need product labels, warning labels, or specialty labeling solutions, our factory-direct pricing and fast delivery make us the trusted choice.
                @endif
            </p>
        </div>
    </section>

    {{-- 4. Trust Badges --}}
    <x-trust-badges />

    {{-- 5. Product Grid --}}
    <section class="py-16 bg-bg-form">
        <div class="max-w-[1200px] mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="section-heading mb-4">Choose from our extensive product range…</h2>
                <p class="text-body text-base max-w-2xl mx-auto">
                    Browse our wide selection of custom {{ strtolower($typeLabel) }} categories to find the perfect solution for your needs.
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
                        // Fallback to first product image
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
                    Global Reach – Made in China, Trusted Worldwide
                </h2>
                <a href="#quote-form" class="btn-primary inline-block text-base px-10 py-4">
                    Get a Quote Now
                </a>
            </div>
        </div>
    </section>

    {{-- 7. Quote Form --}}
    <x-quote-form pageSource="{{ $type }}-catalog" />

    {{-- 8. FAQ Accordion --}}
    @if($faqs->count() > 0)
        <x-faq-accordion :faqs="$faqs" :title="'Custom ' . $typeLabel . 's FAQ'" />
    @endif
@endsection
