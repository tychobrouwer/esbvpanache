<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-2 py-1 h-fit rounded-sm font-semibold text-xs uppercase tracking-widest text-gray-800 bg-gray-100 hover:bg-panache hover:text-gray-100 active:bg-panache active:text-gray-100 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
