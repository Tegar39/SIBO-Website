@extends('layouts.app')

@section('content')
<div class="bg-white">
    <!-- Hero Section -->
    <div class="relative overflow-hidden h-screen min-h-[600px]" 
        onmouseenter="document.getElementById('hero-overlay').classList.add('hovered')"
        onmouseleave="document.getElementById('hero-overlay').classList.remove('hovered')">
        @php
            $heroImage = null;
            $unggulan = $galeri->where('is_unggulan', 1)->first();
            if ($unggulan && $unggulan->path_file) {
                $heroImage = Storage::url($unggulan->path_file);
            } elseif ($kegiatanTerbaru->isNotEmpty() && $kegiatanTerbaru->first()->pamflet) {
                $heroImage = Storage::url($kegiatanTerbaru->first()->pamflet->path_file);
            }
        @endphp
        @if($heroImage)
            <div class="absolute inset-0">
                <img src="{{ $heroImage }}" alt="Hero Background" class="w-full h-full object-cover">
                <div id="hero-overlay" class="absolute inset-0 bg-black/80 transition-all duration-500"></div>
            </div>
        @else
            <div class="absolute inset-0 bg-gradient-to-br from-blue-900 via-indigo-800 to-purple-900"></div>
        @endif

        <div class="relative z-10 flex flex-col items-center justify-center h-full text-center text-white px-4">
            <div class="animate-fade-in-up">
                <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight drop-shadow-lg">SIBO</h1>
                <p class="mt-4 text-xl md:text-2xl max-w-2xl drop-shadow-md">Sistem Informasi Budaya & Olahraga<br>PC DESBOR Kabupaten Kediri</p>
                <div class="mt-8 flex flex-col sm:flex-row justify-center gap-4">
                    <!-- Tombol Lihat Kegiatan (efek slide hanya pada tombol) -->
                    <a href="{{ route('kegiatan.publik.index') }}" wire:navigate 
                    class="relative px-8 py-3 font-semibold rounded-full shadow-lg overflow-hidden inline-block bg-white text-green-600 hover:text-white transition-colors duration-300 group">
                        <span class="relative z-10">Lihat Kegiatan</span>
                        <span class="absolute inset-0 bg-green-600 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-500 ease-out"></span>
                    </a>
                </div>
            </div>
        </div>

        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 cursor-pointer z-30" onclick="window.scrollTo({top: window.innerHeight, behavior: 'smooth'})">
            <div class="animate-bounce bg-white/20 rounded-full p-2 hover:bg-white/40 transition">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
            </div>
        </div>
    </div>

    <style>
        #hero-overlay {
            transition-property: background-color;
            transition-duration: 0.5s;
            transition-timing-function: ease;
        }
        #hero-overlay.hovered {
            background-color: rgba(0, 0, 0, 0.6) !important;
        }
        .animate-infinite-scroll:hover {
            animation-play-state: paused;
        }
        .animate-infinite-scroll {
            animation: infinite-scroll 30s linear infinite;
        }
    </style>

    <!-- Tentang SIBO (Profil) -->
    <div id="tentang" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
            <div class="relative">
                <div class="mb-8 relative">
                    <span class="text-green-700 font-black text-xs uppercase tracking-[0.3em] mb-2 block">Profil Organisasi</span>
                    <h2 class="text-5xl font-black text-gray-900 tracking-tighter uppercase italic leading-none relative z-10">
                        Tentang <span class="text-green-700">SIBO</span>
                    </h2>
                    <div class="absolute -bottom-2 -left-2 w-32 h-4 bg-yellow-400 -z-10 opacity-60"></div>
                </div>
                
                <div class="space-y-4 border-l-4 border-gray-900 pl-6">
                    <p class="text-gray-700 leading-relaxed font-medium">
                        SIBO (Sistem Informasi Budaya & Olahraga) adalah platform digital yang dikembangkan untuk PC DESBOR Kabupaten Kediri dalam rangka mendigitalisasi manajemen organisasi.
                    </p>
                    <p class="text-gray-600 leading-relaxed">
                        Dengan SIBO, diharapkan seluruh anggota dapat mengakses informasi kegiatan secara real-time, mendaftar kegiatan dengan mudah, dan melihat riwayat keikutsertaan.
                    </p>
                </div>
            </div>
            <div class="flex justify-center relative">
                <div class="absolute inset-0 border-4 border-green-700 translate-x-4 translate-y-4 -z-10"></div>
                <img src="{{ asset('images/logo-desbor.png') }}" alt="PC DESBOR" class="bg-white p-4 border-4 border-gray-900 shadow-xl w-full max-w-md object-cover transform hover:-translate-y-2 transition-transform duration-500">
            </div>
        </div>
    </div>

    <!-- Statistik -->
    <div id="statistik" class="relative py-32 overflow-hidden bg-white transition-colors duration-700" id="stat-container">
        <div class="absolute inset-0 z-0 opacity-0 transition-all duration-[1200ms] ease-out scale-125" id="stat-bg">
            @if($heroImage)
                <img src="{{ $heroImage }}" class="w-full h-full object-cover grayscale brightness-[0.3]">
            @endif
            <div class="absolute inset-0 bg-gradient-to-b from-black/20 via-transparent to-black/20"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 relative z-10">
            <div class="text-center mb-24 transition-all duration-700" id="stat-content">
                <div class="inline-block relative">
                    <h2 class="text-6xl md:text-8xl font-black text-gray-900 uppercase tracking-tighter italic leading-none transition-colors duration-500" id="stat-title">
                        DATA <span class="text-green-600 transition-colors duration-500" id="stat-highlight">JUMLAH</span>
                    </h2>
                    <div class="absolute -bottom-2 left-0 w-full h-3 bg-yellow-400 -rotate-1 -z-10 opacity-90"></div>
                </div>
                <p class="text-gray-500 font-bold mt-8 text-[11px] uppercase tracking-[0.5em] max-w-lg mx-auto" id="stat-subtitle">
                    Real-time rekapitulasi anggota se-Kabupaten Kediri
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-16 relative z-20">
                @php
                    $stats = [
                        ['label' => 'Total Anggota', 'val' => $totalAnggota ?? 0],
                        ['label' => 'Total Kegiatan', 'val' => $totalKegiatan ?? 0],
                        ['label' => 'PAC Aktif', 'val' => $totalPac ?? 0],
                    ];
                @endphp

                @foreach($stats as $s)
                <div class="group text-center">
                    <div class="text-8xl font-black text-gray-900 tracking-tighter mb-2 transition-colors duration-500 stat-number">{{ $s['val'] }}</div>
                    <div class="text-green-600 font-black uppercase italic tracking-widest text-xs transition-colors duration-500 stat-label">{{ $s['label'] }}</div>
                    <div class="w-10 h-1.5 bg-green-600 mx-auto mt-6 transition-all group-hover:w-20"></div>
                </div>
                @endforeach
            </div>
            
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full text-center pointer-events-none select-none z-0">
                <span class="stat-outline-dynamic text-[15rem] md:text-[22rem] font-black italic uppercase tracking-tighter block leading-none opacity-5 transition-all duration-700">
                    STATISTIK
                </span>
            </div>
        </div>
    </div>

    <!-- Kegiatan Terbaru dengan efek hover zoom + darken -->
    <div id="kegiatan-terbaru" class="bg-[#f2f2f2] py-20 border-y border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex items-end justify-between mb-10 border-b-2 border-gray-800 pb-4">
                <div>
                    <h2 class="text-3xl font-black text-gray-900 tracking-tighter uppercase italic leading-none">
                        Informasi & <span class="text-green-600">Kegiatan</span>
                    </h2>
                    <p class="text-gray-500 font-bold mt-2 text-[10px] uppercase tracking-widest">Latest from PC DESBOR Kediri</p>
                </div>
                <div class="hidden md:block">
                    <a href="{{ route('kegiatan.publik.index') }}" class="text-[11px] font-black border-2 border-gray-800 px-5 py-2 hover:bg-gray-800 hover:text-white transition-all uppercase tracking-tighter">
                        View All →
                    </a>
                </div>
            </div>

            <div class="relative group">
                <div class="flex overflow-x-auto pb-12 gap-8 snap-x scrollbar-hide" id="scroll-container">
                    @forelse($kegiatanTerbaru as $kegiatan)
                        <div class="flex-none w-[280px] snap-start">
                            <div class="bg-white border border-gray-300 shadow-sm hover:shadow-2xl transition-all duration-700 ease-[cubic-bezier(0.23,1,0.32,1)] flex flex-col h-full group/card relative rounded">
                                
                                <div class="relative aspect-[11/10] overflow-hidden bg-gray-100 border-b border-gray-100">
                                    @php
                                        $imgPath = ($kegiatan->pamflet && $kegiatan->pamflet->path_file) 
                                                   ? Storage::url($kegiatan->pamflet->path_file) 
                                                   : null;
                                    @endphp
                                    
                                    @if($imgPath)
                                        <img src="{{ $imgPath }}" 
                                             alt="{{ $kegiatan->judul }}"
                                             class="w-full h-full object-cover origin-center transition-transform duration-700 ease-[cubic-bezier(0.23,1,0.32,1)] group-hover/card:scale-110 group-hover/card:rotate-3">
                                        
                                        <div class="absolute inset-0 bg-black/0 group-hover/card:bg-black/15 transition-colors duration-500 z-0"></div>
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-300 italic text-xs">
                                            No Poster
                                        </div>
                                    @endif

                                    <div class="absolute top-3 left-3 z-10">
                                        <span class="bg-black text-white text-[9px] font-black px-3 py-1 uppercase tracking-widest shadow">
                                            {{ $kegiatan->kategori->nama ?? 'EVENT' }}
                                        </span>
                                    </div>
                                </div>

                                <div class="p-5 flex-grow flex flex-col relative z-10 bg-white">
                                    <span class="text-[9px] font-bold text-gray-400 mb-2 tracking-widest uppercase">
                                         Kediri / {{ \Carbon\Carbon::parse($kegiatan->tanggal)->translatedFormat('d M Y') }}
                                    </span>
                                    
                                    <h3 class="text-base font-bold text-gray-900 leading-tight mb-3 transition-colors group-hover/card:text-green-700 min-h-[40px] line-clamp-2">
                                        『{{ $kegiatan->judul }}』
                                    </h3>
                                    
                                    <p class="text-xs text-gray-600 leading-relaxed line-clamp-3 mb-6 font-medium">
                                        {{ $kegiatan->deskripsi }}
                                    </p>

                                    <div class="mt-auto border-t border-gray-100 pt-3">
                                        <a href="{{ route('kegiatan.publik.show', $kegiatan->id_kegiatan) }}" 
                                           class="inline-block text-[10px] font-black uppercase tracking-tighter text-green-700 hover:text-gray-950 transition-colors">
                                            Check details →
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="w-full text-center py-24 bg-gray-100 rounded border-2 border-dashed border-gray-300">
                            <p class="text-gray-400 font-bold uppercase tracking-widest text-xs">Belum ada pengumuman terbaru</p>
                        </div>
                    @endforelse
                </div>

                <div class="md:hidden flex justify-center mt-6">
                    <div class="flex gap-1 animate-pulse">
                        <div class="w-1.5 h-1 bg-gray-300"></div>
                        <div class="w-6 h-1 bg-green-600"></div>
                        <div class="w-1.5 h-1 bg-gray-300"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Galeri Foto dengan Carousel Horizontal Loop (dengan efek darken saat hover) -->
    @if($galeri->count() > 0)
    <div id="galeri" class="py-20 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex items-end justify-between mb-12 border-b-4 border-gray-900 pb-6">
                <div>
                    <span class="bg-yellow-400 text-black text-[10px] font-black px-3 py-1 uppercase tracking-widest mb-3 inline-block">Visual Archive</span>
                    <h2 class="text-4xl md:text-5xl font-black text-gray-900 tracking-tighter uppercase italic leading-none">
                        Galeri <span class="text-green-700">Kegiatan</span>
                    </h2>
                </div>
                <div class="hidden md:block">
                    <p class="text-gray-400 text-right font-black text-[10px] uppercase tracking-tighter leading-tight">
                        Momen Berharga<br>PC DESBOR
                    </p>
                </div>
            </div>

            <div class="relative w-full overflow-hidden">
                <div class="flex gap-4 animate-infinite-scroll">
                    @foreach($galeri as $foto)
                        @php
                            $fotoPath = $foto->path_file ? Storage::url($foto->path_file) : null;
                        @endphp
                        @if($fotoPath)
                            <div class="flex-none w-72 h-72 group relative overflow-hidden shadow-md cursor-pointer"
                                onclick="openLightbox('{{ $fotoPath }}', '{{ addslashes($foto->judul_foto ?? '') }}')">
                                <div class="w-full h-full overflow-hidden">
                                    <img src="{{ $fotoPath }}" alt="{{ $foto->judul_foto ?? 'Galeri' }}" 
                                        class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110 group-hover:rotate-1">
                                </div>
                                <!-- Overlay darken saat hover -->
                                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                @if($foto->judul_foto)
                                    <div class="absolute inset-x-0 bottom-0 bg-black/60 text-white text-xs p-2 text-center opacity-0 group-hover:opacity-100 transition">{{ $foto->judul_foto }}</div>
                                @endif
                            </div>
                        @endif
                    @endforeach
                    <!-- Duplikasi untuk loop -->
                    @foreach($galeri as $foto)
                        @php
                            $fotoPath = $foto->path_file ? Storage::url($foto->path_file) : null;
                        @endphp
                        @if($fotoPath)
                            <div class="flex-none w-72 h-72 group relative overflow-hidden shadow-md cursor-pointer"
                                onclick="openLightbox('{{ $fotoPath }}', '{{ addslashes($foto->judul_foto ?? '') }}')">
                                <div class="w-full h-full overflow-hidden">
                                    <img src="{{ $fotoPath }}" alt="{{ $foto->judul_foto ?? 'Galeri' }}" 
                                        class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110 group-hover:rotate-1">
                                </div>
                                <!-- Overlay darken saat hover -->
                                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                @if($foto->judul_foto)
                                    <div class="absolute inset-x-0 bottom-0 bg-black/60 text-white text-xs p-2 text-center opacity-0 group-hover:opacity-100 transition">{{ $foto->judul_foto }}</div>
                                @endif
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<!-- Lightbox Modal -->
<div id="lightbox" class="fixed inset-0 bg-black/80 z-50 hidden items-center justify-center" onclick="closeLightbox()">
    <div class="relative max-w-4xl mx-auto p-4">
        <img id="lightbox-img" src="" class="max-w-full max-h-screen rounded-lg shadow-2xl">
        <p id="lightbox-caption" class="text-white text-center mt-2"></p>
        <button class="absolute top-4 right-4 text-white text-3xl" onclick="closeLightbox()">&times;</button>
    </div>
