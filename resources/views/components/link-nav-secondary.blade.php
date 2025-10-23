@props(['active'])

@php
    $classes = !$active
    ? 'inline-flex items-center justify-center px-2 py-1 h-fit min-w-20 rounded-sm bg-white ring-2 ring-gray-300 font-semibold text-xs text-gray-800 uppercase shadow-sm hover:bg-gray-200 hover:ring-panache transition ease-in-out duration-150'
    : 'inline-flex items-center justify-center px-2 py-1 h-fit min-w-20 rounded-sm bg-panache-600 ring-2 ring-gray-300 font-semibold text-xs text-gray-800 uppercase shadow-sm hover:bg-gray-200 hover:ring-panache transition ease-in-out duration-150';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
