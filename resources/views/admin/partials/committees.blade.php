<section>
    <header x-data class="flex justify-between items-center">
        <x-header size="xl">
            {{ __('Committees') }}
        </x-header>

        <div class="flex items-center gap-3">
            <x-secondary-button x-show="expandedView !== 'committees'" @click="expandedView = 'committees'">{{ __('View All') }}</x-secondary-button>
            <x-secondary-button x-show="expandedView === 'committees'" @click="expandedView = 'no'">{{ __('Back to Dashboard') }}</x-secondary-button>

            <x-secondary-button
                @click="$dispatch('open-modal', 'add-committee')">{{ __('Add Committee') }}</x-secondary-button>
        </div>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div>
            <x-header size="lg">
                {{ __('General Committees') }}
            </x-header>
            @forelse ($general_committees as $index => $committee)
                <div class="mb-2 flex justify-between items-center" x-show="expandedView === 'committees' || {{ $index }} < 5">
                    <div class="font-semibold mr-6 text-nowrap overflow-hidden text-clip">
                        {{ App::isLocale('nl') ? $committee->title_nl : $committee->title_en }}
                    </div>
                    <div class="flex items-center gap-3">
                        <x-secondary-button @click="">{{ __('Edit') }}</x-secondary-button>
                        <form class="ml-auto" method="post" action="{{ route('committee.destroy') }}">
                            @csrf
                            @method('delete')

                            <input type="hidden" name="committee_id" value="{{ $committee->id }}">
                            <x-secondary-button type="submit">{{ __('Delete') }}</x-secondary-button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-gray-500">{{ __('No committees yet.') }}</div>
            @endforelse
        </div>
        <div>
            <x-header size="lg">
                {{ __('Non-General Committees') }}
            </x-header>
            @forelse ($non_general_committees as $index => $committee)
                <div class="mb-2 flex justify-between items-center" x-show="expandedView === 'committees' || {{ $index }} < 5">
                    <div class="font-semibold mr-6 text-nowrap overflow-hidden text-clip">
                        {{ App::isLocale('nl') ? $committee->title_nl : $committee->title_en }}
                    </div>
                    <div class="flex items-center gap-3">
                        <x-secondary-button @click="">{{ __('Edit') }}</x-secondary-button>
                        <form class="ml-auto" method="post" action="{{ route('committee.destroy') }}">
                            @csrf
                            @method('delete')

                            <input type="hidden" name="committee_id" value="{{ $committee->id }}">
                            <x-secondary-button type="submit">{{ __('Delete') }}</x-secondary-button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-gray-500">{{ __('No committees yet.') }}</div>
            @endforelse
        </div>
    </div>
</section>

<x-modal name="add-committee" :show="$errors->addCommittee->any()" maxWidth="lg">
    <form method="post" action="{{ route('committee.create') }}" x-data="committeeForm()">
        @csrf
        @method('post')

        <x-header size="xl" class="flex md:gap-4 flex-col md:flex-row">
            <span class="flex-grow">{{ __('Add Committee') }}</span>
            <x-language-switcher x-model="lang" />
        </x-header>

        <div class="mb-4">
            <x-input-label :value="__('Title')" />
            <div x-show="lang === 'en'">
                <x-text-input name="title_en" x-model="form.translations.en.title" />
                <x-input-error :messages="$errors->addCommittee->get('title_en')" class="mt-2" />
            </div>
            <div x-show="lang === 'nl'">
                <x-text-input name="title_nl" x-model="form.translations.nl.title" />
                <x-input-error :messages="$errors->addCommittee->get('title_nl')" class="mt-2" />
            </div>
        </div>
        <div class="mb-4">
            <x-input-label :value="__('Content')" />
            <div x-show="lang === 'en'">
                <x-text-area name="description_en" x-model="form.translations.en.description" />
                <x-input-error :messages="$errors->addCommittee->get('description_en')" class="mt-2" />
            </div>
            <div x-show="lang === 'nl'">
                <x-text-area name="description_nl" x-model="form.translations.nl.description" />
                <x-input-error :messages="$errors->addCommittee->get('description_nl')" class="mt-2" />
            </div>
        </div>
        <div class="mb-4 flex items-center gap-2">
            <x-input-label :value="__('Is General Committee')" />
            <x-checkbox-input name="is_general" x-model="form.is_general" />
            <x-input-error :messages="$errors->addCommittee->get('is_general')" class="mt-2" />
        </div>
        <div class="flex justify-end">
            <x-secondary-button @click="$dispatch('close-modal', 'add-committee')"
                class="me-2">{{ __('Cancel') }}</x-secondary-button>
            <x-primary-button type="submit">{{ __('Add') }}</x-primary-button>
        </div>
    </form>
</x-modal>

<script>
    function committeeForm() {
        return {
            lang: 'en', // current visible language
            form: {
                translations: {
                    en: {
                        title: '',
                        description: '',
                    },
                    nl: {
                        title: '',
                        description: '',
                    },
                },
                is_general: false,
            },
        }
    }
</script>
