<x-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grid grid-cols-1 gap-3 p-6 mb-6">
        <div class="md:flex items-center">
            <p class="pr-6 basis-3/5">{!! __('welcome') !!}</p>
            <x-panache-logo-full class="fill-panache text-panache-600 basis-2/5" />
        </div>
    </div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grid grid-cols-1 gap-3 p-6 mb-6">
        <x-header size="2xl">
            {{ __('Announcements') }}
        </x-header>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($announcements as $announcement)
                <x-card-link :title="App::isLocale('nl') ? $announcement->title_nl : $announcement->title_en" :date="$announcement->date->format('F j,  Y')" :limit="true" href="{{ route('announcement', ['announcement' => $announcement->id]) }}">
                    {!! nl2br(e(App::isLocale('nl') ? $announcement->content_nl : $announcement->content_en)) !!}
                </x-card-link>
            @empty
                <div class="text-gray-500">{{ __('No announcements yet.') }}</div>
            @endforelse
        </div>
    </div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grid grid-cols-1 gap-3 p-6 mb-6">
        <x-header size="2xl" class="col-span-full">
            {{ __('Information') }}
        </x-header>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <x-card-link :title="__('Training')" :limit="true" href="{{ route('training') }}">
                {!! __('playing_message') !!}
            </x-card-link>

            <x-card-link :title="__('Membership')" :limit="true" href="{{ route('membership') }}">
                {!! __('membership_form_message') !!}
            </x-card-link>

            <x-card-link :title="__('Competition')" :limit="true" href="{{ route('competition') }}">
                {!! __('competition_message') !!}
            </x-card-link>
        </div>
    </div>
</x-app-layout>
