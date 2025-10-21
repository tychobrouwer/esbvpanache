<section x-cloak>
    <header class="mb-2 flex justify-between items-center">
        <x-header size="xl">
            {{ __('Activities') }}
        </x-header>

        <div class="flex items-center gap-3">
            <x-button-secondary x-show="expandedView !== 'activities'" @click="expandedView = 'activities'">{{ __('View All') }}</x-button-secondary>
            <x-button-secondary x-show="expandedView === 'activities'" @click="expandedView = 'no'">{{ __('Back') }}</x-button-secondary>
            
            <x-button-secondary @click="$dispatch('open-modal', 'new-activity')">{{ __('Add') }}</x-button-secondary>
        </div>
    </header>

    @forelse ($activities as $index => $activity)
        <div class="mb-2 flex justify-between items-center" x-show="expandedView === 'activities' || {{ $index }} < 3">
            <div class="inline-grid">
                <div class="font-semibold mr-3 text-nowrap overflow-hidden text-clip">{{ $activity->title_en }}</div>
                <div>{{ $activity->date->format('F j, Y') }}</div>
            </div>
            <div class="flex items-center gap-3">
                <x-button-secondary 
                    @click="$dispatch('open-modal', 'edit-activity-{{ $activity->id }}')"
                >
                    {{ __('Edit') }}
                </x-button-secondary>
                <form method="post" action="{{ route('activity.destroy') }}">
                    @csrf
                    @method('delete')

                    <input type="hidden" name="activity_id" value="{{ $activity->id }}">
                    <x-button-danger type="submit">{{ __('Delete') }}</x-button-danger>
                </form>
            </div>
        </div>

        <x-modal name="edit-activity-{{ $activity->id }}" :show="$errors->getBag('edit-activity-'. $activity->id)->any()" maxWidth="lg">
            <x-form-activity :activity="$activity" formId="edit-activity-{{ $activity->id }}" />
        </x-modal>
    @empty
        <div class="text-gray-500">{{ __('No activities yet.') }}</div>
    @endforelse
</section>

<x-modal name="new-activity" :show="$errors->getBag('new-activity')->any()" maxWidth="lg">
    <x-form-activity :activity="null" formId="new-activity" />
</x-modal>