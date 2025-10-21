<section x-cloak>
    <header class="mb-2 flex justify-between items-center">
        <x-header size="xl">
            {{ __('Announcements') }}
        </x-header>

        <div class="flex items-center gap-3">
            <x-button-secondary x-show="expandedView !== 'announcements'" @click="expandedView = 'announcements'">{{ __('View All') }}</x-button-secondary>
            <x-button-secondary x-show="expandedView === 'announcements'" @click="expandedView = 'no'">{{ __('Back to Dashboard') }}</x-button-secondary>

            <x-button-secondary @click="$dispatch('open-modal', 'new-announcement')">{{ __('Add') }}</x-button-secondary>
        </div>
    </header>

    @forelse ($announcements as $index => $announcement)
        <div class="mb-2 flex justify-between items-center" x-show="expandedView === 'announcements' || {{ $index }} < 3">
            <div class="inline-grid">
                <div class="font-semibold mr-3 text-nowrap overflow-hidden text-clip">{{ $announcement->title_en }}</div>
                <div>{{ $announcement->date->format('F j, Y') }}</div>
            </div>
            <div class="flex items-center gap-3">
                <x-button-secondary 
                    @click="$dispatch('open-modal', 'edit-announcement-{{ $announcement->id }}')"
                >
                    {{ __('Edit') }}
                </x-button-secondary>
                <form method="post" action="{{ route('announcement.destroy') }}">
                    @csrf
                    @method('delete')

                    <input type="hidden" name="announcement_id" value="{{ $announcement->id }}">
                    <x-button-danger type="submit">{{ __('Delete') }}</x-button-danger>
                </form>
            </div>
        </div>

        <x-modal name="edit-announcement-{{ $announcement->id }}" :show="$errors->getBag('edit-announcement-'. $announcement->id)->any()" maxWidth="lg">
            <x-form-announcement :announcement="$announcement" formId="edit-announcement-{{ $announcement->id }}" />
        </x-modal>

    @empty
        <div class="text-gray-500">{{ __('No announcements yet.') }}</div>
    @endforelse
</section>

<x-modal name="new-announcement" :show="$errors->getBag('new-announcement')->any()" maxWidth="lg">
    <x-form-announcement :announcement="null" formId="new-announcement" />
</x-modal>

{{-- <x-modal name="announcement-form" :show="$errors->announcementCreate->any() || $errors->announcementUpdate->any()" maxWidth="lg">
    <form method="post" :action="form.id ? '{{ route('announcement.update') }}' : '{{ route('announcement.create') }}'" x-data="announcementForm()" @reset.window="reset()" @load-data.window="load($event.detail)">
        @csrf
        <input type="hidden" name="_method" :value="form.id ? 'PATCH' : 'POST'">
        <input type="hidden" name="id" x-model="form.id" x-show="form.id">

        <x-header size="xl" class="flex md:gap-4 flex-col md:flex-row">
            <span class="flex-grow">{{ __('Add Announcement') }}</span>
            <x-language-switcher x-model="lang" />
        </x-header>

        <div class="flex md:gap-4 flex-col md:flex-row">
            <div class="mb-2 flex-grow">
                <div x-show="lang === 'en'">
                    <x-input-label for="announcement_title_en" :value="__('Title') . ' (EN)'" />
                    <x-input-text id="announcement_title_en" name="title_en" x-model="form.translations.en.title" />
                    <x-input-error x-show="!form.id" :messages="$errors->announcementCreate->get('title_en')" class="mt-2" />
                    <x-input-error x-show="form.id" :messages="$errors->announcementUpdate->get('title_en')" class="mt-2" />
                </div>
                <div x-show="lang === 'nl'">
                    <x-input-label for="announcement_title_nl" :value="__('Title') . ' (NL)'" />
                    <x-input-text id="announcement_title_nl" name="title_nl" x-model="form.translations.nl.title" />
                    <x-input-error x-show="!form.id" :messages="$errors->announcementCreate->get('title_nl')" class="mt-2" />
                    <x-input-error x-show="form.id" :messages="$errors->announcementUpdate->get('title_nl')" class="mt-2" />
                </div>
            </div>
            <div class="mb-2 flex-grow">
                <x-input-label for="announcement_date" :value="__('Date')" />
                <x-input-datetime id="announcement_date" name="date" x-model="form.date" />
                <x-input-text id="announcement_date" name="date" placeholder="25-7-2025" x-model="form.date" />
                <x-input-error x-show="!form.id" :messages="$errors->announcementCreate->get('date')" />
                <x-input-error x-show="form.id" :messages="$errors->announcementUpdate->get('date')" />
            </div>
        </div>
        <div class="mb-2">
            <div x-show="lang === 'en'">
                <x-input-label for="announcement_content_en" :value="__('Content') . ' (EN)'" />
                <x-input-text-area id="announcement_content_en" name="content_en" x-model="form.translations.en.content" />
                <x-input-error x-show="!form.id" :messages="$errors->announcementCreate->get('content_en')" class="mt-2" />
                <x-input-error x-show="form.id" :messages="$errors->announcementUpdate->get('content_en')" class="mt-2" />
            </div>
            <div x-show="lang === 'nl'">
                <x-input-label for="announcement_content_nl" :value="__('Content') . ' (NL)'" />
                <x-input-text-area id="announcement_content_nl" name="content_nl" x-model="form.translations.nl.content" />
                <x-input-error x-show="!form.id" :messages="$errors->announcementCreate->get('content_nl')" class="mt-2" />
                <x-input-error x-show="form.id" :messages="$errors->announcementUpdate->get('content_nl')" class="mt-2" />
            </div>
        </div>

        <div class="flex justify-end">
            <x-button-secondary @click="$dispatch('close-modal', 'announcement-form')"
                class="me-3">{{ __('Cancel') }}</x-button-secondary>
            <x-button-primary type="submit">
                <p x-show="form.id">
                    {{ __('Update') }}
                </p >
                <p x-show="!form.id">
                    {{ __('Add') }}
                </p >
            </x-button-primary>
        </div>
    </form>
</x-modal>

<script>
    function announcementForm() {
        return {
            lang: 'en',
            form: {
                translations: {
                    en: { 
                        title: @json(old('title_en', '')), 
                        content: @json(old('content_en', ''))
                    },
                    nl: { 
                        title: @json(old('title_nl', '')), 
                        content: @json(old('content_nl', ''))
                    },
                },
                date: @json(old('date', '')),
                id: @json(old('id')),
            },
            load(data) {
                var d = new Date(data.date);

                function pad(n) {
                    return n.toString().padStart(2, "0");
                }

                var datestring = pad(d.getDate())  + "-" + pad(d.getMonth()+1) + "-" + d.getFullYear();

                this.form.id = data.id;
                this.form.translations.en.title = data.title_en || '';
                this.form.translations.en.content = data.content_en || '';
                this.form.translations.nl.title = data.title_nl || '';
                this.form.translations.nl.content = data.content_nl || '';
                this.form.date = datestring;
            },
            reset() {
                Object.assign(this.form, {
                    translations: {
                        en: { title: '', content: '' },
                        nl: { title: '', content: '' },
                    },
                    date: '',
                    id: null,
                });
            }
        }
    }
</script> --}}
