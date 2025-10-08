@props(['disabled' => false])

<textarea @disabled($disabled) {{ $attributes->merge(['class' => 'mt-1 block w-full border border-gray-300 rounded-sm shadow-sm focus:ring-panache focus:border-panache sm:text-sm']) }}></textarea>
