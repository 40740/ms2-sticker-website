<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['faqs' => [], 'title' => 'Frequently Asked Questions']));

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

foreach (array_filter((['faqs' => [], 'title' => 'Frequently Asked Questions']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<section class="py-16 bg-white">
    <div class="max-w-[1200px] mx-auto px-6">
        <h2 class="section-heading text-center mb-10"><?php echo e($title); ?></h2>

        <div class="max-w-3xl mx-auto space-y-4"
             x-data="{ openFaq: null }">
            <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="border border-gray-200 bg-white shadow-light overflow-hidden"
                     :class="openFaq === <?php echo e($index); ?> ? 'shadow-medium' : ''">
                    
                    <button class="w-full flex items-center justify-between px-6 py-5 text-left hover:bg-gray-50 transition-all duration-300"
                            @click="openFaq = openFaq === <?php echo e($index); ?> ? null : <?php echo e($index); ?>"
                            :aria-expanded="openFaq === <?php echo e($index); ?>"
                            aria-controls="faq-answer-<?php echo e($index); ?>">
                        <span class="text-base font-semibold text-box-title pr-4"><?php echo e($faq->question); ?></span>
                        <svg class="w-5 h-5 text-brand shrink-0 transition-transform duration-300"
                             :class="openFaq === <?php echo e($index); ?> ? 'rotate-180' : ''"
                             fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    
                    <div x-show="openFaq === <?php echo e($index); ?>"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 -translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 -translate-y-1"
                         id="faq-answer-<?php echo e($index); ?>"
                         role="region"
                         class="px-6 pb-5">
                        <div class="text-body text-sm leading-relaxed border-t border-gray-100 pt-4">
                            <?php echo e($faq->answer); ?>

                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php /**PATH D:\laragon\www\ms2\resources\views/components/faq-accordion.blade.php ENDPATH**/ ?>