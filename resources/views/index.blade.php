<x-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grid grid-cols-1 gap-3 p-6 mb-6">
        <div class="md:flex items-center">
            <p class="pr-6 basis-3/5">{!! __('welcome') !!}</p>
            <x-panache-logo-full class="fill-panache text-panache basis-2/5" />
        </div>
    </div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grid grid-cols-1 gap-3 p-6 mb-6">
        <x-header size="2xl">
            {{ __('Announcements') }}
        </x-header>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($announcements as $announcement)
                <div class="min-w-[200px] bg-gray-100 overflow-hidden shadow-sm rounded-lg p-6 border-b-4 border-panache flex flex-col justify-between">
                    <div>
                        <div class="font-semibold flex-grow">{{ $announcement->title_en }}</div>
                        <div>{{ $announcement->date->format('F j,  Y') }}</div>
                        <div class="my-4 text-gray-800 text-ellipsis line-clamp-5">
                            {!! nl2br(e($announcement->content_en)) !!}
                        </div>
                    </div>
                    <x-secondary-button class="self-end">{{ __('Read More') }}</x-secondary-button>
                </div>
            @empty
                <div class="text-gray-500">{{ __('No announcements yet.') }}</div>
            @endforelse
        </div>
    </div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grid grid-cols-1 gap-3 p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <x-header size="2xl" class="col-span-full">
                {{ __('Information') }}
            </x-header>
            <div class="min-w-[200px] bg-gray-100 overflow-hidden shadow-sm rounded-lg p-6 border-b-4 border-panache flex flex-col justify-between">
                <div>
                    <div class="font-semibold flex-grow">{{ __('Training & Playing') }}</div>
                    <div class="my-4 text-gray-800 text-ellipsis line-clamp-5">
                        {!! __('playing_message') !!}
                    </div>
                </div>
                <x-secondary-nav-link :href="route('training-and-playing')" :active="false" class="self-end">{{ __('Read More') }}</x-secondary-button>
            </div>
            <div class="min-w-[200px] bg-gray-100 overflow-hidden shadow-sm rounded-lg p-6 border-b-4 border-panache flex flex-col justify-between">
                <div>
                    <div class="font-semibold flex-grow">{{ __('Membership') }}</div>
                    <div class="my-4 text-gray-800 text-ellipsis line-clamp-5">
                        {!! __('membership_form_message') !!}
                    </div>
                </div>
                <x-secondary-nav-link :href="route('membership')" :active="false" class="self-end">{{ __('Read More') }}</x-secondary-button>
            </div>
            <div class="min-w-[200px] bg-gray-100 overflow-hidden shadow-sm rounded-lg p-6 border-b-4 border-panache flex flex-col justify-between">
                <div>
                    <div class="font-semibold flex-grow">{{ __('Competition') }}</div>
                    <div class="my-4 text-gray-800 text-ellipsis line-clamp-5">
                        {!! __('competition_message') !!}
                    </div>
                </div>
                <x-secondary-nav-link :href="route('competition')" :active="false" class="self-end">{{ __('Read More') }}</x-secondary-button>
            </div>
        </div>
    </div>
</x-app-layout>
