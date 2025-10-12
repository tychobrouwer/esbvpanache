<x-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grid grid-cols-1 gap-3 p-6 mb-6">
        <x-header size="2xl">
            {{ __('Training') }}
        </x-header>
        <p>{!! __('training_message') !!}</p>
        <x-header size="2xl">
            {{ __('Free Playing') }}
        </x-header>
        <p>{!! __('free_playing_message') !!}</p>
    </div>
</x-app-layout>