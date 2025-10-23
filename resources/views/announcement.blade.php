<?php use App\Http\Controllers\ImageController; ?>

<x-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grid grid-cols-1 gap-3 p-6 mb-6">
        <div>
            <x-header size="2xl">
                {{ App::isLocale('nl') ? $announcement->title_nl : $announcement->title_en }}
            </x-header>
            <p class="text-gray-500">{{ $announcement->date->format('F j,  Y') }}</p>
        </div>
        {!! ImageController::addImageToContent(App::isLocale('nl') ? $announcement->content_nl : $announcement->content_en) !!}
	</div>
</x-app-layout>
