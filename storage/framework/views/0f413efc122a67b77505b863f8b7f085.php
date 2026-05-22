<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['post']));

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

foreach (array_filter((['post']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $blogImage = $post->image;
    if ($blogImage && !str_starts_with($blogImage, '/') && !str_starts_with($blogImage, 'http')) {
        $blogImage = Storage::disk('uploads')->url($blogImage);
    }
    if (!$blogImage) {
        $blogImage = '/images/blog-placeholder.jpg';
    }
?>

<a href="/blog/<?php echo e($post->slug); ?>" class="group block">
    <div class="overflow-hidden bg-white shadow-light hover:shadow-medium transition-all duration-300 rounded-lg">
        
        <div class="relative overflow-hidden aspect-[16/10] bg-bg-form">
            <img src="<?php echo e($blogImage); ?>"
                 alt="<?php echo e($post->title); ?>"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                 onerror="this.src='/images/product-placeholder.jpg'"
                 loading="lazy">
        </div>

        
        <div class="p-5">
            
            <time class="text-sm text-gray-400 mb-2 block"
                  datetime="<?php echo e($post->published_at?->format('Y-m-d')); ?>">
                <?php echo e($post->published_at?->format('M d, Y')); ?>

            </time>

            
            <h3 class="text-feature font-bold text-box-title mb-2 line-clamp-2 group-hover:text-brand transition-colors duration-300">
                <?php echo e($post->title); ?>

            </h3>

            
            <p class="text-body text-sm leading-relaxed line-clamp-3">
                <?php echo e($post->excerpt); ?>

            </p>

            
            <span class="inline-flex items-center gap-1 text-accent text-sm font-semibold mt-3 group-hover:gap-2 transition-all duration-300">
                Read More
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                </svg>
            </span>
        </div>
    </div>
</a>
<?php /**PATH D:\laragon\www\ms2\resources\views/components/blog-card.blade.php ENDPATH**/ ?>