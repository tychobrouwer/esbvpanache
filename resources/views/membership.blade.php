<x-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grid grid-cols-1 gap-3 p-6 mb-6">
        <p>{!! __('membership_notice_message') !!}</p>
        <x-header size="2xl">
            Student Sports Centre Eindhoven (SSCE)
        </x-header>
        <p>{!! __('ssce_message') !!}</p>
        <x-header size="2xl">
            {{ __('Membership Form') }}
        </x-header>
        <p>{!! __('membership_form_message') !!}</p>
        <x-header size="2xl">
            {{ __('Types of Membership') }}
        </x-header>
        <p>{!! __('types_of_membership_message') !!}</p>
        <x-header size="2xl">
            {{ __('Competition Player (60 Euro)') }}
        </x-header>
        <p>{!! __('competition_player_message') !!}</p>
        <x-header size="2xl">
            {{ __('Recreant Player (40 Euro)') }}
        </x-header>
        <p>{!! __('recreant_player_message') !!}</p>
        <x-header size="2xl">
            {{ __('Contributor Player (30 Euro)') }}
        </x-header>
        <p>{!! __('contributor_player_message') !!}</p>
    </div>
</x-app-layout>