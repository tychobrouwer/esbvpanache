@php
    $general_committees = $general_committees->sortBy('title_en');
    $non_general_committees = $non_general_committees->sortBy('title_en');
@endphp

<x-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grid grid-cols-1 gap-3 p-6 mb-6">
		<x-header size="2xl">
			{{ __('Committees within Panache') }}
		</x-header>
		<p>{!! __('committee_interested_message') !!}</p>
		<div>
			<x-header size="xl">
				{{ __('General Committees') }}
			</x-header>

			@forelse ($general_committees as $committee)
				<div class="py-1">
					<x-header size="lg">
						{{ App::isLocale('nl') ? $committee->title_nl : $committee->title_en }}
					</x-header>
					{!! App::isLocale('nl') ? $committee->description_nl : $committee->description_en !!}
				</div>
			@empty
				<div class="py-1 text-gray-500">
					{{ __('No general committees found.') }}
				</div>
			@endforelse
		</div>
		<div>
			<x-header size="xl">
				{{ __('PKK and Other Committees') }}
			</x-header>
			If there is no description, then this committee has no regular meetings, activities, or something like that. This committee then has no direct visible impact on the association.
			
			@forelse ($non_general_committees as $committee)
				<div class="py-1">
					<x-header size="lg">
						{{ App::isLocale('nl') ? $committee->title_nl : $committee->title_en }}
					</x-header>
					{!! App::isLocale('nl') ? $committee->description_nl : $committee->description_en !!}
				</div>
			@empty
				<div class="py-1 text-gray-500">
					{{ __('No non-general committees found.') }}
				</div>
			@endforelse
		</div>
	</div>
</x-app-layout>
