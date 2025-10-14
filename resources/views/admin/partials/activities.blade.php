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

        <div class="flex items-center gap-3">
            <x-secondary-button x-show="expandedView !== 'activities'" @click="expandedView = 'activities'">{{ __('View All') }}</x-secondary-button>
            <x-secondary-button x-show="expandedView === 'activities'" @click="expandedView = 'no'">{{ __('Back to Dashboard') }}</x-secondary-button>
            <x-secondary-button
                @click="$dispatch('open-modal', 'add-activity')">{{ __('Add Activity') }}</x-secondary-button>
        </div>
    </header>

    @forelse ($activities as $index => $activity)
        <div class="mb-2 flex justify-between items-center" x-show="expandedView === 'committees' || {{ $index }} < 5">
            <div>
                <div class="font-semibold flex-grow">{{ $activity->title_en }}</div>
                <div>{{ $activity->date->format('F j, Y') }}</div>
            </div>
            <div class="flex items-center gap-3">
                <x-secondary-button @click="">{{ __('Edit') }}</x-secondary-button>
                <form method="post" action="{{ route('activity.destroy') }}">
                    @csrf
                    @method('delete')

                    <input type="hidden" name="activity_id" value="{{ $activity->id }}">
                    <x-secondary-button type="submit">{{ __('Delete') }}</x-secondary-button>
                </form>
            </div>
        </div>
    @empty
        <div class="text-gray-500">{{ __('No activities yet.') }}</div>
    @endforelse
</section>

<x-modal name="add-activity" :show="$errors->addActivity->any()" maxWidth="lg">
    <form method="post" action="{{ route('activity.create') }}" x-data="activityForm()">
        @csrf
        @method('post')

        <x-header size="xl" class="flex md:gap-4 flex-col md:flex-row">
            <span class="flex-grow">{{ __('Add Activity') }}</span>
            <x-language-switcher x-model="lang" />
        </x-header>

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
                <x-text-input name="date" x-model="form.date" />
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
                    en: {
                        title: '',
                        location: '',
                        cost: '',
                        join: '',
                        content: ''
                    },
                    nl: {
                        title: '',
                        location: '',
                        cost: '',
                        join: '',
                        content: ''
                    },
                },
                date: '',
            },
        }
    }
</script>
