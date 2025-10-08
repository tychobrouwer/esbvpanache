<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-2 py-1 h-fit rounded-sm bg-white ring-2 ring-gray-300 font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 hover:ring-panache disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
