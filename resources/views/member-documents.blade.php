<x-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grid grid-cols-1 gap-3 p-6 mb-6">
        <x-header size="2xl">
            {{ __('By-Laws') }}
        </x-header>
        <p>{!! __('by_laws_message') !!}</p>
        <x-header size="2xl">
            {{__('Member List') }}
        </x-header>
        <p>{!! __('member_list_message') !!}</p>
        <x-header size="2xl">
            {{__('Privacy Statement') }}
        </x-header>
        <p>{!! __('privacy_statement_message') !!}</p>
    </div>
</x-app-layout>
