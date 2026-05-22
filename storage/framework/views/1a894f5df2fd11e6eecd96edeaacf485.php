<?php $__env->startSection('content'); ?>



<div class="max-w-[1200px] mx-auto px-6">
    <?php if (isset($component)) { $__componentOriginale19f62b34dfe0bfdf95075badcb45bc2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale19f62b34dfe0bfdf95075badcb45bc2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.breadcrumb','data' => ['items' => [['title' => 'MeisaiPrinting']]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([['title' => 'MeisaiPrinting']])]); ?>
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



<section class="py-10 bg-white">
    <div class="max-w-[1200px] mx-auto px-6">
        <h1 class="text-page-title font-bold text-box-title text-center">MeisaiPrinting: Bringing Joy Through Custom Stickers</h1>
    </div>
</section>



<section class="py-12 bg-white">
    <div class="max-w-[1200px] mx-auto px-6">
        <div class="grid grid-cols-1 tablet:grid-cols-2 gap-10 items-center">
            
            <div class="overflow-hidden rounded-lg shadow-medium">
                <img src="/images/about-story.jpg"
                     alt="Our Story"
                     class="w-full h-auto object-cover"
                     loading="lazy">
            </div>

            
            <div>
                <h2 class="text-section font-bold mb-6" style="color: #0095F4;"><?php echo e($aboutStoryTitle); ?></h2>
                <div class="text-body leading-relaxed space-y-4">
                    <?php echo e($aboutStoryContent ?? 'Founded over 24 years ago, MeisaiPrinting started with a simple mission: to make high-quality custom stickers accessible to businesses of all sizes. What began as a small workshop has grown into a state-of-the-art manufacturing facility, serving clients across the globe.'); ?>


                    <p>From our earliest days, we understood that stickers and labels are more than just adhesive paper — they are the face of your brand, the first impression your product makes, and a critical component of your packaging strategy. That understanding has driven every decision we have made since.</p>

                    <p>Today, we are proud to be one of the industry\'s most trusted partners, with certifications from FSC, UL, CSA, and more. Our journey has been defined by a relentless pursuit of quality, innovation, and customer satisfaction.</p>
                </div>
            </div>
        </div>
    </div>
</section>



<section class="py-12 bg-bg-form">
    <div class="max-w-[1200px] mx-auto px-6">
        <div class="grid grid-cols-1 tablet:grid-cols-2 gap-10 items-center">
            
            <div class="order-2 tablet:order-1">
                <h2 class="text-section font-bold mb-6" style="color: #0095F4;"><?php echo e($aboutValuesTitle); ?></h2>
                <div class="text-body leading-relaxed mb-6">
                    <?php echo e($aboutValuesContent ?? 'At MeisaiPrinting, our core values guide everything we do. They shape our decisions, define our culture, and ensure we consistently deliver the best for our clients.'); ?>

                </div>
                <ul class="space-y-3">
                    <li class="flex items-start gap-3">
                        <span class="w-2 h-2 rounded-full bg-brand mt-2 shrink-0"></span>
                        <span class="text-body text-sm leading-relaxed"><strong class="text-box-title">Quality First</strong> — We never compromise on materials or printing standards. Every product is inspected before shipping.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-2 h-2 rounded-full bg-brand mt-2 shrink-0"></span>
                        <span class="text-body text-sm leading-relaxed"><strong class="text-box-title">Customer Centric</strong> — Your success is our success. We listen, adapt, and go the extra mile to exceed expectations.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-2 h-2 rounded-full bg-brand mt-2 shrink-0"></span>
                        <span class="text-body text-sm leading-relaxed"><strong class="text-box-title">Innovation</strong> — We continuously invest in new technologies and processes to deliver better products faster.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-2 h-2 rounded-full bg-brand mt-2 shrink-0"></span>
                        <span class="text-body text-sm leading-relaxed"><strong class="text-box-title">Sustainability</strong> — FSC certified and committed to eco-friendly practices across our supply chain.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-2 h-2 rounded-full bg-brand mt-2 shrink-0"></span>
                        <span class="text-body text-sm leading-relaxed"><strong class="text-box-title">Integrity</strong> — Transparent pricing, honest timelines, and open communication at every step.</span>
                    </li>
                </ul>
            </div>

            
            <div class="order-1 tablet:order-2 overflow-hidden rounded-lg shadow-medium">
                <img src="/images/about-values.jpg"
                     alt="Our Values"
                     class="w-full h-auto object-cover"
                     loading="lazy">
            </div>
        </div>
    </div>
</section>



<section class="py-12 bg-white">
    <div class="max-w-[1200px] mx-auto px-6">
        <div class="grid grid-cols-1 tablet:grid-cols-2 gap-10 items-center">
            
            <div class="overflow-hidden rounded-lg shadow-medium">
                <img src="/images/about-vision.jpg"
                     alt="Our Vision"
                     class="w-full h-auto object-cover"
                     loading="lazy">
            </div>

            
            <div>
                <h2 class="text-section font-bold mb-6" style="color: #0095F4;"><?php echo e($aboutVisionTitle); ?></h2>
                <div class="text-body leading-relaxed space-y-4">
                    <?php echo e($aboutVisionContent ?? 'Our vision is to be the global leader in custom sticker and label solutions, recognized for our unwavering commitment to quality, sustainability, and customer satisfaction.'); ?>


                    <p>We envision a future where every business, regardless of size, has access to premium adhesive products that elevate their brand. Through continuous innovation and strategic partnerships, we are building that future one sticker at a time.</p>
                </div>
            </div>
        </div>
    </div>
</section>



<section class="py-12 bg-bg-form">
    <div class="max-w-[1200px] mx-auto px-6">
        <div class="grid grid-cols-1 tablet:grid-cols-2 gap-10 items-center">
            
            <div class="order-2 tablet:order-1">
                <h2 class="text-section font-bold mb-6" style="color: #0095F4;"><?php echo e($aboutMissionTitle); ?></h2>
                <div class="text-body leading-relaxed mb-6">
                    <?php echo e($aboutMissionContent ?? 'Our mission is to empower businesses with high-quality, affordable custom stickers and labels, delivered with exceptional service and speed.'); ?>

                </div>
                <ul class="space-y-3">
                    <li class="flex items-start gap-3">
                        <span class="w-6 h-6 rounded-full bg-brand flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                            </svg>
                        </span>
                        <span class="text-body text-sm leading-relaxed">Deliver factory-direct pricing without sacrificing quality, making professional stickers accessible to all.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-6 h-6 rounded-full bg-brand flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                            </svg>
                        </span>
                        <span class="text-body text-sm leading-relaxed">Maintain the highest industry certifications and eco-friendly practices in everything we produce.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-6 h-6 rounded-full bg-brand flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                            </svg>
                        </span>
                        <span class="text-body text-sm leading-relaxed">Provide responsive, personalized service that turns first-time buyers into lifelong partners.</span>
                    </li>
                </ul>
            </div>

            
            <div class="order-1 tablet:order-2 overflow-hidden rounded-lg shadow-medium">
                <img src="/images/about-mission.jpg"
                     alt="Our Mission"
                     class="w-full h-auto object-cover"
                     loading="lazy">
            </div>
        </div>
    </div>
</section>



<section class="py-12 bg-white">
    <div class="max-w-[1200px] mx-auto px-6">
        <div class="grid grid-cols-1 tablet:grid-cols-2 gap-10 items-center">
            
            <div class="overflow-hidden rounded-lg shadow-medium">
                <img src="/images/about-identity.jpg"
                     alt="Our Identity"
                     class="w-full h-auto object-cover"
                     loading="lazy">
            </div>

            
            <div>
                <h2 class="text-section font-bold mb-6" style="color: #0095F4;"><?php echo e($aboutIdentityTitle); ?></h2>
                <div class="text-body leading-relaxed space-y-4">
                    <?php echo e($aboutIdentityContent ?? 'MeisaiPrinting is more than a manufacturer — we are a creative partner. Our identity is built on the intersection of craftsmanship, technology, and joy.'); ?>


                    <p>We believe that the best stickers tell a story. They capture attention, communicate value, and create memorable experiences. That belief drives our team of designers, engineers, and printing specialists to push boundaries every single day.</p>

                    <p>Our identity reflects in every product we ship: precision-cut, vividly printed, and built to last. When you choose MeisaiPrinting, you choose a partner who cares about your brand as much as you do.</p>
                </div>
            </div>
        </div>
    </div>
</section>



<section class="py-16 bg-bg-form">
    <div class="max-w-[1200px] mx-auto px-6">
        <div class="text-center mb-10">
            <h2 class="section-heading mb-4"><?php echo e($factoryTitle); ?></h2>
            <?php if($factoryContent): ?>
                <?php
                    $factoryParagraphs = array_filter(explode("\n", $factoryContent), fn($line) => trim($line) !== '');
                ?>
                <div class="text-body leading-relaxed max-w-3xl mx-auto space-y-4">
                    <?php $__currentLoopData = $factoryParagraphs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paragraph): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <p><?php echo e(trim($paragraph)); ?></p>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <div class="text-body leading-relaxed max-w-3xl mx-auto space-y-4">
                    <p>Our 50,000+ sq ft manufacturing facility is equipped with state-of-the-art HP Indigo and Avery Dennison printing systems. With over 24 years of production experience, we have refined our processes to deliver consistent quality at scale.</p>
                    <p>From raw material inspection to final product packaging, every step is monitored by our quality assurance team. Our facility holds FSC, UL, CSA, and CUL certifications, ensuring that every product meets the strictest international standards.</p>
                </div>
            <?php endif; ?>
        </div>

        
        <div class="max-w-4xl mx-auto">
            <div class="relative aspect-video bg-black/5 rounded-lg overflow-hidden shadow-medium">
                <?php if($factoryVideoEmbed ?? ''): ?>
                    
                    <iframe src="<?php echo e($factoryVideoEmbed); ?>"
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



