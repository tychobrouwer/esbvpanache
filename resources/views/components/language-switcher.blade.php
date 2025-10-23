<div
    class="flex items-center gap-2 cursor-pointer select-none"
    @click="lang = lang === 'en' ? 'nl' : 'en'"
>
    <span 
        class="text-sm font-medium" 
        :class="lang === 'en' ? 'text-panache-600' : 'text-gray-300'"
    >
        EN
    </span>
    <div
        class="relative w-12 h-6 rounded-full transition-all duration-300 bg-gray-300"
    >
        <div
            class="absolute top-0.5 left-0.5 w-5 h-5 bg-white rounded-full shadow transition-all duration-300"
            :class="lang === 'nl' ? 'translate-x-6' : 'translate-x-0'"
        ></div>
    </div>
    <span 
        class="text-sm font-medium" 
        :class="lang === 'nl' ? 'text-panache-600' : 'text-gray-300'"
    >
        NL
    </span>
</div>
