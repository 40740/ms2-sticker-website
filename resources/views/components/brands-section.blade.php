@props(['brands' => []])

<section class="py-16 bg-white">
    <div class="max-w-[1200px] mx-auto px-6">
        <h2 class="section-heading text-center mb-10">Brands That Trust Us</h2>

        <div class="grid grid-cols-2 mobile:grid-cols-3 tablet:grid-cols-6 gap-6 items-center">
            @foreach($brands as $brand)
                <div class="flex items-center justify-center p-4 h-28 transition-all duration-300">
                    @if($brand->link)
                        <a href="{{ $brand->link }}" target="_blank" rel="noopener noreferrer" class="block w-full h-full flex items-center justify-center group">
                            <img src="{{ Storage::disk('uploads')->url($brand->image) }}"
                                 alt="{{ $brand->name }}"
                                 class="max-h-full max-w-full object-contain transition-all duration-300 group-hover:scale-110"
                                 loading="lazy">
                        </a>
                    @else
                        <img src="{{ Storage::disk('uploads')->url($brand->image) }}"
                             alt="{{ $brand->name }}"
                             class="max-h-full max-w-full object-contain transition-all duration-300 hover:scale-110"
                             loading="lazy">
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>
