<section x-cloak>
    <header x-data class="mb-2 flex justify-between items-center">
        <x-header size="xl">
            {{ __('Images') }}
        </x-header>

        <div class="flex items-center gap-3">
            <x-button-secondary x-show="expandedView !== 'images'" @click="expandedView = 'images'">{{ __('View All') }}</x-button-secondary>
            <x-button-secondary x-show="expandedView === 'images'" @click="expandedView = 'no'">{{ __('Back to Dashboard') }}</x-button-secondary>

            <x-button-secondary @click="$dispatch('reset'); $dispatch('open-modal', 'image-form')">{{ __('Add') }}</x-button-secondary>

        </div>
    </header>

    @forelse ($images as $index => $image)
        <div class="mb-2 flex justify-between items-center" x-show="expandedView === 'images' || {{ $index }} < 3">
            <div class="font-semibold mr-3 text-nowrap overflow-hidden text-clip">
                {{ $image->tag }}
            </div>
            <form class="ml-auto" method="post" action="{{ route('image.destroy') }}">
                @csrf
                @method('delete')

                <input type="hidden" name="image_id" value="{{ $image->id }}">
                <x-button-danger type="submit">{{ __('Delete') }}</x-button-danger>
            </form>
        </div>
    @empty
        <div class="text-gray-500">{{ __('No images yet.') }}</div>
    @endforelse
</section>

<x-modal name="image-form" :show="$errors->image->any()" maxWidth="lg">
    <form method="post" :action="'{{ route('image.create') }}'" enctype="multipart/form-data" x-data="imageForm()">
        @csrf
        @method('post')

        <x-header size="xl">
            <span class="flex-grow">{{ __('Add Image') }}</span>
        </x-header>

        <div class="mb-2">
            <x-input-label for="image_tag" :value="__('Tag')" />
            <x-input-text name="tag" id="image_tag" x-model="form.tag" />
            <x-input-error :messages="$errors->image->get('tag')" class="mt-2" />
        </div>
        <div class="flex items-end gap-4">
            <div class="flex-grow">
                <x-input-label for="image_image" :value="__('Image')" />
                <input class="text-sm" name="image" id="image_image" type="file" x-ref="fileInput" accept="image/*">
                <x-input-error :messages="$errors->image->get('image')" class="mt-2" />
            </div>
            <div class="flex">
                <x-button-secondary @click="$dispatch('close-modal', 'image-form')"
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
        </div>
    </form>
</x-modal>

<script>
    function imageForm() {
        return {
            form: {
                tag: '',
                image: '',
            },
        }
    }
</script>
