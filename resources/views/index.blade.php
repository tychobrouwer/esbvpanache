<x-app-layout>
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex items-center">
                    <p>{!! __('welcome') !!}</p>
                    <x-panache-logo-full class="fill-panache" />
                </div>
                <h2 class="px-6 pb-6 text-gray-900 font-bold text-2xl flex">
                    {{ __('Announcements') }}
                </h2>
            </div>
        </div>
    </div>
</x-app-layout>
