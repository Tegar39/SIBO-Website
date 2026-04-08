<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" wire:navigate>
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <!-- Desktop Menu -->
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')" wire:navigate>Beranda</x-nav-link>
                    @auth
                        @if(auth()->user()->role == 'admin')
                            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" wire:navigate>Dashboard</x-nav-link>
                            <x-nav-link :href="route('admin.anggota.index')" :active="request()->routeIs('admin.anggota.*')" wire:navigate>Anggota</x-nav-link>
                            <x-nav-link :href="route('admin.kategori.index')" :active="request()->routeIs('admin.kategori.*')" wire:navigate>Kategori</x-nav-link>
                            <x-nav-link :href="route('admin.kegiatan.index')" :active="request()->routeIs('admin.kegiatan.*')" wire:navigate>Kegiatan</x-nav-link>
                            <x-nav-link :href="route('admin.pendaftaran.index')" :active="request()->routeIs('admin.pendaftaran.*')" wire:navigate>Pendaftaran</x-nav-link>
                        @else
                            <x-nav-link :href="route('anggota.dashboard')" :active="request()->routeIs('anggota.dashboard')" wire:navigate>Dashboard</x-nav-link>
                            <x-nav-link :href="route('kegiatan.publik.index')" :active="request()->routeIs('kegiatan.publik.*')" wire:navigate>Kegiatan</x-nav-link>
                            <x-nav-link :href="route('anggota.riwayat')" :active="request()->routeIs('anggota.riwayat')" wire:navigate>Riwayat</x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @auth
                    <!-- Dropdown User -->
                    <div class="relative" x-data="{ dropdownOpen: false }">
                        <button @click="dropdownOpen = !dropdownOpen" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none">
                            {{ Auth::user()->name }}
                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div x-show="dropdownOpen" @click.away="dropdownOpen = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50" style="display: none;">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Log Out</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                @endauth
            </div>
            <!-- Mobile menu button -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu panel -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')" wire:navigate>Beranda</x-responsive-nav-link>
            @auth
                @if(auth()->user()->role == 'admin')
                    <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" wire:navigate>Dashboard</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.anggota.index')" :active="request()->routeIs('admin.anggota.*')" wire:navigate>Anggota</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.kategori.index')" :active="request()->routeIs('admin.kategori.*')" wire:navigate>Kategori</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.kegiatan.index')" :active="request()->routeIs('admin.kegiatan.*')" wire:navigate>Kegiatan</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.pendaftaran.index')" :active="request()->routeIs('admin.pendaftaran.*')" wire:navigate>Pendaftaran</x-responsive-nav-link>
                @else
                    <x-responsive-nav-link :href="route('anggota.dashboard')" :active="request()->routeIs('anggota.dashboard')" wire:navigate>Dashboard</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('kegiatan.publik.index')" :active="request()->routeIs('kegiatan.publik.*')" wire:navigate>Kegiatan</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('anggota.riwayat')" :active="request()->routeIs('anggota.riwayat')" wire:navigate>Riwayat</x-responsive-nav-link>
                @endif
            @endauth
        </div>
        @auth
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
                <div class="mt-3 space-y-1">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">Log Out</x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</nav>