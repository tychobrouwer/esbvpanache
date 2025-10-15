<x-app-layout max_width="max-w-7xl">
    <div x-data="{ expandedView: 'no' }">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grid grid-cols-1 gap-3 p-6 mb-6">
            <x-header size="2xl">
                {{ __('Admin Dashboard') }}
            </x-header>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div x-show="expandedView === 'no' || expandedView === 'announcements'" :class="expandedView === 'announcements' ? 'col-span-1 lg:col-span-2' : ''" class="p-6 bg-gray-100 overflow-hidden shadow-sm sm:rounded-lg">
                    @include('admin.partials.announcements')
                </div>
                <div x-show="expandedView === 'no' || expandedView === 'activities'" :class="expandedView === 'activities' ? 'col-span-1 lg:col-span-2' : ''" class="p-6 bg-gray-100 overflow-hidden shadow-sm sm:rounded-lg">
                    @include('admin.partials.activities')
                </div>
                <div x-show="expandedView === 'no' || expandedView === 'boards'" :class="expandedView === 'boards' ? 'col-span-1 lg:col-span-2' : ''" class="p-6 bg-gray-100 overflow-hidden shadow-sm sm:rounded-lg">
                    @include('admin.partials.boards')
                </div>
                <div x-show="expandedView === 'no' || expandedView === 'committees'" class="p-6 bg-gray-100 overflow-hidden shadow-sm sm:rounded-lg col-span-1 lg:col-span-2">
                    @include('admin.partials.committees')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