<section class="py-16 bg-white">
    <div class="max-w-[1200px] mx-auto px-6">
        <h2 class="section-heading text-center mb-10">Know More About Us</h2>

        <div class="grid grid-cols-2 tablet:grid-cols-4 gap-4 mobile:gap-6">
            
            <div class="group relative overflow-hidden rounded-lg aspect-[3/4] cursor-pointer">
                <img src="/images/gallery-office.jpg"
                     alt="Our Office"
                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                     loading="lazy">
                <div class="absolute inset-0 bg-black/40 group-hover:bg-black/60 transition-all duration-300"></div>
                <div class="absolute inset-0 flex items-end p-4">
                    <h3 class="text-white font-bold text-base mobile:text-lg">Office</h3>
                </div>
            </div>

            
            <div class="group relative overflow-hidden rounded-lg aspect-[3/4] cursor-pointer">
                <img src="/images/gallery-team.jpg"
                     alt="Our Team"
                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                     loading="lazy">
                <div class="absolute inset-0 bg-black/40 group-hover:bg-black/60 transition-all duration-300"></div>
                <div class="absolute inset-0 flex items-end p-4">
                    <h3 class="text-white font-bold text-base mobile:text-lg">Team</h3>
                </div>
            </div>

            
            <div class="group relative overflow-hidden rounded-lg aspect-[3/4] cursor-pointer">
                <img src="/images/gallery-factory.jpg"
                     alt="Our Factory"
                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                     loading="lazy">
                <div class="absolute inset-0 bg-black/40 group-hover:bg-black/60 transition-all duration-300"></div>
                <div class="absolute inset-0 flex items-end p-4">
                    <h3 class="text-white font-bold text-base mobile:text-lg">Factory</h3>
                </div>
            </div>

            
            <div class="group relative overflow-hidden rounded-lg aspect-[3/4] cursor-pointer">
                <img src="/images/gallery-production.jpg"
                     alt="Production Line"
                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                     loading="lazy">
                <div class="absolute inset-0 bg-black/40 group-hover:bg-black/60 transition-all duration-300"></div>
                <div class="absolute inset-0 flex items-end p-4">
                    <h3 class="text-white font-bold text-base mobile:text-lg">Production Line</h3>
                </div>
            </div>
        </div>
    </div>
