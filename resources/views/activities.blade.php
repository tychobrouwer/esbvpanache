<?php

function activityDateString($activity) {
    $dateEnd = clone $activity->date;

    $dateString = $activity->date->format('F j, Y ');
    if (!$activity->duration) {
        return $dateString;
    }
    $dateEnd = $dateEnd->modify("+$activity->duration hours");
    
    return $dateString . $activity->date->format('H:i') . ($activity->duration ? $dateEnd->format(' - H:i') : '');
}

?>

<x-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grid grid-cols-1 gap-3 p-6 mb-6">
        <x-header size="2xl">
            {{ __('Upcoming Activities') }}
        </x-header>
        <p>{!! __('upcoming_activities_message') !!}</p>
        <div class="grid grid-cols-1 gap-6 mb-6">
            @forelse ($upcomingActivities as $activity)
            <x-card-link :title="App::isLocale('nl') ? $activity->title_nl : $activity->title_en" :limit="false" >
                <div>{{ activityDateString($activity) }}</div>
                <div class="mt-4 text-gray-800">
                    {!! nl2br(e(App::isLocale('nl') ? $activity->content_nl : $activity->content_en)) !!}<br><br>
                    <strong>{{ __('How to Join') }}:</strong> {{ App::isLocale('nl') ? $activity->join_nl : $activity->join_en }}<br>
                    <strong>{{ __('Location') }}:</strong> {{ App::isLocale('nl') ? $activity->location_nl : $activity->location_en }}<br>
                    <strong>{{ __('Cost') }}:</strong> {{ App::isLocale('nl') ? $activity->cost_nl : $activity->cost_en }}<br>
                </div>
            </x-card-link>
            @empty
                <div class="text-gray-500">{{ __('No upcoming activities yet.') }}</div>
            @endforelse
        </div>
        <x-header size="2xl">
            {{ __('Past Activities') }}
        </x-header>
        <div class="grid grid-cols-1 gap-6">
            @forelse ($pastActivities as $activity)
            <x-card-link :title="App::isLocale('nl') ? $activity->title_nl : $activity->title_en" :limit="false" >
                <div>{{ activityDateString($activity) }}</div>
                <div class="mt-4 text-gray-800">
                    {!! nl2br(e(App::isLocale('nl') ? $activity->content_nl : $activity->content_en)) !!}<br><br>
                    <strong>{{ __('How to Join') }}:</strong> {{ App::isLocale('nl') ? $activity->join_nl : $activity->join_en }}<br>
                    <strong>{{ __('Location') }}:</strong> {{ App::isLocale('nl') ? $activity->location_nl : $activity->location_en }}<br>
                    <strong>{{ __('Cost') }}:</strong> {{ App::isLocale('nl') ? $activity->cost_nl : $activity->cost_en }}<br>
                </div>
            </x-card-link>
            @empty
                <div class="text-gray-500">{{ __('No past activities yet.') }}</div>
            @endforelse
        </div>
    </div>
</x-app-layout>
