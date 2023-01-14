@props([
    'prevNextButton' => true,
    'pagination' => false,
])

<div class="swiper">
    <div class="swiper-wrapper">
        {{ $slot }}
    </div>

    @if($pagination)
        <div class="swiper-pagination"></div>
    @endif

    @if($prevNextButton)
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    @endif
</div>
