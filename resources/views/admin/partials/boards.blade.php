<?php
function boardString($board) {
    return
        current(explode(" ", $board->chairperson)) . ", " .
        current(explode(" ", $board->vice_chairperson)) . ", " .
        current(explode(" ", $board->secretary)) . ", " .
        current(explode(" ", $board->treasurer));
}

function ordinal($number) {
    $ends = array('th','st','nd','rd','th','th','th','th','th','th');
    if ((($number % 100) >= 11) && (($number%100) <= 13))
        return $number. 'th';
    else
        return $number. $ends[$number % 10];
}
?>

<section x-cloak>
    <header x-data class="flex justify-between items-center">
        <x-header size="xl">
            {{ __('Boards') }}
        </x-header>

        <div class="flex items-center gap-3">
            <x-secondary-button x-show="expandedView !== 'boards'" @click="expandedView = 'boards'">{{ __('View All') }}</x-secondary-button>
            <x-secondary-button x-show="expandedView === 'boards'" @click="expandedView = 'no'">{{ __('Back to Dashboard') }}</x-secondary-button>

            <x-secondary-button
                @click="$dispatch('reset'); $dispatch('open-modal', 'board-form')">{{ __('Add Board') }}</x-secondary-button>
        </div>
    </header>

    @forelse ($boards as $index => $board)
        <div class="mb-2 flex justify-between items-center" x-show="expandedView === 'boards' || {{ $index }} < 5">
            <div>
                <div class="font-semibold flex-grow">{{ boardString($board) }}</div>
                <div>{{ $board->year + 1962 }}-{{ $board->year + 1963 }}, {{ ordinal($board->year) }}</div>
            </div>
            <div class="flex items-center gap-3">
                <x-secondary-button @click="$dispatch('load-data', {{ json_encode($board) }}); $dispatch('open-modal', 'board-form')" >{{ __('Edit') }}</x-secondary-button>
                <form method="post" action="{{ route('board.destroy') }}">
                    @csrf
                    @method('delete')

                    <input type="hidden" name="board_id" value="{{ $board->id }}">
                    <x-danger-button type="submit">{{ __('Delete') }}</x-danger-button>
                </form>
            </div>
        </div>
    @empty
        <div class="text-gray-500">{{ __('No boards yet.') }}</div>
    @endforelse
</section>

<x-modal name="board-form" :show="$errors->board->any()" maxWidth="lg">
    <form method="post" :action="form.id ? '{{ route('board.update') }}' : '{{ route('board.create') }}'" x-data="boardForm()" @reset.window="reset()" @load-data.window="load($event.detail)">
        @csrf
        <input type="hidden" name="_method" :value="form.id ? 'PATCH' : 'POST'">
        <input type="hidden" name="id" x-model="form.id" x-show="form.id">

        <x-header size="xl" class="flex md:gap-4 flex-col md:flex-row">
            <span class="flex-grow">{{ __('Add Board') }}</span>
            <x-language-switcher x-model="lang" />
        </x-header>

        <div class="mb-4">
            <x-input-label :value="__('Year')" />
            <x-text-input name="year" x-model="form.year" />
            <x-input-error :messages="$errors->board->get('year')" class="mt-2" />
        </div>
        <div class="flex md:gap-4 flex-col md:flex-row">
            <div class="mb-4 flex-grow">
                <x-input-label :value="__('Chairperson')" />
                <x-text-input name="chairperson" x-model="form.chairperson" />
                <x-input-error :messages="$errors->board->get('chairperson')" class="mt-2" />
            </div>
            <div class="mb-4 flex-grow">
                <x-input-label :value="__('Vice-chairperson')" />
                <x-text-input name="vice_chairperson" x-model="form.vice_chairperson" />
                <x-input-error :messages="$errors->board->get('vice_chairperson')" class="mt-2" />
            </div>
        </div>
        <div class="flex md:gap-4 flex-col md:flex-row">
            <div class="mb-4 flex-grow">
                <x-input-label :value="__('Secretary')" />
                <x-text-input name="secretary" x-model="form.secretary" />
                <x-input-error :messages="$errors->board->get('secretary')" class="mt-2" />
            </div>
            <div class="mb-4 flex-grow">
                <x-input-label :value="__('Treasurer')" />
                <x-text-input name="treasurer" x-model="form.treasurer" />
                <x-input-error :messages="$errors->board->get('treasurer')" class="mt-2" />
            </div>
        </div>
        <div class="mb-4">
            <x-input-label :value="__('Slogan')" />
            <x-text-input name="slogan" x-model="form.slogan" />
            <x-input-error :messages="$errors->board->get('slogan')" class="mt-2" />
        </div>
        <div class="mb-4">
            <div x-show="lang === 'en'">
                <x-input-label for="message_en" :value="__('Message (EN)')" />
                <x-text-area name="message_en" x-model="form.translations.en.message" />
                <x-input-error :messages="$errors->board->get('message_en')" class="mt-2" />
            </div>
            <div x-show="lang === 'nl'">
                <x-input-label for="message_nl" :value="__('Message (NL)')" />
                <x-text-area name="message_nl" x-model="form.translations.nl.message" />
                <x-input-error :messages="$errors->board->get('message_nl')" class="mt-2" />
            </div>
        </div>
        <div class="flex justify-end">
            <x-secondary-button @click="$dispatch('close-modal', 'board-form')"
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
    function boardForm() {
        return {
            lang: 'en',
            form: {
                translations: {
                    en: { message: '' },
                    nl: { message: '' },
                },
                year: null,
                chairperson: '',
                vice_chairperson: '',
                secretary: '',
                treasurer: '',
                slogan: '',
                id: null,
            },
            load(data) {
                this.form.id = data.id;
                this.form.year = data.year;
                this.form.chairperson = data.chairperson;
                this.form.vice_chairperson = data.vice_chairperson;
                this.form.secretary = data.secretary;
                this.form.treasurer = data.treasurer;
                this.form.slogan = data.slogan;
                this.form.translations.en.message = data.message_en;
                this.form.translations.nl.message = data.message_nl;
            },
            reset() {
                Object.assign(this.form, {
                    translations: {
                        en: { message: '' },
                        nl: { message: '' },
                    },
                    year: null,
                    chairperson: '',
                    vice_chairperson: '',
                    secretary: '',
                    treasurer: '',
                    slogan: '',
                    id: null,
                });
            }
        }
    }
</script>
