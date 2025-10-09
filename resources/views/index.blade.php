<x-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 flex items-center text-lg">
            <p>{!! __('welcome') !!}</p>
            <x-panache-logo-full class="fill-panache" />
        </div>
    </div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
        <h2 class="px-6 pt-6 text-gray-900 font-bold text-2xl flex">
            {{ __('Announcements') }}
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
            @forelse ($announcements as $announcement)
                <div class="min-w-[200px] bg-gray-100 overflow-hidden shadow-sm sm:rounded-lg p-6 border-b-4 border-panache flex flex-col justify-between">
                    <div>
                        <div class="font-bold flex-grow">{{ $announcement->title }}</div>
                        <div>{{ $announcement->date->format('F j,  Y') }}</div>
                        <div class="my-4 text-gray-600 text-ellipsis line-clamp-5">
                            {!! nl2br(e($announcement->content)) !!}
                        </div>
                    </div>
                    <x-secondary-button class="self-end">{{ __('Read More') }}</x-secondary-button>
                </div>
            @empty
                <div class="text-gray-500">{{ __('No announcements yet.') }}</div>
            @endforelse
        </div>
    </div>  
</x-app-layout>
