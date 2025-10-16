<section x-cloak>
    <header x-data class="flex justify-between items-center">
        <x-header size="xl">
            {{ __('Images') }}
        </x-header>

        <div class="flex items-center gap-3">
            <x-secondary-button x-show="expandedView !== 'images'" @click="expandedView = 'images'">{{ __('View All') }}</x-secondary-button>
            <x-secondary-button x-show="expandedView === 'images'" @click="expandedView = 'no'">{{ __('Back to Dashboard') }}</x-secondary-button>

            <x-secondary-button @click="$dispatch('reset'); $dispatch('open-modal', 'image-form')">{{ __('Add Image') }}</x-secondary-button>

        </div>
    </header>

    @forelse ($images as $index => $image)
        <div class="mb-2 flex justify-between items-center" x-show="expandedView === 'images' || {{ $index }} < 3">
            <div class="font-semibold mr-6 text-nowrap overflow-hidden text-clip">
                {{ $image->tag }}
            </div>
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
            <x-text-input name="tag" id="image_tag" x-model="form.tag" />
            <x-input-error :messages="$errors->image->get('tag')" class="mt-2" />
        </div>
        <div class="flex items-end gap-4">
            <div class="flex-grow">
                <x-input-label for="image_image" :value="__('Image')" />
                <input class="text-sm" name="image" id="image_image" type="file" x-ref="fileInput" accept="image/*">
                <x-input-error :messages="$errors->image->get('image')" class="mt-2" />
            </div>
            <div class="flex">
                <x-secondary-button @click="$dispatch('close-modal', 'image-form')"
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
