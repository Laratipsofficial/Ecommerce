<x-front::layouts.default title="Home">

    <x-front::slider>
        <x-front::slider.item
            title="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis, minima"
            href="#"
            :image-url="asset('storage/images/test/1.jpg')"
        />
        <x-front::slider.item
            title="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis, minima"
            href="#"
            :image-url="asset('storage/images/test/2.jpg')"
        />
        <x-front::slider.item
            title="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis, minima"
            href="#"
            :image-url="asset('storage/images/test/3.jpg')"
        />
        <x-front::slider.item
            title="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis, minima"
            href="#"
            :image-url="asset('storage/images/test/4.jpg')"
        />
    </x-front::slider>

    <x-front::container class="py-12">
        <x-front::products
            title="Featured"
            :cols="4"
        >
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

    <div class="py-12 bg-theme/10">
        <x-front::container>
            <x-front::products
                title="Popular"
                :cols="4"
            >
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
    </div>

    <x-front::container class="py-12">
        <x-front::products
            title="Women's wear"
            :cols="4"
        >
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

    <div class="py-12 bg-theme/10">
        <x-front::container>
            <x-front::products
                title="Men's wear"
                :cols="4"
            >
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
    </div>

</x-front::layouts.default>