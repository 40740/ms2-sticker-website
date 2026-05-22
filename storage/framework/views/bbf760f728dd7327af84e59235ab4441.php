<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['slides' => []]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['slides' => []]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php if(count($slides) > 0): ?>
<section class="relative w-full" x-data="{}" x-init="
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof window.initSwiper === 'function' && document.querySelector('#hero-carousel')) {
            window.initSwiper('#hero-carousel', {
                <?php if(count($slides) > 1): ?>
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                <?php else: ?>
                loop: false,
                autoplay: false,
                <?php endif; ?>
                pagination: {
                    el: '#hero-carousel .swiper-pagination',
                    clickable: true,
                },
                navigation: false,
                effect: 'fade',
                fadeEffect: {
                    crossFade: true,
                },
            });
        }
    });
">
    <div class="swiper" id="hero-carousel">
        <div class="swiper-wrapper">
            <?php $__currentLoopData = $slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="swiper-slide">
                    <div class="relative w-full h-[500px] mobile:h-[600px] tablet:h-[700px] overflow-hidden">
                        
                        <div class="absolute inset-0">
                            <img src="<?php echo e($slide['image'] ?? '/images/hero-default.jpg'); ?>"
                                 alt="<?php echo e($slide['title'] ?? 'Hero Slide'); ?>"
                                 class="w-full h-full object-cover"
                                 loading="lazy">
                            
                            <div class="absolute inset-0 bg-black/0"></div>
                        </div>

                        
                        <div class="relative z-10 h-full flex items-center">
                            <div class="max-w-[1200px] mx-auto px-6 w-full">
                                <div class="max-w-2xl mx-auto text-center">
                                    <?php if(isset($slide['subtitle'])): ?>
                                        <p class="text-white/90 text-lg mobile:text-xl mb-4 font-semibold uppercase tracking-wide">
                                            <?php echo e($slide['subtitle']); ?>

                                        </p>
                                    <?php endif; ?>
                                    <h2 class="text-white text-3xl mobile:text-4xl tablet:text-hero font-bold leading-tight mb-6">
                                        <?php echo e($slide['title'] ?? ''); ?>

                                    </h2>
                                    <?php if(isset($slide['cta_text'])): ?>
                                        <a href="<?php echo e($slide['cta_link'] ?? '#'); ?>"
                                           class="inline-flex items-center gap-2 bg-brand text-white text-base font-semibold px-8 py-4 rounded-lg shadow-lg hover:shadow-xl hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300">
                                            <?php echo e($slide['cta_text']); ?>

                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                                            </svg>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <?php if(count($slides) > 1): ?>
        
        <div class="swiper-pagination !bottom-8"></div>
        <?php endif; ?>
    </div>
</section>
<?php endif; ?>
<?php /**PATH D:\laragon\www\ms2\resources\views/components/hero-carousel.blade.php ENDPATH**/ ?>