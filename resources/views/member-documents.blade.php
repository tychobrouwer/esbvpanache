<x-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grid grid-cols-1 gap-3 p-6 mb-6">
        <x-header size="2xl">
            {{ __('Member Documents') }}
        </x-header>
        <x-header size="xl">
            {{ __('By-Laws') }}
        </x-header>
        <p>{!! __('by_laws_message') !!}</p>
        <x-header size="xl">
            {{__('Member List') }}
        </x-header>
        <p>{!! __('member_list_message') !!}</p>
        <x-header size="xl">
            {{__('Privacy Statement') }}
        </x-header>
        <p>{!! __('privacy_statement_message') !!}</p>
    </div>
</x-app-layout>
