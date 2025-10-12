<x-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grid grid-cols-1 gap-3 p-6 mb-6">
        <x-header size="2xl">
            {{ __('Contact') }}
        </x-header>
        <p>{!! __('board_contact') !!}</p>
        <x-header size="2xl">
            {{ __('Board')}}
        </x-header>
        <p>
            {{ __('Chairman') }} - Ata Chaga<br>
            {{ __('Vice-chairman') }} - Luc Broeders<br>
            {{ __('Secretary') }} - Tycho Brouwer<br>
            {{ __('Treasurer') }} - Yoni van Delft
        </p>
        <x-header size="2xl">
            {{ __('Confidential Contact Person') }}
        </x-header>
        <p>{!! __('confidential_contact') !!}</p>
        <x-header size="2xl">
            {{ __('Where can you find us?')}}
        </x-header>
        <p>
            Student Sports Centre Eindhoven (SSCE):<br><br>
            ESBV Panache<br>
            Onze Lieve Vrouwestraat 1<br>
            5612 AW Eindhoven<br>
            <a class="text-panache" href="https://ssceindhoven.tue.nl/en">Website SSCE</a><br><br>
            {{ __('ssc_directions') }}
        </p>
    </div>
</x-app-layout>
