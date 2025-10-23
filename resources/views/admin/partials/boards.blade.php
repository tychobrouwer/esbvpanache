<section x-cloak>
    <header x-data class="mb-2 flex justify-between items-center">
        <x-header size="xl">
            {{ __('Boards') }}
        </x-header>

        <div class="flex items-center gap-3">
            <x-button-secondary x-show="expandedView !== 'boards'" @click="expandedView = 'boards'">{{ __('View All') }}</x-button-secondary>
            <x-button-secondary x-show="expandedView === 'boards'" @click="expandedView = 'no'">{{ __('Back to Dashboard') }}</x-button-secondary>

            <x-button-secondary
                @click="$dispatch('reset'); $dispatch('open-modal', 'new-board')"
            >{{ __('Add') }}</x-button-secondary>
        </div>
    </header>

    @forelse ($boards as $index => $board)
        <div class="mb-2 flex justify-between items-center" x-show="expandedView === 'boards' || {{ $index }} < 3">
            <div class="inline-grid">
                <div class="font-semibold mr-3 text-nowrap overflow-hidden text-clip">{{ $board->string() }}</div>
                <div>{{ $board->year + 1962 }}-{{ $board->year + 1963 }}, {{ $board->ordinal() }}</div>
            </div>
            <div class="flex items-center gap-3">
                <x-button-secondary 
                    @click="$dispatch('open-modal', 'edit-board-{{ $board->id }}')"
                >
                    {{ __('Edit') }}
                </x-button-secondary>
                <form method="post" action="{{ route('board.destroy') }}">
                    @csrf
                    @method('delete')

                    <input type="hidden" name="board_id" value="{{ $board->id }}">
                    <x-button-danger type="submit">{{ __('Delete') }}</x-button-danger>
                </form>
            </div>
        </div>

        <x-modal name="edit-board-{{ $board->id }}" :show="$errors->getBag('edit-board-'. $board->id)->any()" maxWidth="lg">
            <x-form-board :board="$board" formId="edit-board-{{ $board->id }}" />
        </x-modal>
    @empty
        <div class="text-gray-500">{{ __('No boards yet.') }}</div>
    @endforelse
</section>

<x-modal name="new-board" :show="$errors->getBag('new-board')->any()" maxWidth="lg">
    <x-form-board :board="null" formId="new-board" />
</x-modal>
