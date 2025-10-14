<section>
    <header x-data class="flex justify-between items-center">
        <x-header size="xl">
            {{ __('Announcements') }}
        </x-header>

        <div class="flex items-center gap-3">
            <x-secondary-button x-show="expandedView !== 'announcements'" @click="expandedView = 'announcements'">{{ __('View All') }}</x-secondary-button>
            <x-secondary-button x-show="expandedView === 'announcements'" @click="expandedView = 'no'">{{ __('Back to Dashboard') }}</x-secondary-button>

            <x-secondary-button
                @click="$dispatch('open-modal', 'add-announcement')">{{ __('Add Announcement') }}</x-secondary-button>
        </div>
    </header>

    @forelse ($announcements as $index => $announcement)
        <div class="mb-2 flex justify-between items-center" x-show="expandedView === 'committees' || {{ $index }} < 5">
            <div>
                <div class="font-semibold flex-grow">{{ $announcement->title_en }}</div>
                <div>{{ $announcement->date->format('F j, Y') }}</div>
            </div>
            <div class="flex items-center gap-3">
                <x-secondary-button @click="">{{ __('Edit') }}</x-secondary-button>
                <form method="post" action="{{ route('announcement.destroy') }}">
                    @csrf
                    @method('delete')

                    <input type="hidden" name="announcement_id" value="{{ $announcement->id }}">
                    <x-secondary-button type="submit">{{ __('Delete') }}</x-secondary-button>
                </form>
            </div>
        </div>
    @empty
        <div class="text-gray-500">{{ __('No announcements yet.') }}</div>
    @endforelse
</section>

<x-modal name="add-announcement" :show="$errors->addAnnouncement->any()" maxWidth="lg">
    <form method="post" action="{{ route('announcement.create') }}" x-data="announcementForm()">
        @csrf
        @method('post')

        <x-header size="xl" class="flex md:gap-4 flex-col md:flex-row">
            <span class="flex-grow">{{ __('Add Announcement') }}</span>
            <x-language-switcher x-model="lang" />
        </x-header>

        <div class="flex md:gap-4 flex-col md:flex-row">
            <div class="mb-4 flex-grow">
                <x-input-label :value="__('Title')" />
                <div x-show="lang === 'en'">
                    <x-text-input name="title_en" x-model="form.translations.en.title" />
                    <x-input-error :messages="$errors->addAnnouncement->get('title_en')" class="mt-2" />
                </div>
                <div x-show="lang === 'nl'">
                    <x-text-input name="title_nl" x-model="form.translations.nl.title" />
                    <x-input-error :messages="$errors->addAnnouncement->get('title_nl')" class="mt-2" />
                </div>
            </div>
            <div class="mb-4 flex-grow">
                <x-input-label :value="__('Date')" />
                <x-text-input name="date" x-model="form.date" />
                <x-input-error :messages="$errors->addAnnouncement->get('date')" class="mt-2" />
            </div>
        </div>
        <div class="mb-4">
            <x-input-label :value="__('Content')" />
            <div x-show="lang === 'en'">
                <x-text-area name="content_en" x-model="form.translations.en.content" />
                <x-input-error :messages="$errors->addAnnouncement->get('content_en')" class="mt-2" />
            </div>
            <div x-show="lang === 'nl'">
                <x-text-area name="content_nl" x-model="form.translations.nl.content" />
                <x-input-error :messages="$errors->addAnnouncement->get('content_nl')" class="mt-2" />
            </div>
        </div>
        <div class="flex justify-end">
            <x-secondary-button @click="$dispatch('close-modal', 'add-announcement')"
                class="me-2">{{ __('Cancel') }}</x-secondary-button>
            <x-primary-button type="submit">{{ __('Add') }}</x-primary-button>
        </div>
    </form>
</x-modal>

<script>
    function announcementForm() {
        return {
            lang: 'en', // current visible language
            form: {
                translations: {
                    en: {
                        title: '',
                        content: ''
                    },
                    nl: {
                        title: '',
                        content: ''
                    },
                },
                date: '',
            },
        }
    }
</script>
