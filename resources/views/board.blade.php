<?php use App\Http\Controllers\ImageController; ?>

@props(['nr_of_boards' => 3])

<x-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grid grid-cols-1 gap-3 p-6 mb-6">
        <x-header size="2xl">
            {{ __('Board') }}
        </x-header>
        {!! ImageController::addImageToContent(App::isLocale('nl') ? $board->message_nl : $board->message_en) !!}
    </div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grid grid-cols-1 gap-3 p-6 mb-6" x-data x-cloak>
        <x-header size="2xl">
            {{ __('Previous Boards') }}
        </x-header>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($boards as $index => $board)
                <div class="previous_board min-w-[200px] bg-gray-100 overflow-hidden shadow-sm rounded-lg p-6 border-b-4 border-panache flex flex-col justify-between" x-show="{{ $index }} < {{ $nr_of_boards }}">
                    <div>
                        <div class="font-semibold flex-grow">{{ $board->year + 1962 }}-{{ $board->year + 1963 }}, {{ $board->ordinal() }}</div>
                        <div class="my-4 text-gray-800 text-ellipsis line-clamp-5">
                            <strong>{{ __('Chairperson') }}:</strong> {{ $board->chairpersonShort() }}<br>
                            <strong>{{ __('Vice-chairperson') }}:</strong> {{ $board->viceChairpersonShort() }}<br>
                            <strong>{{ __('Secretary') }}:</strong> {{ $board->secretaryShort() }}<br>
                            <strong>{{ __('Treasurer') }}:</strong> {{ $board->treasurerShort() }}<br>
                            <strong>{{ __('Slogan') }}:</strong> {{ $board->slogan }}
                        </div>
                    </div>
                </div>
            @endforeach
            @if (count($boards) > $nr_of_boards)
                <div class="col-span-full text-center">
                    <button class="text-panache font-semibold" @click="document.querySelectorAll('.previous_board').forEach(el => el.style.display = 'flex'); $el.style.display = 'none';">
                        {{ __('Show all boards') }}
                    </button>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
