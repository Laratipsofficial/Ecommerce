@props([
    'imageHeight' => 'h-40',
    'product' => \App\Models\Product::find(17),
])

<a
    href="{{ route('products.show', $product) }}"
    class="block bg-white rounded shadow-md overflow-hidden"
>
    <img
        src="{{ $product->getFirstMediaUrl() }}"
        class="w-full {{ $imageHeight }} object-cover"
    >
    <div class="p-4">
        <div class="flex items-center justify-between">
            <div class="text-gray-600 text-sm">{{ $product->created_at->format('jS M, Y') }}</div>
            <div class="text-gray-700">${{ $product->price }}</div>
        </div>

        <div
            class="mt-2 truncate"
            title="{{ $product->name }}"
        >
            {{ $product->name }}
        </div>
    </div>
</a>