<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <title>Document</title>
</head>

<body>
    <div x-data="{ sidebarOpen: false }">
        <div class="flex h-screen bg-gray-100">
            <!--It is a background that is activated when the screen size is 768px and the sidebar is displayed-->
            <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false"
                class="fixed z-20 inset-0 bg-black opacity-60 transition-opacity lg:hidden"></div>

            <!--Sidebar-->
            <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
                class="fixed z-30 inset-y-0 left-0 w-64 transition duration-300 transform border border-l shadow-sm
                        bg-white overflow-y-auto lg:translate-x-0 lg:static lg:inset-0">

                <!--User role-->
                <a href="{{ route('dashboard') }}"
                    class="flex items-center justify-center h-auto space-x-2 mx-5 border-b-2 flex-wrap">
                    <x-icons.shield class="w-8 max-h-full h-14 text-gray-500" />
                    <span class="text-gray-800 text-2xl font-bold uppercase tracking-wide text-center">
                        {{ Auth::user()->role->name }}
                    </span>
                </a>

                <!--Sidebar options-->
                <nav class="flex-1 px-2 py-4 space-y-2 overflow-y-hidden hover:overflow-y-auto">


                    @can('manage-directors')
                    <x-dropdown.simple.option class="w-full" :isActive="request()->routeIs('director.*')">
                        <x-slot name="header">
                            <x-icons.director />
                            <span>{{ __('Director') }}</span>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown.simple.link :href="route('director.index')">
                                {{ __('List directors') }}
                            </x-dropdown.simple.link>
                            <x-dropdown.simple.link :href="route('director.create')">
                                {{ __('Create a new director') }}
                            </x-dropdown.simple.link>
                        </x-slot>
                    </x-dropdown.simple.option>
                    @endcan


                    @can('manage-guards')
                    <x-dropdown.simple.option class="w-full" :isActive="request()->routeIs('guard.*')">
                        <x-slot name="header">
                            <x-icons.guard />
                            <span>{{ __('Guards') }}</span>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown.simple.link :href="route('guard.index')">
                                {{ __('List guards') }}
                            </x-dropdown.simple.link>
                            <x-dropdown.simple.link :href="route('guard.create')">
                                {{ __('Create a new guard') }}
                            </x-dropdown.simple.link>
                        </x-slot>
                    </x-dropdown.simple.option>
                    @endcan


                    @can('manage-prisoners')
                    <x-dropdown.simple.option title="Hello world" class="w-full" :isActive="request()->routeIs('prisoner.*')">
                        <x-slot name="header">
                            <x-icons.prisoner />
                            <span>{{ __('Prisoners') }}</span>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown.simple.link :href="route('prisoner.index')">
                                {{ __('List prisoner') }}
                            </x-dropdown.simple.link>
                            <x-dropdown.simple.link :href="route('prisoner.create')">
                                {{ __('Create a new prisoner') }}
                            </x-dropdown.simple.link>
                        </x-slot>
                    </x-dropdown.simple.option>
                    @endcan

                    @can('manage-wards')
                        <x-dropdown.simple.option class="w-full" :isActive="request()->routeIs('ward.*')">
                            <x-slot name="header">
                                <x-icons.warehouse/>
                                <span>{{__("Wards")}}</span>
                            </x-slot>
                            <x-slot name="content">

                                <x-dropdown.simple.link :href="route('ward.index')">
                                    {{ __('List wards') }}
                                </x-dropdown.simple.link>

                                <x-dropdown.simple.link :href="route('ward.create')">
                                    {{ __('Create a new ward') }}
                                </x-dropdown.simple.link>
                            </x-slot>
                        </x-dropdown.simple.option>
                    @endcan

                    @can('manage-jails')
                        <x-dropdown.simple.option class="w-full" :isActive="request()->routeIs('jail.*')">
                            <x-slot name="header">
                                <x-icons.jail/>
                                <span>{{__("Jails")}}</span>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown.simple.link :href="route('jail.index')">
                                    {{ __('List jails') }}
                                </x-dropdown.simple.link>
                                <x-dropdown.simple.link :href="route('jail.create')">
                                    {{ __('Create a new jail') }}
                                </x-dropdown.simple.link>
                            </x-slot>
                        </x-dropdown.simple.option>
                    @endcan

                    @can('manage-assignment')
                        <x-dropdown.simple.option class="w-full" :isActive="request()->routeIs('assignment.*')">
                            <x-slot name="header">
                                <x-icons.card/>
                                <span>{{__("Assignments")}}</span>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown.simple.link :href="route('assignment.prisoners-jails.index')">
                                    {{ __('Prisoners to jails') }}
                                </x-dropdown.simple.link>
                                <x-dropdown.simple.link :href="route('assignment.guards-wards.index')">
                                    {{ __('Guards to wards') }}
                                </x-dropdown.simple.link>
                            </x-slot>
                        </x-dropdown.simple.option>
                   @endcan

                   
                </nav>
            </div>

            <!--Main view-->
            <div class="flex-1 flex flex-col">
                <!--Navbar-->
                <header
                    class="flex flex-shrink-0 h-14 justify-between lg:justify-end bg-white shadow-md
                               px-5 md:px-8 z-0">

                    <!--Menu option-->
                    <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
                        <x-icons.menu class="w-6 h-6" />
                    </button>

                    <div class="flex items-center space-x-4">
                        <!--Notifications-->
                        <x-dropdown.menu.option>
                            <x-slot name="header">
                                <x-icons.notification />
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown.menu.link>
                                    {{ __('Notifications') }}
                                </x-dropdown.menu.link>
                            </x-slot>
                        </x-dropdown.menu.option>

                        <!--User options-->
                        <x-dropdown.menu.option>

                            <x-slot name="header">
                                <span class="text-current text-sm hidden sm:block">
                                    {{ Auth::user()->getFullName() }}
                                </span>
                                <x-user-avatar src="{{ Auth::user()->image->getUrl() }}" />
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown.menu.link :href="route('profile')">
                                    {{ __('Profile') }}
                                </x-dropdown.menu.link>
                                <form method="POST" action="{{ route('logout') }}" x-ref="logout">
                                    @csrf
                                    <x-dropdown.menu.link @click="$refs.logout.submit()">
                                        {{ __('Log out') }}
                                    </x-dropdown.menu.link>
                                </form>
                            </x-slot>

                        </x-dropdown.menu.option>
                    </div>
                </header>

                <!-- Page Content -->
                <main class="overflow-x-hidden overflow-y-auto px-6 py-8">
                    <!-- Session Status -->
                    <x-session-status class="mb-4 text-center" :status="session('status')" :color="session('color')"/>

                    @yield('content')

                </main>
            </div>
        </div>
    </div>
</body>

</html>


