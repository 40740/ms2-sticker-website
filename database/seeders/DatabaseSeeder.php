<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\BlogPost;
use App\Models\Category;
use App\Models\Certificate;
use App\Models\Faq;
use App\Models\Product;
use App\Models\Setting;
use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ─── Assign Category Groups ─────────────────────────────────
        $this->call(AssignCategoryGroupsSeeder::class);

        // ─── Seed all data (idempotent: skip records that already exist) ──
        try {
            $this->seedAll();
        } catch (\Illuminate\Database\UniqueConstraintViolationException $e) {
            // Already seeded — safe to ignore
        }
    }

    protected function seedAll(): void
    {
        // All record creation below uses updateOrCreate / firstOrCreate for idempotency

        // ─── Settings ───────────────────────────────────────────────
        $settings = [
            // General
            ['key' => 'site_name', 'value' => 'MeisaiPrinting', 'group' => 'general'],
            ['key' => 'site_logo', 'value' => '/images/logo.png', 'group' => 'general'],
            ['key' => 'site_description', 'value' => 'Custom Stickers & Labels for Business', 'group' => 'general'],

            // Hero
            ['key' => 'hero_title', 'value' => 'Custom Stickers & Labels for Business', 'group' => 'hero'],
            ['key' => 'hero_subtitle', 'value' => '24 years of experience in custom stickers and labels', 'group' => 'hero'],
            ['key' => 'hero_cta_text', 'value' => 'Get Free Quote', 'group' => 'hero'],
            ['key' => 'hero_cta_link', 'value' => '#quote-form', 'group' => 'hero'],

            // Footer
            ['key' => 'footer_about', 'value' => '24 Years Focused on Adhesive Stickers', 'group' => 'footer'],
            ['key' => 'footer_email', 'value' => 'info@meisaiprinting.com', 'group' => 'footer'],
            ['key' => 'footer_phone', 'value' => '+86-755-1234-5678', 'group' => 'footer'],
            ['key' => 'footer_address', 'value' => 'Shenzhen, Guangdong, China', 'group' => 'footer'],

            // Contact (top bar + footer)
            ['key' => 'contact_email', 'value' => 'info@meisaiprinting.com', 'group' => 'contact'],
            ['key' => 'contact_phone', 'value' => '+86-755-1234-5678', 'group' => 'contact'],
            ['key' => 'contact_address', 'value' => 'Shenzhen, Guangdong, China', 'group' => 'contact'],

            // Social Media
            ['key' => 'social_facebook', 'value' => '#', 'group' => 'social'],
            ['key' => 'social_instagram', 'value' => '#', 'group' => 'social'],
            ['key' => 'social_youtube', 'value' => '#', 'group' => 'social'],
            ['key' => 'social_tiktok', 'value' => '#', 'group' => 'social'],

            // About
            ['key' => 'about_story_title', 'value' => 'Our Story', 'group' => 'about'],
            ['key' => 'about_story_content', 'value' => 'Founded in 2000, Funstickers has grown from a small workshop in Shenzhen to one of China\'s leading custom sticker and label manufacturers. Our journey began with a simple belief: every business deserves high-quality, affordable custom stickers that make their brand stand out.

Over the past 24 years, we have served more than 10,000 businesses across 50+ countries, delivering billions of stickers and labels that help brands communicate, protect, and promote their products. Our state-of-the-art factory spans over 10,000 square meters and is equipped with the latest printing technology.

What sets us apart is our unwavering commitment to quality and customer satisfaction. We invest heavily in research and development, continuously improving our materials, printing techniques, and production processes to deliver stickers and labels that exceed expectations.', 'group' => 'about'],
            ['key' => 'about_values_title', 'value' => 'Our Values', 'group' => 'about'],
            ['key' => 'about_values_content', 'value' => '1. Quality First: We never compromise on the quality of our materials or printing. Every sticker and label must meet our rigorous standards before it leaves our factory.

2. Customer-Centric: Your success is our success. We listen to your needs and go above and beyond to deliver solutions that work for your business.

3. Innovation: We continuously invest in new technologies, materials, and techniques to stay at the forefront of the sticker and label industry.

4. Integrity: We believe in honest, transparent business practices. What we promise is what we deliver.

5. Sustainability: We are committed to environmentally responsible manufacturing, using eco-friendly materials and sustainable processes wherever possible.', 'group' => 'about'],
            ['key' => 'about_vision_title', 'value' => 'Our Vision', 'group' => 'about'],
            ['key' => 'about_vision_content', 'value' => 'To be the world\'s most trusted and innovative custom sticker and label manufacturer, empowering businesses of all sizes to build their brands through exceptional printed products.', 'group' => 'about'],
            ['key' => 'about_mission_title', 'value' => 'Our Mission', 'group' => 'about'],
            ['key' => 'about_mission_content', 'value' => '1. Deliver premium quality custom stickers and labels at competitive prices through efficient manufacturing and direct-to-customer service.

2. Provide exceptional customer experiences through responsive communication, expert guidance, and reliable delivery.

3. Drive industry innovation by investing in cutting-edge technology and sustainable manufacturing practices.', 'group' => 'about'],
            ['key' => 'about_identity_title', 'value' => 'Our Identity', 'group' => 'about'],
            ['key' => 'about_identity_content', 'value' => 'We serve startups, small businesses, and global brands alike. Whether you\'re a craft brewer needing bottle labels, an e-commerce brand wanting custom packaging stickers, or a Fortune 500 company requiring industrial-grade product labels, Funstickers has the expertise and capacity to meet your needs. Our clients span industries including food & beverage, cosmetics, pharmaceuticals, consumer electronics, and retail.', 'group' => 'about'],
            ['key' => 'factory_title', 'value' => 'About Our Factory', 'group' => 'factory'],
            ['key' => 'factory_content', 'value' => 'Our 10,000+ square meter factory in Shenzhen, China, has been the heart of Funstickers since 2000. Equipped with state-of-the-art flexographic, digital, and offset printing presses, we can handle orders from as few as 100 to millions of stickers with equal precision and care.

The facility houses dedicated production lines for die-cut stickers, kiss-cut stickers, sticker rolls, sticker sheets, and all types of labels. Our quality control department uses advanced inspection systems to ensure every batch meets international standards.

We hold certifications including BSCI, ISO 9001, REACH, and FSC, demonstrating our commitment to quality management, social responsibility, and environmental sustainability. Our factory operates under strict 5S management principles, ensuring efficiency, safety, and cleanliness throughout the production process.', 'group' => 'factory'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }

        // ─── Categories (Stickers) ──────────────────────────────────
        $stickerCategories = [
            ['name' => 'Die Cut Stickers', 'slug' => 'die-cut-stickers', 'description' => 'Custom die cut stickers with any shape you want. Perfect for branding, promotions, and product packaging.'],
            ['name' => 'Kiss Cut Stickers', 'slug' => 'kiss-cut-stickers', 'description' => 'Kiss cut stickers with easy-peel backing. Great for sticker sheets and promotional giveaways.'],
            ['name' => 'Sticker Rolls', 'slug' => 'sticker-rolls', 'description' => 'Bulk sticker rolls for high-volume applications. Ideal for packaging, labeling, and retail use.'],
            ['name' => 'Sticker Sheets', 'slug' => 'sticker-sheets', 'description' => 'Custom sticker sheets with multiple designs. Perfect for promotions and retail displays.'],
            ['name' => 'Vinyl Stickers', 'slug' => 'vinyl-stickers', 'description' => 'Durable vinyl stickers that are waterproof and weather-resistant. Great for outdoor use.'],
            ['name' => 'Spot UV Stickers', 'slug' => 'spot-uv-stickers', 'description' => 'Premium spot UV stickers with glossy highlights on matte backgrounds. Luxurious finish.'],
            ['name' => 'Foil Stickers', 'slug' => 'foil-stickers', 'description' => 'Eye-catching foil stickers in gold, silver, and holographic finishes. Add luxury to your brand.'],
            ['name' => 'Transparent Stickers', 'slug' => 'transparent-stickers', 'description' => 'Clear transparent stickers that blend seamlessly onto any surface. Clean and modern look.'],
            ['name' => 'Holographic Stickers', 'slug' => 'holographic-stickers', 'description' => 'Stunning holographic stickers with rainbow shimmer effects. Unforgettable visual impact.'],
            ['name' => 'Glitter Stickers', 'slug' => 'glitter-stickers', 'description' => 'Sparkling glitter stickers that catch the light. Fun and eye-catching for any application.'],
            ['name' => 'Glossy Stickers', 'slug' => 'glossy-stickers', 'description' => 'High-shine glossy stickers with vibrant colors. Professional and polished finish.'],
            ['name' => 'Circle Stickers', 'slug' => 'circle-stickers', 'description' => 'Classic circle stickers in any size. Versatile and popular for branding and packaging.'],
            ['name' => 'Rectangle Stickers', 'slug' => 'rectangle-stickers', 'description' => 'Standard rectangle stickers perfect for product labels and packaging seals.'],
            ['name' => 'Square Stickers', 'slug' => 'square-stickers', 'description' => 'Clean square stickers ideal for logos, QR codes, and social media icons.'],
            ['name' => 'Oval Stickers', 'slug' => 'oval-stickers', 'description' => 'Elegant oval stickers for a sophisticated brand presentation.'],
            ['name' => 'Bottle Stickers', 'slug' => 'bottle-stickers', 'description' => 'Custom bottle stickers designed to wrap perfectly around any bottle shape.'],
            ['name' => 'Logo Stickers', 'slug' => 'logo-stickers', 'description' => 'Brand logo stickers that make your business stand out. Perfect for giveaways and packaging.'],
            ['name' => 'Outdoor Stickers', 'slug' => 'outdoor-stickers', 'description' => 'Weatherproof outdoor stickers built to withstand sun, rain, and extreme temperatures.'],
        ];

        foreach ($stickerCategories as $i => $cat) {
            Category::firstOrCreate(['slug' => $cat['slug']], array_merge($cat, [
                'type' => 'sticker',
                'is_active' => true,
                'sort_order' => $i + 1,
            ]));
        }

        // ─── Categories (Labels) ────────────────────────────────────
        $labelCategories = [
            ['name' => 'Juice Bottle Labels', 'slug' => 'juice-bottle-labels', 'description' => 'Custom juice bottle labels that make your beverages stand out on the shelf. Waterproof and vibrant.'],
            ['name' => 'Candle Labels', 'slug' => 'candle-labels', 'description' => 'Beautiful candle labels with heat-resistant materials. Perfect for soy, beeswax, and scented candles.'],
            ['name' => 'Honey Jar Labels', 'slug' => 'honey-jar-labels', 'description' => 'Premium honey jar labels that showcase the natural quality of your honey products.'],
            ['name' => 'Labels On Roll', 'slug' => 'labels-on-roll', 'description' => 'Efficient roll labels for high-speed application. Ideal for large-volume production lines.'],
            ['name' => 'Food Labels', 'slug' => 'food-labels', 'description' => 'FDA-compliant food labels with nutritional information, ingredients, and allergen warnings.'],
            ['name' => 'Seal Labels', 'slug' => 'seal-labels', 'description' => 'Tamper-evident seal labels for product security and brand protection.'],
        ];

        foreach ($labelCategories as $i => $cat) {
            Category::firstOrCreate(['slug' => $cat['slug']], array_merge($cat, [
                'type' => 'label',
                'is_active' => true,
                'sort_order' => $i + 1,
            ]));
        }

        // ─── Products ──────────────────────────────────────────────
        $holographicCat = Category::where('slug', 'holographic-stickers')->first();
        $dieCutCat = Category::where('slug', 'die-cut-stickers')->first();
        $vinylCat = Category::where('slug', 'vinyl-stickers')->first();
        $logoCat = Category::where('slug', 'logo-stickers')->first();
        $foodLabelCat = Category::where('slug', 'food-labels')->first();
        $candleLabelCat = Category::where('slug', 'candle-labels')->first();

        // Product 1: Holographic Stickers
        Product::updateOrCreate(['slug' => 'holographic-stickers'], [
            'category_id' => $holographicCat->id,
            'name' => 'Holographic Stickers',
            'slug' => 'holographic-stickers',
            'type' => 'sticker',
            'description' => 'Make your brand unforgettable with our custom holographic stickers. These eye-catching stickers feature a stunning rainbow shimmer effect that changes with the light, creating a mesmerizing visual impact that demands attention. Perfect for product packaging, promotional giveaways, brand merchandising, and any application where you want to stand out from the crowd.',
            'hero_title' => 'Custom Holographic Stickers',
            'hero_subtitle' => 'Stunning rainbow shimmer effects that make your brand unforgettable',
            'features' => [
                [
                    'title' => 'Rainbow Shimmer Effect',
                    'description' => 'Our holographic material creates a stunning rainbow shimmer that shifts and changes as light hits it from different angles. This dynamic visual effect is impossible to ignore and adds a premium feel to any design.',
                    'image' => '/images/products/holographic-feature-1.jpg',
                ],
                [
                    'title' => 'Premium Vinyl Material',
                    'description' => 'Made from high-quality vinyl with a holographic laminate overlay. Our stickers are waterproof, UV-resistant, and scratch-proof, ensuring your designs stay vibrant and eye-catching for years.',
                    'image' => '/images/products/holographic-feature-2.jpg',
                ],
                [
                    'title' => 'Any Shape & Size',
                    'description' => 'Choose from custom die-cut shapes to perfectly frame your design, or select standard shapes like circles, squares, and rectangles. Available in sizes from 1" to 12" and beyond.',
                    'image' => '/images/products/holographic-feature-3.jpg',
                ],
            ],
            'steps_title' => 'Customize Your Holographic Stickers in 4 Easy Steps',
            'steps' => [
                ['step' => 1, 'title' => 'Choose Your Size & Shape', 'description' => 'Select from our wide range of sizes and shapes, or request a custom die-cut shape for your holographic stickers.'],
                ['step' => 2, 'title' => 'Upload Your Design', 'description' => 'Upload your artwork in AI, PDF, or PSD format. Our design team will review it for optimal holographic printing results.'],
                ['step' => 3, 'title' => 'Select Quantity & Finish', 'description' => 'Choose your quantity (from 50 to 100,000+) and any additional finishing options like custom backing or individual packaging.'],
                ['step' => 4, 'title' => 'Get Your Stickers', 'description' => 'We produce and ship your holographic stickers within 5-7 business days. Free shipping on orders over $100.'],
            ],
            'concerns' => [
                ['title' => 'Are holographic stickers waterproof?', 'description' => 'Yes! Our holographic stickers are made with waterproof vinyl material and a protective laminate coating. They withstand rain, spills, and even dishwasher cycles without fading or peeling.'],
                ['title' => 'How long do holographic stickers last?', 'description' => 'Our holographic stickers are designed to last 3-5 years outdoors and even longer indoors. The UV-resistant laminate prevents fading, and the waterproof material ensures durability in all weather conditions.'],
                ['title' => 'What file format should I use for my design?', 'description' => 'We accept AI, PDF, PSD, EPS, and high-resolution PNG files. For the best holographic effect, we recommend vector formats (AI or PDF) with clearly defined areas for the holographic effect.'],
                ['title' => 'What is the minimum order quantity?', 'description' => 'Our minimum order for holographic stickers is just 50 pieces. We offer quantity discounts for larger orders, making it affordable for both small businesses and large enterprises.'],
            ],
            'testimonials' => [
                ['name' => 'Sarah Chen', 'country' => 'United States', 'avatar' => '/images/testimonials/avatar-1.jpg', 'text' => 'These holographic stickers are absolutely stunning! The rainbow shimmer effect is even better in person. My customers can\'t stop talking about them.'],
                ['name' => 'Marcus Weber', 'country' => 'Germany', 'avatar' => '/images/testimonials/avatar-2.jpg', 'text' => 'We used holographic stickers for our product launch and the response was incredible. They look premium and really helped our brand stand out on store shelves.'],
                ['name' => 'Yuki Tanaka', 'country' => 'Japan', 'avatar' => '/images/testimonials/avatar-3.jpg', 'text' => 'Excellent quality and fast shipping. The holographic effect is consistent across the entire batch. Will definitely order again for our next product line.'],
            ],
            'is_active' => true,
            'sort_order' => 1,
        ]);

        // Product 2: Die Cut Stickers
        Product::updateOrCreate(['slug' => 'die-cut-stickers'], [
            'category_id' => $dieCutCat->id,
            'name' => 'Die Cut Stickers',
            'slug' => 'die-cut-stickers',
            'type' => 'sticker',
            'description' => 'Custom die cut stickers cut exactly to the shape of your design. No white borders, no wasted space — just your artwork perfectly cut and ready to make an impression. Die cut stickers are our most popular product because they offer the ultimate in customization and visual appeal.',
            'hero_title' => 'Custom Die Cut Stickers',
            'hero_subtitle' => 'Cut to any shape for a perfect brand presentation',
            'features' => [
                [
                    'title' => 'Custom Shape Cutting',
                    'description' => 'Your stickers are precisely cut to follow the exact outline of your design. Whether it\'s a complex logo, an intricate illustration, or a simple shape, our die-cut technology delivers clean, accurate cuts every time.',
                    'image' => '/images/products/diecut-feature-1.jpg',
                ],
                [
                    'title' => 'Durable Vinyl Material',
                    'description' => 'Made from premium vinyl with a protective laminate coating. Our die cut stickers are waterproof, UV-resistant, and scratch-proof, making them suitable for both indoor and outdoor use.',
                    'image' => '/images/products/diecut-feature-2.jpg',
                ],
                [
                    'title' => 'Easy Peel & Apply',
                    'description' => 'Each die cut sticker comes with an easy-peel backing that makes application a breeze. The strong adhesive ensures your stickers stay put on virtually any smooth surface.',
                    'image' => '/images/products/diecut-feature-3.jpg',
                ],
            ],
            'steps_title' => 'Customize Your Die Cut Stickers in 4 Easy Steps',
            'steps' => [
                ['step' => 1, 'title' => 'Upload Your Design', 'description' => 'Send us your artwork and we\'ll create a custom die-cut line that follows the exact shape of your design.'],
                ['step' => 2, 'title' => 'Choose Material & Size', 'description' => 'Select from our premium vinyl materials and choose the perfect size for your die cut stickers.'],
                ['step' => 3, 'title' => 'Pick Quantity & Options', 'description' => 'Choose your quantity and any additional options like matte finish, holographic overlay, or custom packaging.'],
                ['step' => 4, 'title' => 'Receive & Enjoy', 'description' => 'Your custom die cut stickers are produced and shipped within 5-7 business days. Satisfaction guaranteed!'],
            ],
            'concerns' => [
                ['title' => 'What is the difference between die cut and kiss cut?', 'description' => 'Die cut stickers are cut all the way through both the sticker and backing material, creating individual stickers in your custom shape. Kiss cut stickers are cut only through the top layer, leaving them on a larger backing sheet.'],
                ['title' => 'Can you do intricate designs with die cutting?', 'description' => 'Yes! Our advanced cutting technology can handle intricate designs with fine details. However, we recommend avoiding extremely thin or narrow elements (under 2mm) for the best results.'],
                ['title' => 'Are die cut stickers suitable for outdoor use?', 'description' => 'Absolutely! Our die cut stickers are made with waterproof vinyl and UV-resistant inks. They can withstand sun, rain, and temperature changes for 3-5 years outdoors.'],
                ['title' => 'How accurate is the die cutting?', 'description' => 'Our cutting precision is within 1mm accuracy. We provide a free digital proof before production so you can verify the cut line matches your design perfectly.'],
            ],
            'testimonials' => [
                ['name' => 'Emma Rodriguez', 'country' => 'United States', 'avatar' => '/images/testimonials/avatar-4.jpg', 'text' => 'The die cut quality is incredible. Every sticker is perfectly cut with clean edges. My logo looks amazing as a custom die cut!'],
                ['name' => 'Liam O\'Brien', 'country' => 'Ireland', 'avatar' => '/images/testimonials/avatar-5.jpg', 'text' => 'We\'ve been ordering die cut stickers for our brewery for 3 years now. Consistent quality, great prices, and the customer service is top-notch.'],
                ['name' => 'Aiko Suzuki', 'country' => 'Japan', 'avatar' => '/images/testimonials/avatar-6.jpg', 'text' => 'Fast production and perfect cutting. The stickers adhere well and look professional. Very satisfied with the overall experience.'],
            ],
            'is_active' => true,
            'sort_order' => 2,
        ]);

        // Product 3: Vinyl Stickers
        Product::updateOrCreate(['slug' => 'vinyl-stickers'], [
            'category_id' => $vinylCat->id,
            'name' => 'Vinyl Stickers',
            'slug' => 'vinyl-stickers',
            'type' => 'sticker',
            'description' => 'Premium vinyl stickers built to last. Our vinyl stickers are made from high-quality PVC vinyl material with a protective laminate coating, making them waterproof, UV-resistant, and virtually indestructible. Perfect for outdoor applications, vehicle graphics, laptop skins, and anywhere durability matters.',
            'hero_title' => 'Custom Vinyl Stickers',
            'hero_subtitle' => 'Tough, waterproof, and made to last — indoors and outdoors',
            'features' => [
                [
                    'title' => 'Waterproof & Weatherproof',
                    'description' => 'Our vinyl stickers are completely waterproof and can withstand rain, snow, and even full submersion. The UV-resistant inks and laminate coating prevent fading from sun exposure for 3-5+ years.',
                    'image' => '/images/products/vinyl-feature-1.jpg',
                ],
                [
                    'title' => 'Strong Adhesive',
                    'description' => 'The permanent adhesive bonds strongly to virtually any smooth surface including metal, plastic, glass, wood, and painted surfaces. Yet removes cleanly without leaving residue when needed.',
                    'image' => '/images/products/vinyl-feature-2.jpg',
                ],
                [
                    'title' => 'Scratch & Scuff Resistant',
                    'description' => 'The protective laminate coating makes our vinyl stickers highly resistant to scratches, scuffs, and chemical exposure. They maintain their appearance even in harsh environments.',
                    'image' => '/images/products/vinyl-feature-3.jpg',
                ],
            ],
            'steps_title' => 'Customize Your Vinyl Stickers in 4 Easy Steps',
            'steps' => [
                ['step' => 1, 'title' => 'Design Your Sticker', 'description' => 'Upload your artwork or work with our design team to create the perfect vinyl sticker design.'],
                ['step' => 2, 'title' => 'Choose Vinyl Type', 'description' => 'Select from white vinyl, clear vinyl, or metallic vinyl to match your brand and application needs.'],
                ['step' => 3, 'title' => 'Select Size & Quantity', 'description' => 'Pick from standard sizes or request custom dimensions. Order from 50 to 500,000+ pieces.'],
                ['step' => 4, 'title' => 'Production & Delivery', 'description' => 'We produce your vinyl stickers in 5-7 business days with quality checks at every stage.'],
            ],
            'concerns' => [
                ['title' => 'Can vinyl stickers be used on cars?', 'description' => 'Yes! Our vinyl stickers are perfect for vehicle applications. They are car wash safe, UV-resistant, and can withstand extreme temperatures. Many customers use them for car decals and bumper stickers.'],
                ['title' => 'Are vinyl stickers dishwasher safe?', 'description' => 'Yes, our vinyl stickers are dishwasher safe. The waterproof laminate coating protects the print through multiple wash cycles, making them great for water bottles, mugs, and tumblers.'],
                ['title' => 'What thickness are your vinyl stickers?', 'description' => 'Our standard vinyl stickers are approximately 0.15mm thick (including laminate). This provides the ideal balance of durability and flexibility for most applications.'],
                ['title' => 'Can vinyl stickers be removed without damage?', 'description' => 'While our vinyl stickers use a permanent adhesive, they can be removed from most surfaces with heat (hair dryer) and gentle peeling. Some residue may remain on porous surfaces.'],
            ],
            'testimonials' => [
                ['name' => 'Jake Morrison', 'country' => 'Australia', 'avatar' => '/images/testimonials/avatar-7.jpg', 'text' => 'I put these vinyl stickers on my surfboard and they\'ve survived months of saltwater and sun. Incredible durability!'],
                ['name' => 'Nina Petrova', 'country' => 'Russia', 'avatar' => '/images/testimonials/avatar-8.jpg', 'text' => 'Great quality vinyl stickers at an amazing price. We use them for our product packaging and they look professional and last forever.'],
                ['name' => 'David Kim', 'country' => 'South Korea', 'avatar' => '/images/testimonials/avatar-9.jpg', 'text' => 'The vinyl material is thick and feels premium. The print quality is excellent with vivid colors. Highly recommended!'],
            ],
            'is_active' => true,
            'sort_order' => 3,
        ]);

        // Product 4: Logo Stickers
        Product::updateOrCreate(['slug' => 'logo-stickers'], [
            'category_id' => $logoCat->id,
            'name' => 'Logo Stickers',
            'slug' => 'logo-stickers',
            'type' => 'sticker',
            'description' => 'Custom logo stickers that put your brand front and center. Whether you need logo stickers for product packaging, promotional giveaways, event handouts, or brand merchandising, we deliver high-quality stickers that represent your brand perfectly. Available in any shape, size, and finish.',
            'hero_title' => 'Custom Logo Stickers',
            'hero_subtitle' => 'Your logo, perfectly printed and cut — ready to stick anywhere',
            'features' => [
                [
                    'title' => 'Perfect Color Matching',
                    'description' => 'We use Pantone color matching technology to ensure your brand colors are reproduced exactly. Your logo will look consistent across every sticker and every batch.',
                    'image' => '/images/products/logo-feature-1.jpg',
                ],
                [
                    'title' => 'Multiple Finish Options',
                    'description' => 'Choose from matte, glossy, holographic, metallic, or spot UV finishes to complement your brand identity. Mix and match finishes for a truly unique look.',
                    'image' => '/images/products/logo-feature-2.jpg',
                ],
                [
                    'title' => 'Branded Packaging',
                    'description' => 'Add custom backing cards, branded packaging, or individual wrapping to create a complete brand experience. Perfect for retail displays and promotional events.',
                    'image' => '/images/products/logo-feature-3.jpg',
                ],
            ],
            'steps_title' => 'Customize Your Logo Stickers in 4 Easy Steps',
            'steps' => [
                ['step' => 1, 'title' => 'Send Your Logo', 'description' => 'Upload your logo file (AI, EPS, PDF, or high-res PNG). We\'ll handle the technical details.'],
                ['step' => 2, 'title' => 'Choose Shape & Size', 'description' => 'Select custom die-cut, circle, square, or rectangle shapes in any size from 1" to 12".'],
                ['step' => 3, 'title' => 'Pick Finish & Quantity', 'description' => 'Choose your finish and order from 50 to 100,000+ pieces with volume discounts.'],
                ['step' => 4, 'title' => 'Review & Approve', 'description' => 'We\'ll send a free digital proof for your approval before production begins.'],
            ],
            'concerns' => [
                ['title' => 'Can you match my exact brand colors?', 'description' => 'Yes! We offer Pantone (PMS) color matching for precise brand color reproduction. Simply provide your PMS numbers and we\'ll ensure accurate color matching across your entire order.'],
                ['title' => 'What if I don\'t have a vector logo file?', 'description' => 'No problem! Our design team can convert your raster logo (PNG, JPG) into a vector format for free. We\'ll ensure it prints crisp and clean at any size.'],
                ['title' => 'Do you offer samples before bulk ordering?', 'description' => 'Yes, we offer sample packs so you can evaluate our quality before placing a large order. Contact us for a free sample request.'],
                ['title' => 'Can I get different logo variations in one order?', 'description' => 'Yes! We can print multiple logo variations within a single order. Each variation needs a minimum of 50 pieces. This is great for brands with multiple sub-brands or seasonal logos.'],
            ],
            'testimonials' => [
                ['name' => 'Rachel Green', 'country' => 'United Kingdom', 'avatar' => '/images/testimonials/avatar-10.jpg', 'text' => 'Our logo stickers look amazing! The colors are spot-on and the die cutting is perfect. We hand them out at every event.'],
                ['name' => 'Carlos Mendez', 'country' => 'Mexico', 'avatar' => '/images/testimonials/avatar-11.jpg', 'text' => 'Professional quality at affordable prices. We use these for all our product packaging and customers love peeling them off.'],
                ['name' => 'Lisa Wang', 'country' => 'Canada', 'avatar' => '/images/testimonials/avatar-12.jpg', 'text' => 'The Pantone color matching was exact. Our brand colors look consistent across all stickers. Will definitely reorder.'],
            ],
            'is_active' => true,
            'sort_order' => 4,
        ]);

        // Product 5: Food Labels
        Product::updateOrCreate(['slug' => 'food-labels'], [
            'category_id' => $foodLabelCat->id,
            'name' => 'Food Labels',
            'slug' => 'food-labels',
            'type' => 'label',
            'description' => 'FDA-compliant custom food labels that meet all regulatory requirements while looking great on your products. Whether you need labels for packaged foods, beverages, sauces, snacks, or organic products, we deliver high-quality food-safe labels with accurate nutritional information, ingredient lists, and allergen warnings.',
            'hero_title' => 'Custom Food Labels',
            'hero_subtitle' => 'FDA-compliant labels that look great and meet all regulatory requirements',
            'features' => [
                [
                    'title' => 'FDA-Compliant Materials',
                    'description' => 'All our food label materials are FDA-approved for direct and indirect food contact. We use food-safe inks and adhesives that comply with FDA 21 CFR regulations.',
                    'image' => '/images/products/food-feature-1.jpg',
                ],
                [
                    'title' => 'Moisture & Grease Resistant',
                    'description' => 'Our food labels withstand refrigeration, condensation, and greasy food surfaces without smudging, peeling, or deteriorating. Perfect for frozen foods, sauces, and oily products.',
                    'image' => '/images/products/food-feature-2.jpg',
                ],
                [
                    'title' => 'Nutritional Label Templates',
                    'description' => 'We offer pre-designed FDA-compliant nutritional label templates that you can customize with your product information. Our team ensures your labels meet all current FDA labeling requirements.',
                    'image' => '/images/products/food-feature-3.jpg',
                ],
            ],
            'steps_title' => 'Customize Your Food Labels in 4 Easy Steps',
            'steps' => [
                ['step' => 1, 'title' => 'Choose Label Format', 'description' => 'Select from cut-to-size, roll, or sheet formats based on your packaging and application needs.'],
                ['step' => 2, 'title' => 'Design Your Label', 'description' => 'Use our templates or upload your own design. We\'ll ensure it meets all FDA labeling requirements.'],
                ['step' => 3, 'title' => 'Select Material', 'description' => 'Choose from our food-safe materials including waterproof, freezer-grade, and grease-resistant options.'],
                ['step' => 4, 'title' => 'Approve & Produce', 'description' => 'Review your proof, approve it, and we\'ll produce your food labels with rigorous quality control.'],
            ],
            'concerns' => [
                ['title' => 'Do your food labels comply with FDA regulations?', 'description' => 'Yes, all our food labels are produced with FDA-compliant materials and inks. We stay up-to-date with the latest FDA labeling requirements and can help ensure your labels meet all current regulations.'],
                ['title' => 'Can food labels withstand freezing temperatures?', 'description' => 'Yes! We offer freezer-grade food labels with special adhesives that maintain their bond at temperatures as low as -40°F (-40°C). These labels won\'t peel or crack in freezer conditions.'],
                ['title' => 'What information is required on food labels?', 'description' => 'FDA requires: product name, net weight, ingredient list, allergen warnings, nutrition facts, manufacturer/distributor info, and country of origin. Our team can help ensure your labels include all required information.'],
                ['title' => 'Can you print variable data on food labels?', 'description' => 'Yes! We support variable data printing for lot numbers, expiration dates, barcodes, and other variable information. This is essential for food traceability and safety.'],
            ],
            'testimonials' => [
                ['name' => 'Mike Thompson', 'country' => 'United States', 'avatar' => '/images/testimonials/avatar-13.jpg', 'text' => 'Funstickers made the FDA compliance process so easy. Their team reviewed our labels and caught issues we would have missed. Great service!'],
                ['name' => 'Sophie Dubois', 'country' => 'France', 'avatar' => '/images/testimonials/avatar-14.jpg', 'text' => 'Our artisan jam labels look beautiful and withstand refrigeration perfectly. The colors stay vibrant even after months in the fridge.'],
                ['name' => 'Andreas Mueller', 'country' => 'Germany', 'avatar' => '/images/testimonials/avatar-15.jpg', 'text' => 'Excellent quality food labels at competitive prices. The variable data printing for expiration dates works flawlessly. Very reliable supplier.'],
            ],
            'is_active' => true,
            'sort_order' => 5,
        ]);

        // Product 6: Candle Labels
        Product::updateOrCreate(['slug' => 'candle-labels'], [
            'category_id' => $candleLabelCat->id,
            'name' => 'Candle Labels',
            'slug' => 'candle-labels',
            'type' => 'label',
            'description' => 'Beautiful custom candle labels that complement your handcrafted candles. Our candle labels are made with heat-resistant materials that won\'t curl, fade, or peel even when exposed to the warmth of a burning candle. Available in a wide range of finishes including metallic, textured, and eco-friendly options.',
            'hero_title' => 'Custom Candle Labels',
            'hero_subtitle' => 'Heat-resistant labels that look beautiful on every candle',
            'features' => [
                [
                    'title' => 'Heat Resistant Material',
                    'description' => 'Our candle labels are made with specially formulated heat-resistant materials that maintain their appearance and adhesion even when candles burn low. No curling, bubbling, or peeling.',
                    'image' => '/images/products/candle-feature-1.jpg',
                ],
                [
                    'title' => 'Luxury Finish Options',
                    'description' => 'Choose from metallic gold/silver, textured linen, smooth matte, or glossy finishes that complement the artisan quality of your candles. Add foil stamping for extra elegance.',
                    'image' => '/images/products/candle-feature-2.jpg',
                ],
                [
                    'title' => 'Wrap-Around Designs',
                    'description' => 'Our wrap-around candle labels are precisely sized to fit your candle containers perfectly. We offer labels for jars, tins, pillars, votives, and all popular candle formats.',
                    'image' => '/images/products/candle-feature-3.jpg',
                ],
            ],
            'steps_title' => 'Customize Your Candle Labels in 4 Easy Steps',
            'steps' => [
                ['step' => 1, 'title' => 'Measure Your Candle', 'description' => 'Provide the dimensions of your candle container and we\'ll create a perfectly sized label template.'],
                ['step' => 2, 'title' => 'Choose Material & Finish', 'description' => 'Select from our heat-resistant materials and luxury finishes including metallic, textured, and eco-friendly options.'],
                ['step' => 3, 'title' => 'Design Your Label', 'description' => 'Upload your design or work with our team to create a label that captures the essence of your candle brand.'],
                ['step' => 4, 'title' => 'Approve & Order', 'description' => 'Review your proof, request any changes, and place your order. Free shipping on orders over $100.'],
            ],
            'concerns' => [
                ['title' => 'Will the labels withstand candle heat?', 'description' => 'Yes! Our candle labels are specifically designed to withstand the heat generated by burning candles. They maintain their adhesion and appearance even when candles burn down to the label line.'],
                ['title' => 'Do you offer labels for different candle container shapes?', 'description' => 'Absolutely! We make labels for glass jars, metal tins, ceramic containers, pillar candles, votives, and more. Just provide the dimensions and we\'ll create a custom fit.'],
                ['title' => 'Can I include safety warnings on my candle labels?', 'description' => 'Yes! We can incorporate ASTM-standard candle safety warnings, CLP compliance information (for EU), and any other required safety text into your label design.'],
                ['title' => 'What is the minimum order for candle labels?', 'description' => 'Our minimum order is 50 labels. We understand many candle makers are small businesses, so we keep our minimums low and offer competitive pricing for small batches.'],
            ],
            'testimonials' => [
                ['name' => 'Ashley Brooks', 'country' => 'United States', 'avatar' => '/images/testimonials/avatar-16.jpg', 'text' => 'These candle labels are gorgeous! The gold metallic finish looks so premium on my soy candles. My customers always comment on them.'],
                ['name' => 'Hannah Schmidt', 'country' => 'Germany', 'avatar' => '/images/testimonials/avatar-17.jpg', 'text' => 'The heat resistance is no joke — my labels look perfect even after the candle burns down. Finally found a label supplier who understands candles!'],
                ['name' => 'Olivia Brown', 'country' => 'United Kingdom', 'avatar' => '/images/testimonials/avatar-18.jpg', 'text' => 'Great quality, fast turnaround, and they helped me design the perfect label for my candle line. The wrap-around fit is spot on.'],
            ],
            'is_active' => true,
            'sort_order' => 6,
        ]);

        // ─── FAQs ──────────────────────────────────────────────────

        // Sticker category FAQs
        $stickerFaqData = [
            ['question' => 'What types of custom stickers do you offer?', 'answer' => 'We offer a wide variety of custom stickers including die cut stickers, kiss cut stickers, vinyl stickers, holographic stickers, clear/transparent stickers, foil stickers, glitter stickers, sticker rolls, and sticker sheets. Each type is available in multiple materials and finishes.'],
            ['question' => 'What materials are your stickers made from?', 'answer' => 'Our stickers are primarily made from premium vinyl (PVC) material with a protective laminate coating. We also offer paper stickers, clear polyester stickers, and specialty materials like holographic and metallic vinyl. All materials are selected for durability and print quality.'],
            ['question' => 'Are your stickers waterproof?', 'answer' => 'Yes! All our vinyl stickers are 100% waterproof. They can withstand rain, spills, and even dishwasher cycles. Our paper stickers are not waterproof but are suitable for indoor applications.'],
            ['question' => 'What is the minimum order quantity for stickers?', 'answer' => 'Our minimum order is just 50 stickers for most types. We offer competitive pricing that decreases with quantity, making it affordable for both small and large orders.'],
            ['question' => 'How long do your stickers last outdoors?', 'answer' => 'Our premium vinyl stickers last 3-5 years outdoors with UV and water resistance. Indoor stickers can last 5+ years. The lifespan depends on the specific material and environmental conditions.'],
            ['question' => 'What file formats do you accept for sticker designs?', 'answer' => 'We accept AI, PDF, EPS, PSD, SVG, and high-resolution PNG/JPG files (300 DPI minimum). Vector formats (AI, PDF, EPS) are preferred for the best print quality and accurate die-cutting.'],
            ['question' => 'Can you help me design my stickers?', 'answer' => 'Absolutely! Our in-house design team can help bring your vision to life. We offer free basic design adjustments and affordable custom design services for more complex projects.'],
            ['question' => 'What is the difference between die cut and kiss cut stickers?', 'answer' => 'Die cut stickers are cut all the way through both the sticker and backing, creating individual stickers in your custom shape. Kiss cut stickers are cut only through the top vinyl layer, leaving them on a rectangular backing sheet — ideal for sticker sheets with multiple designs.'],
            ['question' => 'Do you offer free samples?', 'answer' => 'Yes! We offer a free sample pack so you can evaluate our sticker quality before placing a bulk order. Contact our team to request your free sample pack.'],
            ['question' => 'How long does production take?', 'answer' => 'Standard production time is 5-7 business days after proof approval. Rush orders (2-3 business days) are available for an additional fee. Shipping times vary by destination.'],
            ['question' => 'Can I get a custom shape for my stickers?', 'answer' => 'Yes! Our die-cut technology can cut stickers into virtually any shape. Simply provide your design and we\'ll create a custom cut line that follows the outline of your artwork.'],
            ['question' => 'Do you offer bulk/wholesale pricing?', 'answer' => 'Yes! We offer competitive volume discounts for orders of 1,000+ stickers. The more you order, the lower the per-unit price. Contact us for a custom quote on large orders.'],
            ['question' => 'Are your stickers safe for food packaging?', 'answer' => 'We offer FDA-compliant stickers specifically designed for food packaging applications. These are made with food-safe inks and adhesives that meet FDA regulations for indirect food contact.'],
        ];

        foreach ($stickerFaqData as $i => $faq) {
            // Assign to sticker categories in rotation
            $stickerCatIds = Category::where('type', 'sticker')->pluck('id')->toArray();
            $catId = $stickerCatIds[$i % count($stickerCatIds)];
            Faq::updateOrCreate(['question' => $faq['question']], [
                'category_id' => $catId,
                'product_id' => null,
                'question' => $faq['question'],
                'answer' => $faq['answer'],
                'sort_order' => $i + 1,
                'is_active' => true,
            ]);
        }

        // Label category FAQs
        $labelFaqData = [
            ['question' => 'What types of labels do you offer?', 'answer' => 'We offer custom labels for all applications including food labels, beverage labels, candle labels, cosmetic labels, pharmaceutical labels, industrial labels, and more. Each type is available in multiple materials, finishes, and formats.'],
            ['question' => 'What label materials do you offer?', 'answer' => 'We offer a wide range of label materials including white paper, gloss paper, matte paper, vinyl, clear polyester, metallic foil, textured materials, and eco-friendly options. Each material is available with various adhesive options.'],
            ['question' => 'Do your food labels comply with FDA regulations?', 'answer' => 'Yes, all our food label materials are FDA-compliant for indirect and direct food contact. We use food-safe inks and adhesives and stay up-to-date with all FDA labeling requirements.'],
            ['question' => 'What is the difference between cut-to-size and roll labels?', 'answer' => 'Cut-to-size labels are individually cut and delivered in stacks, ideal for manual application. Roll labels are wound on a core, perfect for high-speed machine application and larger production runs.'],
            ['question' => 'Can you print variable data on labels?', 'answer' => 'Yes! We support variable data printing for barcodes, QR codes, lot numbers, expiration dates, sequential numbering, and personalized information on each label.'],
            ['question' => 'Are your labels waterproof?', 'answer' => 'We offer waterproof label options made from vinyl and polyester materials. These are ideal for products that encounter moisture, refrigeration, or outdoor exposure.'],
            ['question' => 'What adhesive options are available?', 'answer' => 'We offer permanent, removable, freezer-grade, and repositionable adhesives. The right choice depends on your product and application requirements. Our team can help you select the best option.'],
            ['question' => 'What is the minimum order for labels?', 'answer' => 'Our minimum order is 100 labels for cut-to-size and 250 for roll labels. We offer competitive pricing with volume discounts for larger quantities.'],
            ['question' => 'Can I get a proof before production?', 'answer' => 'Yes! We provide free digital proofs for all label orders. You can review and request changes before production begins. We also offer physical proof samples for an additional fee.'],
            ['question' => 'Do you offer eco-friendly label options?', 'answer' => 'Yes! We offer eco-friendly label materials including recycled paper, biodegradable materials, and FSC-certified options. These are perfect for brands committed to sustainability.'],
        ];

        $labelCatIds = Category::where('type', 'label')->pluck('id')->toArray();
        foreach ($labelFaqData as $i => $faq) {
            $catId = $labelCatIds[$i % count($labelCatIds)];
            Faq::updateOrCreate(['question' => $faq['question']], [
                'category_id' => $catId,
                'product_id' => null,
                'question' => $faq['question'],
                'answer' => $faq['answer'],
                'sort_order' => $i + 1,
                'is_active' => true,
            ]);
        }

        // Product-specific FAQs
        $productFaqData = [
            'holographic-stickers' => [
                ['question' => 'What makes holographic stickers special?', 'answer' => 'Holographic stickers feature a special material that creates a rainbow shimmer effect when light hits it from different angles. This dynamic visual effect is impossible to replicate with regular printing and makes your brand truly stand out.'],
                ['question' => 'Can I choose which parts of my design are holographic?', 'answer' => 'Yes! The entire sticker surface has the holographic effect, but you can use white ink underlay to make specific areas appear as solid colors while leaving other areas holographic. Our design team can help you optimize your artwork for this effect.'],
                ['question' => 'Are holographic stickers more expensive than regular stickers?', 'answer' => 'Holographic stickers are slightly more expensive than standard vinyl stickers due to the premium holographic material. However, the visual impact they create makes them an excellent value for branding and promotional use.'],
                ['question' => 'Can holographic stickers be used outdoors?', 'answer' => 'Yes! Our holographic stickers are made with waterproof vinyl and UV-resistant laminate. They can be used outdoors and will maintain their shimmer effect and color for 2-3 years in outdoor conditions.'],
                ['question' => 'What colors print best on holographic material?', 'answer' => 'Dark colors (black, navy, dark purple) create the most dramatic holographic effect because they allow the rainbow shimmer to show through. Light colors and white areas will appear more subtle. Our team can advise on the best color choices for your design.'],
            ],
            'die-cut-stickers' => [
                ['question' => 'How precise is your die cutting?', 'answer' => 'Our die cutting precision is within 1mm accuracy. We use advanced digital cutting technology that can handle complex shapes with clean, consistent edges across your entire order.'],
                ['question' => 'Can I get a custom die cut shape that isn\'t a standard shape?', 'answer' => 'Absolutely! That\'s the whole point of die cut stickers. We can cut virtually any shape you can design — logos, mascots, objects, text, and more. The only limitation is avoiding elements thinner than 2mm.'],
                ['question' => 'Do die cut stickers have a white border?', 'answer' => 'Die cut stickers can be made with or without a white border. A "bleed" edge (design extends slightly past the cut line) ensures no white edges show. We typically recommend a 2mm bleed for the best results.'],
                ['question' => 'What is the largest die cut sticker you can make?', 'answer' => 'We can produce die cut stickers up to 12" x 12" (30cm x 30cm). For larger sizes, please contact us for a custom quote. Most standard orders range from 1" to 6".'],
                ['question' => 'How are die cut stickers packaged?', 'answer' => 'Individual die cut stickers are typically stacked and packaged in clear bags. We also offer custom backing cards, branded packaging, and retail-ready packaging options for an additional charge.'],
            ],
            'vinyl-stickers' => [
                ['question' => 'What is the difference between white vinyl and clear vinyl?', 'answer' => 'White vinyl has a white background that makes colors appear vibrant and opaque. Clear vinyl is transparent, allowing the surface behind the sticker to show through — ideal for glass and window applications.'],
                ['question' => 'Can vinyl stickers be used on clothing?', 'answer' => 'Vinyl stickers are not recommended for clothing as they are not flexible enough for fabric. For clothing applications, we recommend our iron-on transfers or fabric stickers instead.'],
                ['question' => 'How do I apply vinyl stickers without bubbles?', 'answer' => 'Clean the surface thoroughly, peel the backing, position the sticker, and press from the center outward using a squeegee or credit card. For large stickers, we recommend the "hinge method" — contact us for detailed application instructions.'],
                ['question' => 'Are vinyl stickers recyclable?', 'answer' => 'Vinyl stickers are not currently recyclable through standard municipal recycling. However, we offer eco-friendly paper sticker alternatives that are fully recyclable and biodegradable.'],
                ['question' => 'Can I get vinyl stickers in metallic colors?', 'answer' => 'Yes! We offer metallic gold and silver vinyl materials that provide a genuine metallic sheen. These are perfect for luxury branding, awards, and premium product applications.'],
            ],
            'logo-stickers' => [
                ['question' => 'Can you print my logo in exact brand colors?', 'answer' => 'Yes! We use Pantone (PMS) color matching to ensure your brand colors are reproduced with precision. Simply provide your PMS numbers and we\'ll match them exactly.'],
                ['question' => 'What is the best size for a logo sticker?', 'answer' => 'The best size depends on your application. For laptop stickers: 2-3 inches. For product packaging: 1-2 inches. For car decals: 4-6 inches. For promotional handouts: 2-3 inches. We can advise on the ideal size for your specific use.'],
                ['question' => 'Can I get my logo stickers on custom backing cards?', 'answer' => 'Yes! We offer custom-printed backing cards that add a professional touch to your logo stickers. These are perfect for retail displays, event giveaways, and promotional packages.'],
                ['question' => 'Do you offer logo sticker sample packs?', 'answer' => 'Yes! We offer sample packs that showcase different materials and finishes. This lets you evaluate the quality and choose the best option for your brand before placing a bulk order.'],
                ['question' => 'How do I prepare my logo for sticker printing?', 'answer' => 'For the best results, provide your logo as a vector file (AI, EPS, or PDF) with outlined text. If you only have a raster file (PNG/JPG), our design team can convert it for free. Ensure your logo is high resolution (300+ DPI).'],
            ],
            'food-labels' => [
                ['question' => 'What information must be on a food label?', 'answer' => 'FDA requires: product name, net weight (both metric and US), ingredient list (in descending order by weight), allergen warnings, nutrition facts panel, name and address of manufacturer/distributor, and country of origin.'],
                ['question' => 'Do you provide nutrition fact panel templates?', 'answer' => 'Yes! We offer FDA-compliant nutrition fact panel templates in standard, tabular, and linear formats. Our team can help you format your nutritional information correctly.'],
                ['question' => 'Can food labels withstand cooking temperatures?', 'answer' => 'Standard food labels are not designed for cooking temperatures. However, we offer special heat-resistant labels that can withstand oven temperatures up to 500°F for microwave and oven-safe packaging.'],
                ['question' => 'Are your food labels BPA-free?', 'answer' => 'Yes! All our food label materials are BPA-free and comply with current food safety regulations. We use food-safe inks and adhesives throughout our food label production.'],
                ['question' => 'Can you print labels with QR codes linking to recipes?', 'answer' => 'Absolutely! We can print QR codes on your food labels that link to recipes, nutritional information, promotional pages, or any URL. This is a great way to engage customers and provide additional product information.'],
            ],
            'candle-labels' => [
                ['question' => 'What safety information should be on candle labels?', 'answer' => 'ASTM standards require candle labels to include: manufacturer information, candle identity, net weight, and safety warnings (burn within sight, keep away from flammables, keep away from children, etc.). For EU markets, CLP compliance is also required.'],
                ['question' => 'Can candle labels withstand the heat of a burning candle?', 'answer' => 'Yes! Our candle labels are made with heat-resistant materials and adhesives that maintain their appearance and bond even when candles burn down. They won\'t curl, discolor, or peel from heat exposure.'],
                ['question' => 'Do you offer labels for soy wax candles?', 'answer' => 'Yes! We offer labels specifically designed for soy wax candles, including options with eco-friendly materials and natural textures that complement the organic feel of soy candles.'],
                ['question' => 'What is the best label material for candle jars?', 'answer' => 'For glass candle jars, we recommend our white gloss vinyl or metallic vinyl materials with permanent adhesive. These provide excellent adhesion to glass and a premium appearance. For a more natural look, try our textured linen material.'],
                ['question' => 'Can I order labels for multiple candle scents in one order?', 'answer' => 'Yes! We can print different label designs (for different scents) within the same order. Each design variant requires a minimum of 50 labels. This is a cost-effective way to label your entire candle line.'],
            ],
        ];

        foreach ($productFaqData as $slug => $faqs) {
            $product = Product::where('slug', $slug)->first();
            if ($product) {
                foreach ($faqs as $i => $faq) {
                    Faq::updateOrCreate(['question' => $faq['question']], [
                        'product_id' => $product->id,
                        'category_id' => null,
                        'question' => $faq['question'],
                        'answer' => $faq['answer'],
                        'sort_order' => $i + 1,
                        'is_active' => true,
                    ]);
                }
            }
        }

        // ─── Blog Posts ────────────────────────────────────────────
        $blogPosts = [
            [
                'title' => 'The Ultimate Guide to Custom Die Cut Stickers for Your Business',
                'slug' => 'ultimate-guide-custom-die-cut-stickers',
                'excerpt' => 'Learn everything about custom die cut stickers — from design tips to material choices — and discover how they can elevate your brand visibility.',
                'content' => '<h2>Why Die Cut Stickers Are a Game-Changer for Brands</h2>

<p>Custom die cut stickers have become one of the most popular and effective marketing tools for businesses of all sizes. Unlike standard rectangular stickers, die cut stickers are precisely cut to follow the exact outline of your design, creating a professional and eye-catching result that stands out from the crowd.</p>

<h3>What Makes Die Cut Stickers Special?</h3>

<p>The key difference between die cut stickers and other types is the cutting method. Die cut stickers are cut all the way through both the vinyl material and the backing, creating individual stickers in your exact custom shape. This means no white borders and no wasted space — just your design, perfectly cut and ready to make an impression.</p>

<h3>Design Tips for Perfect Die Cut Stickers</h3>

<p>When designing die cut stickers, keep these tips in mind:</p>

<ul>
<li><strong>Keep it simple:</strong> Bold, clean designs work best for stickers. Avoid tiny details that might not reproduce well at small sizes.</li>
<li><strong>Add a bleed:</strong> Extend your design 2-3mm past the cut line to ensure no white edges show after cutting.</li>
<li><strong>Avoid thin elements:</strong> Lines or shapes thinner than 2mm may not cut cleanly or could be fragile.</li>
<li><strong>Use vector files:</strong> AI, EPS, or PDF files give the sharpest, most accurate results.</li>
</ul>

<h3>Choosing the Right Material</h3>

<p>At Funstickers, we offer several premium materials for die cut stickers:</p>

<ul>
<li><strong>White Vinyl:</strong> The most popular choice. Vibrant colors, waterproof, and durable.</li>
<li><strong>Clear Vinyl:</strong> Transparent background for a clean, modern look on glass and surfaces.</li>
<li><strong>Holographic Vinyl:</strong> Eye-catching rainbow shimmer effect that demands attention.</li>
<li><strong>Metallic Vinyl:</strong> Available in gold and silver for a premium, luxury feel.</li>
</ul>

<h3>Get Started with Your Custom Die Cut Stickers</h3>

<p>Ready to create your own die cut stickers? Simply upload your design, choose your material and size, and we\'ll handle the rest. Our minimum order is just 50 pieces, and we offer free digital proofs on every order.</p>',
                'meta_title' => 'Ultimate Guide to Custom Die Cut Stickers | Funstickers',
                'meta_description' => 'Learn everything about custom die cut stickers — design tips, material choices, and how they can elevate your brand. Free digital proofs, 50 piece minimum.',
            ],
            [
                'title' => 'Holographic Stickers: The Secret Weapon for Brand Differentiation',
                'slug' => 'holographic-stickers-brand-differentiation',
                'excerpt' => 'Discover how holographic stickers can make your brand unforgettable with their stunning rainbow shimmer effects and premium visual appeal.',
                'content' => '<h2>Why Holographic Stickers Are Taking the Branding World by Storm</h2>

<p>In a world saturated with marketing messages, standing out is harder than ever. Holographic stickers offer a unique solution — their mesmerizing rainbow shimmer effect is impossible to ignore and creates an instant "wow" factor that regular stickers simply can\'t match.</p>

<h3>The Science Behind the Shimmer</h3>

<p>Holographic stickers are made with a special material that contains micro-embossed patterns. When light hits these patterns, it diffracts into a spectrum of colors, creating the signature rainbow shimmer effect. This effect changes depending on the viewing angle, making the sticker dynamic and eye-catching from every direction.</p>

<h3>Best Uses for Holographic Stickers</h3>

<p>Holographic stickers excel in applications where visual impact is paramount:</p>

<ul>
<li><strong>Product Packaging:</strong> Add holographic seals or labels to make products pop on store shelves.</li>
<li><strong>Event Merchandise:</strong> Concert and festival holographic stickers are collector\'s items.</li>
<li><strong>Brand Merchandising:</strong> Holographic logo stickers generate social media buzz.</li>
<li><strong>Promotional Giveaways:</strong> People keep holographic stickers longer because they\'re special.</li>
</ul>

<h3>Designing for Holographic Material</h3>

<p>Not all designs work equally well on holographic material. Here\'s what you need to know:</p>

<p>Dark colors like black, navy, and deep purple create the most dramatic holographic effect because they allow the rainbow shimmer to show through prominently. Light colors and white areas will appear more subtle, with less visible shimmer. For the best results, consider using a white ink underlay on specific areas while leaving others holographic.</p>

<h3>Quality Matters</h3>

<p>At Funstickers, our holographic stickers are made with premium vinyl and a protective laminate coating. This means they\'re not just beautiful — they\'re also waterproof, UV-resistant, and built to last for years both indoors and outdoors.</p>',
                'meta_title' => 'Holographic Stickers for Brand Differentiation | Funstickers',
                'meta_description' => 'Discover how holographic stickers with stunning rainbow shimmer effects can differentiate your brand. Premium quality, waterproof, and made to last.',
            ],
            [
                'title' => 'Vinyl Stickers vs Paper Stickers: Which Is Right for Your Project?',
                'slug' => 'vinyl-stickers-vs-paper-stickers',
                'excerpt' => 'A comprehensive comparison of vinyl and paper stickers to help you choose the right material for your specific application and budget.',
                'content' => '<h2>Making the Right Choice: Vinyl vs Paper Stickers</h2>

<p>One of the most common questions we get at Funstickers is: "Should I choose vinyl or paper stickers?" The answer depends on your specific application, budget, and desired aesthetic. Let\'s break down the key differences to help you make an informed decision.</p>

<h3>Vinyl Stickers: The Durable Choice</h3>

<p>Vinyl stickers are made from PVC (polyvinyl chloride) material and are the gold standard for durability and versatility. Here\'s why they\'re our most popular option:</p>

<ul>
<li><strong>Waterproof:</strong> Completely resistant to water, rain, and spills.</li>
<li><strong>UV-Resistant:</strong> Won\'t fade in sunlight for 3-5+ years.</li>
<li><strong>Scratch-Proof:</strong> Protective laminate coating resists scratches and scuffs.</li>
<li><strong>Versatile:</strong> Sticks to virtually any smooth surface — glass, metal, plastic, wood.</li>
<li><strong>Outdoor-Ready:</strong> Perfect for car decals, outdoor equipment, and more.</li>
</ul>

<h3>Paper Stickers: The Eco-Friendly & Economical Choice</h3>

<p>Paper stickers offer their own unique advantages:</p>

<ul>
<li><strong>Cost-Effective:</strong> Generally 20-40% less expensive than vinyl.</li>
<li><strong>Eco-Friendly:</strong> Made from renewable materials and fully recyclable.</li>
<li><strong>Natural Feel:</strong> Matte and uncoated options provide a tactile, artisan quality.</li>
<li><strong>Writeable:</strong> You can write on paper stickers with pen or marker.</li>
<li><strong>Best for Indoor Use:</strong> Ideal for packaging, envelopes, and indoor displays.</li>
</ul>

<h3>When to Choose Vinyl</h3>

<p>Choose vinyl stickers when your stickers will be exposed to moisture, sunlight, or frequent handling. This includes: water bottles, laptops, car bumpers, outdoor signage, product packaging that may get wet, and any application requiring long-term durability.</p>

<h3>When to Choose Paper</h3>

<p>Choose paper stickers when you need an economical option for indoor, short-term use. This includes: packaging seals, address labels, envelope stickers, food packaging (dry goods), event name tags, and eco-friendly branding.</p>

<h3>Our Recommendation</h3>

<p>When in doubt, choose vinyl. The small price difference is worth the dramatically superior durability and versatility. However, if sustainability is a top priority for your brand, our premium paper stickers are an excellent choice that won\'t let you down for indoor applications.</p>',
                'meta_title' => 'Vinyl vs Paper Stickers: Complete Comparison | Funstickers',
                'meta_description' => 'Comprehensive comparison of vinyl and paper stickers. Learn the key differences in durability, cost, and applications to choose the right material for your project.',
            ],
            [
                'title' => 'Food Label Compliance: Everything You Need to Know in 2024',
                'slug' => 'food-label-compliance-guide-2024',
                'excerpt' => 'Stay compliant with the latest FDA food labeling requirements. Our comprehensive guide covers nutrition facts, allergen warnings, and essential label elements.',
                'content' => '<h2>Navigating FDA Food Label Requirements</h2>

<p>Food labeling compliance is not optional — it\'s a legal requirement that protects consumers and ensures fair trade. Failing to comply can result in product recalls, fines, and damage to your brand reputation. This guide covers the essential elements every food label must include in 2024.</p>

<h3>Required Elements on Every Food Label</h3>

<p>The FDA requires the following elements on all packaged food products:</p>

<ol>
<li><strong>Product Identity:</strong> The common or usual name of the food, prominently displayed.</li>
<li><strong>Net Quantity:</strong> The net weight or volume in both metric and US customary units.</li>
<li><strong>Ingredient List:</strong> All ingredients listed in descending order by weight.</li>
<li><strong>Allergen Declaration:</strong> The 9 major allergens (milk, eggs, fish, shellfish, tree nuts, peanuts, wheat, soybeans, sesame) must be clearly declared.</li>
<li><strong>Nutrition Facts Panel:</strong> Standardized nutrition information including serving size, calories, and daily values.</li>
<li><strong>Manufacturer Information:</strong> Name and address of the manufacturer, packer, or distributor.</li>
<li><strong>Country of Origin:</strong> Where the product was manufactured or produced.</li>
</ol>

<h3>2024 Nutrition Facts Panel Updates</h3>

<p>The FDA has made several updates to the Nutrition Facts panel requirements that you should be aware of:</p>

<ul>
<li>Added "Added Sugars" as a new required line item</li>
<li>Updated Daily Values for various nutrients</li>
<li>Changed serving size requirements to reflect actual consumption patterns</li>
<li>Requires dual-column labeling for packages containing 2-3 servings</li>
</ul>

<h3>Allergen Labeling Best Practices</h3>

<p>Proper allergen labeling is critical for consumer safety. The FDA requires that major allergens be declared either in the ingredient list using the common name, or in a separate "Contains" statement below the ingredient list. Many manufacturers choose to do both for maximum clarity.</p>

<h3>How Funstickers Helps with Compliance</h3>

<p>At Funstickers, we understand the complexities of food labeling compliance. Our team can help you with FDA-compliant label templates, proper nutritional panel formatting, and food-safe materials that meet all regulatory requirements. We stay up-to-date with the latest FDA regulations so you don\'t have to.</p>',
                'meta_title' => 'FDA Food Label Compliance Guide 2024 | Funstickers',
                'meta_description' => 'Complete guide to FDA food labeling requirements in 2024. Nutrition facts, allergen declarations, and compliance tips from Funstickers.',
            ],
            [
                'title' => 'How to Design the Perfect Candle Label for Your Brand',
                'slug' => 'design-perfect-candle-label',
                'excerpt' => 'From choosing the right material to designing a label that sells, learn everything you need to create stunning candle labels that customers love.',
                'content' => '<h2>Creating Candle Labels That Sell</h2>

<p>The candle market is booming, and with so many brands competing for attention, your candle label needs to do more than just look pretty — it needs to tell your brand story, communicate essential information, and compel customers to choose your candle over the competition. Here\'s how to design the perfect candle label.</p>

<h3>Start with the Right Material</h3>

<p>Candle labels face unique challenges that other product labels don\'t: heat exposure, potential wax residue, and condensation. Choosing the right material is crucial:</p>

<ul>
<li><strong>Heat-Resistant Vinyl:</strong> Our top recommendation for candle labels. Maintains adhesion and appearance even when candles burn low.</li>
<li><strong>Textured Paper:</strong> Perfect for artisan and handcrafted candles. Provides a natural, tactile feel that complements organic products.</li>
<li><strong>Metallic Foil:</strong> For luxury candle brands, nothing says premium like gold or silver foil accents.</li>
<li><strong>Matte Laminate:</strong> Sophisticated and modern. Reduces glare and provides a smooth, elegant finish.</li>
</ul>

<h3>Essential Elements of a Candle Label</h3>

<p>A well-designed candle label should include:</p>

<ul>
<li><strong>Brand Name & Logo:</strong> Your most prominent element. Make it instantly recognizable.</li>
<li><strong>Scent Name:</strong> Clearly display the fragrance name and description.</li>
<li><strong>Net Weight:</strong> Required by law. Display in ounces and grams.</li>
<li><strong>Safety Warnings:</strong> ASTM-compliant safety instructions are required for all candles.</li>
<li><strong>Burn Time:</strong> Customers want to know how long the candle will last.</li>
<li><strong>Ingredients:</strong> Wax type (soy, beeswax, paraffin) and fragrance composition.</li>
</ul>

<h3>Design Tips for Maximum Impact</h3>

<p>Use these proven design strategies to create candle labels that sell:</p>

<ol>
<li><strong>Color Psychology:</strong> Warm colors (amber, gold, deep red) suggest warmth and coziness. Cool colors (blue, green, lavender) suggest freshness and calm. Match your color palette to your scent profile.</li>
<li><strong>Typography:</strong> Use elegant serif fonts for luxury positioning, or clean sans-serif for modern, minimalist branding. Limit yourself to 2-3 font families maximum.</li>
<li><strong>White Space:</strong> Don\'t overcrowd your label. Strategic use of white space creates a premium feel and makes key information easier to read.</li>
<li><strong>Wrap-Around Design:</strong> For jar candles, use the full wrap-around space. Front: brand and scent. Back: ingredients and safety info. Side: story or additional details.</li>
</ol>

<h3>Get Started with Funstickers</h3>

<p>At Funstickers, we specialize in candle labels that look amazing and perform flawlessly. Our heat-resistant materials, precision cutting, and color-matching technology ensure your candle labels exceed your expectations. Start with as few as 50 labels and scale up as your candle business grows.</p>',
                'meta_title' => 'How to Design the Perfect Candle Label | Funstickers',
                'meta_description' => 'Learn how to design stunning candle labels that sell. Material choices, essential elements, and design tips from the experts at Funstickers.',
            ],
        ];

        foreach ($blogPosts as $i => $post) {
            BlogPost::updateOrCreate(['slug' => $post['slug']], array_merge($post, [
                'image' => '/images/blog/blog-' . ($i + 1) . '.jpg',
                'is_published' => true,
                'published_at' => now()->subDays(count($blogPosts) - $i),
            ]));
        }

        // ─── Certificates ─────────────────────────────────────────
        $certificates = [
            ['name' => 'BSCI', 'image' => '/images/certificates/bsci.png'],
            ['name' => 'CUL', 'image' => '/images/certificates/cul.png'],
            ['name' => 'UL', 'image' => '/images/certificates/ul.png'],
            ['name' => 'REACH', 'image' => '/images/certificates/reach.png'],
            ['name' => 'FSC', 'image' => '/images/certificates/fsc.png'],
            ['name' => 'CSA', 'image' => '/images/certificates/csa.png'],
            ['name' => 'ISO', 'image' => '/images/certificates/iso.png'],
            ['name' => 'GMI', 'image' => '/images/certificates/gmi.png'],
        ];

        foreach ($certificates as $i => $cert) {
            Certificate::updateOrCreate(['name' => $cert['name']], array_merge($cert, [
                'sort_order' => $i + 1,
                'is_active' => true,
            ]));
        }

        // ─── Brands ───────────────────────────────────────────────
        $brands = [
            ['name' => 'Coca-Cola', 'image' => '/images/brands/coca-cola.png', 'link' => 'https://www.coca-cola.com'],
            ['name' => 'Unilever', 'image' => '/images/brands/unilever.png', 'link' => 'https://www.unilever.com'],
            ['name' => 'L\'Oreal', 'image' => '/images/brands/loreal.png', 'link' => 'https://www.loreal.com'],
            ['name' => 'Nestle', 'image' => '/images/brands/nestle.png', 'link' => 'https://www.nestle.com'],
        ];

        foreach ($brands as $i => $brand) {
            Brand::updateOrCreate(['name' => $brand['name']], array_merge($brand, [
                'sort_order' => $i + 1,
                'is_active' => true,
            ]));
        }

        // ─── Team Members ─────────────────────────────────────────
        $teamMembers = [
            ['name' => 'Allen', 'title' => 'Sales Manager', 'avatar' => '/images/team/allen.jpg', 'bio' => 'With over 10 years of experience in international sticker and label sales, Allen leads our sales team with a customer-first approach. He has helped thousands of businesses find the perfect sticker and label solutions for their needs.'],
            ['name' => 'Lee', 'title' => 'Senior Consultant', 'avatar' => '/images/team/lee.jpg', 'bio' => 'Lee brings 15 years of printing industry expertise to Funstickers. As our Senior Consultant, he provides technical guidance on materials, finishes, and production methods to ensure every project achieves the best possible results.'],
            ['name' => 'Liang', 'title' => 'Marketing Director', 'avatar' => '/images/team/liang.jpg', 'bio' => 'Liang drives our brand strategy and market expansion efforts. With a deep understanding of the global sticker and label market, he ensures Funstickers stays ahead of industry trends and continues to deliver value to our clients.'],
            ['name' => 'Lilia', 'title' => 'Team Leader', 'avatar' => '/images/team/lilia.jpg', 'bio' => 'Lilia leads our production team with precision and dedication. She oversees quality control, production scheduling, and ensures every order meets our rigorous standards before shipping.'],
        ];

        foreach ($teamMembers as $i => $member) {
            TeamMember::updateOrCreate(['name' => $member['name']], array_merge($member, [
                'sort_order' => $i + 1,
                'is_active' => true,
            ]));
        }

        // ─── Admin User ──────────────────────────────────────────────
        // Use updateOrCreate to avoid unique constraint violation on repeated seeding
        \App\Models\User::updateOrCreate(
            ['email' => 'admin@meisaiprinting.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('admin123'),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );
    } // end seedAll()
}
