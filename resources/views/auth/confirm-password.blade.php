<x-guest-layout>
    <div class="mb-4 text-sm text-gray-800">
        {{ __('please_confirm_password') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />

            <x-input-text id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <x-button-primary>
                {{ __('Confirm') }}
            </x-button-primary>
        </div>
    </form>
</x-guest-layout>
