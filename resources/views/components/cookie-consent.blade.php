<div x-data="{
    show: false,
    showSettings: false,
    
    init() {
        // Check if user has already made a choice
        const consent = localStorage.getItem('cookie_consent');
        if (!consent) {
            // Show banner after a short delay for better UX
            setTimeout(() => {
                this.show = true;
            }, 1000);
        }
    },
    
    acceptAll() {
        localStorage.setItem('cookie_consent', 'all');
        localStorage.setItem('cookie_timestamp', Date.now().toString());
        this.show = false;
    },
    
    rejectAll() {
        localStorage.setItem('cookie_consent', 'reject');
        localStorage.setItem('cookie_timestamp', Date.now().toString());
        this.show = false;
    },
    
    saveSettings() {
        // For now, save as accepted (can be expanded to save individual preferences)
        localStorage.setItem('cookie_consent', 'custom');
        localStorage.setItem('cookie_timestamp', Date.now().toString());
        this.show = false;
        this.showSettings = false;
    },
    
    closeSettings() {
        this.showSettings = false;
    }
}" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-full" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-full" x-cloak
    class="fixed bottom-0 left-0 right-0 z-[100] bg-white shadow-[0_-4px_20px_rgba(0,0,0,0.15)]"
    @keydown.escape.window="show = false; showSettings = false">

    {{-- Main Banner --}}
    <div x-show="!showSettings" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-6">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            {{-- Left: Icon + Text --}}
            <div class="flex items-start gap-4 flex-1">
                {{-- Cookie Icon --}}
                <div class="shrink-0 w-12 h-12 bg-[#FF008A]/10 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-[#FF008A]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8.25v-1.5m0 1.5c-1.355 0-2.697.056-4.024.166C6.845 8.51 6 9.473 6 10.608v2.513m6-4.87c1.355 0 2.697.055 4.024.165C17.155 8.51 18 9.473 18 10.608v2.513m-3-4.87v-1.5m-6 1.5v-1.5m12 9.75l-1.5.75a3.354 3.354 0 01-3 0 3.354 3.354 0 00-3 0 3.354 3.354 0 01-3 0 3.354 3.354 0 00-3 0 3.354 3.354 0 01-3 0L3 16.5m15-3.38a48.474 48.474 0 00-6-.37c-2.032 0-4.034.125-6 .37m12 0c.39.049.777.102 1.163.16 1.07.16 1.837 1.094 1.837 2.175v5.17c0 .62-.504 1.124-1.125 1.124H4.125A1.125 1.125 0 013 20.625v-5.17c0-1.08.768-2.014 1.837-2.174A47.78 47.78 0 016 13.12M12.265 3.11a.375.375 0 11-.53 0L12 2.845l.265.265zm-3 0a.375.375 0 11-.53 0l.265-.265.265.265zm6 0a.375.375 0 11-.53 0l.265-.265.265.265z"/>
                    </svg>
                </div>
                
                {{-- Text Content --}}
                <div>
                    <h3 class="text-base sm:text-lg font-semibold text-[#1D2B36] mb-1">We value your privacy</h3>
                    <p class="text-sm text-[#333333] leading-relaxed max-w-2xl">
                        We use cookies to enhance your browsing experience, serve personalized content, and analyze our traffic. By clicking "Accept All", you consent to our use of cookies. 
                        <a href="/pages/privacy-policy" class="text-[#0095F4] hover:text-[#FF008A] underline underline-offset-2 transition-colors">Learn more</a>
                    </p>
                </div>
            </div>

            {{-- Right: Buttons --}}
            <div class="flex flex-wrap items-center gap-3 ml-16 sm:ml-0">
                {{-- Cookie Settings Button --}}
                <button @click="showSettings = true" class="px-4 py-2 text-sm font-medium text-[#333333] hover:text-[#FF008A] border border-gray-300 hover:border-[#FF008A] rounded-lg transition-all duration-200">
                    Cookie Settings
                </button>
                
                {{-- Reject Button --}}
                <button @click="rejectAll()" class="px-4 py-2 text-sm font-medium text-[#333333] hover:text-white bg-gray-100 hover:bg-gray-600 rounded-lg transition-all duration-200">
                    Reject All
                </button>
                
                {{-- Accept All Button (Primary Brand Color) --}}
                <button @click="acceptAll()" class="px-6 py-2 text-sm font-medium text-white bg-[#FF008A] hover:bg-[#FF33A1] rounded-lg transition-all duration-200 shadow-sm hover:shadow-md">
                    Accept All
                </button>
            </div>
        </div>
    </div>

    {{-- Cookie Settings Panel --}}
    <div x-show="showSettings" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-[#1D2B36]">Cookie Preferences</h3>
            <button @click="closeSettings()" class="p-1 text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        
        {{-- Cookie Categories --}}
        <div class="space-y-4 mb-6">
            {{-- Necessary Cookies --}}
            <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-lg">
                <div class="flex items-center h-6 mt-0.5">
                    <input id="cookie-necessary" type="checkbox" checked disabled class="w-4 h-4 text-[#FF008A] bg-gray-100 border-gray-300 rounded cursor-not-allowed">
                </div>
                <div class="flex-1">
                    <label for="cookie-necessary" class="text-sm font-medium text-[#1D2B36] cursor-not-allowed">Strictly Necessary Cookies</label>
                    <p class="text-xs text-gray-500 mt-1">These cookies are essential for the website to function properly. They enable core functionality such as security, network management, and accessibility.</p>
                </div>
                <span class="text-xs font-medium text-green-600 bg-green-50 px-2 py-1 rounded">Always Active</span>
            </div>
            
            {{-- Analytics Cookies --}}
            <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-lg">
                <div class="flex items-center h-6 mt-0.5">
                    <input id="cookie-analytics" type="checkbox" checked class="w-4 h-4 text-[#FF008A] bg-white border-gray-300 rounded focus:ring-[#FF008A] focus:ring-offset-0 cursor-pointer">
                </div>
                <div class="flex-1">
                    <label for="cookie-analytics" class="text-sm font-medium text-[#1D2B36] cursor-pointer">Analytics Cookies</label>
                    <p class="text-xs text-gray-500 mt-1">These cookies help us understand how visitors interact with our website by collecting and reporting information anonymously.</p>
                </div>
            </div>
            
            {{-- Marketing Cookies --}}
            <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-lg">
                <div class="flex items-center h-6 mt-0.5">
                    <input id="cookie-marketing" type="checkbox" checked class="w-4 h-4 text-[#FF008A] bg-white border-gray-300 rounded focus:ring-[#FF008A] focus:ring-offset-0 cursor-pointer">
                </div>
                <div class="flex-1">
                    <label for="cookie-marketing" class="text-sm font-medium text-[#1D2B36] cursor-pointer">Marketing Cookies</label>
                    <p class="text-xs text-gray-500 mt-1">These cookies are used to track visitors across websites to display relevant advertisements based on their browsing habits.</p>
                </div>
            </div>
            
            {{-- Functional Cookies --}}
            <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-lg">
                <div class="flex items-center h-6 mt-0.5">
                    <input id="cookie-functional" type="checkbox" checked class="w-4 h-4 text-[#FF008A] bg-white border-gray-300 rounded focus:ring-[#FF008A] focus:ring-offset-0 cursor-pointer">
                </div>
                <div class="flex-1">
                    <label for="cookie-functional" class="text-sm font-medium text-[#1D2B36] cursor-pointer">Functional Cookies</label>
                    <p class="text-xs text-gray-500 mt-1">These cookies enable enhanced functionality and personalization, such as remembering your preferences and settings.</p>
                </div>
            </div>
        </div>
        
        {{-- Action Buttons --}}
        <div class="flex justify-end gap-3">
            <button @click="closeSettings()" class="px-4 py-2 text-sm font-medium text-[#333333] hover:text-[#FF008A] border border-gray-300 hover:border-[#FF008A] rounded-lg transition-all duration-200">
                Cancel
            </button>
            <button @click="saveSettings()" class="px-6 py-2 text-sm font-medium text-white bg-[#FF008A] hover:bg-[#FF33A1] rounded-lg transition-all duration-200 shadow-sm hover:shadow-md">
                Save Preferences
            </button>
        </div>
    </div>
</div>
