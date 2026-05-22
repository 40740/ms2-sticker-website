<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['brands' => []]));

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

foreach (array_filter((['brands' => []]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<section class="py-16 bg-white">
    <div class="max-w-[1200px] mx-auto px-6">
        <h2 class="section-heading text-center mb-10">Brands That Trust Us</h2>

        <div class="grid grid-cols-2 mobile:grid-cols-3 tablet:grid-cols-6 gap-6 items-center">
            <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="flex items-center justify-center p-4 h-28 transition-all duration-300">
                    <?php if($brand->link): ?>
                        <a href="<?php echo e($brand->link); ?>" target="_blank" rel="noopener noreferrer" class="block w-full h-full flex items-center justify-center group">
                            <img src="<?php echo e(Storage::disk('uploads')->url($brand->image)); ?>"
                                 alt="<?php echo e($brand->name); ?>"
                                 class="max-h-full max-w-full object-contain transition-all duration-300 group-hover:scale-110"
                                 loading="lazy">
                        </a>
                    <?php else: ?>
                        <img src="<?php echo e(Storage::disk('uploads')->url($brand->image)); ?>"
                             alt="<?php echo e($brand->name); ?>"
                             class="max-h-full max-w-full object-contain transition-all duration-300 hover:scale-110"
                             loading="lazy">
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php /**PATH D:\laragon\www\ms2\resources\views/components/brands-section.blade.php ENDPATH**/ ?>