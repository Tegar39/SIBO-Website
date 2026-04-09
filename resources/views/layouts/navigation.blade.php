<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <!-- Beranda - hover hijau -->
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="hover:text-green-600 transition-colors duration-200">
                        Beranda
                    </x-nav-link>
                    @auth
                        @if(auth()->user()->role == 'admin')
                            <!-- Dashboard - hover biru -->
                            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="hover:text-blue-600 transition-colors duration-200">
                                Dashboard
                            </x-nav-link>
                            <!-- Anggota - hover orange -->
                            <x-nav-link :href="route('admin.anggota.index')" :active="request()->routeIs('admin.anggota.*')" class="hover:text-orange-500 transition-colors duration-200">
                                Anggota
                            </x-nav-link>
                            <!-- Kategori - hover kuning -->
                            <x-nav-link :href="route('admin.kategori.index')" :active="request()->routeIs('admin.kategori.*')" class="hover:text-yellow-500 transition-colors duration-200">
                                Kategori
                            </x-nav-link>
                            <!-- Kegiatan - hover merah -->
                            <x-nav-link :href="route('admin.kegiatan.index')" :active="request()->routeIs('admin.kegiatan.*')" class="hover:text-red-600 transition-colors duration-200">
                                Kegiatan
                            </x-nav-link>
                            <!-- Pendaftaran - hover ungu -->
                            <x-nav-link :href="route('admin.pendaftaran.index')" :active="request()->routeIs('admin.pendaftaran.*')" class="hover:text-purple-600 transition-colors duration-200">
                                Pendaftaran
                            </x-nav-link>
                            <!-- Absensi - hover pink -->
                            <x-nav-link :href="route('admin.absensi.index')" :active="request()->routeIs('admin.absensi.*')" class="hover:text-pink-500 transition-colors duration-200">
                                Absensi
                            </x-nav-link>
                            <!-- Galeri - hover coklat (amber-800) -->
                            <x-nav-link :href="route('admin.galeri.index')" :active="request()->routeIs('admin.galeri.*')" class="hover:text-amber-800 transition-colors duration-200">
                                Galeri
                            </x-nav-link>
                        @else
                            <!-- Dashboard anggota - hover biru muda -->
                            <x-nav-link :href="route('anggota.dashboard')" :active="request()->routeIs('anggota.dashboard')" class="hover:text-blue-500 transition-colors duration-200">
                                Dashboard
                            </x-nav-link>
                            <!-- Kegiatan anggota - hover merah -->
                            <x-nav-link :href="route('kegiatan.publik.index')" :active="request()->routeIs('kegiatan.publik.*')" class="hover:text-red-500 transition-colors duration-200">
                                Kegiatan
                            </x-nav-link>
                            <!-- Riwayat - hover ungu -->
                            <x-nav-link :href="route('anggota.riwayat')" :active="request()->routeIs('anggota.riwayat')" class="hover:text-purple-500 transition-colors duration-200">
                                Riwayat
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">Log Out</x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ms-4 text-sm text-gray-700 underline">Register</a>
                    @endif
                @endauth
            </div>
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
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')" class="hover:text-green-600">Beranda</x-responsive-nav-link>
            @auth
                @if(auth()->user()->role == 'admin')
                    <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="hover:text-blue-600">Dashboard</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.anggota.index')" :active="request()->routeIs('admin.anggota.*')" class="hover:text-orange-500">Anggota</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.kategori.index')" :active="request()->routeIs('admin.kategori.*')" class="hover:text-yellow-500">Kategori</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.kegiatan.index')" :active="request()->routeIs('admin.kegiatan.*')" class="hover:text-red-600">Kegiatan</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.pendaftaran.index')" :active="request()->routeIs('admin.pendaftaran.*')" class="hover:text-purple-600">Pendaftaran</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.absensi.index')" :active="request()->routeIs('admin.absensi.*')" class="hover:text-pink-500">Absensi</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.galeri.index')" :active="request()->routeIs('admin.galeri.*')" class="hover:text-amber-800">Galeri</x-responsive-nav-link>
                @else
                    <x-responsive-nav-link :href="route('anggota.dashboard')" :active="request()->routeIs('anggota.dashboard')" class="hover:text-blue-500">Dashboard</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('kegiatan.publik.index')" :active="request()->routeIs('kegiatan.publik.*')" class="hover:text-red-500">Kegiatan</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('anggota.riwayat')" :active="request()->routeIs('anggota.riwayat')" class="hover:text-purple-500">Riwayat</x-responsive-nav-link>
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