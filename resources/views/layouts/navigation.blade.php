<nav x-data="{ open: false }" 
     class="bg-white/80 backdrop-blur-xl border-b border-white/20 fixed w-full top-0 z-[9999] shadow-sm">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">

            <div class="flex-1 flex items-center">
                <a href="{{ route('home') }}" wire:navigate class="flex items-center gap-3 group">
                    <img src="{{ asset('images/logo-sibo.png') }}" 
                         class="h-10 w-auto transition-transform duration-500 group-hover:scale-110">
                    <div class="hidden md:block leading-none">
                        <span class="block text-sm font-black text-slate-800 uppercase tracking-tighter">IPNU IPPNU</span>
                        <span class="block text-[9px] font-black text-emerald-600 uppercase tracking-[0.2em]">KAB. KEDIRI</span>
                    </div>
                </a>
            </div>

            <div class="hidden sm:flex flex-7 justify-center">
                <div class="flex items-center gap-10">

                    {{-- ===== GUEST (HOME SCROLL) ===== --}}
                    @guest
                        <a href="{{ route('home') }}#home" wire:navigate data-section="home" class="nav-item">Beranda</a>
                        <a href="{{ route('home') }}#tentang" wire:navigate data-section="tentang" class="nav-item">Profil Organisasi</a>
                        <a href="{{ route('home') }}#statistik" wire:navigate data-section="statistik" class="nav-item">Jumlah Data</a>
                        <a href="{{ route('home') }}#kegiatan-terbaru" wire:navigate data-section="kegiatan-terbaru" class="nav-item">Informasi Kegiatan</a>
                        <a href="{{ route('home') }}#galeri" wire:navigate data-section="galeri" class="nav-item">Galeri</a>
                    @endguest

                    {{-- ===== AUTH ===== --}}
                    @auth
                        @if(auth()->user()->role == 'admin')
                            <a href="{{ route('admin.dashboard') }}" wire:navigate class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
                            <a href="{{ route('admin.anggota.index') }}" wire:navigate class="nav-item {{ request()->routeIs('admin.anggota.*') ? 'active' : '' }}">Anggota</a>
                            <a href="{{ route('admin.kategori.index') }}" wire:navigate class="nav-item {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}">Kategori</a>
                            <a href="{{ route('admin.kegiatan.index') }}" wire:navigate class="nav-item {{ request()->routeIs('admin.kegiatan.*') ? 'active' : '' }}">Kegiatan</a>
                            <a href="{{ route('admin.pendaftaran.index') }}" wire:navigate class="nav-item {{ request()->routeIs('admin.pendaftaran.*') ? 'active' : '' }}">Pendaftaran</a>
                            <a href="{{ route('admin.absensi.index') }}" wire:navigate class="nav-item {{ request()->routeIs('admin.absensi.*') ? 'active' : '' }}">Absensi</a>
                            <a href="{{ route('admin.galeri.index') }}" wire:navigate class="nav-item {{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}">Galeri</a>
                            <a href="{{ route('admin.laporan.index') }}" wire:navigate class="nav-item {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">Laporan</a>
                        @else
                            <a href="{{ route('anggota.dashboard') }}" wire:navigate class="nav-item {{ request()->routeIs('anggota.dashboard') ? 'active' : '' }}">Dashboard</a>
                            <a href="{{ route('kegiatan.publik.index') }}" wire:navigate class="nav-item {{ request()->routeIs('kegiatan.publik.*') ? 'active' : '' }}">Kegiatan</a>
                            <a href="{{ route('anggota.riwayat') }}" wire:navigate class="nav-item {{ request()->routeIs('anggota.riwayat') ? 'active' : '' }}">Riwayat</a>
                            <a href="{{ route('anggota.profil') }}" wire:navigate class="nav-item {{ request()->routeIs('anggota.profil') ? 'active' : '' }}">Profil</a>
                        @endif
                    @endauth

                </div>
            </div>

            <div class="flex-1 flex justify-end items-center">

                @guest
                    <a href="{{ route('login') }}" wire:navigate
                       class="px-6 py-2.5 text-white bg-emerald-600 hover:bg-slate-800 rounded-full font-black text-xs uppercase tracking-widest transition-all shadow-lg shadow-emerald-100 active:scale-95">
                        Log In
                    </a>
                @endguest

                @auth
                <div class="relative" x-data="{ userOpen: false }">
                    <button @click="userOpen = !userOpen"
                        class="flex items-center gap-3 font-black text-[11px] uppercase tracking-widest text-slate-700 hover:text-emerald-600 transition-colors">
                        {{ auth()->user()->name }}
                        <svg class="w-3 h-3 transition-transform" :class="userOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                    </button>

                    <div x-show="userOpen" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         @click.away="userOpen = false"
                         class="absolute right-0 mt-4 w-56 bg-white/90 backdrop-blur-xl border border-white rounded-[1.5rem] shadow-2xl z-[9999] overflow-hidden p-2">

                        @if(auth()->user()->role == 'anggota')
                        <a href="{{ route('anggota.profil') }}" wire:navigate
                           class="block px-4 py-3 text-[11px] font-bold uppercase tracking-wider text-slate-600 hover:bg-emerald-50 hover:text-emerald-600 rounded-xl transition-all">
                            Profil Saya
                        </a>
                        @endif

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="w-full text-left px-4 py-3 text-[11px] font-bold uppercase tracking-wider text-rose-500 hover:bg-rose-50 rounded-xl transition-all">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
                @endauth

            </div>

            <div class="sm:hidden">
                <button @click="open = !open" class="p-2 text-slate-600">
                    <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                    <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

        </div>
    </div>

    <div x-show="open" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="sm:hidden bg-white/95 backdrop-blur-md border-t border-slate-100">
        <div class="px-4 py-6 space-y-3">
            @guest
                <a href="{{ route('home') }}#home" wire:navigate class="nav-item-mobile" @click="open = false">Beranda</a>
                <a href="{{ route('home') }}#tentang" wire:navigate class="nav-item-mobile" @click="open = false">Profil</a>
                <a href="{{ route('home') }}#statistik" wire:navigate class="nav-item-mobile" @click="open = false">Jumlah Data</a>
                <a href="{{ route('home') }}#kegiatan-terbaru" wire:navigate class="nav-item-mobile" @click="open = false">Informasi</a>
                <a href="{{ route('home') }}#galeri" wire:navigate class="nav-item-mobile" @click="open = false">Galeri</a>
                <a href="{{ route('login') }}" wire:navigate class="block text-center mt-6 px-4 py-4 bg-emerald-600 text-white rounded-2xl font-black uppercase text-xs tracking-[0.2em]" @click="open = false">
                    Log In
                </a>
            @endguest

            @auth
                @if(auth()->user()->role == 'admin')
                    <a href="{{ route('admin.dashboard') }}" wire:navigate class="nav-item-mobile {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" @click="open = false">Dashboard</a>
                    <a href="{{ route('admin.anggota.index') }}" wire:navigate class="nav-item-mobile {{ request()->routeIs('admin.anggota.*') ? 'active' : '' }}" @click="open = false">Anggota</a>
                    <a href="{{ route('admin.kategori.index') }}" wire:navigate class="nav-item-mobile {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}" @click="open = false">Kategori</a>
                    <a href="{{ route('admin.kegiatan.index') }}" wire:navigate class="nav-item-mobile {{ request()->routeIs('admin.kegiatan.*') ? 'active' : '' }}" @click="open = false">Kegiatan</a>
                    <a href="{{ route('admin.pendaftaran.index') }}" wire:navigate class="nav-item-mobile {{ request()->routeIs('admin.pendaftaran.*') ? 'active' : '' }}" @click="open = false">Pendaftaran</a>
                    <a href="{{ route('admin.absensi.index') }}" wire:navigate class="nav-item-mobile {{ request()->routeIs('admin.absensi.*') ? 'active' : '' }}" @click="open = false">Absensi</a>
                    <a href="{{ route('admin.galeri.index') }}" wire:navigate class="nav-item-mobile {{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}" @click="open = false">Galeri</a>
                    <a href="{{ route('admin.laporan.index') }}" wire:navigate class="nav-item-mobile {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}" @click="open = false">Laporan</a>
                @else
                    <a href="{{ route('anggota.dashboard') }}" wire:navigate class="nav-item-mobile {{ request()->routeIs('anggota.dashboard') ? 'active' : '' }}" @click="open = false">Dashboard</a>
                    <a href="{{ route('kegiatan.publik.index') }}" wire:navigate class="nav-item-mobile {{ request()->routeIs('kegiatan.publik.*') ? 'active' : '' }}" @click="open = false">Kegiatan</a>
                    <a href="{{ route('anggota.riwayat') }}" wire:navigate class="nav-item-mobile {{ request()->routeIs('anggota.riwayat') ? 'active' : '' }}" @click="open = false">Riwayat</a>
                    <a href="{{ route('anggota.profil') }}" wire:navigate class="nav-item-mobile {{ request()->routeIs('anggota.profil') ? 'active' : '' }}" @click="open = false">Profil</a>
                @endif
                
                <form method="POST" action="{{ route('logout') }}" class="mt-6">
                    @csrf
                    <button class="w-full text-center px-4 py-4 bg-rose-500 text-white rounded-2xl font-black uppercase text-xs tracking-[0.2em]" @click="open = false">
                        Logout
                    </button>
                </form>
            @endauth
        </div>
    </div>
