@props([
    'title',
    'cols' => 4,
])

@php
    $gridCols = match($cols) {
        2 => 'grid-cols-2',
        3 => 'grid-cols-3',
        4 => 'grid-cols-4',
        default => 'grid-cols-4',
    }
@endphp

<div>
    <div class="flex items-center justify-between">
        <h2 class="text-4xl text-theme font-bold">{{ $title }}</h2>

        {{ $filters ?? null }}
    </div>

    <div class="mt-8 grid {{ $gridCols }} gap-6">
        {{ $slot }}
    </div>
</div>