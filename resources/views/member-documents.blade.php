<x-app-layout>
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <h2 class="p-6 text-gray-900 font-bold text-3xl flex">
                    {{ __('By-Laws') }}
                </h2>
                <div class="px-6 pb-6 text-gray-900 flex">
                    <p>{!! __('by_laws_message') !!}</p>
                </div>
                <h2 class="px-6 pb-6 text-gray-900 font-bold text-3xl flex">
                    {{__('Member List') }}
                </h2>
                <div class="px-6 pb-6 text-gray-900 flex">
                    <p>{!! __('member_list_message') !!}</p>
                </div>
                <h2 class="px-6 pb-6 text-gray-900 font-bold text-3xl flex">
                    {{__('Privacy Statement') }}
                </h2>
                <div class="px-6 pb-6 text-gray-900 flex">
                    <p>{!! __('privacy_statement_message') !!}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
