<?php $__env->startSection('content'); ?>

<style>
    /* Force Info Cards 3-column layout - overrides any Tailwind issue */
    @media (min-width: 1000px) {
        .info-cards-grid {
            display: grid !important;
            grid-template-columns: repeat(3, 1fr) !important;
        }
    }
</style>


<h1 class="sr-only">Custom Stickers & Labels – MeisaiPrinting</h1>



<?php if (isset($component)) { $__componentOriginal7c65c7b292d8ab163b5839aa2f2c30c5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7c65c7b292d8ab163b5839aa2f2c30c5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.hero-carousel','data' => ['slides' => $heroSlides]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('hero-carousel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['slides' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($heroSlides)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7c65c7b292d8ab163b5839aa2f2c30c5)): ?>
<?php $attributes = $__attributesOriginal7c65c7b292d8ab163b5839aa2f2c30c5; ?>
<?php unset($__attributesOriginal7c65c7b292d8ab163b5839aa2f2c30c5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7c65c7b292d8ab163b5839aa2f2c30c5)): ?>
<?php $component = $__componentOriginal7c65c7b292d8ab163b5839aa2f2c30c5; ?>
<?php unset($__componentOriginal7c65c7b292d8ab163b5839aa2f2c30c5); ?>
<?php endif; ?>



<section class="py-16 bg-white">
    <div class="max-w-[1200px] mx-auto px-6">
        <h2 class="section-heading text-center mb-10">What Are You Looking For?</h2>

        <div class="grid grid-cols-1 tablet:grid-cols-5 gap-6">
            
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



<?php if (isset($component)) { $__componentOriginalb46848292f41c207996399fc87b6e67b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb46848292f41c207996399fc87b6e67b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.quote-form','data' => ['pageSource' => 'homepage']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('quote-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['pageSource' => 'homepage']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb46848292f41c207996399fc87b6e67b)): ?>
<?php $attributes = $__attributesOriginalb46848292f41c207996399fc87b6e67b; ?>
<?php unset($__attributesOriginalb46848292f41c207996399fc87b6e67b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb46848292f41c207996399fc87b6e67b)): ?>
<?php $component = $__componentOriginalb46848292f41c207996399fc87b6e67b; ?>
<?php unset($__componentOriginalb46848292f41c207996399fc87b6e67b); ?>
<?php endif; ?>



<?php if (isset($component)) { $__componentOriginald1860217e247f31dc2f0bf9319aae99a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald1860217e247f31dc2f0bf9319aae99a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.trust-badges','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('trust-badges'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald1860217e247f31dc2f0bf9319aae99a)): ?>
<?php $attributes = $__attributesOriginald1860217e247f31dc2f0bf9319aae99a; ?>
<?php unset($__attributesOriginald1860217e247f31dc2f0bf9319aae99a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald1860217e247f31dc2f0bf9319aae99a)): ?>
<?php $component = $__componentOriginald1860217e247f31dc2f0bf9319aae99a; ?>
<?php unset($__componentOriginald1860217e247f31dc2f0bf9319aae99a); ?>
<?php endif; ?>



<section class="py-16 bg-bg-form">
    <div class="max-w-[1200px] mx-auto px-6">
        <div class="grid grid-cols-1 tablet:grid-cols-3 gap-6 info-cards-grid">
            
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



<?php if (isset($component)) { $__componentOriginal4ceff2adfaeb307b5fc5aca2ebab4662 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4ceff2adfaeb307b5fc5aca2ebab4662 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.certificates-carousel','data' => ['certificates' => $certificates]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('certificates-carousel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['certificates' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($certificates)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4ceff2adfaeb307b5fc5aca2ebab4662)): ?>
<?php $attributes = $__attributesOriginal4ceff2adfaeb307b5fc5aca2ebab4662; ?>
<?php unset($__attributesOriginal4ceff2adfaeb307b5fc5aca2ebab4662); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4ceff2adfaeb307b5fc5aca2ebab4662)): ?>
<?php $component = $__componentOriginal4ceff2adfaeb307b5fc5aca2ebab4662; ?>
<?php unset($__componentOriginal4ceff2adfaeb307b5fc5aca2ebab4662); ?>
<?php endif; ?>



