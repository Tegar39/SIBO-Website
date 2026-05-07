@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen py-16 md:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-12 md:mb-16">
            <h1 class="text-4xl md:text-5xl font-black text-slate-900 tracking-tight">
                Galeri <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-green-400">Kegiatan</span>
            </h1>
            <p class="text-slate-500 max-w-2xl mx-auto mt-4">
                Dokumentasi foto-foto kegiatan PC DESBOR Kabupaten Kediri
            </p>
        </div>

        <!-- Filter by Kegiatan -->
        <div class="mb-10 flex flex-wrap justify-center gap-4">
            <a href="{{ route('galeri.publik.index') }}" 
               class="px-6 py-2 rounded-full text-sm font-bold transition-all {{ !request('kegiatan') ? 'bg-green-600 text-white shadow-md' : 'bg-white text-slate-600 hover:bg-green-50 border border-slate-200' }}">
                Semua Kegiatan
            </a>
            @foreach($kegiatans as $keg)
                <a href="{{ route('galeri.publik.index', ['kegiatan' => $keg->id_kegiatan]) }}" 
                   class="px-6 py-2 rounded-full text-sm font-bold transition-all {{ request('kegiatan') == $keg->id_kegiatan ? 'bg-green-600 text-white shadow-md' : 'bg-white text-slate-600 hover:bg-green-50 border border-slate-200' }}">
                    {{ $keg->judul }}
                </a>
            @endforeach
        </div>

        <!-- Galeri Grid -->
        @if($galeri->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($galeri as $foto)
                    <div class="group relative overflow-hidden rounded-2xl bg-white shadow-md hover:shadow-xl transition-all duration-300 cursor-pointer"
                         onclick="openLightbox('{{ Storage::url($foto->path_file) }}', '{{ addslashes($foto->judul_foto ?? $foto->kegiatan->judul) }}')">
                        <div class="aspect-square overflow-hidden bg-slate-100">
                            <img src="{{ Storage::url($foto->path_file) }}" 
                                 alt="{{ $foto->judul_foto ?? 'Galeri' }}"
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4">
                            <h3 class="text-white font-bold text-sm md:text-base line-clamp-1">{{ $foto->judul_foto ?? $foto->kegiatan->judul }}</h3>
                            <p class="text-green-300 text-xs mt-1">
                                {{ \Carbon\Carbon::parse($foto->kegiatan->tanggal)->translatedFormat('d M Y') }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-12">
                {{ $galeri->appends(request()->query())->links() }}
            </div>
        @else
            <div class="text-center py-20 bg-white rounded-2xl shadow-sm border">
                <svg class="w-16 h-16 mx-auto text-slate-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                <p class="text-slate-500">Belum ada foto galeri untuk kegiatan ini.</p>
            </div>
        @endif
    </div>
</div>

<!-- Lightbox Modal (sama seperti di home) -->
<div id="lightbox" class="fixed inset-0 bg-slate-950/90 backdrop-blur-md z-[100] hidden items-center justify-center" onclick="closeLightbox()">
    <div class="relative max-w-6xl mx-auto p-4 w-full flex flex-col items-center justify-center h-full" onclick="event.stopPropagation()">
        <button class="absolute top-6 right-6 md:top-10 md:right-10 w-12 h-12 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center text-white backdrop-blur-sm transition-all" onclick="closeLightbox()">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        <img id="lightbox-img" src="" class="max-w-full max-h-[80vh] rounded-2xl shadow-2xl object-contain">
        <div class="mt-6 px-6 py-3 bg-white/10 backdrop-blur-md rounded-full ring-1 ring-white/20">
            <p id="lightbox-caption" class="text-white font-semibold text-lg text-center"></p>
        </div>
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
</script>
@endpush

@push('styles')
<style>
    .line-clamp-1 {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush
@endsection