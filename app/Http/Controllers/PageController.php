<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Certificate;
use App\Models\Product;
use App\Models\Setting;
use App\Models\BlogPost;
use App\Models\Faq;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Display the homepage.
     */
    public function index(): View
    {
        // Hero banner settings (3 slides)
        $heroSlides = [];
        for ($i = 1; $i <= 3; $i++) {
            // Check if this slide is enabled (default: enabled)
            $enabled = Setting::get("hero_{$i}_enabled", '1');
            if ($enabled !== '1') {
                continue; // Skip disabled slides — no HTML rendered, no images loaded
            }

            $title = Setting::get("hero_{$i}_title", '');
            $subtitle = Setting::get("hero_{$i}_subtitle", '');
            $ctaText = Setting::get("hero_{$i}_cta_text", '');
            $ctaLink = Setting::get("hero_{$i}_cta_link", '');
            $image = Setting::get("hero_{$i}_image", '/images/hero-' . $i . '.jpg');

            if ($title || $image) {
                $heroSlides[] = [
                    'title' => $title,
                    'subtitle' => $subtitle,
                    'cta_text' => $ctaText,
                    'cta_link' => $ctaLink,
                    'image' => $image,
                ];
            }
        }
        // Fallback if no slides configured
        if (empty($heroSlides)) {
            $heroSlides = [
                ['title' => 'Custom Stickers & Labels for Business', 'subtitle' => '24 years of experience in custom stickers and labels', 'cta_text' => 'Get Free Quote', 'cta_link' => '#quote-form', 'image' => '/images/hero-1.jpg'],
            ];
        }

        // Five main navigation categories by group
        $materialCategories = Category::with(['products' => function ($query) {
            $query->active()->ordered();
        }])->byGroup('material')->active()->ordered()->get();

        $industryCategories = Category::with(['products' => function ($query) {
            $query->active()->ordered();
        }])->byGroup('industry')->active()->ordered()->get();

        $shapeCategories = Category::with(['products' => function ($query) {
            $query->active()->ordered();
        }])->byGroup('shape')->active()->ordered()->get();

        // Custom Stickers - use type='sticker' for backward compatibility
        $stickerCategories = Category::with(['products' => function ($query) {
            $query->active()->ordered();
        }])->byGroup('sticker')->active()->ordered()->get();

        // If no sticker group categories, fall back to type='sticker'
        if ($stickerCategories->isEmpty()) {
            $stickerCategories = Category::with(['products' => function ($query) {
                $query->active()->ordered();
            }])->where('type', 'sticker')->active()->ordered()->get();
        }

        // Blank Labels - use type='label' for backward compatibility
        $blankLabelCategories = Category::with(['products' => function ($query) {
            $query->active()->ordered();
        }])->byGroup('label')->active()->ordered()->get();

        // If no label group categories, fall back to type='label'
        if ($blankLabelCategories->isEmpty()) {
            $blankLabelCategories = Category::with(['products' => function ($query) {
                $query->active()->ordered();
            }])->where('type', 'label')->active()->ordered()->get();
        }

        // Certificates
        $certificates = Certificate::active()->ordered()->get();

        // Brands
        $brands = Brand::active()->ordered()->get();

        // Latest blog posts
        $latestPosts = BlogPost::published()->latestPublished()->take(3)->get();

        // Best-selling products (featured / active products)
        $bestSellers = Product::with('category')->active()->ordered()->take(8)->get();

        // Expertise section settings
        $expertiseTitle = Setting::get('expertise_title', 'Expertise Is More Than Just Words');
        $expertiseContent = Setting::get('expertise_content', "With over 24 years of experience in custom sticker and label manufacturing, MeisaiPrinting has built a reputation for delivering high-quality products at competitive prices. Our state-of-the-art facility and dedicated team ensure every order meets the highest standards.\n\nFrom small businesses to global brands, we've helped thousands of clients bring their vision to life through custom adhesive solutions. Our FSC, UL, and CSA certifications are a testament to our commitment to quality and sustainability.");
        $expertiseButtonText = Setting::get('expertise_button_text', 'More About Us');
        $expertiseButtonLink = Setting::get('expertise_button_link', '/pages/MeisaiPrinting');
        $expertiseVideoUrl = Setting::get('expertise_video_url', '');

        // Convert YouTube URL to embed URL
        $expertiseVideoEmbed = '';
        if ($expertiseVideoUrl) {
            $expertiseVideoEmbed = $this->getYoutubeEmbedUrl($expertiseVideoUrl);
        }

        // Site settings for footer etc.
        $siteName = Setting::get('site_name', 'MeisaiPrinting');
        $footerAbout = Setting::get('footer_about');
        $footerEmail = Setting::get('footer_email');
        $footerPhone = Setting::get('footer_phone');
        $footerAddress = Setting::get('footer_address');

        return view('pages.home', compact(
            'heroSlides',
            'materialCategories',
            'industryCategories',
            'shapeCategories',
            'stickerCategories',
            'blankLabelCategories',
            'certificates',
            'brands',
            'latestPosts',
            'bestSellers',
            'expertiseTitle',
            'expertiseContent',
            'expertiseButtonText',
            'expertiseButtonLink',
            'expertiseVideoUrl',
            'expertiseVideoEmbed',
            'siteName',
            'footerAbout',
            'footerEmail',
            'footerPhone',
            'footerAddress'
        ));
    }

    /**
     * Display the Blank Labels catalog page.
     */
    public function blankLabels(): View
    {
        // Load categories of type label (blank labels)
        $categories = Category::with(['products' => function ($query) {
            $query->active()->ordered();
        }])
            ->byGroup('label')
            ->active()
            ->ordered()
            ->get();

        // Fall back to type='label' if no group='label' categories
        if ($categories->isEmpty()) {
            $categories = Category::with(['products' => function ($query) {
                $query->active()->ordered();
            }])
                ->where('type', 'label')
                ->active()
                ->ordered()
                ->get();
        }

        // Category-level FAQs
        $categoryIds = $categories->pluck('id');
        $faqs = Faq::with('category')
            ->whereIn('category_id', $categoryIds)
            ->active()
            ->ordered()
            ->get();

        // Brands
        $brands = Brand::active()->ordered()->get();

        return view('pages.blank-labels', compact('categories', 'faqs', 'brands'));
    }

    /**
     * Display the About Us page.
     */
    public function about(): View
    {
        $teamMembers = \App\Models\TeamMember::active()->ordered()->get();

        $aboutStoryTitle = Setting::get('about_story_title', 'Our Story');
        $aboutStoryContent = Setting::get('about_story_content');
        $aboutValuesTitle = Setting::get('about_values_title', 'Our Values');
        $aboutValuesContent = Setting::get('about_values_content');
        $aboutVisionTitle = Setting::get('about_vision_title', 'Our Vision');
        $aboutVisionContent = Setting::get('about_vision_content');
        $aboutMissionTitle = Setting::get('about_mission_title', 'Our Mission');
        $aboutMissionContent = Setting::get('about_mission_content');
        $aboutIdentityTitle = Setting::get('about_identity_title', 'Our Identity');
        $aboutIdentityContent = Setting::get('about_identity_content');
        $factoryTitle = Setting::get('factory_title', 'About Our Factory');
        $factoryContent = Setting::get('factory_content');
        $factoryVideoUrl = Setting::get('factory_video_url', '');

        // Convert YouTube URL to embed URL
        $factoryVideoEmbed = '';
        if ($factoryVideoUrl) {
            $factoryVideoEmbed = $this->getYoutubeEmbedUrl($factoryVideoUrl);
        }

        $certificates = Certificate::active()->ordered()->get();

        $siteName = Setting::get('site_name', 'MeisaiPrinting');
        $footerAbout = Setting::get('footer_about');
        $footerEmail = Setting::get('footer_email');
        $footerPhone = Setting::get('footer_phone');
        $footerAddress = Setting::get('footer_address');

        return view('pages.about', compact(
            'teamMembers',
            'aboutStoryTitle',
            'aboutStoryContent',
            'aboutValuesTitle',
            'aboutValuesContent',
            'aboutVisionTitle',
            'aboutVisionContent',
            'aboutMissionTitle',
            'aboutMissionContent',
            'aboutIdentityTitle',
            'aboutIdentityContent',
            'factoryTitle',
            'factoryContent',
            'factoryVideoUrl',
            'factoryVideoEmbed',
            'certificates',
            'siteName',
            'footerAbout',
            'footerEmail',
            'footerPhone',
            'footerAddress'
        ));
    }

    /**
     * Display a static page (e.g., free-samples, artwork-guidelines, etc.)
     */
    public function page(string $slug): View
    {
        $siteName = Setting::get('site_name', 'MeisaiPrinting');
        $footerAbout = Setting::get('footer_about');
        $footerEmail = Setting::get('footer_email');
        $footerPhone = Setting::get('footer_phone');
        $footerAddress = Setting::get('footer_address');

        // Define page metadata
        $pages = [
            'free-samples' => [
                'title' => 'Free Samples',
                'seoTitle' => 'Request Free Samples – MeisaiPrinting',
                'seoDescription' => 'Request free samples from MeisaiPrinting. Experience our quality materials and printing before you place a bulk order.',
            ],
            'material-sample-pack' => [
                'title' => 'Material Sample Pack',
                'seoTitle' => 'Material Sample Pack – MeisaiPrinting',
                'seoDescription' => 'Get our comprehensive material sample pack to explore all label and sticker materials we offer.',
            ],
            'size-chart' => [
                'title' => 'Size Chart',
                'seoTitle' => 'Size Chart – MeisaiPrinting',
                'seoDescription' => 'Find the perfect size for your custom stickers and labels with our comprehensive size chart.',
            ],
            'moq-pricing' => [
                'title' => 'MOQ & Pricing',
                'seoTitle' => 'MOQ & Pricing – MeisaiPrinting',
                'seoDescription' => 'Learn about our minimum order quantities and competitive factory-direct pricing.',
            ],
            'artwork-guidelines' => [
                'title' => 'Artwork Guidelines',
                'seoTitle' => 'Artwork Guidelines – MeisaiPrinting',
                'seoDescription' => 'Follow our artwork guidelines to ensure your designs are print-ready and look perfect.',
            ],
            'eco-friendly' => [
                'title' => 'Eco-Friendly & Recyclable Labels',
                'seoTitle' => 'Eco-Friendly Labels – MeisaiPrinting',
                'seoDescription' => 'Discover our FSC certified, recyclable, and compostable label materials for sustainable packaging.',
            ],
            'compliance' => [
                'title' => 'REACH & RoHS Compliance',
                'seoTitle' => 'REACH & RoHS Compliance – MeisaiPrinting',
                'seoDescription' => 'MeisaiPrinting products meet EU REACH and RoHS compliance standards for chemical safety.',
            ],
            'privacy-policy' => [
                'title' => 'Privacy Policy',
                'seoTitle' => 'Privacy Policy – MeisaiPrinting',
                'seoDescription' => 'Learn how MeisaiPrinting collects, uses, and protects your personal information.',
            ],
        ];

        $page = $pages[$slug] ?? null;

        if (!$page) {
            abort(404);
        }

        return view('pages.show', compact(
            'slug',
            'siteName',
            'footerAbout',
            'footerEmail',
            'footerPhone',
            'footerAddress',
            'page'
        ));
    }

    /**
     * Convert various YouTube URL formats to embed URL.
     * Supports:
     *   - https://www.youtube.com/watch?v=VIDEO_ID
     *   - https://youtu.be/VIDEO_ID
     *   - https://www.youtube.com/embed/VIDEO_ID
     *   - https://www.youtube.com/v/VIDEO_ID
     *   - https://youtube.com/live/VIDEO_ID
     */
    private function getYoutubeEmbedUrl(string $url): string
    {
        $videoId = null;

        // Standard watch URL: youtube.com/watch?v=VIDEO_ID
        if (preg_match('/(?:youtube\.com\/watch\?.*v=|youtu\.be\/|youtube\.com\/embed\/|youtube\.com\/v\/|youtube\.com\/live\/)([a-zA-Z0-9_-]{11})/', $url, $matches)) {
            $videoId = $matches[1];
        }

        if ($videoId) {
            return 'https://www.youtube.com/embed/' . $videoId . '?rel=0&modestbranding=1';
        }

        // If already a valid embed URL, return as-is
        if (str_contains($url, 'youtube.com/embed/')) {
            return $url;
        }

        // Return empty if can't parse
        return '';
    }
}
