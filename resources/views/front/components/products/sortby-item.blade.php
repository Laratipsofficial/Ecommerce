@props([
    'queryParams' => []
])

<li {{ $attributes }}>
    <a
        href="{{ url()->current() }}?{{ http_build_query($queryParams) }}"
        class="block px-4 py-2 hover:bg-theme/80 hover:text-white transition-colors duration-500"
    >
        {{ $slot }}
    </a>
</li>
