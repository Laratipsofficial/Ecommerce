<nav class="shadow">
    <x-front::container>
        <div class="flex items-center justify-between">
            <div>
                <a
                    href="{{ route('home') }}"
                    class="block"
                >
                    <img
                        src="{{ Storage::url('images/favicon.png') }}"
                        alt="logo"
                        class="h-12 w-auto"
                    >
                </a>
            </div>
            <div class="flex items-center">
                <x-front::layouts.navbar.item
                    :href="route('home')"
                    is-active
                >
                    Home
                </x-front::layouts.navbar.item>
                <x-front::layouts.navbar.item :href="route('products')">Products</x-front::layouts.navbar.item>
                <x-front::layouts.navbar.item href="#">About Us</x-front::layouts.navbar.item>
                <x-front::layouts.navbar.item href="#">Contact Us</x-front::layouts.navbar.item>
                <x-front::layouts.navbar.item
                    href="#"
                    class="relative"
                >
                    <x-front::icons.cart class="w-6 h-6 text-theme" />
                    <div
                        class="absolute top-4 right-2 bg-theme text-white w-4 h-4 leading-4 p-3 rounded-full flex items-center justify-center">
                        1
                    </div>
                </x-front::layouts.navbar.item>
            </div>
        </div>
    </x-front::container>
</nav>