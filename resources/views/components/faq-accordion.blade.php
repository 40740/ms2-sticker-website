@props(['faqs' => [], 'title' => 'Frequently Asked Questions'])

<section class="py-16 bg-white">
    <div class="max-w-[1200px] mx-auto px-6">
        <h2 class="section-heading text-center mb-10">{{ $title }}</h2>

        <div class="max-w-3xl mx-auto space-y-4"
             x-data="{ openFaq: null }">
            @foreach($faqs as $index => $faq)
                <div class="border border-gray-200 bg-white shadow-light overflow-hidden"
                     :class="openFaq === {{ $index }} ? 'shadow-medium' : ''">
                    {{-- Question --}}
                    <button class="w-full flex items-center justify-between px-6 py-5 text-left hover:bg-gray-50 transition-all duration-300"
                            @click="openFaq = openFaq === {{ $index }} ? null : {{ $index }}"
                            :aria-expanded="openFaq === {{ $index }}"
                            aria-controls="faq-answer-{{ $index }}">
                        <span class="text-base font-semibold text-box-title pr-4">{{ $faq->question }}</span>
                        <svg class="w-5 h-5 text-brand shrink-0 transition-transform duration-300"
                             :class="openFaq === {{ $index }} ? 'rotate-180' : ''"
                             fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    {{-- Answer --}}
                    <div x-show="openFaq === {{ $index }}"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 -translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 -translate-y-1"
                         id="faq-answer-{{ $index }}"
                         role="region"
                         class="px-6 pb-5">
                        <div class="text-body text-sm leading-relaxed border-t border-gray-100 pt-4">
                            {{ $faq->answer }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
