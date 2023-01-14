@props([
    'title' => null,
    'href' => '#',
    'imageUrl' => null,
    'imageHeight' => 'lg:h-[600px]',
])

<div class="swiper-slide">
    <a
        href="{{ $href }}"
        class="relative block"
    >
        @if($imageUrl)
            <img
                src="{{ $imageUrl }}"
                alt=""
                class="w-full {{ $imageHeight }} object-cover"
            >
        @endif

        @isset($imageHtml)
            {{ $imageHtml }}
        @endisset

        @if($title)
            <div class="absolute bottom-0 bg-black/60 w-full">
                <x-front::container>
                    <div class="py-10 text-white text-xl">
                        {{ $title }}
                    </div>
                </x-front::container>
            </div>
        @endif
    </a>
</div>