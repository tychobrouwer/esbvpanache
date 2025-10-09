<x-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <h2 class="px-6 pt-6 text-gray-900 font-bold text-2xl flex">
            {{ __('Admin Dashboard') }}
        </h1>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 p-6">
            <div class="p-6 bg-gray-100 overflow-hidden shadow-sm sm:rounded-lg">
                @include('admin.partials.add-announcement-form')
            </div>
            <div class="min-w-[200px] bg-gray-100 overflow-hidden shadow-sm sm:rounded-lg p-6 border-b-4 border-panache">
                @include('admin.partials.add-activity-form')
            </div>
        </div>
    </div>
</x-app-layout>