<section class="py-16 bg-white">
    <div class="max-w-[1200px] mx-auto px-6">
        <div class="grid grid-cols-1 tablet:grid-cols-2 gap-10 items-center">
            
            <div>
                <h2 class="text-page-title font-bold text-box-title mb-6"><?php echo e($expertiseTitle ?? 'Expertise Is More Than Just Words'); ?></h2>
                <?php
                    $paragraphs = array_filter(explode("\n", $expertiseContent ?? ''), fn($line) => trim($line) !== '');
                    $lastIndex = count($paragraphs) - 1;
                ?>
                <?php $__currentLoopData = $paragraphs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $paragraph): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <p class="text-body leading-relaxed <?php echo e($i < $lastIndex ? 'mb-6' : 'mb-8'); ?>">
                        <?php echo e(trim($paragraph)); ?>

                    </p>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php if($expertiseButtonText ?? 'More About Us'): ?>
                    <a href="<?php echo e($expertiseButtonLink ?? '/pages/MeisaiPrinting'); ?>" class="btn-primary inline-block px-8 py-3">
                        <?php echo e($expertiseButtonText ?? 'More About Us'); ?>

                        <svg class="w-4 h-4 inline-block ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                        </svg>
                    </a>
                <?php endif; ?>
            </div>

            
            <div class="relative aspect-video bg-black/5 rounded-lg overflow-hidden shadow-medium">
                <?php if($expertiseVideoEmbed ?? ''): ?>
                    
                    <iframe src="<?php echo e($expertiseVideoEmbed); ?>"
                            class="w-full h-full"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen
                            loading="lazy"
                            title="YouTube Video"></iframe>
                <?php else: ?>
                    
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
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>



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
                    <?php $__currentLoopData = $latestPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="swiper-slide">
                            <?php if (isset($component)) { $__componentOriginalef84dbe2113ee1aa06beffddb73fe07d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalef84dbe2113ee1aa06beffddb73fe07d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.blog-card','data' => ['post' => $post]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('blog-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['post' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($post)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalef84dbe2113ee1aa06beffddb73fe07d)): ?>
<?php $attributes = $__attributesOriginalef84dbe2113ee1aa06beffddb73fe07d; ?>
<?php unset($__attributesOriginalef84dbe2113ee1aa06beffddb73fe07d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalef84dbe2113ee1aa06beffddb73fe07d)): ?>
<?php $component = $__componentOriginalef84dbe2113ee1aa06beffddb73fe07d; ?>
<?php unset($__componentOriginalef84dbe2113ee1aa06beffddb73fe07d); ?>
<?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                
                <div class="swiper-button-prev !text-brand !left-0"></div>
                <div class="swiper-button-next !text-brand !right-0"></div>

                
                <div class="swiper-pagination !relative mt-8"></div>
            </div>
        </div>
    </div>
</section>



<section class="py-16 bg-white">
    <div class="max-w-[1200px] mx-auto px-6">
        <div class="text-center mb-10">
            <h2 class="section-heading mb-3">Best-Selling Products</h2>
            <p class="text-body text-base max-w-2xl mx-auto">Discover our most popular custom stickers and labels, trusted by businesses worldwide for quality and reliability.</p>
        </div>

        <div class="grid grid-cols-2 tablet:grid-cols-4 gap-4 mobile:gap-6">
            <?php $__currentLoopData = $bestSellers->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if (isset($component)) { $__componentOriginal3fd2897c1d6a149cdb97b41db9ff827a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3fd2897c1d6a149cdb97b41db9ff827a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.product-card','data' => ['product' => $product]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('product-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['product' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3fd2897c1d6a149cdb97b41db9ff827a)): ?>
<?php $attributes = $__attributesOriginal3fd2897c1d6a149cdb97b41db9ff827a; ?>
<?php unset($__attributesOriginal3fd2897c1d6a149cdb97b41db9ff827a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3fd2897c1d6a149cdb97b41db9ff827a)): ?>
<?php $component = $__componentOriginal3fd2897c1d6a149cdb97b41db9ff827a; ?>
<?php unset($__componentOriginal3fd2897c1d6a149cdb97b41db9ff827a); ?>
<?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="text-center mt-10">
            <a href="/pages/custom-stickers" class="btn-primary inline-block px-10 py-4 text-base">View All Products</a>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', [
    'transparentOnTop' => true,
], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\ms2\resources\views/pages/home.blade.php ENDPATH**/ ?>