</div>

@push('scripts')
<script>
    function openLightbox(src, caption) {
        document.getElementById('lightbox-img').src = src;
        document.getElementById('lightbox-caption').innerText = caption;
        document.getElementById('lightbox').classList.remove('hidden');
        document.getElementById('lightbox').classList.add('flex');
        document.body.style.overflow = 'hidden';
    }
    function closeLightbox() {
        document.getElementById('lightbox').classList.add('hidden');
        document.getElementById('lightbox').classList.remove('flex');
        document.body.style.overflow = '';
    }
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeLightbox();
    });

    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('statistik');

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    container.classList.add('stat-active');
                } else {
                    container.classList.remove('stat-active');
                }
            });
        }, { 
            threshold: 0.4 // Muncul pas 40% section masuk layar
        });

        observer.observe(container);
    });
</script>
@endpush

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
    .group:hover .group-hover\:rotate-1 {
        transform: scale(1.1) rotate(1deg);
    }
    .tracking-tighter { letter-spacing: -0.05em; }
    .group-hover\/card\:scale-110 {
        transform: scale(1.1);
        /* Opsional: tambahkan sedikit rotasi agar lebih dinamis seperti desain majalah */
        /* transform: scale(1.1) rotate(1deg); */
    }

    img {
        backface-visibility: hidden;
        -webkit-font-smoothing: subpixel-antialiased;
        transform: translate-z(0);
    }
    .line-clamp-2, .line-clamp-3 {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    .line-clamp-2 { -webkit-line-clamp: 2; }
    .line-clamp-3 { -webkit-line-clamp: 3; }

    .stat-outline-dynamic {
        color: transparent;
        -webkit-text-stroke: 1.5px #000;
    }
    
    /* State saat aktif (Terkena Sorot) */
    .stat-active #stat-bg {
        opacity: 0.4 !important; /* Intensitas gambar 40% */
        transform: scale(1) !important; /* Efek Zoom Out */
    }

    .stat-active {
        background-color: #050505 !important; /* Berubah jadi hitam */
    }

    .stat-active #stat-title, 
    .stat-active .stat-number { color: white !important; }
    
    .stat-active #stat-highlight,
    .stat-active .stat-label { color: #22c55e !important; } /* Green-500 */

    .stat-active .stat-outline-dynamic {
        -webkit-text-stroke: 1.5px rgba(255, 255, 255, 0.2);
    }
</style>
@endpush
@endsection