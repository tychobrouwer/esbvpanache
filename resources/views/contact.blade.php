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
            <strong>{{ __('Chairperson') }}:</strong> {{ $board->chairperson }}<br>
            <strong>{{ __('Vice-chairperson') }}:</strong> {{ $board->vice_chairperson }}<br>
            <strong>{{ __('Secretary') }}:</strong> {{ $board->secretary }}<br>
            <strong>{{ __('Treasurer') }}:</strong> {{ $board->treasurer }}<br>
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
            <a class="text-panache-600" href="https://ssceindhoven.tue.nl/en">Website SSCE</a><br><br>
            {{ __('ssc_directions') }}
        </p>
    </div>
</x-app-layout>
