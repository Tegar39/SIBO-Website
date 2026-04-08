<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="text-xl font-bold text-gray-800">SIBO</a>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">Beranda</x-nav-link>
                    @auth
                        @if(auth()->user()->role == 'admin')
                            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">Dashboard</x-nav-link>
                            <x-nav-link :href="route('admin.anggota.index')" :active="request()->routeIs('admin.anggota.*')">Anggota</x-nav-link>
                            <x-nav-link :href="route('admin.kategori.index')" :active="request()->routeIs('admin.kategori.*')">Kategori</x-nav-link>
                            <x-nav-link :href="route('admin.kegiatan.index')" :active="request()->routeIs('admin.kegiatan.*')">Kegiatan</x-nav-link>
                            <x-nav-link :href="route('admin.pendaftaran.index')" :active="request()->routeIs('admin.pendaftaran.*')">Pendaftaran</x-nav-link>
                            <x-nav-link :href="route('admin.absensi.index')" :active="request()->routeIs('admin.absensi.*')">Absensi</x-nav-link>
                            <x-nav-link :href="route('admin.galeri.index')" :active="request()->routeIs('admin.galeri.*')">Galeri</x-nav-link>
                        @else
                            <x-nav-link :href="route('anggota.dashboard')" :active="request()->routeIs('anggota.dashboard')">Dashboard</x-nav-link>
                            <x-nav-link :href="route('kegiatan.publik.index')" :active="request()->routeIs('kegiatan.publik.*')">Kegiatan</x-nav-link>
                            <x-nav-link :href="route('anggota.riwayat')" :active="request()->routeIs('anggota.riwayat')">Riwayat</x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @auth
                    <div class="relative">
                        <button @click="open = !open" class="flex items-center text-gray-700 hover:text-gray-900 focus:outline-none">
                            {{ Auth::user()->name }}
                            <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-20">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">Logout</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                @endauth
            </div>
        </div>
    </div>
</nav>