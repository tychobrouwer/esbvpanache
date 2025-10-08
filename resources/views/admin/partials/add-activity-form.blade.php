<section>
    <header x-data class="flex justify-between items-center mb-4">
		<h2 class="text-xl font-bold">{{ __('Activities') }}</h2>
		<x-secondary-button @click="$dispatch('open-modal', 'add-announcement')">{{ __('Add Activity') }}</x-secondary-button>

		<x-modal name="add-announcement" :show="false" maxWidth="lg">
			<h2 class="text-lg font-bold mb-4">{{ __('Add Activity') }}</h2>
			<form method="post" action="{{ route('activity.add') }}" >
				@csrf
				@method('post')

				<div class="mb-4">
					<x-input-label for="add_activity_title" :value="__('Title')" />
					<x-text-input id="add_activity_title" name="title" class="mt-1 block w-full" />
				</div>
				<div class="mb-4">
					<x-input-label for="add_activity_date" :value="__('Date')" />
					<x-text-input id="add_activity_date" name="date" class="mt-1 block w-full" />
				</div>
				<div class="mb-4">
					<x-input-label for="add_activity_location" :value="__('Location')" />
					<x-text-input id="add_activity_location" name="location" class="mt-1 block w-full" />
				</div>
				<div class="mb-4">
					<x-input-label for="add_activity_cost" :value="__('Cost')" />
					<x-text-input id="add_activity_cost" name="cost" class="mt-1 block w-full" />
				</div>
				<div class="mb-4">
					<x-input-label for="add_activity_join" :value="__('How to Join')" />
					<x-text-input id="add_activity_join" name="join" class="mt-1 block w-full" />
				</div>

				<div class="mb-4">
					<x-input-label for="add_activity_content" :value="__('Content')" />
					<x-text-area id="add_activity_content" name="content" class="mt-1 block w-full" />
				</div>
				<div class="flex justify-end">
					<x-secondary-button @click="$dispatch('close-modal', 'add-announcement')" class="me-2">{{ __('Cancel') }}</x-secondary-button>
					<x-primary-button type="submit">{{ __('Add') }}</x-primary-button>
				</div>
			</form>
		</x-modal>
    </header>

	@forelse ($activities as $activity)
		<div class="mb-2 flex justify-between items-center">
			<div>
				<div class="font-bold flex-grow">{{ $activity->title }}</div>
				<div>{{ $activity->date->format('F j, Y') }}</div>
			</div>
			<form method="post" action="{{ route('activity.delete') }}">
				@csrf
				@method('delete')

				<input type="hidden" name="activity_id" value="{{ $activity->id }}">
				<x-secondary-button type="submit">{{ __('Delete') }}</x-secondary-button>
			</form>
		</div>
	@empty
		<div class="text-gray-500">{{ __('No activities yet.') }}</div>
	@endforelse

</section>