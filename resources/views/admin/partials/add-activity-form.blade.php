<section>
    <header x-data class="flex justify-between items-center mb-4">
		<h2 class="text-xl font-bold">{{ __('Activities') }}</h2>
		<x-secondary-button @click="$dispatch('open-modal', 'add-announcement')">{{ __('Add Activity') }}</x-secondary-button>

		<x-modal name="add-announcement" :show="false" maxWidth="lg">
			<h2 class="text-lg font-bold mb-4">{{ __('Add Activity') }}</h2>
			<form method="post" >
				<div class="mb-4">
					<label for="title" class="block text-sm font-medium text-gray-700">{{ __('Title') }}</label>
					<input type="text" name="title" id="title" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-panache focus:border-panache sm:text-sm" required>
				</div>
				<div class="mb-4">
					<label for="date" class="block text-sm font-medium text-gray-700">{{ __('Date') }}</label>
					<input type="text" name="title" id="title" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-panache focus:border-panache sm:text-sm" required>
				</div>
				<div class="mb-4">
					<label for="location" class="block text-sm font-medium text-gray-700">{{ __('Location') }}</label>
					<input type="text" name="title" id="title" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-panache focus:border-panache sm:text-sm" required>
				</div>
				<div class="mb-4">
					<label for="cost" class="block text-sm font-medium text-gray-700">{{ __('Cost') }}</label>
					<input type="text" name="title" id="title" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-panache focus:border-panache sm:text-sm" required>
				</div>
				<div class="mb-4">
					<label for="join" class="block text-sm font-medium text-gray-700">{{ __('How to Join') }}</label>
					<input type="text" name="title" id="title" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-panache focus:border-panache sm:text-sm" required>
				</div>

				<div class="mb-4">
					<label for="content" class="block text-sm font-medium text-gray-700">{{ __('Content') }}</label>
					<textarea name="content" id="content" rows="4" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-panache focus:border-panache sm:text-sm" required></textarea>
				</div>
				<div class="flex justify-end">
					<x-secondary-button @click="$dispatch('close-modal', 'add-announcement')" class="me-2">{{ __('Cancel') }}</x-secondary-button>
					<x-primary-button type="submit">{{ __('Add') }}</x-primary-button>
				</div>
			</form>
		</x-modal>
    </header>

	@forelse ($activities as $activity)
		<div class="mb-2 flex">
			<div class="font-bold flex-grow">{{ $activity->title }}</div>
			<div>{{ $activity->date->format('F j, Y') }}</div>
		</div>
	@empty
		<div class="text-gray-500">{{ __('No activities yet.') }}</div>
	@endforelse

</section>