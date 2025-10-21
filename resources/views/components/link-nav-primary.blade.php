@props(['active'])

@php
    $classes = !$active
    ? 'inline-flex items-center px-2 py-1 h-fit rounded-sm font-semibold text-xs uppercase text-gray-800 bg-gray-100 hover:bg-panache hover:text-gray-100 transition ease-in-out duration-150'
    : 'inline-flex items-center px-2 py-1 h-fit rounded-sm font-semibold text-xs uppercase text-gray-100 bg-panache hover:bg-panache hover:text-gray-100 transition ease-in-out duration-150';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
