@props(['align' => 'right', 'width' => 'w-max', 'contentClasses' => 'py-1 bg-white'])

@php
$alignmentClasses = match ($align) {
    'left' => 'ltr:origin-top-left rtl:origin-top-right start-0',
    'top' => 'origin-top',
    default => 'ltr:origin-top-right rtl:origin-top-left end-0',
};
@endphp

<div class="relative"
     x-data="{ open: false, timeout: null }"
     @click.outside="open = false"
     @mouseenter="clearTimeout(timeout); open = true"
     @mouseleave="timeout = setTimeout(() => open = false, 150)">
     
    <div @click="open = true">
        {{ $trigger }}
    </div>

    <div x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="absolute z-50 mt-2 {{ $width }} shadow-lg {{ $alignmentClasses }}"
            style="display: none;"
            @click="open = false">
        <div class="ring-1 ring-black ring-opacity-5 {{ $contentClasses }}">
            {{ $content }}
        </div>
    </div>
</div>
