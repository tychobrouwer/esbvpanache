<section>
    <header x-data class="flex justify-between items-center">
        <x-header size="xl">
            {{ __('Announcements') }}
        </x-header>

        <div class="flex items-center gap-3">
            <x-secondary-button x-show="expandedView !== 'announcements'" @click="expandedView = 'announcements'">{{ __('View All') }}</x-secondary-button>
            <x-secondary-button x-show="expandedView === 'announcements'" @click="expandedView = 'no'">{{ __('Back to Dashboard') }}</x-secondary-button>

            <x-secondary-button
                @click="$dispatch('reset'); $dispatch('open-modal', 'announcement-form'); $dispatch('update-textarea')">{{ __('Add Announcement') }}</x-secondary-button>
        </div>
    </header>

    @forelse ($announcements as $index => $announcement)
        <div class="mb-2 flex justify-between items-center" x-show="expandedView === 'committees' || {{ $index }} < 5">
            <div>
                <div class="font-semibold flex-grow">{{ $announcement->title_en }}</div>
                <div>{{ $announcement->date->format('F j, Y') }}</div>
            </div>
            <div class="flex items-center gap-3">
                <x-secondary-button @click="$dispatch('load-data', {{ json_encode($announcement) }}); $dispatch('open-modal', 'announcement-form'); $dispatch('update-textarea')" >{{ __('Edit') }}</x-secondary-button>
                <form method="post" action="{{ route('announcement.destroy') }}">
                    @csrf
                    @method('delete')

                    <input type="hidden" name="announcement_id" value="{{ $announcement->id }}">
                    <x-danger-button type="submit">{{ __('Delete') }}</x-danger-button>
                </form>
            </div>
        </div>
    @empty
        <div class="text-gray-500">{{ __('No announcements yet.') }}</div>
    @endforelse
</section>

<x-modal name="announcement-form" :show="$errors->announcement->any()" maxWidth="lg">
    <form method="post" :action="form.id ? '{{ route('announcement.update') }}' : '{{ route('announcement.create') }}'" x-data="announcementForm()" @reset.window="reset()" @load-data.window="load($event.detail)">
        @csrf
        <input type="hidden" name="_method" :value="form.id ? 'PATCH' : 'POST'">
        <input type="hidden" name="id" x-model="form.id" x-show="form.id">

        <x-header size="xl" class="flex md:gap-4 flex-col md:flex-row">
            <span class="flex-grow">{{ __('Add Announcement') }}</span>
            <x-language-switcher x-model="lang" />
        </x-header>

        <div class="flex md:gap-4 flex-col md:flex-row">
            <div class="mb-4 flex-grow">
                <x-input-label :value="__('Title')" />
                <div x-show="lang === 'en'">
                    <x-text-input name="title_en" x-model="form.translations.en.title" />
                    <x-input-error :messages="$errors->announcement->get('title_en')" class="mt-2" />
                </div>
                <div x-show="lang === 'nl'">
                    <x-text-input name="title_nl" x-model="form.translations.nl.title" />
                    <x-input-error :messages="$errors->announcement->get('title_nl')" class="mt-2" />
                </div>
            </div>
            <div class="mb-4 flex-grow">
                <x-input-label :value="__('Date')" />
                <x-text-input name="date" placeholder="25-7-2025" x-model="form.date" />
                <x-input-error :messages="$errors->announcement->get('date')" />
            </div>
        </div>
        <div class="mb-4">
            <x-input-label :value="__('Content')" />
            <div x-show="lang === 'en'">
                <x-text-area name="content_en" x-model="form.translations.en.content" />
                <x-input-error :messages="$errors->announcement->get('content_en')" class="mt-2" />
            </div>
            <div x-show="lang === 'nl'">
                <x-text-area name="content_nl" x-model="form.translations.nl.content" />
                <x-input-error :messages="$errors->announcement->get('content_nl')" class="mt-2" />
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
    function announcementForm() {
        return {
            lang: 'en', // current visible language
            form: {
                translations: {
                    en: { title: '', content: '' },
                    nl: { title: '', content: '' },
                },
                date: '',
                id: null,
            },
            load(data) {
                var d = new Date(data.date);
                var datestring = d.getDate()  + "-" + (d.getMonth()+1) + "-" + d.getFullYear();

                this.form.id = data.id;
                this.form.translations.en.title = data.title_en || '';
                this.form.translations.en.content = data.content_en || '';
                this.form.translations.nl.title = data.title_nl || '';
                this.form.translations.nl.content = data.content_nl || '';
                this.form.date = datestring;
            },
            reset() {
                this.form.id = null;
                this.form.translations.en.title = '';
                this.form.translations.en.content = '';
                this.form.translations.nl.title = '';
                this.form.translations.nl.content = '';
                this.form.date = '';
            }
        }
    }
</script>
