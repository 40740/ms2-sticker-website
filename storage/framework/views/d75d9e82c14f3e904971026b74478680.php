<?php $__env->startSection('content'); ?>
    
    <section class="bg-box-title">
        <div class="max-w-[1200px] mx-auto px-6 py-16 mobile:py-20">
            <div class="grid grid-cols-1 mobile:grid-cols-2 gap-10 items-center">
                
                <div>
                    <h1 class="text-white text-3xl mobile:text-4xl tablet:text-page-title font-bold leading-tight mb-6">
                        <?php echo e($product->hero_title ?? $product->name); ?>

                    </h1>
                    <?php if(isset($product->hero_subtitle)): ?>
                        <p class="text-white/80 text-base mobile:text-lg leading-relaxed mb-8">
                            <?php echo e($product->hero_subtitle); ?>

                        </p>
                    <?php endif; ?>
                    <?php if(isset($product->description)): ?>
                        <?php if(empty($product->hero_subtitle)): ?>
                            <p class="text-white/80 text-base mobile:text-lg leading-relaxed mb-8">
                                <?php echo e($product->description); ?>

                            </p>
                        <?php endif; ?>
                    <?php endif; ?>
                    <a href="#quote-form" class="btn-primary inline-block text-base px-10 py-4">
                        Get an Instant Quote
                    </a>
                </div>

                
                <div class="flex justify-center mobile:justify-end">
                    <div class="w-full max-w-md overflow-hidden rounded-lg">
                        <?php
                            $showHeroImage = $product->hero_image ?: ($product->image ?: ($product->category->image ?? null));
                            if ($showHeroImage && !str_starts_with($showHeroImage, '/') && !str_starts_with($showHeroImage, 'http')) {
                                $showHeroImage = '/' . ltrim($showHeroImage, '/');
                            }
                            if (!$showHeroImage) {
                                $showHeroImage = '/images/product-placeholder.jpg';
                            }
                        ?>
                        <img src="<?php echo e($showHeroImage); ?>"
                             alt="<?php echo e($product->name); ?>"
                             class="w-full h-auto object-cover"
                             onerror="this.src='/images/product-placeholder.jpg'"
                             loading="eager">
                    </div>
                </div>
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

    
    <?php if(is_array($product->features) && count($product->features) > 0): ?>
        <section class="py-16 bg-white">
            <div class="max-w-[1200px] mx-auto px-6">
                <h2 class="text-[40px] font-bold text-[#3C4043] text-center mb-12">
                    Features of Our <?php echo e($product->name); ?>

                </h2>

                <div class="grid grid-cols-1 tablet:grid-cols-2 desktop:grid-cols-3 gap-6">
                    <?php $__currentLoopData = $product->features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
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
                        ?>
                        <div class="bg-white border border-gray-100 rounded-lg p-5 shadow-light hover:shadow-medium transition-all duration-300 group">
                            
                            <?php if($image): ?>
                                <div class="relative overflow-hidden h-36 mb-4 rounded-md">
                                    <img src="<?php echo e($image); ?>"
                                         alt="<?php echo e($title); ?>"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                         loading="lazy">
                                </div>
                            <?php endif; ?>

                            
                            <div>
                                <h3 class="text-feature font-bold text-box-title mb-2 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-brand flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <?php echo e($title); ?>

                                </h3>
                                <?php if($description): ?>
                                    <p class="text-body text-sm leading-relaxed"><?php echo e($description); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    
    <?php if(is_array($product->steps) && count($product->steps) > 0): ?>
        <?php if (isset($component)) { $__componentOriginalf5b7269ee6fad6f0175fe75976844b81 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf5b7269ee6fad6f0175fe75976844b81 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.steps-section','data' => ['stepsTitle' => $product->steps_title ?? '4 Easy Steps','steps' => $product->steps]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('steps-section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['stepsTitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product->steps_title ?? '4 Easy Steps'),'steps' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product->steps)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf5b7269ee6fad6f0175fe75976844b81)): ?>
<?php $attributes = $__attributesOriginalf5b7269ee6fad6f0175fe75976844b81; ?>
<?php unset($__attributesOriginalf5b7269ee6fad6f0175fe75976844b81); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf5b7269ee6fad6f0175fe75976844b81)): ?>
<?php $component = $__componentOriginalf5b7269ee6fad6f0175fe75976844b81; ?>
<?php unset($__componentOriginalf5b7269ee6fad6f0175fe75976844b81); ?>
<?php endif; ?>
    <?php endif; ?>

    
    <?php if(is_array($product->concerns) && count($product->concerns) > 0): ?>
        <?php if (isset($component)) { $__componentOriginal665d8f7b0c077a6db0b0d4be080e8c9a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal665d8f7b0c077a6db0b0d4be080e8c9a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.concerns-grid','data' => ['concerns' => $product->concerns]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('concerns-grid'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['concerns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product->concerns)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal665d8f7b0c077a6db0b0d4be080e8c9a)): ?>
