@props(['announcement' => null, 'formId' => 'announcement-form'])

<form method="POST" id="{{ $formId }}"
    :action="form.id ? '{{ route('announcement.update', '_ID_') }}'.replace('_ID_', form.id) :
        '{{ route('announcement.store') }}'"
    x-data="announcementForm({
        initialAnnouncement: @js($announcement),
        formId: '{{ $formId }}'
    })">
    @csrf
    <input type="hidden" name="_method" :value="form.id ? 'PUT' : 'POST'">
    <input type="hidden" name="form_id" :value="formId">

    <x-header size="xl" class="flex md:gap-4 flex-col md:flex-row">
        <span class="flex-grow">{{ $announcement ? __('Edit Announcement') : __('Add Announcement') }}</span>
        <x-language-switcher x-model="lang" />
    </x-header>

    <!-- Title & Date -->
    <div class="flex md:gap-4 flex-col md:flex-row">
        <div class="mb-2 flex-grow">
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
        <div class="mb-2 flex-grow">
            <x-input-label for="{{ $formId }}_date" :value="__('Date')" />
            <x-input-text id="{{ $formId }}_date" name="date" placeholder="25-07-2025 14:30"
                x-model="form.date" />

            {{-- <x-input-datetime id="{{ $formId }}_date" name="date" x-model="form.date" /> --}}
            <x-input-error :messages="$errors->getBag($formId)->get('date') ?? $errors->get('date')" class="mt-2" />
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
            {{ $announcement ? __('Update') : __('Add') }}
        </x-button-primary>
    </div>
</form>

<script>
    function announcementForm(config = {}) {
        return {
            lang: 'en',
            formId: config.formId || 'announcement-form',
            form: {
                id: null,
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
                    }
                },
                date: '',
                duration: ''
            },

            init() {
                if (config.initialAnnouncement) {
                    this.load(config.initialAnnouncement);
                }
            },

            load(data) {
                if (!data) return;

                // Format date for display
                const d = data.date ? new Date(data.date) : new Date();
                const pad = n => n.toString().padStart(2, '0');
                const formattedDate = `${pad(d.getDate())}-${pad(d.getMonth()+1)}-${d.getFullYear()}`;

                // Set form data
                this.form.id = data.id;
                this.form.date = formattedDate;

                // Set translations
                ['en', 'nl'].forEach(lang => {
                    this.form.translations[lang] = {
                        title: data[`title_${lang}`] || '',
                        content: data[`content_${lang}`] || ''
                    };
                });
            },
        };
    }
</script>
