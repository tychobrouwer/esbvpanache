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
                @click="$dispatch('reset'); $dispatch('open-modal', 'announcement-form'); $dispatch('update-textarea')">{{ __('Add Activity') }}</x-secondary-button>
        </div>
    </header>

    @forelse ($activities as $index => $activity)
        <div class="mb-2 flex justify-between items-center" x-show="expandedView === 'committees' || {{ $index }} < 5">
            <div>
                <div class="font-semibold flex-grow">{{ $activity->title_en }}</div>
                <div>{{ $activity->date->format('F j, Y') }}</div>
            </div>
            <div class="flex items-center gap-3">
                <x-secondary-button @click="$dispatch('load-data', {{ json_encode($activity) }}); $dispatch('open-modal', 'activity-form'); $dispatch('update-textarea')" >{{ __('Edit') }}</x-secondary-button>
                <form method="post" action="{{ route('activity.destroy') }}">
                    @csrf
                    @method('delete')

                    <input type="hidden" name="activity_id" value="{{ $activity->id }}">
                    <x-danger-button type="submit">{{ __('Delete') }}</x-danger-button>
                </form>
            </div>
        </div>
    @empty
        <div class="text-gray-500">{{ __('No activities yet.') }}</div>
    @endforelse
</section>

<x-modal name="activity-form" :show="$errors->activity->any()" maxWidth="lg">
    <form method="post" :action="form.id ? '{{ route('activity.update') }}' : '{{ route('activity.create') }}'" x-data="activityForm()" @reset.window="reset()" @load-data.window="load($event.detail)">
        @csrf
        <input type="hidden" name="_method" :value="form.id ? 'PATCH' : 'POST'">
        <input type="hidden" name="id" x-model="form.id" x-show="form.id">

        <x-header size="xl" class="flex md:gap-4 flex-col md:flex-row">
            <span class="flex-grow">{{ __('Add Activity') }}</span>
            <x-language-switcher x-model="lang" />
        </x-header>

        <div class="flex md:gap-4 flex-col md:flex-row">
            <div class="mb-4 flex-grow">
                <x-input-label :value="__('Title')" />
                <div x-show="lang === 'en'">
                    <x-text-input name="title_en" x-model="form.translations.en.title" />
                    <x-input-error :messages="$errors->activity->get('title_en')" class="mt-2" />

                </div>
                <div x-show="lang === 'nl'">
                    <x-text-input name="title_nl" x-model="form.translations.nl.title" />
                    <x-input-error :messages="$errors->activity->get('title_nl')" class="mt-2" />
                </div>
            </div>
            <div class="mb-4 flex-grow">
                <x-input-label :value="__('Date')" />
                <x-text-input name="date" placeholder="25-7-2025 20:00" x-model="form.date" />
                <x-input-error :messages="$errors->activity->get('date')" class="mt-2" />
            </div>
        </div>
        <div class="flex md:gap-4 flex-col md:flex-row">
            <div class="mb-4 flex-grow">
                <x-input-label :value="__('Location')" />
                <div x-show="lang === 'en'">
                    <x-text-input name="location_en" x-model="form.translations.en.location" />
                    <x-input-error :messages="$errors->activity->get('location_en')" class="mt-2" />
                </div>
                <div x-show="lang === 'nl'">
                    <x-text-input name="location_nl" x-model="form.translations.nl.location" />
                    <x-input-error :messages="$errors->activity->get('location_nl')" class="mt-2" />
                </div>
            </div>
            <div class="mb-4 flex-grow">
                <x-input-label :value="__('Cost')" />
                <div x-show="lang === 'en'">
                    <x-text-input name="cost_en" x-model="form.translations.en.cost" />
                    <x-input-error :messages="$errors->activity->get('cost_en')" class="mt-2" />
                </div>
                <div x-show="lang === 'nl'">
                    <x-text-input name="cost_nl" x-model="form.translations.nl.cost" />
                    <x-input-error :messages="$errors->activity->get('cost_nl')" class="mt-2" />
                </div>
            </div>
        </div>
        <div class="mb-4">
            <x-input-label :value="__('How to Join')" />
            <div x-show="lang === 'en'">
                <x-text-input name="join_en" x-model="form.translations.en.join" />
                <x-input-error :messages="$errors->activity->get('join_en')" class="mt-2" />
            </div>
            <div x-show="lang === 'nl'">
                <x-text-input name="join_nl" x-model="form.translations.nl.join" />
                <x-input-error :messages="$errors->activity->get('join_nl')" class="mt-2" />
            </div>
        </div>
        <div class="mb-4">
            <x-input-label :value="__('Content')" />
            <div x-show="lang === 'en'">
                <x-text-area name="content_en" x-model="form.translations.en.content" />
                <x-input-error :messages="$errors->activity->get('content_en')" class="mt-2" />
            </div>
            <div x-show="lang === 'nl'">
                <x-text-area name="content_nl" x-model="form.translations.nl.content" />
                <x-input-error :messages="$errors->activity->get('content_nl')" class="mt-2" />
            </div>
        </div>
        <div class="flex justify-end">
            <x-secondary-button @click="$dispatch('close-modal', 'announcement-form')"
                class="me-3">{{ __('Cancel') }}</x-secondary-button>
            <x-primary-button type="submit">
                <p x-show="form.id">
                    {{ __('Update') }}
                </p >
                <p x-show="!form.id">
                    {{ __('Add') }}
                </p >
            </x-primary-button>
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
                date: '',
                id: null,
            },
            load(data) {
                var d = new Date(data.date);
                var datestring = d.getDate()  + "-" + (d.getMonth()+1) + "-" + d.getFullYear() + " " + d.getHours().toString().padStart(2, "0") + ":" + d.getMinutes().toString().padStart(2, "0");

                this.form.id = data.id;
                this.form.translations.en.title = data.title_en || '';
                this.form.translations.en.content = data.location_en || '';
                this.form.translations.en.content = data.cost_en || '';
                this.form.translations.en.content = data.join_en || '';
                this.form.translations.en.content = data.content_en || '';
                this.form.translations.nl.title = data.title_nl || '';
                this.form.translations.nl.content = data.location_nl || '';
                this.form.translations.nl.content = data.cost_nl || '';
                this.form.translations.nl.content = data.join_nl || '';
                this.form.translations.nl.content = data.content_nl || '';
                this.form.date = datestring;
            },
            reset() {
                this.form.id = null;
                this.form.translations.en.title = '';
                this.form.translations.en.content = '';
                this.form.translations.en.content = '';
                this.form.translations.en.content = '';
                this.form.translations.en.content = '';
                this.form.translations.nl.title = '';
                this.form.translations.nl.content = '';
                this.form.translations.nl.content = '';
                this.form.translations.nl.content = '';
                this.form.translations.nl.content = '';
                this.form.date = '';
            }
        }
    }
</script>
