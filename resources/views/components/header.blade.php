@props(['size' => null])

@if ($size === '2xl')
<h2 {{ $attributes->merge(['class' => 'text-gray-900 font-semibold text-2xl']) }}>
    {{ $slot }}
</h2>
@elseif ($size === 'xl')
<h3 {{ $attributes->merge(['class' => 'text-gray-900 font-semibold text-xl']) }}>
    {{ $slot }}
</h3>
@else
<h4 {{ $attributes->merge(['class' => 'text-panache font-semibold text-lg']) }}>
    {{ $slot }}
</h4>
@endif
