<section>
    <header x-data class="flex justify-between items-center mb-4">
		<h2 class="text-xl font-bold">{{ __('Announcements') }}</h2>
		<x-secondary-button @click="$dispatch('open-modal', 'add-activity')">{{ __('Add Announcement') }}</x-secondary-button>

		<x-modal name="add-activity" :show="false" maxWidth="lg">
			<h2 class="text-lg font-bold mb-4">{{ __('Add Announcement') }}</h2>
			<form method="post" action="{{ route('announcement.add') }}" >
				@csrf
				<div class="mb-4">
					<x-input-label for="add_announcement_title" :value="__('Title')" />
					<x-text-input id="add_announcement_title" name="title" class="mt-1 block w-full" />
					<x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />

				</div>
				<div class="mb-4">
					<x-input-label for="add_announcement_date" :value="__('Date')" />
					<x-text-input id="add_announcement_date" name="date" class="mt-1 block w-full" />
				</div>
				<div class="mb-4">
					<x-input-label for="add_announcement_content" :value="__('Content')" />
					<x-text-area id="add_announcement_content" name="content" class="mt-1 block w-full" />
				</div>
				<div class="flex justify-end">
					<x-secondary-button @click="$dispatch('close-modal', 'add-activity')" class="me-2">{{ __('Cancel') }}</x-secondary-button>
					<x-primary-button type="submit">{{ __('Add') }}</x-primary-button>
				</div>
			</form>
		</x-modal>
    </header>

	<ul class="list-disc list-inside">
		<li><a href="#" class="text-panache">View Users</a></li>
		<li><a href="#" class="text-panache">Add User</a></li>
		<li><a href="#" class="text-panache">Edit User</a></li>
		<li><a href="#" class="text-panache">Delete User</a></li>
	</ul>

</section>