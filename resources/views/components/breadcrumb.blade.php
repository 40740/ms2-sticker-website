@props(['items' => []])

<nav aria-label="Breadcrumb" class="py-4">
    <ol class="flex items-center flex-wrap gap-1 text-sm">
        <li class="flex items-center">
            <a href="/" class="text-gray-400 hover:text-brand transition-all duration-300">Home</a>
        </li>
        @foreach($items as $index => $item)
            <li class="flex items-center">
                <svg class="w-4 h-4 text-gray-300 mx-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
                @if($loop->last)
                    <span class="text-box-title font-semibold">{{ $item['title'] }}</span>
                @else
                    <a href="{{ $item['url'] }}" class="text-gray-400 hover:text-brand transition-all duration-300">{{ $item['title'] }}</a>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
