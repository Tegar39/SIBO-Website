@extends('layouts.app')

@section('content')
<div class="bg-white">
    <!-- Hero Section -->
    <div class="relative h-screen min-h-[600px] bg-gradient-to-r from-blue-900 via-indigo-800 to-purple-900 overflow-hidden">
        @if($galeri->isNotEmpty())
            <div class="absolute inset-0">
                <img src="{{ Storage::url($galeri->first()->path_file) }}" alt="Hero" class="w-full h-full object-cover opacity-30">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            </div>
        @endif
        <div class="relative z-10 flex flex-col items-center justify-center h-full text-center text-white px-4 backdrop-blur-sm">
            <h1 class="text-6xl md:text-8xl font-extrabold tracking-tight drop-shadow-lg animate-fade-in-up">
                SIBO
            </h1>
            <p class="mt-4 text-xl md:text-2xl max-w-2xl drop-shadow-md">
                Sistem Informasi Budaya & Olahraga<br>PC DESBOR Kabupaten Kediri
            </p>
            <div class="mt-8 flex flex-col sm:flex-row gap-4">
                <a href="{{ route('kegiatan.publik.index') }}" class="px-8 py-3 bg-white text-blue-900 font-semibold rounded-full shadow-lg hover:bg-gray-100 transition transform hover:scale-105">
                    Lihat Kegiatan
                </a>
                @guest
                    <a href="{{ route('login') }}" class="px-8 py-3 bg-transparent border-2 border-white text-white font-semibold rounded-full hover:bg-white hover:text-blue-900 transition">
                        Login Anggota
                    </a>
                @endguest
            </div>
        </div>
        <!-- Scroll Down Button -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce cursor-pointer" onclick="window.scrollTo({top: window.innerHeight, behavior: 'smooth'})">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </div>

    <!-- Statistik Cards -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 -mt-12 relative z-20">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-2xl shadow-xl p-6 text-center transform hover:-translate-y-2 transition duration-300">
                <div class="text-5xl font-bold text-blue-600">{{ $totalAnggota }}</div>
                <div class="text-gray-600 mt-2">Total Anggota</div>
            </div>
            <div class="bg-white rounded-2xl shadow-xl p-6 text-center transform hover:-translate-y-2 transition duration-300">
                <div class="text-5xl font-bold text-green-600">{{ $totalKegiatan }}</div>
                <div class="text-gray-600 mt-2">Total Kegiatan</div>
            </div>
            <div class="bg-white rounded-2xl shadow-xl p-6 text-center transform hover:-translate-y-2 transition duration-300">
                <div class="text-5xl font-bold text-purple-600">{{ $totalAnggota }}</div>
                <div class="text-gray-600 mt-2">PAC Aktif</div>
            </div>
        </div>
    </div>

    <!-- Kegiatan Terbaru -->
    <div class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-extrabold text-gray-900 text-center mb-4">Kegiatan Terbaru</h2>
            <p class="text-gray-600 text-center mb-12 max-w-2xl mx-auto">Ikuti berbagai kegiatan seru dan bermanfaat dari PC DESBOR.</p>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($kegiatanTerbaru as $kegiatan)
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300 transform hover:-translate-y-1">
                        @if($kegiatan->pamflet)
                            <img src="{{ Storage::url($kegiatan->pamflet->path_file) }}" class="w-full h-56 object-cover">
                        @else
                            <div class="w-full h-56 bg-gray-200 flex items-center justify-center text-gray-500">No image</div>
                        @endif
                        <div class="p-5">
                            <span class="inline-block px-3 py-1 text-xs font-semibold text-blue-800 bg-blue-100 rounded-full">{{ $kegiatan->kategori->nama ?? 'Umum' }}</span>
                            <h3 class="text-xl font-bold text-gray-900 mt-2">{{ $kegiatan->judul }}</h3>
                            <p class="text-gray-600 mt-2 line-clamp-2">{{ Str::limit($kegiatan->deskripsi, 100) }}</p>
                            <div class="mt-4 flex justify-between items-center">
                                <span class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('d M Y') }}</span>
                                <a href="{{ route('kegiatan.publik.show', $kegiatan->id_kegiatan) }}" class="text-blue-600 hover:underline font-medium">Detail →</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center text-gray-500 py-8">Belum ada kegiatan terbaru.</div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Galeri Foto -->
    @if($galeri->count() > 0)
    <div class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-extrabold text-gray-900 text-center mb-4">Galeri Kegiatan</h2>
            <p class="text-gray-600 text-center mb-12 max-w-2xl mx-auto">Dokumentasi momen berharga dari berbagai kegiatan.</p>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                @foreach($galeri->take(8) as $foto)
                    <div class="group relative overflow-hidden rounded-xl shadow-md hover:shadow-xl transition">
                        <img src="{{ Storage::url($foto->path_file) }}" alt="{{ $foto->judul_foto ?? 'Galeri' }}" class="w-full h-48 object-cover group-hover:scale-110 transition duration-500">
                        @if($foto->judul_foto)
                            <div class="absolute inset-x-0 bottom-0 bg-black/60 text-white text-xs p-2 text-center">{{ $foto->judul_foto }}</div>
                        @endif
                    </div>
                @endforeach
            </div>
            @if($galeri->count() > 8)
                <div class="text-center mt-8">
                    <a href="{{ route('galeri.publik.index') ?? '#' }}" class="inline-block px-6 py-2 border border-blue-600 text-blue-600 rounded-full hover:bg-blue-600 hover:text-white transition">Lihat Semua</a>
                </div>
            @endif
        </div>
    </div>
    @endif

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p>&copy; {{ date('Y') }} SIBO - PC DESBOR Kabupaten Kediri. All rights reserved.</p>
            <p class="text-sm mt-2">Jl. Imam Bonjol, Ds. Ngadirejo, Kec. Kota, Kota Kediri</p>
        </div>
    </footer>
</div>
@endsection

@push('styles')
<style>
    @keyframes fade-in-up {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-up {
        animation: fade-in-up 1s ease-out;
    }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush