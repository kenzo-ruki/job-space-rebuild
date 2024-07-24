<nav x-data="{ open: false }" class="bg-white border-b border-slate-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    @if (Auth::user()->hasRole('admin'))
                        <a href="{{ route('admin') }}">
                            <x-application-logo class="block h-10 w-auto fill-current text-slate-600" />
                        </a>
                    @elseif (Auth::user()->hasRole('recruiter'))
                        <a href="{{ route('recruiter.dashboard') }}">
                            <x-application-logo class="block h-10 w-auto fill-current text-slate-600" />
                        </a>
                    @elseif (Auth::user()->hasRole('jobseeker'))
                        <a href="{{ route('jobseeker.dashboard') }}">
                            <x-application-logo class="block h-10 w-auto fill-current text-slate-600" />
                        </a>
                    @elseif (Auth::user()->hasRole('user'))
                        <a href="{{ route('user.dashboard') }}">
                            <x-application-logo class="block h-10 w-auto fill-current text-slate-600" />
                        </a>
                    @endif
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @if (Auth::user()->hasRole('admin'))
                        <x-nav-link :href="route('admin')" :active="request()->routeIs('admin')">
                            {{ 'Admin ' }}
                        </x-nav-link>
                    @elseif (Auth::user()->hasRole('recruiter'))
                        <x-nav-link :href="route('recruiter.dashboard')" :active="request()->routeIs('recruiter.dashboard')">
                            {{ 'Recruiter Dashboard ' }}
                        </x-nav-link>
                    @elseif (Auth::user()->hasRole('jobseeker'))
                        <x-nav-link :href="route('jobseeker.dashboard')" :active="request()->routeIs('jobseeker.dashboard')">
                            {{ 'Jobseeker Dashboard ' }}
                        </x-nav-link>
                    @elseif (Auth::user()->hasRole('user'))
                        <x-nav-link :href="route('user.dashboard')" :active="request()->routeIs('user.dashboard')">
                            {{ 'Dashboard ' }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">

                <!-- Settings Dropdown -->
                <div class="ms-3 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-slate-500 bg-white hover:text-slate-700 focus:outline-none focus:bg-slate-50 active:bg-slate-50 transition ease-in-out duration-150">
                                        {{ Auth::user()->name }}

                                        <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-slate-400">
                                {{ 'Manage Account ' }}
                            </div>

                            <x-dropdown-link href="{{ route('profile.show') }}">
                                {{ 'Profile ' }}
                            </x-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ 'API Tokens ' }}
                                </x-dropdown-link>
                            @endif

                            <div class="border-t border-slate-200"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-dropdown-link href="{{ route('logout') }}"
                                         @click.prevent="$root.submit();">
                                    {{ 'Log Out ' }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-slate-400 hover:text-slate-500 hover:bg-slate-100 focus:outline-none focus:bg-slate-100 focus:text-slate-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @if (Auth::user()->hasRole('admin'))
                <x-responsive-nav-link :href="route('admin')" :active="request()->routeIs('admin')">
                    {{ 'Admin ' }}
                </x-responsive-nav>
            @elseif (Auth::user()->hasRole('recruiter'))
                <x-responsive-nav-link :href="route('recruiter.dashboard')" :active="request()->routeIs('recruiter.dashboard')">
                    {{ 'Recruiter Dashboard ' }}
                </x-responsive-nav>
            @elseif (Auth::user()->hasRole('jobseeker'))
                <x-responsive-nav-link :href="route('jobseeker.dashboard')" :active="request()->routeIs('jobseeker.dashboard')">
                    {{ 'Jobseeker Dashboard ' }}
                </x-responsive-nav>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-slate-200">
            <div class="flex items-center px-4">
                <div>
                    <div class="font-medium text-base text-slate-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-slate-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ 'Profile ' }}
                </x-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                        {{ 'API Tokens ' }}
                    </x-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-responsive-nav-link href="{{ route('logout') }}"
                                   @click.prevent="$root.submit();">
                        {{ 'Log Out ' }}
                    </x-responsive-nav-link>
                </form>

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="border-t border-slate-200"></div>

                    <div class="block px-4 py-2 text-xs text-slate-400">
                        {{ 'Manage Team ' }}
                    </div>

                    <!-- Team Settings -->
                    <x-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                        {{ 'Team Settings ' }}
                    </x-responsive-nav-link>

                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                            {{ 'Create New Team ' }}
                        </x-responsive-nav-link>
                    @endcan

                    <!-- Team Switcher -->
                    @if (Auth::user()->allTeams()->count() > 1)
                        <div class="border-t border-slate-200"></div>

                        <div class="block px-4 py-2 text-xs text-slate-400">
                            {{ 'Switch Teams ' }}
                        </div>

                        @foreach (Auth::user()->allTeams() as $team)
                            <x-switchable-team :team="$team" component="responsive-nav-link" />
                        @endforeach
                    @endif
                @endif
            </div>
        </div>
    </div>
</nav>