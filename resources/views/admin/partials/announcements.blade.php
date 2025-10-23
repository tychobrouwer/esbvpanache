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
