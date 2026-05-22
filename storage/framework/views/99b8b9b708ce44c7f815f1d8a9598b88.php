<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['items' => []]));

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

foreach (array_filter((['items' => []]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<nav aria-label="Breadcrumb" class="py-4">
    <ol class="flex items-center flex-wrap gap-1 text-sm">
        <li class="flex items-center">
            <a href="/" class="text-gray-400 hover:text-brand transition-all duration-300">Home</a>
        </li>
        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="flex items-center">
                <svg class="w-4 h-4 text-gray-300 mx-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
                <?php if($loop->last): ?>
                    <span class="text-box-title font-semibold"><?php echo e($item['title']); ?></span>
                <?php else: ?>
                    <a href="<?php echo e($item['url']); ?>" class="text-gray-400 hover:text-brand transition-all duration-300"><?php echo e($item['title']); ?></a>
                <?php endif; ?>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ol>
</nav>
<?php /**PATH D:\laragon\www\ms2\resources\views/components/breadcrumb.blade.php ENDPATH**/ ?>