<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['product']));

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

foreach (array_filter((['product']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $productSlug = $product->slug ?: \Str::slug($product->name);
    $productImage = $product->image;
    if ($productImage && !str_starts_with($productImage, '/') && !str_starts_with($productImage, 'http')) {
        $productImage = '/' . ltrim($productImage, '/');
    }
    if (!$productImage) {
        $productImage = '/images/product-placeholder.jpg';
    }
?>

<a href="/products/<?php echo e($productSlug); ?>" class="group block">
    <div class="overflow-hidden rounded-lg bg-white shadow-light hover:shadow-medium transition-all duration-300">
        
        <div class="relative overflow-hidden aspect-square bg-bg-form">
            <img src="<?php echo e($productImage); ?>"
                 alt="<?php echo e($product->name); ?>"
                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                 onerror="this.src='/images/product-placeholder.jpg'"
                 loading="lazy">
        </div>

        
        <div class="p-4">
            <h3 class="product-title text-center truncate"><?php echo e($product->name); ?></h3>
        </div>
    </div>
</a>
<?php /**PATH D:\laragon\www\ms2\resources\views/components/product-card.blade.php ENDPATH**/ ?>