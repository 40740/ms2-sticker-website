@extends('layouts.app', [
    'seoTitle' => "{$product->name} – MeisaiPrinting",
    'seoDescription' => $product->description ?? "Professional custom {$product->name}. Factory direct pricing. FSC, UL, CSA certified. Get an instant quote.",
    'transparentOnTop' => false,
])

@section('content')
    {{-- 1. Hero Banner – Split Layout --}}
    <section class="bg-box-title">
        <div class="max-w-[1200px] mx-auto px-6 py-16 mobile:py-20">
            <div class="grid grid-cols-1 mobile:grid-cols-2 gap-10 items-center">
                {{-- Left: Text --}}
                <div>
                    <h1 class="text-white text-3xl mobile:text-4xl tablet:text-page-title font-bold leading-tight mb-6">
                        {{ $product->hero_title ?? $product->name }}
                    </h1>
                    @isset($product->hero_subtitle)
                        <p class="text-white/80 text-base mobile:text-lg leading-relaxed mb-8">
                            {{ $product->hero_subtitle }}
                        </p>
                    @endisset
                    @isset($product->description)
                        @empty($product->hero_subtitle)
                            <p class="text-white/80 text-base mobile:text-lg leading-relaxed mb-8">
                                {{ $product->description }}
                            </p>
                        @endempty
                    @endisset
                    <a href="#quote-form" class="btn-primary inline-block text-base px-10 py-4">
                        Get an Instant Quote
                    </a>
                </div>

                {{-- Right: Product Image --}}
                <div class="flex justify-center mobile:justify-end">
                    <div class="w-full max-w-md overflow-hidden rounded-lg">
                        @php
                            $showHeroImage = $product->hero_image ?: ($product->image ?: ($product->category->image ?? null));
                            if ($showHeroImage && !str_starts_with($showHeroImage, '/') && !str_starts_with($showHeroImage, 'http')) {
                                $showHeroImage = '/' . ltrim($showHeroImage, '/');
                            }
                            if (!$showHeroImage) {
                                $showHeroImage = '/images/product-placeholder.jpg';
                            }
                        @endphp
                        <img src="{{ $showHeroImage }}"
                             alt="{{ $product->name }}"
                             class="w-full h-auto object-cover"
                             onerror="this.src='/images/product-placeholder.jpg'"
                             loading="eager">
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 2. Trust Badges --}}
    <x-trust-badges />

    {{-- 3. Features --}}
    @if(is_array($product->features) && count($product->features) > 0)
        <section class="py-16 bg-white">
            <div class="max-w-[1200px] mx-auto px-6">
                <h2 class="text-[40px] font-bold text-[#3C4043] text-center mb-12">
                    Features of Our {{ $product->name }}
                </h2>

                <div class="grid grid-cols-1 tablet:grid-cols-2 desktop:grid-cols-3 gap-6">
                    @foreach($product->features as $feature)
                        @php
                            // Support both string array ["text"] and object array [{title, description, image}]
                            if (is_string($feature)) {
                                $title = $feature;
                                $description = '';
                                $image = null;
                            } else {
                                $title = $feature['title'] ?? '';
                                $description = $feature['description'] ?? '';
                                $image = $feature['image'] ?? null;
                            }
                        @endphp
                        <div class="bg-white border border-gray-100 rounded-lg p-5 shadow-light hover:shadow-medium transition-all duration-300 group">
                            {{-- Feature Image --}}
                            @if($image)
                                <div class="relative overflow-hidden h-36 mb-4 rounded-md">
                                    <img src="{{ $image }}"
                                         alt="{{ $title }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                         loading="lazy">
                                </div>
                            @endif

                            {{-- Feature Content --}}
                            <div>
                                <h3 class="text-feature font-bold text-box-title mb-2 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-brand flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    {{ $title }}
                                </h3>
                                @if($description)
                                    <p class="text-body text-sm leading-relaxed">{{ $description }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- 4. 4 Easy Steps --}}
    @if(is_array($product->steps) && count($product->steps) > 0)
        <x-steps-section
            :stepsTitle="$product->steps_title ?? '4 Easy Steps'"
            :steps="$product->steps" />
    @endif

    {{-- 5. Concerns / Solutions --}}
    @if(is_array($product->concerns) && count($product->concerns) > 0)
        <x-concerns-grid :concerns="$product->concerns" />
    @endif

    {{-- 6. Contact CTA --}}
    <section class="py-16 bg-brand">
        <div class="max-w-[1200px] mx-auto px-6 text-center">
            <h2 class="text-white text-3xl mobile:text-4xl font-bold mb-4">
                Still Have Question? Need Help?
            </h2>
            <p class="text-white/80 text-base max-w-xl mx-auto mb-8">
                Our expert team is ready to assist you with any questions about our {{ $product->name }}. Get in touch today!
            </p>
            <a href="#quote-form" class="bg-white text-brand font-semibold rounded-[35px] px-10 py-4 text-base hover:bg-gray-100 transition-all duration-300 inline-block">
                Contact Now
            </a>
        </div>
    </section>

    {{-- 7. Testimonials --}}
    @if(is_array($product->testimonials) && count($product->testimonials) > 0)
        <x-testimonials-carousel :testimonials="$product->testimonials" />
    @endif

    {{-- 8. Brands Trust --}}
    @if($brands->count() > 0)
        <x-brands-section :brands="$brands" />
    @endif

    {{-- 9. Quote Form --}}
    <x-quote-form pageSource="product-{{ $product->slug }}" />

    {{-- 10. FAQ Accordion --}}
    @if($product->faqs->count() > 0)
        <x-faq-accordion :faqs="$product->faqs" :title="$product->name . ' FAQ'" />
    @endif

    {{-- 11. Popular Products / Related --}}
    @if($relatedProducts->count() > 0)
        <section class="py-16 bg-bg-form">
            <div class="max-w-[1200px] mx-auto px-6">
                <h2 class="section-heading text-center mb-10">Popular Products</h2>

                <div class="grid grid-cols-2 tablet:grid-cols-4 gap-6">
                    @foreach($relatedProducts as $relatedProduct)
                        <x-product-card :product="$relatedProduct" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
