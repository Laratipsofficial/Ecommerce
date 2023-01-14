<x-front::layouts.default :title="$title">
    <x-front::container class="py-12">
        <x-front::products
            :title="$title"
            :cols="4"
        >
            <x-slot name="filters">
                <x-front::products.sortby :items="$sortByItems" :current="$currentSortedItem" />
            </x-slot>

            <x-front::products.item />
            <x-front::products.item />
            <x-front::products.item />
            <x-front::products.item />
            <x-front::products.item />
            <x-front::products.item />
            <x-front::products.item />
            <x-front::products.item />
            <x-front::products.item />
            <x-front::products.item />
            <x-front::products.item />
            <x-front::products.item />
            <x-front::products.item />
            <x-front::products.item />
            <x-front::products.item />
            <x-front::products.item />
        </x-front::products>
    </x-front::container>
</x-front::layouts.default>