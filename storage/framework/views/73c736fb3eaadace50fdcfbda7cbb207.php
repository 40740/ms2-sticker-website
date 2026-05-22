<?php $__env->startSection('content'); ?>
    
    <div class="max-w-[1200px] mx-auto px-6">
        <?php if (isset($component)) { $__componentOriginale19f62b34dfe0bfdf95075badcb45bc2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale19f62b34dfe0bfdf95075badcb45bc2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.breadcrumb','data' => ['items' => [
            ['title' => 'Shapes'],
        ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
            ['title' => 'Shapes'],
        ])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale19f62b34dfe0bfdf95075badcb45bc2)): ?>
<?php $attributes = $__attributesOriginale19f62b34dfe0bfdf95075badcb45bc2; ?>
<?php unset($__attributesOriginale19f62b34dfe0bfdf95075badcb45bc2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale19f62b34dfe0bfdf95075badcb45bc2)): ?>
<?php $component = $__componentOriginale19f62b34dfe0bfdf95075badcb45bc2; ?>
<?php unset($__componentOriginale19f62b34dfe0bfdf95075badcb45bc2); ?>
<?php endif; ?>
    </div>

    
    <section class="relative w-full h-[400px] mobile:h-[500px] overflow-hidden">
        <div class="absolute inset-0">
            <img src="/images/shapes-hero.jpg"
                 alt="Custom Shapes"
                 class="w-full h-full object-cover"
                 loading="eager">
            <div class="absolute inset-0 bg-black/45"></div>
        </div>

        <div class="relative z-10 h-full flex items-center justify-center text-center">
            <div class="max-w-[800px] mx-auto px-6">
                <h1 class="text-white text-3xl mobile:text-4xl tablet:text-hero font-bold leading-tight mb-4">
                    Any Shape You Can Imagine
                </h1>
                <p class="text-white/85 text-lg mobile:text-xl mb-6 max-w-xl mx-auto">
                    From classic circles to custom die-cut shapes, bring your brand to life with perfectly shaped stickers and labels.
                </p>
                <a href="#quote-form" class="btn-primary inline-block text-base px-10 py-4">
                    Design Your Shape
                </a>
            </div>
        </div>
    </section>

    
    <section class="py-16 bg-white">
        <div class="max-w-[1200px] mx-auto px-6">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-[58px] font-bold text-[#222] leading-tight mb-6">
                    Custom Shapes for Every Need
                </h2>
                <p class="text-body text-base leading-relaxed mb-8">
                    At MeisaiPrinting, we offer an incredible variety of shapes for your custom stickers and labels. Whether you need standard shapes like circles, squares, or ovals, or want something unique like custom die-cut shapes that match your logo, we have the capabilities to make it happen. Our advanced cutting technology ensures precise, professional results every time, while our variety of materials ensures your shaped stickers look great and last long.
                </p>
                <a href="#quote-form" class="btn-primary inline-block text-base px-10 py-4">
                    Get a Custom Quote
                </a>
            </div>
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

    
    <?php if($stickerShapes->count() > 0): ?>
        <section class="py-16 bg-white">
            <div class="max-w-[1200px] mx-auto px-6">
                <div class="text-center mb-12">
                    <h2 class="section-heading mb-4">Sticker Shapes</h2>
                    <p class="text-body text-base max-w-2xl mx-auto">
                        Perfect for promotional stickers, product labels, and branding applications.
                    </p>
                </div>

                <div class="grid grid-cols-2 tablet:grid-cols-4 gap-6">
                    <?php $__currentLoopData = $stickerShapes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $linkUrl = '/shapes/' . $category->slug;
                            $categoryImage = $category->image;
                            if ($categoryImage && !str_starts_with($categoryImage, '/') && !str_starts_with($categoryImage, 'http')) {
                                $categoryImage = '/' . ltrim($categoryImage, '/');
                            }
                            if (!$categoryImage) {
                                $categoryImage = '/images/category-placeholder.jpg';
                            }
                        ?>
                        <a href="<?php echo e($linkUrl); ?>" class="group block">
                            <div class="overflow-hidden rounded-lg bg-bg-form shadow-light hover:shadow-medium transition-all duration-300">
                                <div class="relative overflow-hidden aspect-square">
                                    <img src="<?php echo e($categoryImage); ?>"
                                         alt="<?php echo e($category->name); ?>"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                         loading="lazy">
                                </div>
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold text-black text-center truncate">
                                        <?php echo e($category->name); ?>

                                    </h3>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    
    <?php if($labelShapes->count() > 0): ?>
        <section class="py-16 bg-bg-form">
            <div class="max-w-[1200px] mx-auto px-6">
                <div class="text-center mb-12">
                    <h2 class="section-heading mb-4">Label Shapes</h2>
                    <p class="text-body text-base max-w-2xl mx-auto">
                        Ideal for product labels, packaging, and industrial applications.
                    </p>
                </div>

                <div class="grid grid-cols-2 tablet:grid-cols-4 gap-6">
                    <?php $__currentLoopData = $labelShapes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $linkUrl = '/shapes/' . $category->slug;
                            $categoryImage = $category->image;
                            if ($categoryImage && !str_starts_with($categoryImage, '/') && !str_starts_with($categoryImage, 'http')) {
                                $categoryImage = '/' . ltrim($categoryImage, '/');
                            }
                            if (!$categoryImage) {
                                $categoryImage = '/images/category-placeholder.jpg';
                            }
                        ?>
                        <a href="<?php echo e($linkUrl); ?>" class="group block">
                            <div class="overflow-hidden rounded-lg bg-white shadow-light hover:shadow-medium transition-all duration-300">
                                <div class="relative overflow-hidden aspect-square">
                                    <img src="<?php echo e($categoryImage); ?>"
                                         alt="<?php echo e($category->name); ?>"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                         loading="lazy">
                                </div>
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold text-black text-center truncate">
                                        <?php echo e($category->name); ?>

                                    </h3>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    
    <section class="py-16 bg-white">
        <div class="max-w-[1200px] mx-auto px-6">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-[58px] font-bold text-[#222] leading-tight mb-6">
                    Need a Custom Shape?
                </h2>
                <p class="text-body text-base leading-relaxed mb-8">
                    Don't see your perfect shape? Upload your design or describe your needs, and our team will create a custom die-cut shape just for you.
                </p>
                <a href="#quote-form" class="btn-primary inline-block text-base px-10 py-4">
                    Request Custom Shape Quote
                </a>
            </div>
        </div>
    </section>

    
    <?php if (isset($component)) { $__componentOriginalb46848292f41c207996399fc87b6e67b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb46848292f41c207996399fc87b6e67b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.quote-form','data' => ['pageSource' => 'shapes']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('quote-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['pageSource' => 'shapes']); ?>
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', [
    'seoTitle' => 'Custom Shapes – MeisaiPrinting',
    'seoDescription' => 'Custom die-cut, kiss-cut, and shaped stickers and labels. Circle, square, heart, and any custom shape you need.',
    'transparentOnTop' => false,
], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\ms2\resources\views/shapes/index.blade.php ENDPATH**/ ?>