@props(['disabled' => false])

<textarea x-data x-on:update-textarea.window="setTimeout(() => { $el.style.height = 'auto'; $el.style.height = $el.scrollHeight + 2 + 'px' }, 1)" x-on:input="$el.style.height = 'auto'; $el.style.height = $el.scrollHeight + 2 + 'px'"
    @disabled($disabled) rows="10"
    {{ $attributes->merge(['class' => 'mt-1 block w-full border border-gray-300 rounded-sm shadow-sm focus:ring-panache focus:border-panache sm:text-sm']) }}>
</textarea>
