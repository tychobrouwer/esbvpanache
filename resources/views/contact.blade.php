<x-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <h1 class="p-6 text-gray-900 font-bold text-3xl flex">
            {{ __('Contact') }}
        </h1>
        <div class="px-6 pb-6 text-gray-900 flex">
            <p>{!! __('board_contact') !!}</p>
        </div>
        <h2 class="px-6 text-gray-900 font-bold text-2xl flex">
            {{ __('Board') }}
        </h2>
        <div class="px-6 pb-6 text-gray-900 flex">
            {{ __('Chairman') }} - Ata Chaga<br>
            {{ __('Vice-chairman') }} - Luc Broeders<br>
            {{ __('Secretary') }} - Tycho Brouwer<br>
            {{ __('Treasurer') }} - Yoni van Delft
        </div>
        <h2 class="px-6 text-gray-900 font-bold text-2xl flex">
            {{ __('Confidential Contact Person') }}
        </h2>
        <div class="px-6 pb-6 text-gray-900 flex">
            <p>{!! __('confidential_contact') !!}</p>
        </div>
        <h2 class="px-6 text-gray-900 font-bold text-2xl flex">
            {{ __('Where can you find us?') }}
        </h2>
        <div class="px-6 pb-6 text-gray-900 flex">
            <p>Student Sports Centre Eindhoven (SSCE):<br><br>

            ESBV Panache<br>
            Onze Lieve Vrouwestraat 1<br>
            5612 AW Eindhoven<br>
            <a class="text-panache" href="https://ssceindhoven.tue.nl/en">Website SSCE</a><br><br>

            {{ __('ssc_directions') }}</p>
        </div>
    </div>
</x-app-layout>