<?php $attributes = $__attributesOriginal665d8f7b0c077a6db0b0d4be080e8c9a; ?>
<?php unset($__attributesOriginal665d8f7b0c077a6db0b0d4be080e8c9a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal665d8f7b0c077a6db0b0d4be080e8c9a)): ?>
<?php $component = $__componentOriginal665d8f7b0c077a6db0b0d4be080e8c9a; ?>
<?php unset($__componentOriginal665d8f7b0c077a6db0b0d4be080e8c9a); ?>
<?php endif; ?>
    <?php endif; ?>

    
    <section class="py-16 bg-brand">
        <div class="max-w-[1200px] mx-auto px-6 text-center">
            <h2 class="text-white text-3xl mobile:text-4xl font-bold mb-4">
                Still Have Question? Need Help?
            </h2>
            <p class="text-white/80 text-base max-w-xl mx-auto mb-8">
                Our expert team is ready to assist you with any questions about our <?php echo e($product->name); ?>. Get in touch today!
            </p>
            <a href="#quote-form" class="bg-white text-brand font-semibold rounded-[35px] px-10 py-4 text-base hover:bg-gray-100 transition-all duration-300 inline-block">
                Contact Now
            </a>
        </div>
    </section>

    
    <?php if(is_array($product->testimonials) && count($product->testimonials) > 0): ?>
        <?php if (isset($component)) { $__componentOriginale649749a09477fd012e9a456582dee8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale649749a09477fd012e9a456582dee8e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.testimonials-carousel','data' => ['testimonials' => $product->testimonials]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('testimonials-carousel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['testimonials' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product->testimonials)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale649749a09477fd012e9a456582dee8e)): ?>
<?php $attributes = $__attributesOriginale649749a09477fd012e9a456582dee8e; ?>
<?php unset($__attributesOriginale649749a09477fd012e9a456582dee8e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale649749a09477fd012e9a456582dee8e)): ?>
<?php $component = $__componentOriginale649749a09477fd012e9a456582dee8e; ?>
<?php unset($__componentOriginale649749a09477fd012e9a456582dee8e); ?>
<?php endif; ?>
    <?php endif; ?>

    
    <?php if($brands->count() > 0): ?>
        <?php if (isset($component)) { $__componentOriginal1afaf4b9cdbeae37655383f47bfe3065 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1afaf4b9cdbeae37655383f47bfe3065 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.brands-section','data' => ['brands' => $brands]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('brands-section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['brands' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($brands)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1afaf4b9cdbeae37655383f47bfe3065)): ?>
<?php $attributes = $__attributesOriginal1afaf4b9cdbeae37655383f47bfe3065; ?>
<?php unset($__attributesOriginal1afaf4b9cdbeae37655383f47bfe3065); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1afaf4b9cdbeae37655383f47bfe3065)): ?>
<?php $component = $__componentOriginal1afaf4b9cdbeae37655383f47bfe3065; ?>
<?php unset($__componentOriginal1afaf4b9cdbeae37655383f47bfe3065); ?>
<?php endif; ?>
    <?php endif; ?>

    
    <?php if (isset($component)) { $__componentOriginalb46848292f41c207996399fc87b6e67b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb46848292f41c207996399fc87b6e67b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.quote-form','data' => ['pageSource' => 'product-'.e($product->slug).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('quote-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['pageSource' => 'product-'.e($product->slug).'']); ?>
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

    
    <?php if($product->faqs->count() > 0): ?>
        <?php if (isset($component)) { $__componentOriginal5d1e16bf605b55f667e923c5493c639b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5d1e16bf605b55f667e923c5493c639b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.faq-accordion','data' => ['faqs' => $product->faqs,'title' => $product->name . ' FAQ']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('faq-accordion'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['faqs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product->faqs),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product->name . ' FAQ')]); ?>
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

    
    <?php if($relatedProducts->count() > 0): ?>
        <section class="py-16 bg-bg-form">
            <div class="max-w-[1200px] mx-auto px-6">
                <h2 class="section-heading text-center mb-10">Popular Products</h2>

                <div class="grid grid-cols-2 tablet:grid-cols-4 gap-6">
                    <?php $__currentLoopData = $relatedProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relatedProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if (isset($component)) { $__componentOriginal3fd2897c1d6a149cdb97b41db9ff827a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3fd2897c1d6a149cdb97b41db9ff827a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.product-card','data' => ['product' => $relatedProduct]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('product-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['product' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($relatedProduct)]); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', [
    'seoTitle' => "{$product->name} – MeisaiPrinting",
    'seoDescription' => $product->description ?? "Professional custom {$product->name}. Factory direct pricing. FSC, UL, CSA certified. Get an instant quote.",
    'transparentOnTop' => false,
], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\ms2\resources\views/products/show.blade.php ENDPATH**/ ?>