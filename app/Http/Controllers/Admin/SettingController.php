<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends Controller
{
    /**
     * All expected settings with their defaults and groups.
     * This ensures the admin settings page always shows all tabs/fields,
     * even if the database rows are missing.
     */
    protected static array $expectedSettings = [
        // General
        ['key' => 'site_name', 'value' => 'MeisaiPrinting', 'group' => 'general'],
        ['key' => 'site_logo', 'value' => '/images/logo.png', 'group' => 'general'],
        ['key' => 'site_description', 'value' => '', 'group' => 'general'],
        ['key' => 'site_title', 'value' => '', 'group' => 'general'],
        ['key' => 'site_keywords', 'value' => '', 'group' => 'general'],
        // Hero Slide 1
        ['key' => 'hero_1_enabled', 'value' => '1', 'group' => 'hero'],
        ['key' => 'hero_1_title', 'value' => 'Custom Stickers & Labels for Business', 'group' => 'hero'],
        ['key' => 'hero_1_subtitle', 'value' => '24 years of experience in custom stickers and labels', 'group' => 'hero'],
        ['key' => 'hero_1_cta_text', 'value' => 'Get Free Quote', 'group' => 'hero'],
        ['key' => 'hero_1_cta_link', 'value' => '#quote-form', 'group' => 'hero'],
        ['key' => 'hero_1_image', 'value' => '/images/hero-1.jpg', 'group' => 'hero'],
        // Hero Slide 2
        ['key' => 'hero_2_enabled', 'value' => '1', 'group' => 'hero'],
        ['key' => 'hero_2_title', 'value' => 'Premium Custom Labels', 'group' => 'hero'],
        ['key' => 'hero_2_subtitle', 'value' => 'FSC, UL, CSA Certified · Factory Direct Pricing', 'group' => 'hero'],
        ['key' => 'hero_2_cta_text', 'value' => 'Get Free Quote', 'group' => 'hero'],
        ['key' => 'hero_2_cta_link', 'value' => '#quote-form', 'group' => 'hero'],
        ['key' => 'hero_2_image', 'value' => '/images/hero-2.jpg', 'group' => 'hero'],
        // Hero Slide 3
        ['key' => 'hero_3_enabled', 'value' => '1', 'group' => 'hero'],
        ['key' => 'hero_3_title', 'value' => 'Fast Turnaround & Delivery', 'group' => 'hero'],
        ['key' => 'hero_3_subtitle', 'value' => 'From Design to Your Doorstep', 'group' => 'hero'],
        ['key' => 'hero_3_cta_text', 'value' => 'Get Free Quote', 'group' => 'hero'],
        ['key' => 'hero_3_cta_link', 'value' => '#quote-form', 'group' => 'hero'],
        ['key' => 'hero_3_image', 'value' => '/images/hero-3.jpg', 'group' => 'hero'],
        // Contact (unified for top bar + footer)
        ['key' => 'contact_email', 'value' => 'info@meisaiprinting.com', 'group' => 'contact'],
        ['key' => 'contact_phone', 'value' => '+1-800-123-4567', 'group' => 'contact'],
        ['key' => 'contact_address', 'value' => '', 'group' => 'contact'],
        // Social Media (unified for top bar + footer)
        ['key' => 'social_facebook', 'value' => '#', 'group' => 'social'],
        ['key' => 'social_instagram', 'value' => '#', 'group' => 'social'],
        ['key' => 'social_youtube', 'value' => '#', 'group' => 'social'],
        ['key' => 'social_tiktok', 'value' => '#', 'group' => 'social'],
        // Footer
        ['key' => 'footer_about', 'value' => '', 'group' => 'footer'],
        // Expertise Section (homepage "Expertise Is More Than Just Words")
        ['key' => 'expertise_title', 'value' => 'Expertise Is More Than Just Words', 'group' => 'expertise'],
        ['key' => 'expertise_content', 'value' => "With over 24 years of experience in custom sticker and label manufacturing, MeisaiPrinting has built a reputation for delivering high-quality products at competitive prices. Our state-of-the-art facility and dedicated team ensure every order meets the highest standards.\n\nFrom small businesses to global brands, we've helped thousands of clients bring their vision to life through custom adhesive solutions. Our FSC, UL, and CSA certifications are a testament to our commitment to quality and sustainability.", 'group' => 'expertise'],
        ['key' => 'expertise_button_text', 'value' => 'More About Us', 'group' => 'expertise'],
        ['key' => 'expertise_button_link', 'value' => '/pages/MeisaiPrinting', 'group' => 'expertise'],
        ['key' => 'expertise_video_url', 'value' => '', 'group' => 'expertise'],
        // About
        ['key' => 'about_story_title', 'value' => '', 'group' => 'about'],
        ['key' => 'about_story_content', 'value' => '', 'group' => 'about'],
        ['key' => 'about_values_title', 'value' => '', 'group' => 'about'],
        ['key' => 'about_values_content', 'value' => '', 'group' => 'about'],
        ['key' => 'about_vision_title', 'value' => '', 'group' => 'about'],
        ['key' => 'about_vision_content', 'value' => '', 'group' => 'about'],
        ['key' => 'about_mission_title', 'value' => '', 'group' => 'about'],
        ['key' => 'about_mission_content', 'value' => '', 'group' => 'about'],
        ['key' => 'about_identity_title', 'value' => '', 'group' => 'about'],
        ['key' => 'about_identity_content', 'value' => '', 'group' => 'about'],
        // Factory (About Our Factory section on MeisaiPrinting page)
        ['key' => 'factory_title', 'value' => '', 'group' => 'factory'],
        ['key' => 'factory_content', 'value' => '', 'group' => 'factory'],
        ['key' => 'factory_video_url', 'value' => '', 'group' => 'factory'],
        // Chat / Messaging App (floating button)
        ['key' => 'chat_app_type', 'value' => 'whatsapp', 'group' => 'chat'],
        ['key' => 'chat_app_number', 'value' => '', 'group' => 'chat'],
    ];

    /**
     * Keys that are deprecated/duplicate and should be hidden from the settings UI.
     * These exist in old seeders but are not used by the frontend.
     */
    protected static array $hiddenKeys = [
        'footer_email',
        'footer_phone',
        'footer_address',
        'hero_title',
        'hero_subtitle',
        'hero_cta_text',
        'hero_cta_link',
    ];

    /**
     * Display all settings grouped.
     */
    public function index(): View
    {
        // Ensure all expected settings exist in DB
        foreach (static::$expectedSettings as $s) {
            Setting::firstOrCreate(
                ['key' => $s['key']],
                ['value' => $s['value'], 'group' => $s['group']]
            );
        }

        $settings = Setting::grouped()
            ->map(fn ($group) => $group->filter(
                fn ($setting) => !in_array($setting->key, static::$hiddenKeys)
            ))
            ->filter(fn ($group) => $group->isNotEmpty());

        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update settings (key-value pairs).
     */
    public function update(Request $request): RedirectResponse
    {
        // Validate file uploads
        $request->validate([
            'logo_file' => 'nullable|image|max:2048',
            'hero_1_image_file' => 'nullable|image|max:2048',
            'hero_2_image_file' => 'nullable|image|max:2048',
            'hero_3_image_file' => 'nullable|image|max:2048',
        ]);

        $settings = $request->input('settings', []);
        $groups = $request->input('settings_group', []);

        // Only allow whitelisted setting keys
        $allowedKeys = collect(static::$expectedSettings)->pluck('key')->toArray();

        // Handle logo file upload
        if ($request->hasFile('logo_file')) {
            $file = $request->file('logo_file');
            $filename = 'logo_' . time() . '.' . $file->extension();
            $destPath = public_path('uploads/settings');
            if (!is_dir($destPath)) {
                mkdir($destPath, 0755, true);
            }
            $file->move($destPath, $filename);
            $settings['site_logo'] = '/uploads/settings/' . $filename;
        }

        // Handle hero image uploads
        foreach (['hero_1_image', 'hero_2_image', 'hero_3_image'] as $heroImageKey) {
            $fileKey = $heroImageKey . '_file';
            if ($request->hasFile($fileKey)) {
                $file = $request->file($fileKey);
                $filename = $heroImageKey . '_' . time() . '.' . $file->extension();
                $destPath = public_path('uploads/settings');
                if (!is_dir($destPath)) {
                    mkdir($destPath, 0755, true);
                }
                $file->move($destPath, $filename);
                $settings[$heroImageKey] = '/uploads/settings/' . $filename;
            }
        }

        foreach ($settings as $key => $value) {
            // Skip keys not in the whitelist
            if (!in_array($key, $allowedKeys)) {
                continue;
            }
            $group = $groups[$key] ?? 'general';
            Setting::set($key, $value, $group);
        }

        // Clear setting caches after bulk update
        Setting::clearCache();

        return redirect()->route('admin.settings.index')
            ->with('success', '设置已保存成功。');
    }
}
