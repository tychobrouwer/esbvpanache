<x-app-layout>
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <h1 class="p-6 text-gray-900 font-bold text-2xl flex">
                    {{ __('Admin Dashboard') }}
                </h1>
                <div class="flex">
                    <div class="m-2 w-1/2 p-6 bg-gray-100 overflow-hidden shadow-sm sm:rounded-lg">
                        @include('admin.partials.add-announcement-form')
                    </div>
                    <div class="m-2 w-1/2 p-6 bg-gray-100 overflow-hidden shadow-sm sm:rounded-lg">
                        @include('admin.partials.add-activity-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
