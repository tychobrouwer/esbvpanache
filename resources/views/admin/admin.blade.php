<x-app-layout max_width="max-w-7xl">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grid grid-cols-1 gap-3 p-6 mb-6">
        <x-header size="2xl">
            {{ __('Admin Dashboard') }}
        </x-header>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="p-6 bg-gray-100 overflow-hidden shadow-sm sm:rounded-lg">
                @include('admin.partials.announcement-form')
            </div>
            <div class="p-6 bg-gray-100 overflow-hidden shadow-sm sm:rounded-lg">
                @include('admin.partials.activity-form')
            </div>
            <div class="p-6 bg-gray-100 overflow-hidden shadow-sm sm:rounded-lg col-span-1 lg:col-span-2">
                @include('admin.partials.committees')
            </div>
        </div>
    </div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grid grid-cols-1 gap-3 p-6 mb-6">
        <x-header size="2xl">
            {{ __('Board Dashboard') }}
        </x-header>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        </div>
    </div>
</x-app-layout>
