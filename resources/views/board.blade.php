<?php
function firstName($name) {
    return current(explode(" ", $name));
}

function ordinal($number) {
    $ends = array('th','st','nd','rd','th','th','th','th','th','th');
    if ((($number % 100) >= 11) && (($number%100) <= 13))
        return $number. 'th';
    else
        return $number. $ends[$number % 10];
}
?>

@props(['nr_of_boards' => 3])

<x-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grid grid-cols-1 gap-3 p-6 mb-6">
        <x-header size="2xl">
            {{ __('Board') }}
        </x-header>
        <p>{{ App::isLocale('nl') ? $board->message_nl : $board->message_en }}</p>
    </div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grid grid-cols-1 gap-3 p-6 mb-6" x-data x-cloak>
        <x-header size="2xl">
            {{ __('Previous Boards') }}
        </x-header>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($boards as $index => $board)
                <div class="min-w-[200px] bg-gray-100 overflow-hidden shadow-sm rounded-lg p-6 border-b-4 border-panache flex flex-col justify-between" x-show="{{ $index }} < {{ $nr_of_boards }}">
                    <div>
                        <div class="font-semibold flex-grow">{{ $board->year + 1962 }}-{{ $board->year + 1963 }}, {{ ordinal($board->year) }}</div>
                        <div class="my-4 text-gray-800 text-ellipsis line-clamp-5">
                            <strong>{{ __('Chairperson') }}:</strong> {{ firstName($board->chairperson) }}<br>
                            <strong>{{ __('Vice-chairperson') }}:</strong> {{ firstName($board->vice_chairperson) }}<br>
                            <strong>{{ __('Secretary') }}:</strong> {{ firstName($board->secretary) }}<br>
                            <strong>{{ __('Treasurer') }}:</strong> {{ firstName($board->treasurer) }}<br>
                            <strong>{{ __('Slogan') }}:</strong> {{ $board->slogan }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
