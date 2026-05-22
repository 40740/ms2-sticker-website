<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['stepsTitle' => 'How It Works', 'steps' => []]));

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

foreach (array_filter((['stepsTitle' => 'How It Works', 'steps' => []]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<section class="py-16 bg-box-title">
    <div class="max-w-[1200px] mx-auto px-6">
        <h2 class="section-heading text-center text-white mb-12"><?php echo e($stepsTitle); ?></h2>

        <div class="grid grid-cols-1 mobile:grid-cols-2 tablet:grid-cols-4 gap-8">
            <?php $__currentLoopData = $steps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="text-center">
                    
                    <div class="w-14 h-14 rounded-full bg-brand flex items-center justify-center mx-auto mb-5">
                        <span class="text-white text-xl font-bold"><?php echo e($index + 1); ?></span>
                    </div>

                    
                    <?php if(isset($step['icon'])): ?>
                        <div class="w-12 h-12 flex items-center justify-center mx-auto mb-4 text-brand-hover">
                            <?php echo $step['icon']; ?>

                        </div>
                    <?php endif; ?>

                    
                    <h3 class="text-feature font-bold text-white mb-3"><?php echo e($step['title'] ?? ''); ?></h3>

                    
                    <p class="text-white/70 text-sm leading-relaxed"><?php echo e($step['description'] ?? ''); ?></p>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        
        <div class="text-center mt-12">
            <a href="/pages/custom-stickers" class="btn-primary inline-block px-10 py-4 text-base">Custom Now</a>
        </div>
    </div>
</section>
<?php /**PATH D:\laragon\www\ms2\resources\views/components/steps-section.blade.php ENDPATH**/ ?>