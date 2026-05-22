<?php $__env->startSection('content'); ?>
    
    <div class="max-w-[1200px] mx-auto px-6">
        <x-breadcrumb :items="[
            ['title' => "Custom {$typeLabel}s"],
        ]" />
    </div>

    
    <section class="relative w-full h-[400px] mobile:h-[500px] overflow-hidden">
        <div class="absolute inset-0">
            <?php if($type === 'sticker'): ?>
                <img src="/images/sticker-catalog-hero.jpg"
                     alt="Custom Stickers"
                     class="w-full h-full object-cover"
                     loading="eager">
            <?php else: ?>
                <img src="/images/label-catalog-hero.jpg"
                     alt="Custom Labels"
                     class="w-full h-full object-cover"
                     loading="eager">
            <?php endif; ?>
            <div class="absolute inset-0 bg-black/45"></div>
        </div>

        <div class="relative z-10 h-full flex items-center justify-center text-center">
            <div class="max-w-[800px] mx-auto px-6">
                <h1 class="text-white text-3xl mobile:text-4xl tablet:text-hero font-bold leading-tight mb-4">
                    A <?php echo e($typeLabel); ?> Manufacturer You Can Trust For OEM &amp; ODM!
                </h1>
                <p class="text-white/85 text-lg mobile:text-xl mb-6 max-w-xl mx-auto">
                    24 years of professional <?php echo e(strtolower($typeLabel)); ?> manufacturing experience. Quality, speed, and reliability you can count on.
                </p>
                <a href="#quote-form" class="btn-primary inline-block text-base px-10 py-4">
                    Learn More
                </a>
            </div>
        </div>
    </section>

    
    <section class="py-8 bg-white">
        <div class="max-w-[1200px] mx-auto px-6">
            <p class="text-body text-base leading-relaxed max-w-3xl mx-auto text-center">
                <?php if($type === 'sticker'): ?>
                    As a leading custom sticker manufacturer with over 24 years of experience, MeisaiPrinting delivers premium adhesive solutions for businesses worldwide. From die-cut stickers to vinyl decals, we offer a full range of custom sticker products with OEM &amp; ODM services. Our FSC, UL, and CSA certifications ensure every sticker meets the highest quality and safety standards. Whether you need product labels, promotional stickers, or specialty adhesive solutions, our factory-direct pricing and fast delivery make us the trusted choice.
                <?php else: ?>
                    As a leading custom label manufacturer with over 24 years of experience, MeisaiPrinting delivers premium labeling solutions for businesses worldwide. From food labels to pharmaceutical labels, we offer a full range of custom label products with OEM &amp; ODM services. Our FSC, UL, and CSA certifications ensure every label meets the highest quality and safety standards. Whether you need product labels, warning labels, or specialty labeling solutions, our factory-direct pricing and fast delivery make us the trusted choice.
                <?php endif; ?>
            </p>
        </div>
    </section>

    
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
            <div class="text-center mb-12">
                <h2 class="section-heading mb-4">Choose from our extensive product range…</h2>
                <p class="text-body text-base max-w-2xl mx-auto">
                    Browse our wide selection of custom <?php echo e(strtolower($typeLabel)); ?> categories to find the perfect solution for your needs.
                </p>
            </div>

            <div class="grid grid-cols-2 tablet:grid-cols-4 gap-6">
                <?php $__currentLoopData = $categories->filter(fn($cat) => $cat->products->count() > 0); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
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
                    ?>
                    <a href="<?php echo e($linkUrl); ?>"
                       class="group block" id="<?php echo e($category->slug); ?>">
                        <div class="overflow-hidden rounded-lg bg-white shadow-light hover:shadow-medium transition-all duration-300">
                            
                            <div class="relative overflow-hidden aspect-square bg-bg-form">
                                <img src="<?php echo e($categoryImage); ?>"
                                     alt="<?php echo e($category->name); ?>"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                     loading="lazy">
                            </div>

                            
                            <div class="p-4">
                                <h3 class="text-[24px] font-semibold text-black text-center truncate">
                                    <?php echo e($category->name); ?>

                                </h3>
                            </div>
                        </div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    
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

    
    <?php if (isset($component)) { $__componentOriginalb46848292f41c207996399fc87b6e67b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb46848292f41c207996399fc87b6e67b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.quote-form','data' => ['pageSource' => ''.e($type).'-catalog']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('quote-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['pageSource' => ''.e($type).'-catalog']); ?>
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

    
    <?php if($faqs->count() > 0): ?>
        <?php if (isset($component)) { $__componentOriginal5d1e16bf605b55f667e923c5493c639b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5d1e16bf605b55f667e923c5493c639b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.faq-accordion','data' => ['faqs' => $faqs,'title' => 'Custom ' . $typeLabel . 's FAQ']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('faq-accordion'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['faqs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($faqs),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('Custom ' . $typeLabel . 's FAQ')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5d1e16bf605b55f667e923c5493c639b)): ?>
<?php $attributes = $__attributesOriginal5d1e16bf605b55f667e923c5493c639b; ?>
<?php unset($__attributesOriginal5d1e16bf605b55f667e923c5493c639b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5d1e16bf605b55f667e923c5493c639b)): ?>
<?php $component = $__componentOriginal5d1e16bf605b55f667e923c5493c639b; ?>
<?php unset($__componentOriginal5d1e16bf605b55f667e923c5493c639b); ?>
<?php endif; ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', [
    'seoTitle' => "Custom {$typeLabel}s – MeisaiPrinting",
    'seoDescription' => "Professional custom {$typeLabel} printing. 24 years of experience. FSC, UL, CSA certified. Factory direct pricing. Browse our {$typeLabel} catalog.",
    'transparentOnTop' => false,
], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\ms2\resources\views/products/catalog.blade.php ENDPATH**/ ?>