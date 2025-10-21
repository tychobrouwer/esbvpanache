<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex justify-center items-center px-2 py-1 h-fit min-w-20 rounded-sm font-semibold text-xs uppercase text-gray-800 bg-gray-100 hover:bg-panache hover:text-gray-100 active:bg-panache active:text-gray-100 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
