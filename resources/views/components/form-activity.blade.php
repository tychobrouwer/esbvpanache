@props(['activity' => null, 'formId' => 'activity-form'])

<form method="POST" id="{{ $formId }}"
    :action="form.id ? '{{ route('activity.update', '_ID_') }}'.replace('_ID_', form.id) : '{{ route('activity.store') }}'"
    x-data="activityForm({
        initialActivity: @js($activity ? $activity : session()->getOldInput()),
        formId: '{{ $formId }}'
    })">
    @csrf
    <input type="hidden" name="_method" :value="form.id ? 'PUT' : 'POST'">
    <input type="hidden" name="form_id" :value="formId">

    <x-header size="xl" class="flex md:gap-4 flex-col md:flex-row">
        <span class="flex-grow">{{ $activity ? __('Edit Activity') : __('Add Activity') }}</span>
        <x-language-switcher x-model="lang" />
    </x-header>

    <!-- Title -->
    <div class="mb-2">
        <div x-show="lang === 'en'">
            <x-input-label for="{{ $formId }}_title_en" :value="__('Title (EN)')" />
            <x-input-text id="{{ $formId }}_title_en" name="title_en" x-model="form.translations.en.title" />
            <x-input-error :messages="$errors->getBag($formId)->get('title_en') ?? $errors->get('title_en')" class="mt-2" />
        </div>
        <div x-show="lang === 'nl'">
            <x-input-label for="{{ $formId }}_title_nl" :value="__('Title (NL)')" />
            <x-input-text id="{{ $formId }}_title_nl" name="title_nl" x-model="form.translations.nl.title" />
            <x-input-error :messages="$errors->getBag($formId)->get('title_nl') ?? $errors->get('title_nl')" class="mt-2" />
        </div>
    </div>

    <!-- Date & Duration -->
    <div class="flex md:gap-4 flex-col md:flex-row">
        <div class="mb-2 flex-grow">
            <x-input-label for="{{ $formId }}_date" :value="__('Date & Time')" />
            {{-- <x-input-text id="{{ $formId }}_date" name="date" placeholder="25-07-2025 14:30" x-model="form.date" /> --}}

            <x-input-datetime id="{{ $formId }}_date" name="date" x-model="form.date" />
            <x-input-error :messages="$errors->getBag($formId)->get('date') ?? $errors->get('date')" class="mt-2" />
        </div>
        <div class="mb-2 flex-grow">
            <x-input-label for="{{ $formId }}_duration" :value="__('Duration (hours, optional)')" />
            <x-input-text id="{{ $formId }}_duration" name="duration" placeholder="1.5"
                x-model="form.duration" />
            <x-input-error :messages="$errors->getBag($formId)->get('duration') ?? $errors->get('duration')" class="mt-2" />
        </div>
    </div>

    <!-- Location & Cost -->
    <div class="flex md:gap-4 flex-col md:flex-row">
        <div class="mb-2 flex-grow">
            <div x-show="lang === 'en'">
                <x-input-label for="{{ $formId }}_location_en" :value="__('Location (EN)')" />
                <x-input-text id="{{ $formId }}_location_en" name="location_en"
                    x-model="form.translations.en.location" />
                <x-input-error :messages="$errors->getBag($formId)->get('location_en') ?? $errors->get('location_en')" class="mt-2" />
            </div>
            <div x-show="lang === 'nl'">
                <x-input-label for="{{ $formId }}_location_nl" :value="__('Location (NL)')" />
                <x-input-text id="{{ $formId }}_location_nl" name="location_nl"
                    x-model="form.translations.nl.location" />
                <x-input-error :messages="$errors->getBag($formId)->get('location_nl') ?? $errors->get('location_nl')" class="mt-2" />
            </div>
        </div>
        <div class="mb-2 flex-grow">
            <div x-show="lang === 'en'">
                <x-input-label for="{{ $formId }}_cost_en" :value="__('Cost (EN)')" />
                <x-input-text id="{{ $formId }}_cost_en" name="cost_en" x-model="form.translations.en.cost" />
                <x-input-error :messages="$errors->getBag($formId)->get('cost_en') ?? $errors->get('cost_en')" class="mt-2" />
            </div>
            <div x-show="lang === 'nl'">
                <x-input-label for="{{ $formId }}_cost_nl" :value="__('Cost (NL)')" />
                <x-input-text id="{{ $formId }}_cost_nl" name="cost_nl" x-model="form.translations.nl.cost" />
                <x-input-error :messages="$errors->getBag($formId)->get('cost_nl') ?? $errors->get('cost_nl')" class="mt-2" />
            </div>
        </div>
    </div>

    <!-- Join Info -->
    <div class="mb-2">
        <div x-show="lang === 'en'">
            <x-input-label for="{{ $formId }}_join_en" :value="__('How to Join (EN)')" />
            <x-input-text id="{{ $formId }}_join_en" name="join_en" x-model="form.translations.en.join" />
            <x-input-error :messages="$errors->getBag($formId)->get('join_en') ?? $errors->get('join_en')" class="mt-2" />
        </div>
        <div x-show="lang === 'nl'">
            <x-input-label for="{{ $formId }}_join_nl" :value="__('How to Join (NL)')" />
            <x-input-text id="{{ $formId }}_join_nl" name="join_nl" x-model="form.translations.nl.join" />
            <x-input-error :messages="$errors->getBag($formId)->get('join_nl') ?? $errors->get('join_nl')" class="mt-2" />
        </div>
    </div>

    <!-- Content -->
    <div class="mb-2">
        <div x-show="lang === 'en'">
            <x-input-label for="{{ $formId }}_content_en" :value="__('Content (EN)')" />
            <x-input-text-area id="{{ $formId }}_content_en" name="content_en"
                x-model="form.translations.en.content" />
            <x-input-error :messages="$errors->getBag($formId)->get('content_en') ?? $errors->get('content_en')" class="mt-2" />
        </div>
        <div x-show="lang === 'nl'">
            <x-input-label for="{{ $formId }}_content_nl" :value="__('Content (NL)')" />
            <x-input-text-area id="{{ $formId }}_content_nl" name="content_nl"
                x-model="form.translations.nl.content" />
            <x-input-error :messages="$errors->getBag($formId)->get('content_nl') ?? $errors->get('content_nl')" class="mt-2" />
        </div>
    </div>

    <div class="flex justify-end">
        <x-button-secondary @click="$dispatch('close-modal', '{{ $formId }}')" class="me-3">
            {{ __('Cancel') }}
        </x-button-secondary>
        <x-button-primary type="submit">
            {{ $activity ? __('Update') : __('Add') }}
        </x-button-primary>
    </div>
</form>

<script>
    function activityForm(config = {}) {
        return {
            lang: 'en',
            formId: config.formId || 'activity-form',
            form: {
                id: null,
                translations: {
                    en: { title: '', location: '', cost: '', join: '', content: '' },
                    nl: { title: '', location: '', cost: '', join: '', content: '' }
                },
                date: '',
                duration: ''
            },

            init() {
                if (config.initialActivity) {
                    this.load(config.initialActivity);
                }
            },

            load(data) {
                if (!data) return;

                // Set form data
                this.form.id = data.id;
                this.form.date = data.date;
                this.form.duration = data.duration || '';

                // Set translations
                ['en', 'nl'].forEach(lang => {
                    this.form.translations[lang] = {
                        title: data[`title_${lang}`] || '',
                        location: data[`location_${lang}`] || '',
                        cost: data[`cost_${lang}`] || '',
                        join: data[`join_${lang}`] || '',
                        content: data[`content_${lang}`] || ''
                    };
                });
            },
        };
    }
</script>
