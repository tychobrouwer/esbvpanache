<nav x-data="{ open: false }" class="bg-white border-b border-b-gray-100 border-t-4 border-t-panache">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-center lg:justify-between items-center my-1">
            <a class="hidden lg:block" href="{{ route('index') }}">
                <x-panache-logo class="h-8 w-14 fill-panache" />
            </a>

            <div class="sm:flex sm:items-center lg:ms-6">
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-3 lg:ms-6 sm:flex">
                    <x-link-nav-primary :href="route('index')" :active="request()->routeIs('index')">
                        {{ __('Home') }} 
                    </x-link-nav-primary>
                </div>

                <div class="hidden sm:flex sm:items-center sm:ms-3 lg:ms-6">
                    <x-dropdown align="right" width="w-48">
                        <x-slot name="trigger">
                            <x-button-primary>
                                <div>{{ __('About Us') }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </x-button-primary>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('contact')" :active="request()->routeIs('contact')">
                                {{ __('Contact') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('board')" :active="request()->routeIs('board')">
                                {{ __('Board') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('pictures')" :active="request()->routeIs('pictures')">
                                {{ __('Pictures') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('history')" :active="request()->routeIs('history')">
                                {{ __('History') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('committees')" :active="request()->routeIs('committees')">
                                {{ __('Committees') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('member-documents')" :active="request()->routeIs('member-documents')">
                                {{ __('Member Documents') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                </div>

                <div class="hidden sm:flex sm:items-center sm:ms-3 lg:ms-6">
                    <x-dropdown align="right" width="w-48">
                        <x-slot name="trigger">
                            <x-button-primary>
                                <div>{{ __('Playing at Panache') }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </x-button-primary>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('training')" :active="request()->routeIs('training')">
                                {{ __('Training') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('membership')" :active="request()->routeIs('membership')">
                                {{ __('Membership') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('competition')" :active="request()->routeIs('competition')">
                                {{ __('Competition') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-3 lg:ms-6 sm:flex">
                    <x-link-nav-primary :href="route('activities')" :active="request()->routeIs('activities')">
                        {{ __('Activities') }}
                    </x-link-nav-primary>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-3 lg:ms-6 sm:flex">
                    <x-link-nav-primary :href="url('https://esbvpanache.nl/toernooi')" :active="false">
                        Panache {{ __('Tournament') }}
                    </x-link-nav-primary>
                </div>

                {{-- <div class="hidden space-x-8 sm:-my-px sm:ms-3 lg:ms-6 sm:flex">
                    <x-link-nav-primary :href="route('contact')" :active="request()->routeIs('contact')">
                        {{ __('Contact') }}
                    </x-link-nav-primary>
                </div> --}}

                <div class="hidden space-x-8 sm:-my-px sm:ms-3 lg:ms-6 sm:flex">
                    <x-link-nav-primary :href="route('locale-switch')" :active="false">
                        @if (App::isLocale('en'))
                            {{-- NL&#127475;&#127473; --}}
                            EN &#10132; NL
                        @else
                            {{-- EN&#127466;&#127475; --}}
                            NL &#10132; EN
                        @endif
                    </x-link-nav-primary>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>
