@props(['stepsTitle' => 'How It Works', 'steps' => []])

<section class="py-16 bg-box-title">
    <div class="max-w-[1200px] mx-auto px-6">
        <h2 class="section-heading text-center text-white mb-12">{{ $stepsTitle }}</h2>

        <div class="grid grid-cols-1 mobile:grid-cols-2 tablet:grid-cols-4 gap-8">
            @foreach($steps as $index => $step)
                <div class="text-center">
                    {{-- Number Circle --}}
                    <div class="w-14 h-14 rounded-full bg-brand flex items-center justify-center mx-auto mb-5">
                        <span class="text-white text-xl font-bold">{{ $index + 1 }}</span>
                    </div>

                    {{-- Icon --}}
                    @isset($step['icon'])
                        <div class="w-12 h-12 flex items-center justify-center mx-auto mb-4 text-brand-hover">
                            {!! $step['icon'] !!}
                        </div>
                    @endisset

                    {{-- Title --}}
                    <h3 class="text-feature font-bold text-white mb-3">{{ $step['title'] ?? '' }}</h3>

                    {{-- Description --}}
                    <p class="text-white/70 text-sm leading-relaxed">{{ $step['description'] ?? '' }}</p>
                </div>
            @endforeach
        </div>

        {{-- CTA Button --}}
        <div class="text-center mt-12">
            <a href="/pages/custom-stickers" class="btn-primary inline-block px-10 py-4 text-base">Custom Now</a>
        </div>
    </div>
</section>
