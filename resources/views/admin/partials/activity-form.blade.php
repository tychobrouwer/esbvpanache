@php
    if ($errors->any()) {
        // dd($errors->all());
    }
@endphp

<section>
    <header x-data class="flex justify-between items-center">
        <x-header size="xl">
            {{ __('Activities') }}
        </x-header>

        <x-secondary-button
            @click="$dispatch('open-modal', 'add-activity')">{{ __('Add Activity') }}</x-secondary-button>
    </header>

    @forelse ($activities as $activity)
        <div class="mb-2 flex justify-between items-center">
            <div>
                <div class="font-bold flex-grow">{{ $activity->title_en }}</div>
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

<x-modal name="add-activity" :show="$errors->addActivity->any()" maxWidth="lg">
    <form method="post" action="{{ route('activity.add') }}" x-data="activityForm()">
        @csrf
        @method('post')

        <div class="flex md:gap-4 flex-col md:flex-row">
            <h2 class="text-lg font-bold mb-4 flex-grow">{{ __('Add Activity') }}</h2>
            <x-language-switcher x-model="lang" />
        </div>
        <div class="flex md:gap-4 flex-col md:flex-row">
            <div class="mb-4 flex-grow">
                <x-input-label :value="__('Title')" />
                <div x-show="lang === 'en'">
                    <x-text-input name="title_en" x-model="form.translations.en.title" />
                    <x-input-error :messages="$errors->addActivity->get('title_en')" class="mt-2" />

                </div>
                <div x-show="lang === 'nl'">
                    <x-text-input name="title_nl" x-model="form.translations.nl.title" />
                    <x-input-error :messages="$errors->addActivity->get('title_nl')" class="mt-2" />
                </div>
            </div>
            <div class="mb-4 flex-grow">
                <x-input-label :value="__('Date')" />
                <x-text-input id="add_activity_date" name="date" />
                <x-input-error :messages="$errors->addActivity->get('date')" class="mt-2" />
            </div>
        </div>
        <div class="flex md:gap-4 flex-col md:flex-row">
            <div class="mb-4 flex-grow">
                <x-input-label :value="__('Location')" />
                <div x-show="lang === 'en'">
                    <x-text-input name="location_en" x-model="form.translations.en.location" />
                    <x-input-error :messages="$errors->addActivity->get('location_en')" class="mt-2" />
                </div>
                <div x-show="lang === 'nl'">
                    <x-text-input name="location_nl" x-model="form.translations.nl.location" />
                    <x-input-error :messages="$errors->addActivity->get('location_nl')" class="mt-2" />
                </div>
            </div>
            <div class="mb-4 flex-grow">
                <x-input-label :value="__('Cost')" />
                <div x-show="lang === 'en'">
                    <x-text-input name="cost_en" x-model="form.translations.en.cost" />
                    <x-input-error :messages="$errors->addActivity->get('cost_en')" class="mt-2" />
                </div>
                <div x-show="lang === 'nl'">
                    <x-text-input name="cost_nl" x-model="form.translations.nl.cost" />
                    <x-input-error :messages="$errors->addActivity->get('cost_nl')" class="mt-2" />
                </div>
            </div>
        </div>
        <div class="mb-4">
            <x-input-label :value="__('How to Join')" />
            <div x-show="lang === 'en'">
                <x-text-input name="join_en" x-model="form.translations.en.join" />
                <x-input-error :messages="$errors->addActivity->get('join_en')" class="mt-2" />
            </div>
            <div x-show="lang === 'nl'">
                <x-text-input name="join_nl" x-model="form.translations.nl.join" />
                <x-input-error :messages="$errors->addActivity->get('join_nl')" class="mt-2" />
            </div>
        </div>
        <div class="mb-4">
            <x-input-label :value="__('Content')" />
            <div x-show="lang === 'en'">
                <x-text-area name="content_en" x-model="form.translations.en.content" />
                <x-input-error :messages="$errors->addActivity->get('content_en')" class="mt-2" />
            </div>
            <div x-show="lang === 'nl'">
                <x-text-area name="content_nl" x-model="form.translations.nl.content" />
                <x-input-error :messages="$errors->addActivity->get('content_nl')" class="mt-2" />
            </div>
        </div>
        <div class="flex justify-end">
            <x-secondary-button @click="$dispatch('close-modal', 'add-activity')"
                class="me-2">{{ __('Cancel') }}</x-secondary-button>
            <x-primary-button type="submit">{{ __('Add') }}</x-primary-button>
        </div>
    </form>
</x-modal>

<script>
function activityForm() {
	return {
		lang: 'en', // current visible language
		form: {
			translations: {
				en: { title: '', location: '', cost: '', join: '', content: '' },
				nl: { title: '', location: '', cost: '', join: '', content: '' },
			},
		},
	}
}
</script>
