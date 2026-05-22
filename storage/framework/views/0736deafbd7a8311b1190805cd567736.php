<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['pageSource' => 'general']));

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

foreach (array_filter((['pageSource' => 'general']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php if (! $__env->hasRenderedOnce('1e9d7452-dc45-4c66-83bf-e36706c08126')): $__env->markAsRenderedOnce('1e9d7452-dc45-4c66-83bf-e36706c08126'); ?>
<?php $__env->startPush('inline-scripts'); ?>
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('quoteForm', (source) => ({
        form: {
            name: '',
            email: '',
            phone: '',
            message: '',
            design: null,
            page_source: source
        },
        fileName: '',
        loading: false,
        success: false,
        error: '',
        errors: {},
        validate() {
            this.errors = {};
            if (!this.form.name.trim()) this.errors.name = 'Name is required';
            if (!this.form.email.trim()) {
                this.errors.email = 'Email is required';
            } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.form.email)) {
                this.errors.email = 'Please enter a valid email address';
            }
            if (this.form.phone.trim() && !/^[0-9+\-\(\)\s]+$/.test(this.form.phone.trim())) {
                this.errors.phone = 'Phone number must contain only numbers and valid phone characters';
            }
            return Object.keys(this.errors).length === 0;
        },
        submitForm() {
            if (!this.validate()) return;
            this.loading = true;
            this.error = '';
            this.success = false;

            const data = new FormData();
            data.append('name', this.form.name);
            data.append('email', this.form.email);
            data.append('phone', this.form.phone);
            data.append('message', this.form.message);
            data.append('page_source', this.form.page_source);
            if (this.form.design) data.append('design', this.form.design);

            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            fetch('/inquiry', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken ? csrfToken.getAttribute('content') : '',
                    'Accept': 'application/json'
                },
                body: data
            })
            .then(response => {
                this.loading = false;
                if (response.ok) {
                    this.success = true;
                    this.form = { name: '', email: '', phone: '', message: '', design: null, page_source: source };
                    this.fileName = '';
                } else {
                    return response.json().then(data => {
                        if (data.errors) {
                            this.errors = data.errors;
                        } else {
                            this.error = data.message || 'Something went wrong. Please try again.';
                        }
                    });
                }
            })
            .catch(() => {
                this.loading = false;
                this.error = 'Network error. Please check your connection and try again.';
            });
        },
        handleFileSelect(event) {
            const file = event.target.files[0];
            if (file) {
                this.form.design = file;
                this.fileName = file.name;
            }
        }
    }));
});
</script>
<?php $__env->stopPush(); ?>
<?php endif; ?>

<section class="py-16 bg-bg-form" id="quote-form">
    <div class="max-w-[1200px] mx-auto px-6">
        <div class="text-center mb-10">
            <h2 class="section-heading mb-3">Expects To Provide You With Perfect Service</h2>
            <p class="text-body text-base max-w-2xl mx-auto">Fill out the form below and our team will get back to you within 24 hours with a custom quote tailored to your needs.</p>
        </div>

        <div class="max-w-3xl mx-auto bg-white p-8 mobile:p-10 shadow-light" x-data="quoteForm('<?php echo e($pageSource); ?>')">

            
            <div x-show="success" x-transition class="mb-6 p-4 bg-dot-active/10 border border-dot-active/30 text-green-800 rounded text-center">
                <div class="flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="font-semibold">Thank you! Your inquiry has been submitted successfully. We'll get back to you soon.</span>
                </div>
            </div>

            
            <div x-show="error" x-transition class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded text-center">
                <span x-text="error"></span>
            </div>

            <div class="grid grid-cols-1 mobile:grid-cols-2 gap-6">
                
                <div>
                    <label for="quote-name" class="block text-sm font-semibold text-box-title mb-2">
                        Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           id="quote-name"
                           x-model="form.name"
                           class="w-full px-4 py-3 bg-bg-form border border-gray-200 text-body focus:outline-none focus:border-brand focus:ring-1 focus:ring-brand transition-all duration-300"
                           placeholder="Your full name"
                           required>
                    <p x-show="errors.name" x-text="errors.name" class="text-red-500 text-xs mt-1"></p>
                </div>

                
                <div>
                    <label for="quote-email" class="block text-sm font-semibold text-box-title mb-2">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <input type="email"
                           id="quote-email"
                           x-model="form.email"
                           class="w-full px-4 py-3 bg-bg-form border border-gray-200 text-body focus:outline-none focus:border-brand focus:ring-1 focus:ring-brand transition-all duration-300"
                           placeholder="your@email.com"
                           required>
                    <p x-show="errors.email" x-text="errors.email" class="text-red-500 text-xs mt-1"></p>
                </div>

                
                <div>
                    <label for="quote-phone" class="block text-sm font-semibold text-box-title mb-2">
                        Phone Number
                    </label>
                    <input type="tel"
                           id="quote-phone"
                           x-model="form.phone"
                           class="w-full px-4 py-3 bg-bg-form border border-gray-200 text-body focus:outline-none focus:border-brand focus:ring-1 focus:ring-brand transition-all duration-300"
                           placeholder="+1 (555) 000-0000">
                    <p x-show="errors.phone" x-text="errors.phone" class="text-red-500 text-xs mt-1"></p>
                </div>

                
                <div>
                    <label for="quote-design" class="block text-sm font-semibold text-box-title mb-2">
                        Upload Design
                    </label>
                    <div class="relative w-full">
                        <input type="file"
                               id="quote-design"
                               @change="handleFileSelect($event)"
                               accept=".ai,.eps,.pdf,.png,.jpg,.jpeg,.svg,.psd,.cdr"
                               class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <div class="w-full px-4 py-3 bg-bg-form border border-gray-200 border-dashed text-body flex items-center justify-between cursor-pointer hover:border-brand transition-all duration-300">
                            <span class="truncate text-sm" :class="fileName ? 'text-box-title' : 'text-gray-400'" x-text="fileName || 'Choose file (AI, EPS, PDF, PNG, JPG, SVG)'"></span>
                            <svg class="w-5 h-5 text-gray-400 shrink-0 ml-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                
                <div class="mobile:col-span-2">
                    <label for="quote-message" class="block text-sm font-semibold text-box-title mb-2">
                        Message
                    </label>
                    <textarea id="quote-message"
                              x-model="form.message"
                              rows="4"
                              class="w-full px-4 py-3 bg-bg-form border border-gray-200 text-body focus:outline-none focus:border-brand focus:ring-1 focus:ring-brand transition-all duration-300 resize-vertical"
                              placeholder="Tell us about your project – size, quantity, material, special requirements..."></textarea>
                </div>
            </div>

            
            <div class="mt-8 text-center">
                <button type="button"
                        @click="submitForm()"
                        class="btn-submit px-12 py-4 text-base"
                        :disabled="loading"
                        :class="loading ? 'opacity-70 cursor-not-allowed' : ''">
                    <span x-show="!loading">Submit Inquiry</span>
                    <span x-show="loading" class="flex items-center justify-center gap-2">
                        <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Submitting...
                    </span>
                </button>
            </div>
        </div>
    </div>
</section>
<?php /**PATH D:\laragon\www\ms2\resources\views/components/quote-form.blade.php ENDPATH**/ ?>