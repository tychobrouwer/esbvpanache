@props(['active'])

@php
    $classes = !$active
    ? 'block w-full px-4 py-1 mb-1 text-start font-semibold text-xs uppercase leading-5 bg-white text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out'
    : 'block w-full px-4 py-1 mb-1 text-start font-semibold text-xs uppercase leading-5 bg-panache text-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