</section>



<section class="py-16 bg-bg-form">
    <div class="max-w-[1200px] mx-auto px-6">
        <h2 class="section-heading text-center mb-10">Team of Professionals</h2>

        <div class="grid grid-cols-2 tablet:grid-cols-4 gap-6">
            <?php $__currentLoopData = $teamMembers->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white rounded-lg overflow-hidden shadow-light hover:shadow-medium transition-all duration-300 text-center">
                    
                    <div class="aspect-square bg-bg-form overflow-hidden">
                        <?php if($member->avatar): ?>
                            <img src="<?php echo e(Storage::disk('uploads')->url($member->avatar)); ?>"
                                 alt="<?php echo e($member->name); ?>"
                                 class="w-full h-full object-cover"
                                 loading="lazy">
                        <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center bg-brand/10">
                                <span class="text-brand text-4xl font-bold">
                                    <?php echo e(strtoupper(substr($member->name, 0, 1))); ?>

                                </span>
                            </div>
                        <?php endif; ?>
                    </div>

                    
                    <div class="p-5">
                        <h3 class="text-feature font-bold text-box-title mb-1"><?php echo e($member->name); ?></h3>
                        <p class="text-accent text-sm font-semibold mb-3"><?php echo e($member->title); ?></p>
                        <?php if($member->bio): ?>
                            <p class="text-body text-sm leading-relaxed line-clamp-3"><?php echo e($member->bio); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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



<?php if (isset($component)) { $__componentOriginalb46848292f41c207996399fc87b6e67b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb46848292f41c207996399fc87b6e67b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.quote-form','data' => ['pageSource' => 'about']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('quote-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['pageSource' => 'about']); ?>
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

<?php echo $__env->make('layouts.app', ['transparentOnTop' => false], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\ms2\resources\views/pages/about.blade.php ENDPATH**/ ?>