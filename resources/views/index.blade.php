<x-app-layout>
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex items-center">
                    <p>{!! __('welcome') !!}</p>
                    <x-panache-logo-full class="fill-panache" />
                </div>
                <h2 class="px-6 pb-6 text-gray-900 font-bold text-2xl flex">
                    {{ __('Announcements') }}
                </h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 pt-6">
                	@forelse ($announcements as $announcement)
                        <div class="min-w-[200px] bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                            <div class="text-gray-900 flex items-center">
                                <div class="font-bold flex-grow">{{ $announcement->title }}</div>
                                <div>{{ $announcement->date->format('F j, Y') }}</div>
                            </div>
                            <div class="mt-4 text-gray-600">
                                {!! nl2br(e($announcement->content)) !!}
                            </div>
                        </div>
                    @empty
                        <div class="text-gray-500">{{ __('No announcements yet.') }}</div>
                    @endforelse
            </div>  
        </div>
    </div>
</x-app-layout>
