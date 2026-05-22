<?php $__env->startSection('content'); ?>
    
    <div class="max-w-[1200px] mx-auto px-6">
        <?php if (isset($component)) { $__componentOriginale19f62b34dfe0bfdf95075badcb45bc2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale19f62b34dfe0bfdf95075badcb45bc2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.breadcrumb','data' => ['items' => [
            ['title' => 'Materials', 'url' => '/materials'],
            ['title' => $category->name],
        ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
            ['title' => 'Materials', 'url' => '/materials'],
            ['title' => $category->name],
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
            <?php if($category->hero_image): ?>
                <img src="<?php echo e($category->hero_image); ?>"
                     alt="<?php echo e($category->hero_title ?? $category->name); ?>"
                     class="w-full h-full object-cover"
                     loading="eager">
            <?php else: ?>
                <img src="/images/materials-hero.jpg"
                     alt="<?php echo e($category->name); ?>"
                     class="w-full h-full object-cover"
                     loading="eager">
            <?php endif; ?>
            <div class="absolute inset-0 bg-black/45"></div>
        </div>

        <div class="relative z-10 h-full flex items-center justify-center text-center">
            <div class="max-w-[800px] mx-auto px-6">
                <h1 class="text-white text-3xl mobile:text-4xl tablet:text-hero font-bold leading-tight mb-4">
                    <?php echo e($category->hero_title ?? "Custom {$category->name}"); ?>

                </h1>
                <p class="text-white/85 text-lg mobile:text-xl mb-6 max-w-xl mx-auto">
                    <?php echo e($category->hero_subtitle ?? "Premium {$category->name} for your custom labels and stickers."); ?>

                </p>
                <a href="#quote-form" class="btn-primary inline-block text-base px-10 py-4">
                    Request Quote
                </a>
            </div>
        </div>
    </section>

    
    <section class="py-8 bg-white">
        <div class="max-w-[1200px] mx-auto px-6">
            <p class="text-body text-base leading-relaxed max-w-3xl mx-auto text-center">
                <?php echo e($category->description ?? "Explore our selection of {$category->name} materials for your custom labels and stickers. Perfect for various applications with excellent durability and print quality."); ?>

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
                <h2 class="section-heading mb-4"><?php echo e($category->name); ?> Products</h2>
                <p class="text-body text-base max-w-2xl mx-auto">
                    Browse our selection of custom products made with <?php echo e($category->name); ?> material.
                </p>
            </div>

            <div class="grid grid-cols-2 tablet:grid-cols-4 gap-6">
                <?php $__currentLoopData = $category->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
        </div>
    </section>

    
    <?php if($relatedProducts->count() > 0): ?>
        <section class="py-16 bg-white">
            <div class="max-w-[1200px] mx-auto px-6">
                <div class="text-center mb-12">
                    <h2 class="section-heading mb-4">More Materials</h2>
                    <p class="text-body text-base max-w-2xl mx-auto">
                        Explore other material options for your custom labels and stickers.
                    </p>
                </div>

                <div class="grid grid-cols-2 tablet:grid-cols-4 gap-6">
                    <?php $__currentLoopData = $relatedProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
            </div>
        </section>
    <?php endif; ?>

    
    <?php if (isset($component)) { $__componentOriginalb46848292f41c207996399fc87b6e67b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb46848292f41c207996399fc87b6e67b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.quote-form','data' => ['pageSource' => 'material-{$category->slug}']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('quote-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['pageSource' => 'material-{$category->slug}']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.faq-accordion','data' => ['faqs' => $faqs,'title' => $category->name . ' FAQ']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('faq-accordion'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['faqs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($faqs),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($category->name . ' FAQ')]); ?>
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
    'seoTitle' => $category->hero_title ?? "{$category->name} – MeisaiPrinting",
    'seoDescription' => $category->description ?? "Custom {$category->name} labels and stickers from MeisaiPrinting. Premium quality, factory direct pricing.",
    'transparentOnTop' => false,
], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\ms2\resources\views/materials/show.blade.php ENDPATH**/ ?>