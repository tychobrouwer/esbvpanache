@props(['board' => null, 'formId' => 'board-form'])

<form method="POST" id="{{ $formId }}"
    :action="form.id ? '{{ route('board.update', '_ID_') }}'.replace('_ID_', form.id) :
        '{{ route('board.store') }}'"
    x-data="boardForm({
        initialBoard: @js($board ? $board : session()->getOldInput()),
        formId: '{{ $formId }}'
    })">
    @csrf
    <input type="hidden" name="_method" :value="form.id ? 'PUT' : 'POST'">
    <input type="hidden" name="form_id" :value="formId">

    <x-header size="xl" class="flex md:gap-4 flex-col md:flex-row">
        <span class="flex-grow">{{ $board ? __('Edit Board') : __('Add Board') }}</span>
        <x-language-switcher x-model="lang" />
    </x-header>

    <!-- Year -->
    <div class="mb-2">
        <x-input-label :value="__('Year')" />
        <x-input-text name="year" x-model="form.year" />
        <x-input-error :messages="$errors->getBag($formId)->get('year') ?? $errors->get('year')" class="mt-2" />
    </div>

    <!-- Members -->
    <div class="flex md:gap-4 flex-col md:flex-row">
        <div class="mb-2 flex-grow">
            <x-input-label for="{{ $formId }}_chairperson" :value="__('Chairperson')" />
            <x-input-text id="{{ $formId }}_chairperson" name="chairperson" x-model="form.chairperson" />
            <x-input-error :messages="$errors->getBag($formId)->get('chairperson') ?? $errors->get('chairperson')" class="mt-2" />
        </div>
        <div class="mb-2 flex-grow">
            <x-input-label for="{{ $formId }}_vice_chairperson" :value="__('Vice-chairperson')" />
            <x-input-text id="{{ $formId }}_vice_chairperson" name="vice_chairperson" x-model="form.vice_chairperson" />
            <x-input-error :messages="$errors->getBag($formId)->get('vice_chairperson') ?? $errors->get('vice_chairperson')" class="mt-2" />
        </div>
    </div>

    <div class="flex md:gap-4 flex-col md:flex-row">
        <div class="mb-2 flex-grow">
            <x-input-label for="{{ $formId }}_secretary" :value="__('Secretary')" />
            <x-input-text id="{{ $formId }}_secretary" name="secretary" x-model="form.secretary" />
            <x-input-error :messages="$errors->getBag($formId)->get('secretary') ?? $errors->get('secretary')" class="mt-2" />
        </div>
        <div class="mb-2 flex-grow">
            <x-input-label for="{{ $formId }}_treasurer" :value="__('Treasurer')" />
            <x-input-text id="{{ $formId }}_treasurer" name="treasurer" x-model="form.treasurer" />
            <x-input-error :messages="$errors->getBag($formId)->get('treasurer') ?? $errors->get('treasurer')" class="mt-2" />
        </div>
    </div>

    <!-- Slogan -->
    <div class="mb-2">
        <x-input-label for="{{ $formId }}_slogan" :value="__('Slogan')" />
        <x-input-text id="{{ $formId }}_slogan" name="slogan" x-model="form.slogan" />
        <x-input-error :messages="$errors->getBag($formId)->get('slogan') ?? $errors->get('slogan')" class="mt-2" />
    </div>

    <!-- Message -->
    <div class="mb-2">
        <div x-show="lang === 'en'">
            <x-input-label for="{{ $formId }}_message_en" :value="__('Message') . ' (EN)'" />
            <x-input-text-area id="{{ $formId }}_message_en" name="message_en" x-model="form.translations.en.message" />
            <x-input-error :messages="$errors->getBag($formId)->get('message_en') ?? $errors->get('message_en')" class="mt-2" />
        </div>
        <div x-show="lang === 'nl'">
            <x-input-label for="{{ $formId }}_message_nl" :value="__('Message') . ' (NL)'" />
            <x-input-text-area id="{{ $formId }}_message_nl" name="message_nl" x-model="form.translations.nl.message" />
            <x-input-error :messages="$errors->getBag($formId)->get('message_nl') ?? $errors->get('message_nl')" class="mt-2" />
        </div>
    </div>

    <div class="flex justify-end">
        <x-button-secondary @click="$dispatch('close-modal', formId)" class="me-3">
            {{ __('Cancel') }}
        </x-button-secondary>
        <x-button-primary type="submit">
            {{ $board ? __('Update') : __('Add') }}
        </x-button-primary>
    </div>
</form>

<script>
    function boardForm(config = {}) {
        return {
            lang: 'en',
            formId: config.formId || 'board-form',
            form: {
                id: null,
                year: '',
                chairperson: '',
                vice_chairperson: '',
                secretary: '',
                treasurer: '',
                slogan: '',
                translations: {
                    en: { message: '' },
                    nl: { message: '' },
                },
            },

            init() {
                if (config.initialBoard) {
                    this.load(config.initialBoard);
                }
            },

            load(data) {
                if (!data) return;

                // Set form data
                this.form.id = data.id;
                this.form.year = data.year;
                this.form.chairperson = data.chairperson;
                this.form.vice_chairperson = data.vice_chairperson;
                this.form.secretary = data.secretary;
                this.form.treasurer = data.treasurer;
                this.form.slogan = data.slogan;
                this.form.date = data.date;

                // Set translations
                ['en', 'nl'].forEach(lang => {
                    this.form.translations[lang] = {
                        message: data[`message_${lang}`] || ''
                    };
                });
            },
        };
    }
</script>
