<x-front::layouts.default :title="$product->name">
    <x-front::container class="mt-1">
        <div class="grid grid-cols-2">
            <div>
                <x-front::slider
                    prev-next-button
                    :pagination="false"
                >
                    @foreach ($product->getMedia() as $media)
                    <x-front::slider.item>
                        <x-slot name="imageHtml">
                            {!! $media->img('', ['class' => 'w-full lg:h-[400px] object-cover'])->toHtml() !!}
                        </x-slot>
                    </x-front::slider.item>
                    @endforeach
                </x-front::slider>
            </div>

            <div class="px-6 py-4">
                <h1 class="text-4xl text-theme font-bold">{{ $product->name }}</h1>

                <div class="mt-4 space-x-2 text-gray-600">
                    @foreach ($product->categories as $category)
                        @if($loop->last && !$loop->first)
                            <span>&gt;</span>
                        @endif

                        <a href="{{ route('category-products', $category) }}">{{ $category->name }}</a>
                    @endforeach
                </div>

                <div class="mt-8">Price: ${{ $product->price }}</div>

                <form class="mt-8" method="POST">
                    @csrf

                    <div class="w-32">
                        <label for="quantity">Quantity:</label>
                        <input
                            type="number"
                            name="quantity"
                            id="quantity"
                            class="w-full border px-2 py-1 rounded"
                            placeholder="Quantity"
                            value="1"
                            min="1"
                        >
                    </div>

                    <button class="px-4 py-2 mt-4 w-32 rounded bg-theme text-white">Add to cart</button>
                </form>

            </div>
        </div>
    </x-front::container>

    <x-front::container class="py-12">
        {!! $product->description !!}
    </x-front::container>
</x-front::layouts.default>