<?php $__env->startSection('content'); ?>
    
    <div class="max-w-[1200px] mx-auto px-6">
        <?php if (isset($component)) { $__componentOriginale19f62b34dfe0bfdf95075badcb45bc2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale19f62b34dfe0bfdf95075badcb45bc2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.breadcrumb','data' => ['items' => [
            ['title' => $page['title']],
        ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
            ['title' => $page['title']],
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

    
    <section class="relative w-full h-[300px] mobile:h-[400px] overflow-hidden">
        <div class="absolute inset-0">
            <img src="/images/page-hero-<?php echo e($slug); ?>.jpg"
                 alt="<?php echo e($page['title']); ?>"
                 class="w-full h-full object-cover"
                 loading="eager"
                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
            <div class="hidden absolute inset-0 bg-brand/80 items-center justify-center">
                <div class="text-center text-white p-6">
                    <h1 class="text-3xl mobile:text-4xl tablet:text-hero font-bold"><?php echo e($page['title']); ?></h1>
                </div>
            </div>
            <div class="absolute inset-0 bg-black/45"></div>
        </div>

        <div class="relative z-10 h-full flex items-center justify-center text-center">
            <div class="max-w-[800px] mx-auto px-6">
                <h1 class="text-white text-3xl mobile:text-4xl tablet:text-hero font-bold leading-tight mb-4">
                    <?php echo e($page['title']); ?>

                </h1>
            </div>
        </div>
    </section>

    
    <section class="py-16 bg-white">
        <div class="max-w-[1200px] mx-auto px-6">
            <div class="max-w-3xl mx-auto">
                
                <?php if($slug === 'free-samples'): ?>
                    <h2 class="text-[40px] font-bold text-[#222] leading-tight mb-6">Request Your Free Sample Pack</h2>
                    <p class="text-body text-base leading-relaxed mb-6">
                        At MeisaiPrinting, we understand that quality matters. That's why we offer free samples so you can experience our products firsthand before placing a bulk order.
                    </p>
                    <h3 class="text-2xl font-bold text-[#222] mb-4">How to Request Samples</h3>
                    <ol class="list-decimal list-inside space-y-3 text-body mb-8">
                        <li>Fill out the sample request form below with your details</li>
                        <li>Specify the materials and sizes you're interested in</li>
                        <li>Our team will prepare your custom sample pack</li>
                        <li>Receive your samples within 5-7 business days</li>
                    </ol>
                    <h3 class="text-2xl font-bold text-[#222] mb-4">What's Included in Your Sample Pack</h3>
                    <ul class="list-disc list-inside space-y-3 text-body mb-8">
                        <li>Samples of various materials (vinyl, paper, PET, etc.)</li>
                        <li>Different finish options (matte, glossy, waterproof)</li>
                        <li>Sample of your chosen size range</li>
                        <li>Print quality demonstration</li>
                    </ul>

                
                <?php elseif($slug === 'material-sample-pack'): ?>
                    <h2 class="text-[40px] font-bold text-[#222] leading-tight mb-6">Complete Material Sample Pack</h2>
                    <p class="text-body text-base leading-relaxed mb-6">
                        Our comprehensive material sample pack includes all available materials, finishes, and adhesive options we offer. Perfect for designers, brand managers, and product developers.
                    </p>
                    <h3 class="text-2xl font-bold text-[#222] mb-4">Pack Contents</h3>
                    <ul class="list-disc list-inside space-y-3 text-body mb-8">
                        <li><strong>Paper Materials:</strong> Glossy, matte, uncoated</li>
                        <li><strong>Plastic Materials:</strong> PET, PP, PVC, vinyl</li>
                        <li><strong>Specialty Materials:</strong> Kraft, holographic, metallic, transparent</li>
                        <li><strong>Adhesive Types:</strong> Permanent, removable, freezer-grade</li>
                    </ul>

                
                <?php elseif($slug === 'size-chart'): ?>
                    <h2 class="text-[40px] font-bold text-[#222] leading-tight mb-6">Size Chart & Specifications</h2>
                    <p class="text-body text-base leading-relaxed mb-8">
                        Find the perfect size for your custom stickers and labels. All sizes are available in inches and millimeters.
                    </p>
                    <h3 class="text-2xl font-bold text-[#222] mb-4">Popular Sticker Sizes</h3>
                    <div class="overflow-x-auto mb-8">
                        <table class="w-full border-collapse">
                            <thead>
                                <tr class="bg-bg-form">
                                    <th class="border border-gray-200 p-3 text-left">Size Name</th>
                                    <th class="border border-gray-200 p-3 text-left">Inches</th>
                                    <th class="border border-gray-200 p-3 text-left">Millimeters</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td class="border border-gray-200 p-3">Small Round</td><td class="border border-gray-200 p-3">1" x 1"</td><td class="border border-gray-200 p-3">25.4 x 25.4 mm</td></tr>
                                <tr><td class="border border-gray-200 p-3">Medium Round</td><td class="border border-gray-200 p-3">2" x 2"</td><td class="border border-gray-200 p-3">50.8 x 50.8 mm</td></tr>
                                <tr><td class="border border-gray-200 p-3">Large Round</td><td class="border border-gray-200 p-3">3" x 3"</td><td class="border border-gray-200 p-3">76.2 x 76.2 mm</td></tr>
                                <tr><td class="border border-gray-200 p-3">Small Rectangle</td><td class="border border-gray-200 p-3">2" x 1"</td><td class="border border-gray-200 p-3">50.8 x 25.4 mm</td></tr>
                                <tr><td class="border border-gray-200 p-3">Standard Rectangle</td><td class="border border-gray-200 p-3">4" x 2"</td><td class="border border-gray-200 p-3">101.6 x 50.8 mm</td></tr>
                                <tr><td class="border border-gray-200 p-3">Large Rectangle</td><td class="border border-gray-200 p-3">6" x 4"</td><td class="border border-gray-200 p-3">152.4 x 101.6 mm</td></tr>
                            </tbody>
                        </table>
                    </div>
                    <p class="text-body text-sm italic">Custom sizes available upon request. Contact us for non-standard dimensions.</p>

                
                <?php elseif($slug === 'moq-pricing'): ?>
                    <h2 class="text-[40px] font-bold text-[#222] leading-tight mb-6">Minimum Order Quantities & Pricing</h2>
                    <p class="text-body text-base leading-relaxed mb-6">
                        At MeisaiPrinting, we offer flexible minimum order quantities to accommodate businesses of all sizes, from startup to enterprise.
                    </p>
                    <h3 class="text-2xl font-bold text-[#222] mb-4">Minimum Order Quantities</h3>
                    <ul class="list-disc list-inside space-y-3 text-body mb-8">
                        <li><strong>Custom Stickers:</strong> As low as 100 pieces</li>
                        <li><strong>Roll Labels:</strong> Starting at 500 pieces</li>
                        <li><strong>Sheet Labels:</strong> Minimum 100 sheets</li>
                        <li><strong>Die-Cut Shapes:</strong> Starting at 250 pieces</li>
                    </ul>
                    <h3 class="text-2xl font-bold text-[#222] mb-4">Volume Discounts</h3>
                    <p class="text-body text-base leading-relaxed mb-4">
                        We offer competitive pricing with volume discounts:
                    </p>
                    <ul class="list-disc list-inside space-y-2 text-body mb-8">
                        <li>500+ pieces: 10% off</li>
                        <li>1,000+ pieces: 15% off</li>
                        <li>5,000+ pieces: 20% off</li>
                        <li>10,000+ pieces: Contact us for custom pricing</li>
                    </ul>

                
                <?php elseif($slug === 'artwork-guidelines'): ?>
                    <h2 class="text-[40px] font-bold text-[#222] leading-tight mb-6">Artwork Guidelines</h2>
                    <p class="text-body text-base leading-relaxed mb-6">
                        Follow these guidelines to ensure your artwork is print-ready and produces the best possible results.
                    </p>
                    <h3 class="text-2xl font-bold text-[#222] mb-4">File Formats</h3>
                    <ul class="list-disc list-inside space-y-3 text-body mb-8">
                        <li><strong>Preferred:</strong> AI, EPS, PDF (vector)</li>
                        <li><strong>Acceptable:</strong> PSD, TIFF, high-resolution JPEG (300 DPI+)</li>
                        <li><strong>Not Recommended:</strong> PNG, GIF, low-resolution images</li>
                    </ul>
                    <h3 class="text-2xl font-bold text-[#222] mb-4">Design Requirements</h3>
                    <ul class="list-disc list-inside space-y-3 text-body mb-8">
                        <li>Minimum resolution: 300 DPI at actual print size</li>
                        <li>Convert all text to outlines/paths</li>
                        <li>Include 2-3mm bleed on all sides</li>
                        <li>Use CMYK color mode (not RGB)</li>
                        <li>Keep important content 3mm away from trim edge</li>
                    </ul>

                
                <?php elseif($slug === 'eco-friendly'): ?>
                    <h2 class="text-[40px] font-bold text-[#222] leading-tight mb-6">Eco-Friendly & Recyclable Labels</h2>
                    <p class="text-body text-base leading-relaxed mb-6">
                        At MeisaiPrinting, we're committed to sustainability. We offer a range of eco-friendly label materials that meet the growing demand for sustainable packaging.
                    </p>
                    <h3 class="text-2xl font-bold text-[#222] mb-4">Our Eco-Friendly Materials</h3>
                    <ul class="list-disc list-inside space-y-3 text-body mb-8">
                        <li><strong>FSC Certified Paper:</strong> Sourced from responsibly managed forests</li>
                        <li><strong>Recycled Paper:</strong> Made from post-consumer waste</li>
                        <li><strong>Kraft Paper:</strong> Biodegradable and compostable</li>
                        <li><strong>PLA (Polylactic Acid):</strong> Plant-based, compostable material</li>
                        <li><strong>Water-Based Inks:</strong> Non-toxic, eco-friendly printing</li>
                    </ul>
                    <h3 class="text-2xl font-bold text-[#222] mb-4">Certifications</h3>
                    <ul class="list-disc list-inside space-y-3 text-body">
                        <li>FSC (Forest Stewardship Council)</li>
                        <li>Compostable materials certified</li>
                        <li>ISO 14001 Environmental Management</li>
                    </ul>

                
                <?php elseif($slug === 'compliance'): ?>
                    <h2 class="text-[40px] font-bold text-[#222] leading-tight mb-6">REACH & RoHS Compliance</h2>
                    <p class="text-body text-base leading-relaxed mb-6">
                        At MeisaiPrinting, we ensure our products meet the highest environmental and safety standards required by international markets.
                    </p>
                    <h3 class="text-2xl font-bold text-[#222] mb-4">REACH Compliance</h3>
                    <p class="text-body text-base leading-relaxed mb-8">
                        REACH (Registration, Evaluation, Authorisation and Restriction of Chemicals) is a European Union regulation to protect human health and the environment from chemical risks. All our materials comply with REACH requirements, ensuring safety for food packaging, pharmaceutical labels, and other sensitive applications.
                    </p>
                    <h3 class="text-2xl font-bold text-[#222] mb-4">RoHS Compliance</h3>
                    <p class="text-body text-base leading-relaxed mb-8">
                        RoHS (Restriction of Hazardous Substances) restricts the use of specific hazardous materials in electronic equipment. Our labels and stickers are RoHS compliant, making them suitable for electronics packaging and components.
                    </p>
                    <h3 class="text-2xl font-bold text-[#222] mb-4">Documentation</h3>
                    <p class="text-body text-base leading-relaxed">
                        We provide compliance documentation for all our products upon request, including material safety data sheets (MSDS) and certificates of compliance.
                    </p>

                
                <?php elseif($slug === 'privacy-policy'): ?>
                    <div class="space-y-8">
                        <p class="text-body text-base leading-relaxed">
                            <strong>Last Updated:</strong> May 21, 2026
                        </p>

                        <h2 class="text-2xl font-bold text-[#222] mb-4">1. Information We Collect</h2>
                        <p class="text-body text-base leading-relaxed mb-4">
                            We collect information you provide directly to us, such as when you create an account, place an order, subscribe to our newsletter, or contact us for support. This may include your name, email address, phone number, postal address, payment information, and any other information you choose to provide.
                        </p>

                        <h3 class="text-xl font-bold text-[#222] mb-3">Automatically Collected Information</h3>
                        <p class="text-body text-base leading-relaxed mb-4">
                            When you visit our website, we automatically collect certain information about your device, including your IP address, browser type, operating system, referring URLs, and information about your visit, such as pages viewed and time spent on pages.
                        </p>

                        <h2 class="text-2xl font-bold text-[#222] mb-4">2. How We Use Your Information</h2>
                        <p class="text-body text-base leading-relaxed mb-4">
                            We use the information we collect to:
                        </p>
                        <ul class="list-disc list-inside space-y-2 text-body mb-4">
                            <li>Process and fulfill your orders</li>
                            <li>Send you order confirmations and updates</li>
                            <li>Respond to your questions and provide customer support</li>
                            <li>Send you marketing communications (with your consent)</li>
                            <li>Improve our website and services</li>
                            <li>Comply with legal obligations</li>
                        </ul>

                        <h2 class="text-2xl font-bold text-[#222] mb-4">3. Cookies and Tracking Technologies</h2>
                        <p class="text-body text-base leading-relaxed mb-4">
                            We use cookies and similar tracking technologies to collect information about your browsing activities. Cookies are small data files stored on your device that help us remember your preferences and understand how you use our website.
                        </p>

                        <h3 class="text-xl font-bold text-[#222] mb-3">Types of Cookies We Use</h3>
                        <ul class="list-disc list-inside space-y-2 text-body mb-4">
                            <li><strong>Essential Cookies:</strong> Required for the website to function properly</li>
                            <li><strong>Analytics Cookies:</strong> Help us understand how visitors use our site</li>
                            <li><strong>Marketing Cookies:</strong> Used to deliver relevant advertisements</li>
                            <li><strong>Functional Cookies:</strong> Remember your preferences and settings</li>
                        </ul>

                        <h2 class="text-2xl font-bold text-[#222] mb-4">4. Information Sharing</h2>
                        <p class="text-body text-base leading-relaxed mb-4">
                            We do not sell, trade, or rent your personal information to third parties. We may share your information with:
                        </p>
                        <ul class="list-disc list-inside space-y-2 text-body mb-4">
                            <li>Service providers who assist us in operating our website</li>
                            <li>Payment processors to handle transactions</li>
                            <li>Shipping partners to deliver your orders</li>
                            <li>Legal authorities when required by law</li>
                        </ul>

                        <h2 class="text-2xl font-bold text-[#222] mb-4">5. Data Security</h2>
                        <p class="text-body text-base leading-relaxed mb-4">
                            We implement appropriate technical and organizational measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction. However, no method of transmission over the Internet is 100% secure.
                        </p>

                        <h2 class="text-2xl font-bold text-[#222] mb-4">6. Your Rights</h2>
                        <p class="text-body text-base leading-relaxed mb-4">
                            Depending on your location, you may have the right to:
                        </p>
                        <ul class="list-disc list-inside space-y-2 text-body mb-4">
                            <li>Access your personal information</li>
                            <li>Correct inaccurate information</li>
                            <li>Request deletion of your information</li>
                            <li>Object to processing of your information</li>
                            <li>Data portability</li>
                            <li>Withdraw consent at any time</li>
                        </ul>

                        <h2 class="text-2xl font-bold text-[#222] mb-4">7. Children's Privacy</h2>
                        <p class="text-body text-base leading-relaxed mb-4">
                            Our website is not directed to children under 16 years of age. We do not knowingly collect personal information from children. If you believe we have collected information from a child under 16, please contact us immediately.
                        </p>

                        <h2 class="text-2xl font-bold text-[#222] mb-4">8. International Data Transfers</h2>
                        <p class="text-body text-base leading-relaxed mb-4">
                            Your information may be transferred to and processed in countries other than your country of residence. We ensure appropriate safeguards are in place for such transfers.
                        </p>

                        <h2 class="text-2xl font-bold text-[#222] mb-4">9. Changes to This Policy</h2>
                        <p class="text-body text-base leading-relaxed mb-4">
                            We may update this Privacy Policy from time to time. We will notify you of any changes by posting the new policy on this page and updating the "Last Updated" date. We encourage you to review this policy periodically.
                        </p>

                        <h2 class="text-2xl font-bold text-[#222] mb-4">10. Contact Us</h2>
                        <p class="text-body text-base leading-relaxed">
                            If you have any questions about this Privacy Policy, please contact us:
                        </p>
                        <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                            <p class="text-body text-base"><strong><?php echo e(\App\Models\Setting::get('site_name', 'MeisaiPrinting')); ?></strong></p>
                            <?php ($contactEmail = \App\Models\Setting::get('contact_email')); ?>
                            <?php ($contactPhone = \App\Models\Setting::get('contact_phone')); ?>
                            <?php if($contactEmail): ?>
                                <p class="text-body text-base">Email: <?php echo e($contactEmail); ?></p>
                            <?php endif; ?>
                            <?php if($contactPhone): ?>
                                <p class="text-body text-base">Phone: <?php echo e($contactPhone); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                <?php else: ?>
                    
                    <h2 class="text-[40px] font-bold text-[#222] leading-tight mb-6"><?php echo e($page['title']); ?></h2>
                    <p class="text-body text-base leading-relaxed">
                        Content coming soon. Please contact us for more information about this topic.
                    </p>
                <?php endif; ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.quote-form','data' => ['pageSource' => 'page-{$slug}']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('quote-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['pageSource' => 'page-{$slug}']); ?>
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

<?php echo $__env->make('layouts.app', [
    'seoTitle' => $page['seoTitle'] ?? "{$page['title']} – MeisaiPrinting",
    'seoDescription' => $page['seoDescription'] ?? "Learn more about {$page['title']} at MeisaiPrinting.",
    'transparentOnTop' => false,
], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\ms2\resources\views/pages/show.blade.php ENDPATH**/ ?>