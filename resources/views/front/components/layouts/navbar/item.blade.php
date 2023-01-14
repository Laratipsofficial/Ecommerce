@props(['isActive' => false])

<a
    {{ $attributes->class(['block px-6 py-8 hover:text-theme transition-colors duration-300', 'text-theme font-bold' => $isActive]) }}
>
    {{ $slot }}
</a>