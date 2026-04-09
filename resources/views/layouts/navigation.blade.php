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
                    @guest
                        <!-- Menu untuk guest (belum login) -->
                        <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="hover:text-green-600">Beranda</x-nav-link>
                        <a href="#tentang" onclick="event.preventDefault(); document.getElementById('tentang').scrollIntoView({ behavior: 'smooth' });" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            Profil
                        </a>
                        <a href="#statistik" onclick="event.preventDefault(); document.getElementById('statistik').scrollIntoView({ behavior: 'smooth' });" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            Data Jumlah
                        </a>
                        <a href="#kegiatan-terbaru" onclick="event.preventDefault(); document.getElementById('kegiatan-terbaru').scrollIntoView({ behavior: 'smooth' });" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            Kegiatan Terbaru
                        </a>
                        <a href="#galeri" onclick="event.preventDefault(); document.getElementById('galeri').scrollIntoView({ behavior: 'smooth' });" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            Galeri
                        </a>
                    @endguest

                    @auth
                        @if(auth()->user()->role == 'admin')
                            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="hover:text-blue-600">Dashboard</x-nav-link>
                            <x-nav-link :href="route('admin.anggota.index')" :active="request()->routeIs('admin.anggota.*')" class="hover:text-orange-500">Anggota</x-nav-link>
                            <x-nav-link :href="route('admin.kategori.index')" :active="request()->routeIs('admin.kategori.*')" class="hover:text-yellow-500">Kategori</x-nav-link>
                            <x-nav-link :href="route('admin.kegiatan.index')" :active="request()->routeIs('admin.kegiatan.*')" class="hover:text-red-600">Kegiatan</x-nav-link>
                            <x-nav-link :href="route('admin.pendaftaran.index')" :active="request()->routeIs('admin.pendaftaran.*')" class="hover:text-purple-600">Pendaftaran</x-nav-link>
                            <x-nav-link :href="route('admin.absensi.index')" :active="request()->routeIs('admin.absensi.*')" class="hover:text-pink-500">Absensi</x-nav-link>
                            <x-nav-link :href="route('admin.galeri.index')" :active="request()->routeIs('admin.galeri.*')" class="hover:text-amber-800">Galeri</x-nav-link>
                        @else
                            <x-nav-link :href="route('anggota.dashboard')" :active="request()->routeIs('anggota.dashboard')" class="hover:text-blue-500">Dashboard</x-nav-link>
                            <x-nav-link :href="route('kegiatan.publik.index')" :active="request()->routeIs('kegiatan.publik.*')" class="hover:text-red-500">Kegiatan</x-nav-link>
                            <x-nav-link :href="route('anggota.riwayat')" :active="request()->routeIs('anggota.riwayat')" class="hover:text-purple-500">Riwayat</x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- User menu / login -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <div x-data="{ userOpen: false }" class="relative">
                        <button @click="userOpen = !userOpen" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none">
                            {{ Auth::user()->name }}
                            <svg class="ms-1 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div x-show="userOpen" @click.away="userOpen = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50" style="display: none;">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Log Out</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>
                @endauth
            </div>

            <!-- Burger button -->
            <div class="-me-2 flex items-center sm:hidden">
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
    <div x-show="open" x-cloak class="sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @guest
                <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')" class="hover:text-green-600">Beranda</x-responsive-nav-link>
                <a href="#statistik" onclick="event.preventDefault(); document.getElementById('statistik').scrollIntoView({ behavior: 'smooth' });" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">
                    Data Jumlah
                </a>
                <a href="#kegiatan-terbaru" onclick="event.preventDefault(); document.getElementById('kegiatan-terbaru').scrollIntoView({ behavior: 'smooth' });" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">
                    Kegiatan Terbaru
                </a>
                <a href="#galeri" onclick="event.preventDefault(); document.getElementById('galeri').scrollIntoView({ behavior: 'smooth' });" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">
                    Galeri
                </a>
                <a href="#" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">
                    Profil
                </a>
            @endguest
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
<style>
    [x-cloak] { display: none !important; }
</style>