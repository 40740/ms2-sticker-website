@props(['concerns' => []])

<section class="py-16 bg-white">
    <div class="max-w-[1200px] mx-auto px-6">
        <h2 class="section-heading text-center mb-10">We Understand Your Concerns</h2>

        <div class="grid grid-cols-1 mobile:grid-cols-2 gap-6">
            @foreach($concerns as $concern)
                <div class="bg-white border border-gray-100 rounded-lg overflow-hidden shadow-light hover:shadow-medium transition-all duration-300 group">
                    {{-- Image --}}
                    <div class="relative overflow-hidden h-48">
                        <img src="{{ $concern['image'] ?? '/images/concern-placeholder.jpg' }}"
                             alt="{{ $concern['title'] ?? '' }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                             loading="lazy">
                    </div>

                    {{-- Content --}}
                    <div class="p-6">
                        <h3 class="text-feature font-bold text-box-title mb-3">{{ $concern['title'] ?? '' }}</h3>
                        <p class="text-body text-sm leading-relaxed">{{ $concern['description'] ?? '' }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
