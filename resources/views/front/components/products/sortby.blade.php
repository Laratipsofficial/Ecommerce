@props([
    'items',
    'current' => null,
])

<div
    x-data="{show: false}"
    class="relative w-1/2"
>
    <button
        class="px-4 py-2 ml-auto space-x-2 bg-white text-gray-600 flex items-center border rounded"
        x-on:click.prevent="show=!show"
    >
        <span>{{ $current ?: 'Sorty By' }}</span>
        <x-front::icons.cart class="w-4 h-4" />
    </button>

    <ul
        x-show="show"
        class="mt-1 py-1 absolute right-0 bg-white rounded shadow overflow-hidden"
    >
        @foreach ($items as $item)
            <x-front::products.sortby-item
                :query-params="['sortby' => $item['identifier']]"
                :class="(!$loop->last ? ' border-b' : null) . ($current === $item['name'] ? ' text-theme' : null)"
            >
                {{ $item['name'] }}
            </x-front::products.sortby-item>
        @endforeach
    </ul>
</div>