<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['certificates' => []]));

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

foreach (array_filter((['certificates' => []]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<section class="py-16 bg-white">
    <div class="max-w-[1200px] mx-auto px-6">
        <h2 class="section-heading text-center mb-10">Professional Certificates</h2>

        <div class="relative" x-data="{
            lightboxOpen: false,
            lightboxImage: '',
            lightboxAlt: '',
            openLightbox(image, alt) {
                this.lightboxImage = image;
                this.lightboxAlt = alt;
                this.lightboxOpen = true;
                document.body.style.overflow = 'hidden';
            },
            closeLightbox() {
                this.lightboxOpen = false;
                this.lightboxImage = '';
                this.lightboxAlt = '';
                document.body.style.overflow = '';
            }
        }" x-init="
            document.addEventListener('DOMContentLoaded', function() {
                if (typeof window.initSwiper === 'function' && document.querySelector('#certificates-carousel')) {
                    window.initSwiper('#certificates-carousel', {
                        loop: true,
                        autoplay: {
                            delay: 3000,
                            disableOnInteraction: false,
                        },
                        slidesPerView: 2,
                        spaceBetween: 20,
                        navigation: {
                            nextEl: '#certificates-carousel .swiper-button-next',
                            prevEl: '#certificates-carousel .swiper-button-prev',
                        },
                        pagination: {
                            el: '#certificates-carousel .swiper-pagination',
                            clickable: true,
                        },
                        breakpoints: {
                            480: { slidesPerView: 3 },
                            768: { slidesPerView: 4 },
                            1000: { slidesPerView: 5 },
                        },
                    });
                }
            });
            // Close lightbox on Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    $dispatch('close-lightbox');
                }
            });
        " @close-lightbox.window="closeLightbox()">
            <div class="swiper" id="certificates-carousel">
                <div class="swiper-wrapper">
                    <?php $__currentLoopData = $certificates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $certificate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="swiper-slide">
                            <div class="flex items-center justify-center p-4 bg-white shadow-light hover:shadow-medium transition-all duration-300 rounded-lg cursor-pointer group"
                                 @click="openLightbox('<?php echo e(Storage::disk('uploads')->url($certificate->image)); ?>', '<?php echo e($certificate->name); ?>')">
                                <img src="<?php echo e(Storage::disk('uploads')->url($certificate->image)); ?>"
                                     alt="<?php echo e($certificate->name); ?>"
                                     class="w-full h-32 object-contain grayscale hover:grayscale-0 transition-all duration-300"
                                     loading="lazy">
                                
                                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-black/10 rounded-lg">
                                    <svg class="w-8 h-8 text-brand" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                
                <div class="swiper-button-prev !text-brand !left-0"></div>
                <div class="swiper-button-next !text-brand !right-0"></div>

                
                <div class="swiper-pagination !relative mt-6"></div>
            </div>

            
            <div x-show="lightboxOpen"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 z-50 flex items-center justify-center bg-black/90 backdrop-blur-sm"
                 @click="closeLightbox()"
                 x-cloak>
                
                <button @click="closeLightbox()" class="absolute top-4 right-4 text-white hover:text-brand transition-colors z-10">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>

                
                <div class="max-w-4xl max-h-[85vh] mx-4" @click.stop>
                    <img :src="lightboxImage"
                         :alt="lightboxAlt"
                         class="max-w-full max-h-[85vh] object-contain rounded-lg shadow-2xl">
                    <p class="text-white text-center mt-4 text-lg font-medium" x-text="lightboxAlt"></p>
                </div>

                
                <div class="absolute left-4 top-1/2 -translate-y-1/2" @click.stop>
                    <button class="swiper-button-prev !text-white hover:!text-brand transition-colors !static !w-12 !h-12 !rounded-full !bg-white/10 hover:!bg-white/20 backdrop-blur-sm"></button>
                </div>
                <div class="absolute right-4 top-1/2 -translate-y-1/2" @click.stop>
                    <button class="swiper-button-next !text-white hover:!text-brand transition-colors !static !w-12 !h-12 !rounded-full !bg-white/10 hover:!bg-white/20 backdrop-blur-sm"></button>
                </div>
            </div>
        </div>
    </div>
</section>
<?php /**PATH D:\laragon\www\ms2\resources\views/components/certificates-carousel.blade.php ENDPATH**/ ?>