<nav x-data="{ open: false }" class="bg-[#002F6C] text-white shadow-md">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- LEFT: Logo + Menu -->
            <div class="flex items-center">

                <!-- Logo -->
                <a href="{{ route('dashboard') }}" class="flex items-center mr-8">
                    <img src="{{ asset('storage/logos/NACIONAL.jpg') }}" class="h-10 w-auto" alt="PN">
                </a>

                <!-- Menu Desktop -->
                <div class="hidden sm:flex space-x-6 text-[15px] font-semibold">

                    {{-- Dashboard --}}
                    <a href="{{ route('dashboard') }}"
                        class="hover:text-[#A4D2FF] {{ request()->routeIs('dashboard') ? 'text-[#A4D2FF] underline underline-offset-4' : '' }}">
                        Dashboard
                    </a>

                    {{-- Registrar Acta --}}
                    @if (in_array(auth()->user()->role, ['admin', 'digitador']))
                        <a href="{{ route('actas.create') }}"
                            class="hover:text-[#A4D2FF] {{ request()->routeIs('actas.create') ? 'text-[#A4D2FF] underline underline-offset-4' : '' }}">
                            Registrar Acta
                        </a>

                        <a href="{{ route('actas.index') }}"
                            class="hover:text-[#A4D2FF] {{ request()->routeIs('actas.index') ? 'text-[#A4D2FF] underline underline-offset-4' : '' }}">
                            Listado de Actas
                        </a>
                    @endif

                   

                    {{-- Dashboard Electoral interno --}}
                    @if (in_array(auth()->user()->role, ['admin', 'digitador']))
                        <a href="{{ route('dashboard.electoral') }}"
                            class="hover:text-[#A4D2FF] {{ request()->routeIs('dashboard.electoral') ? 'text-[#A4D2FF] underline underline-offset-4' : '' }}">
                            Dashboard Electoral
                        </a>
                    @endif

                    {{-- Dashboard Público --}}
                    <a href="{{ route('dashboard.electoral.publico') }}"
                        class="hover:text-[#A4D2FF] {{ request()->routeIs('dashboard.electoral.publico') ? 'text-[#A4D2FF] underline underline-offset-4' : '' }}">
                        Dashboard Público
                    </a>

                </div>
            </div>


            <!-- RIGHT: User Dropdown -->
            <div class="hidden sm:flex sm:items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent 
                                      bg-[#004A9F] hover:bg-[#1E88E5] text-white rounded-md 
                                      text-sm font-semibold transition">
                            {{ Auth::user()->name }}
                            <svg class="ml-2 h-4 w-4 fill-current" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Perfil
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Cerrar Sesión
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Mobile Button -->
            <div class="sm:hidden flex items-center">
                <button @click="open = ! open"
                    class="p-2 text-white focus:outline-none rounded-md 
                           hover:bg-[#1E88E5] transition">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
    </div>


    <!-- Mobile Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="sm:hidden bg-[#003C84] text-white">
        <div class="pt-2 pb-3 space-y-1 px-4">

            <x-responsive-nav-link :href="route('dashboard')">
                Dashboard
            </x-responsive-nav-link>

            @if (in_array(auth()->user()->role, ['admin', 'digitador']))
                <x-responsive-nav-link :href="route('actas.create')">
                    Registrar Acta
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('actas.index')">
                    Listado de Actas
                </x-responsive-nav-link>
            @endif

            @if (auth()->user()->role === 'admin')
                <x-responsive-nav-link :href="route('mesas.index')">
                    Mesas Electorales
                </x-responsive-nav-link>
            @endif

            <x-responsive-nav-link :href="route('dashboard.electoral')">
                Dashboard Electoral
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('dashboard.electoral.publico')">
                Dashboard Público
            </x-responsive-nav-link>
        </div>
    </div>
</nav>