</nav>

<style>
html {
    scroll-behavior: smooth;
    scroll-padding-top: 80px;
}

.nav-item {
    position: relative;
    font-size: 11px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: #64748b;
    padding: 10px 0;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.nav-item::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 50%;
    width: 0%;
    height: 2px;
    background: #059669;
    transition: all 0.3s ease;
    transform: translateX(-50%);
    border-radius: 2px;
}

.nav-item:hover {
    color: #059669;
}

.nav-item.active {
    color: #059669;
}

.nav-item.active::after {
    width: 20px;
}

.nav-item-mobile {
    display: block;
    padding: 12px 16px;
    border-radius: 12px;
    color: #64748b;
    font-size: 12px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.1em;
}

.nav-item-mobile.active {
    background: #ecfdf5;
    color: #059669;
}

[x-cloak] {
    display: none !important;
}
</style>

<script>
function initNavbar() {
    if (window.location.pathname !== '/') return;

    const sections = document.querySelectorAll("section[id], div[id]");
    const navLinks = document.querySelectorAll(".nav-item");
    const mobileLinks = document.querySelectorAll(".nav-item-mobile");

    function setActive(current) {
        navLinks.forEach(link => {
            link.classList.remove("active");
            if (link.dataset.section === current) {
                link.classList.add("active");
            }
        });
        mobileLinks.forEach(link => {
            link.classList.remove("active");
            if (link.dataset.section === current) {
                link.classList.add("active");
            }
        });
    }

    function detectSection() {
        let current = "home";
        sections.forEach(section => {
            const top = section.offsetTop - 120;
            const height = section.offsetHeight;
            if (window.scrollY >= top && window.scrollY < top + height) {
                current = section.id;
            }
        });
        if (window.scrollY < 100) current = "home";
        setActive(current);
    }

    window.removeEventListener("scroll", detectSection);
    window.addEventListener("scroll", detectSection);
    detectSection();
}

document.addEventListener("DOMContentLoaded", initNavbar);
document.addEventListener("livewire:navigated", initNavbar);
</script>