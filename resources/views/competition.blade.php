<x-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grid grid-cols-1 gap-3 p-6 mb-6">
        <p>{!! __('competition_interest_message') !!}</p>
        <x-header size="2xl">
            {{ __('Competition') }}
        </x-header>
        <p>{!! __('competition_message') !!}</p>
        <x-header size="2xl">
            {{ __('Tournaments') }}
        </x-header>
        <p>{!! __('tournaments_message') !!}</p>
    </div>
</x-app-layout>
