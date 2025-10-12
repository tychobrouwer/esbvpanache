@props(['size' => null])

@if ($size === '2xl')
<h2 class="text-gray-900 font-bold text-2xl">
    {{ $slot }}
</h2>
@elseif ($size === 'xl')
<h3 class="text-gray-900 font-bold text-xl pb-2">
    {{ $slot }}
</h3>
@else
<h4 class="text-panache font-bold text-lg pb-1">
    {{ $slot }}
</h4>
@endif
