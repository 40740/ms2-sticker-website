@extends('layouts.admin')

@section('title', '网站设置')

@section('content')
    @php
        $groupLabels = [
            'general' => '基本设置',
            'hero' => '首页Hero区',
            'expertise' => '首页实力展示',
            'footer' => '页脚设置',
            'contact' => '联系方式',
            'social' => '社交媒体',
            'chat' => '即时通讯',
            'about' => '关于我们',
            'factory' => '工厂介绍',
        ];
        $keyLabels = [
            'site_name' => '网站名称',
            'site_logo' => '网站Logo',
            'site_description' => '网站描述',
            'site_title' => 'SEO标题',
            'site_keywords' => 'SEO关键词',
            'hero_1_enabled' => '幻灯片1 - 是否开启',
            'hero_1_title' => '幻灯片1 - 标题',
            'hero_1_subtitle' => '幻灯片1 - 副标题',
            'hero_1_cta_text' => '幻灯片1 - 按钮文字',
            'hero_1_cta_link' => '幻灯片1 - 按钮链接',
            'hero_1_image' => '幻灯片1 - 背景图片',
            'hero_2_enabled' => '幻灯片2 - 是否开启',
            'hero_2_title' => '幻灯片2 - 标题',
            'hero_2_subtitle' => '幻灯片2 - 副标题',
            'hero_2_cta_text' => '幻灯片2 - 按钮文字',
            'hero_2_cta_link' => '幻灯片2 - 按钮链接',
            'hero_2_image' => '幻灯片2 - 背景图片',
            'hero_3_enabled' => '幻灯片3 - 是否开启',
            'hero_3_title' => '幻灯片3 - 标题',
            'hero_3_subtitle' => '幻灯片3 - 副标题',
            'hero_3_cta_text' => '幻灯片3 - 按钮文字',
            'hero_3_cta_link' => '幻灯片3 - 按钮链接',
            'hero_3_image' => '幻灯片3 - 背景图片',
            'footer_about' => '页脚简介',
            'contact_email' => '联系邮箱',
            'contact_phone' => '联系电话',
            'contact_address' => '联系地址',
            'social_facebook' => 'Facebook链接',
            'social_instagram' => 'Instagram链接',
            'social_youtube' => 'YouTube链接',
            'social_tiktok' => 'TikTok链接',
            'hero_1_enabled' => '关闭后该幻灯片不会在前台渲染，图片也不会加载，可提升页面打开速度',
            'hero_2_enabled' => '关闭后该幻灯片不会在前台渲染，图片也不会加载，可提升页面打开速度',
            'hero_3_enabled' => '关闭后该幻灯片不会在前台渲染，图片也不会加载，可提升页面打开速度',
            'expertise_title' => '区域标题',
            'expertise_content' => '区域文案内容',
            'expertise_button_text' => '按钮文字',
            'expertise_button_link' => '按钮链接',
            'expertise_video_url' => 'YouTube视频链接',
            'about_story_title' => '故事标题',
            'about_story_content' => '故事内容',
            'about_values_title' => '价值观标题',
            'about_values_content' => '价值观内容',
            'about_vision_title' => '愿景标题',
            'about_vision_content' => '愿景内容',
            'about_mission_title' => '使命标题',
            'about_mission_content' => '使命内容',
            'about_identity_title' => '身份标题',
            'about_identity_content' => '身份内容',
            'factory_title' => '工厂标题',
            'factory_content' => '工厂文案内容',
            'factory_video_url' => 'YouTube视频链接',
            'chat_app_type' => '即时通讯类型',
            'chat_app_number' => '账号/号码',
        ];
        $keyHelp = [
            'site_logo' => '可输入Logo图片URL，或上传Logo图片文件。上传后自动替换为图片路径。默认使用 /images/logo.png',
            'site_name' => '网站名称会显示在导航栏Logo旁、浏览器标题等位置',
            'contact_email' => '同时用于顶部栏和页脚',
            'contact_phone' => '同时用于顶部栏和页脚',
            'contact_address' => '用于页脚联系信息',
            'social_facebook' => '同时用于顶部栏和页脚',
            'social_instagram' => '同时用于顶部栏和页脚',
            'social_youtube' => '同时用于顶部栏和页脚',
            'social_tiktok' => '同时用于顶部栏和页脚',
            'chat_app_type' => '选择右下角浮动按钮打开的即时通讯应用',
            'chat_app_number' => 'WhatsApp填手机号(如8613800138000)、Messenger填主页ID、Telegram填用户名、WeChat填微信号、Line填好友ID',
            'expertise_title' => '首页"实力展示"区域的标题，默认为 Expertise Is More Than Just Words',
            'expertise_content' => '首页"实力展示"区域的文案内容，支持换行（每行一个段落）。留空则使用默认文案',
            'expertise_button_text' => '底部按钮文字，默认为 More About Us',
            'expertise_button_link' => '底部按钮点击跳转链接，默认为 /pages/MeisaiPrinting',
            'expertise_video_url' => '填写YouTube视频链接，支持多种格式：https://www.youtube.com/watch?v=xxx 或 https://youtu.be/xxx 等。留空则显示默认播放按钮占位',
            'factory_title' => '关于我们页"工厂介绍"区域的标题，默认为 About Our Factory',
            'factory_content' => '关于我们页"工厂介绍"区域的文案内容，支持换行（每行一个段落）。留空则使用默认文案',
            'factory_video_url' => '填写YouTube视频链接，支持多种格式：https://www.youtube.com/watch?v=xxx 或 https://youtu.be/xxx 等。留空则显示默认播放按钮占位',
        ];
    @endphp

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg flex items-center gap-2">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-100" x-data="{ activeTab: '{{ $settings->keys()->first() ?? 'general' }}' }">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="text-lg font-semibold text-gray-900">网站设置</h2>
        </div>

        {{-- Tabs --}}
        <div class="border-b border-gray-200 px-6">
            <nav class="flex gap-1 -mb-px overflow-x-auto">
                @foreach ($settings->keys() as $group)
                    <button @click="activeTab = '{{ $group }}'"
                            :class="activeTab === '{{ $group }}' ? 'border-[#FF008A] text-[#FF008A]' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            class="whitespace-nowrap py-3 px-4 border-b-2 text-sm font-medium transition-colors">
                        {{ $groupLabels[$group] ?? ucfirst($group) }}
                    </button>
                @endforeach
            </nav>
        </div>

        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="p-6">
            @method('PUT')
            @csrf

            @foreach ($settings as $group => $groupSettings)
                <div x-show="activeTab === '{{ $group }}'" x-cloak class="space-y-6">
                    <h3 class="text-md font-semibold text-gray-800 border-b border-gray-100 pb-2">{{ $groupLabels[$group] ?? ucfirst($group) . '设置' }}</h3>
                    @foreach ($groupSettings as $setting)
                        @if($group === 'hero' && ($setting->key === 'hero_1_enabled' || $setting->key === 'hero_2_enabled' || $setting->key === 'hero_3_enabled'))
                            <div class="pt-4 mt-2 border-t border-dashed border-gray-200">
                                @if($setting->key === 'hero_1_enabled')
                                    <h4 class="text-sm font-bold text-[#FF008A] mb-3">🎞️ 幻灯片 1</h4>
                                @elseif($setting->key === 'hero_2_enabled')
                                    <h4 class="text-sm font-bold text-[#FF008A] mb-3">🎞️ 幻灯片 2</h4>
                                @else
                                    <h4 class="text-sm font-bold text-[#FF008A] mb-3">🎞️ 幻灯片 3</h4>
                                @endif
                            </div>
                        @endif
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                {{ $keyLabels[$setting->key] ?? ucwords(str_replace(['_', '-'], ' ', $setting->key)) }}
                            </label>

                            @if(str_ends_with($setting->key, '_enabled'))
                                {{-- Toggle switch for enabled/disabled --}}
                                @php $isEnabled = ($setting->value ?? '1') === '1'; @endphp
                                <input type="hidden" name="settings[{{ $setting->key }}]" value="0">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox"
                                           name="settings[{{ $setting->key }}]"
                                           value="1"
                                           {{ $isEnabled ? 'checked' : '' }}
                                           class="sr-only peer"
                                           x-data="{ on: {{ $isEnabled ? 'true' : 'false' }} }"
                                           x-init="$watch('on', val => { $el.nextElementSibling?.querySelector('span') && ($el.nextElementSibling.querySelector('span').textContent = val ? '已开启' : '已关闭') })">
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-[#FF008A]/30 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#FF008A]">
                                        <span class="ms-14 text-sm {{ $isEnabled ? 'text-green-600 font-medium' : 'text-gray-400' }} whitespace-nowrap">
                                            {{ $isEnabled ? '已开启' : '已关闭' }}
                                        </span>
                                    </div>
                                </label>
                            @elseif($setting->key === 'site_logo')
                                {{-- Special handling for logo: show preview + URL input + file upload --}}
                                <div class="space-y-3">
                                    {{-- Current Logo Preview --}}
                                    @php
                                        $logoPreviewUrl = $setting->value ?: '/images/logo.png';
                                        if ($logoPreviewUrl && !str_starts_with($logoPreviewUrl, '/') && !str_starts_with($logoPreviewUrl, 'http')) {
                                            $logoPreviewUrl = '/' . ltrim($logoPreviewUrl, '/');
                                        }
                                    @endphp
                                    <div class="flex items-center gap-4 p-3 bg-gray-50 rounded-lg">
                                        <img src="{{ $logoPreviewUrl }}" alt="Logo Preview" class="h-12 w-auto rounded" id="logo-preview"
                                             onerror="this.src='/images/logo.png'">
                                        <span class="text-sm text-gray-500">当前Logo预览</span>
                                    </div>

                                    {{-- URL Input --}}
                                    <input type="text"
                                           name="settings[{{ $setting->key }}]"
                                           value="{{ $setting->value ?? '' }}"
                                           placeholder="/images/logo.png 或完整URL"
                                           class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]">

                                    {{-- File Upload --}}
                                    <div class="flex items-center gap-3">
                                        <span class="text-sm text-gray-500">或上传新Logo：</span>
                                        <input type="file" name="logo_file" accept="image/*"
                                               class="text-sm text-gray-500 file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-pink-50 file:text-[#FF008A] hover:file:bg-pink-100">
                                    </div>
                                </div>
                            @elseif(str_contains($setting->key, 'hero_') && str_ends_with($setting->key, '_image'))
                                {{-- Special handling: hero image with preview + URL + file upload --}}
                                @php
                                    $heroImgKey = $setting->key;
                                    $heroImgUrl = $setting->value ?: '/images/hero-default.jpg';
                                    if ($heroImgUrl && !str_starts_with($heroImgUrl, '/') && !str_starts_with($heroImgUrl, 'http')) {
                                        $heroImgUrl = '/' . ltrim($heroImgUrl, '/');
                                    }
                                @endphp
                                <div class="space-y-3">
                                    <div class="flex items-center gap-4 p-3 bg-gray-50 rounded-lg">
                                        <img src="{{ $heroImgUrl }}" alt="Hero Preview" class="h-20 w-auto rounded"
                                             onerror="this.src='/images/hero-default.jpg'">
                                        <span class="text-sm text-gray-500">当前背景图预览</span>
                                    </div>
                                    <input type="text"
                                           name="settings[{{ $setting->key }}]"
                                           value="{{ $setting->value ?? '' }}"
                                           placeholder="/images/hero-1.jpg 或完整URL"
                                           class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]">
                                    <div class="flex items-center gap-3">
                                        <span class="text-sm text-gray-500">或上传新图片：</span>
                                        <input type="file" name="{{ $heroImgKey }}_file" accept="image/*"
                                               class="text-sm text-gray-500 file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-pink-50 file:text-[#FF008A] hover:file:bg-pink-100">
                                    </div>
                                </div>
                            @elseif($setting->key === 'chat_app_type')
                                {{-- Special handling: dropdown for chat app type --}}
                                <select name="settings[chat_app_type]"
                                        class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A] bg-white">
                                    <option value="whatsapp" {{ ($setting->value ?? 'whatsapp') === 'whatsapp' ? 'selected' : '' }}>WhatsApp</option>
                                    <option value="messenger" {{ ($setting->value ?? '') === 'messenger' ? 'selected' : '' }}>Facebook Messenger</option>
                                    <option value="telegram" {{ ($setting->value ?? '') === 'telegram' ? 'selected' : '' }}>Telegram</option>
                                    <option value="wechat" {{ ($setting->value ?? '') === 'wechat' ? 'selected' : '' }}>WeChat / 微信</option>
                                    <option value="line" {{ ($setting->value ?? '') === 'line' ? 'selected' : '' }}>LINE</option>
                                </select>
                            @elseif($setting->key === 'expertise_video_url' || $setting->key === 'factory_video_url')
                                {{-- Special handling: YouTube video URL with preview --}}
                                <div class="space-y-3">
                                    <input type="text"
                                           name="settings[{{ $setting->key }}]"
                                           value="{{ $setting->value ?? '' }}"
                                           placeholder="https://www.youtube.com/watch?v=xxx 或 https://youtu.be/xxx"
                                           class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]">
                                    @php
                                        $previewVideoUrl = $setting->value ?? '';
                                        $previewEmbedUrl = '';
                                        if ($previewVideoUrl && preg_match('/(?:youtube\.com\/watch\?.*v=|youtu\.be\/|youtube\.com\/embed\/|youtube\.com\/v\/|youtube\.com\/live\/)([a-zA-Z0-9_-]{11})/', $previewVideoUrl, $pm)) {
                                            $previewEmbedUrl = 'https://www.youtube.com/embed/' . $pm[1] . '?rel=0&modestbranding=1';
                                        } elseif (str_contains($previewVideoUrl, 'youtube.com/embed/')) {
                                            $previewEmbedUrl = $previewVideoUrl;
                                        }
                                    @endphp
                                    @if($previewEmbedUrl)
                                        <div class="p-3 bg-gray-50 rounded-lg">
                                            <p class="text-xs text-gray-500 mb-2">视频预览：</p>
                                            <div class="aspect-video rounded overflow-hidden">
                                                <iframe src="{{ $previewEmbedUrl }}" class="w-full h-full" frameborder="0" allowfullscreen></iframe>
                                            </div>
                                        </div>
                                    @elseif($previewVideoUrl)
                                        <div class="p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                                            <p class="text-xs text-yellow-600">无法识别该YouTube链接，请检查链接格式是否正确</p>
                                        </div>
                                    @else
                                        <div class="p-3 bg-gray-50 rounded-lg">
                                            <p class="text-xs text-gray-400">未设置视频链接，前端将显示默认播放按钮占位图</p>
                                        </div>
                                    @endif
                                </div>
                            @elseif($setting->key === 'expertise_content' || $setting->key === 'factory_content')
                                {{-- Special handling: content with larger textarea --}}
                                <textarea name="settings[{{ $setting->key }}]"
                                          rows="6"
                                          placeholder="每行一个段落，支持换行分隔多个段落"
                                          class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]">{{ $setting->value ?? '' }}</textarea>
                            @elseif(str_contains($setting->key, 'description') || str_contains($setting->key, 'address') || str_contains($setting->key, 'about') || str_contains($setting->key, 'content'))
                                <textarea name="settings[{{ $setting->key }}]"
                                          rows="3"
                                          class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]">{{ $setting->value ?? '' }}</textarea>
                            @else
                                <input type="text"
                                       name="settings[{{ $setting->key }}]"
                                       value="{{ $setting->value ?? '' }}"
                                       class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]">
                            @endif

                            @if(isset($keyHelp[$setting->key]))
                                <p class="mt-1 text-xs text-gray-400">{{ $keyHelp[$setting->key] }}</p>
                            @endif

                            <input type="hidden" name="settings_group[{{ $setting->key }}]" value="{{ $setting->group }}">
                        </div>
                    @endforeach
                </div>
            @endforeach

            <div class="mt-8 pt-4 border-t border-gray-100">
                <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 bg-[#FF008A] text-white rounded-lg text-sm font-semibold hover:bg-[#FF33A1] transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                    </svg>
                    保存设置
                </button>
            </div>
        </form>
    </div>
@endsection
