@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen py-16 md:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 md:mb-16">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-emerald-50 text-emerald-700 text-[11px] font-black uppercase tracking-[0.25em] mb-4">
                Dokumentasi Kegiatan
            </div>
            <h1 class="text-4xl md:text-5xl font-black text-slate-900 tracking-tight">
                Galeri <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-green-400">SIBO</span>
            </h1>
            <p class="text-slate-500 max-w-2xl mx-auto mt-4">
                Dokumentasi dikelompokkan berdasarkan kegiatan agar lebih rapi dan mudah dicari.
            </p>
        </div>

        @if($selectedKegiatan)
            <div class="mb-8 flex flex-col md:flex-row md:items-end md:justify-between gap-5">
                <div>
                    <a href="{{ route('galeri.publik.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-emerald-700 hover:text-emerald-900 mb-4">
                        <span>←</span> Kembali ke folder kegiatan
                    </a>
                    <h2 class="text-2xl md:text-3xl font-black text-slate-900">{{ $selectedKegiatan->judul }}</h2>
                    <p class="text-slate-500 mt-2">
                        {{ \Carbon\Carbon::parse($selectedKegiatan->tanggal)->translatedFormat('d F Y') }} · {{ $selectedKegiatan->lokasi }}
                    </p>
                </div>
                <div class="px-5 py-3 rounded-2xl bg-white border border-slate-200 shadow-sm text-sm font-bold text-slate-600">
                    {{ $galeri->total() }} dokumentasi
                </div>
            </div>

            @if($galeri->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($galeri as $foto)
                        @php
                            $url = Storage::url($foto->path_file);
                            $isVideo = ($foto->jenis_media ?? 'foto') === 'video' || str_starts_with((string) $foto->mime_type, 'video/');
                            $judul = $foto->judul_foto ?: $selectedKegiatan->judul;
                        @endphp
                        <div class="group relative overflow-hidden rounded-2xl bg-white shadow-md hover:shadow-xl transition-all duration-300">
                            <div class="aspect-square overflow-hidden bg-slate-100 relative">
                                @if($isVideo)
                                    <video src="{{ $url }}" class="w-full h-full object-cover" muted preload="metadata"></video>
                                    <div class="absolute inset-0 flex items-center justify-center bg-black/20">
                                        <div class="w-16 h-16 rounded-full bg-white/90 text-emerald-700 flex items-center justify-center shadow-lg text-2xl">▶</div>
                                    </div>
                                @else
                                    <img src="{{ $url }}" alt="{{ $judul }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                @endif
                            </div>
                            <div class="p-5">
                                <div class="text-[10px] font-black uppercase tracking-[0.2em] {{ $isVideo ? 'text-amber-600' : 'text-emerald-600' }} mb-2">
                                    {{ $isVideo ? 'Video' : 'Foto' }} Dokumentasi
                                </div>
                                <h3 class="text-slate-900 font-black text-base line-clamp-2">{{ $judul }}</h3>
                                @if($foto->deskripsi)
                                    <p class="text-slate-500 text-sm mt-2 line-clamp-2">{{ $foto->deskripsi }}</p>
                                @endif
                                <button type="button"
                                    onclick="{{ $isVideo ? 'openVideo' : 'openLightbox' }}('{{ $url }}', '{{ addslashes($judul) }}')"
                                    class="mt-4 w-full px-4 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-black uppercase tracking-widest transition-all">
                                    {{ $isVideo ? 'Putar Video' : 'Lihat Foto' }}
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-12">{{ $galeri->appends(request()->query())->links() }}</div>
            @else
                <div class="text-center py-20 bg-white rounded-2xl shadow-sm border">
                    <p class="text-slate-500">Belum ada dokumentasi untuk kegiatan ini.</p>
                </div>
            @endif
        @else
            @if($kegiatans->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">
                    @foreach($kegiatans as $kegiatan)
                        @php
                            $cover = $kegiatan->galeris->first();
                            $coverUrl = $cover?->path_file ? Storage::url($cover->path_file) : null;
                            $coverIsVideo = $cover && (($cover->jenis_media ?? 'foto') === 'video' || str_starts_with((string) $cover->mime_type, 'video/'));
                        @endphp
                        <a href="{{ route('galeri.publik.index', ['kegiatan' => $kegiatan->id_kegiatan]) }}" class="group block bg-white rounded-[2rem] overflow-hidden border border-slate-100 shadow-md hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
                            <div class="h-52 bg-emerald-50 relative overflow-hidden">
                                @if($coverUrl && !$coverIsVideo)
                                    <img src="{{ $coverUrl }}" alt="{{ $kegiatan->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @elseif($coverUrl && $coverIsVideo)
                                    <video src="{{ $coverUrl }}" class="w-full h-full object-cover" muted preload="metadata"></video>
                                    <div class="absolute inset-0 flex items-center justify-center bg-black/20 text-white text-4xl">▶</div>
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-emerald-700">
                                        <svg class="w-24 h-24 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 7a2 2 0 012-2h4l2 2h8a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V7z" /></svg>
                                    </div>
                                @endif
                                <div class="absolute top-4 left-4 px-4 py-2 rounded-full bg-white/90 backdrop-blur text-[10px] font-black uppercase tracking-widest text-emerald-700 shadow">
                                    Folder Kegiatan
                                </div>
                            </div>
                            <div class="p-6">
                                <h2 class="text-xl font-black text-slate-900 leading-tight group-hover:text-emerald-700 transition-colors">{{ $kegiatan->judul }}</h2>
                                <p class="text-slate-500 text-sm mt-3">
                                    {{ \Carbon\Carbon::parse($kegiatan->tanggal)->translatedFormat('d F Y') }} · {{ $kegiatan->lokasi }}
                                </p>
                                <div class="mt-5 flex items-center justify-between">
                                    <span class="inline-flex items-center px-4 py-2 rounded-full bg-slate-100 text-slate-600 text-xs font-bold">
                                        {{ $kegiatan->galeris_count }} file dokumentasi
                                    </span>
                                    <span class="text-emerald-700 font-black text-sm">Buka →</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="mt-12">{{ $kegiatans->links() }}</div>
            @else
                <div class="text-center py-20 bg-white rounded-2xl shadow-sm border">
                    <p class="text-slate-500">Belum ada folder dokumentasi kegiatan yang tersedia.</p>
                </div>
            @endif
        @endif
    </div>
</div>

<div id="lightbox" class="fixed inset-0 bg-slate-950/90 backdrop-blur-md z-[100] hidden items-center justify-center" onclick="closeMediaModal()">
    <div class="relative max-w-6xl mx-auto p-4 w-full flex flex-col items-center justify-center h-full" onclick="event.stopPropagation()">
        <button class="absolute top-5 right-5 md:top-8 md:right-8 w-14 h-14 bg-white text-slate-900 hover:bg-rose-500 hover:text-white rounded-full flex items-center justify-center shadow-2xl text-3xl font-black transition-all z-[120]" onclick="closeMediaModal()" aria-label="Tutup galeri">×</button>
        <img id="lightbox-img" src="" class="hidden max-w-full max-h-[80vh] rounded-2xl shadow-2xl object-contain">
        <video id="lightbox-video" src="" controls class="hidden max-w-full max-h-[80vh] rounded-2xl shadow-2xl bg-black"></video>
        <div class="mt-6 px-6 py-3 bg-white/10 backdrop-blur-md rounded-full ring-1 ring-white/20">
            <p id="lightbox-caption" class="text-white font-semibold text-lg text-center"></p>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function openLightbox(src, caption) {
        document.getElementById('lightbox-img').src = src;
        document.getElementById('lightbox-img').classList.remove('hidden');
        document.getElementById('lightbox-video').classList.add('hidden');
        document.getElementById('lightbox-video').pause();
        showMediaModal(caption);
    }

    function openVideo(src, caption) {
        document.getElementById('lightbox-video').src = src;
        document.getElementById('lightbox-video').classList.remove('hidden');
        document.getElementById('lightbox-img').classList.add('hidden');
        showMediaModal(caption);
    }

    function showMediaModal(caption) {
        document.getElementById('lightbox-caption').innerText = caption;
        document.getElementById('lightbox').classList.remove('hidden');
        document.getElementById('lightbox').classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeMediaModal() {
        const video = document.getElementById('lightbox-video');
        video.pause();
        video.src = '';
        document.getElementById('lightbox-img').src = '';
        document.getElementById('lightbox').classList.add('hidden');
        document.getElementById('lightbox').classList.remove('flex');
        document.body.style.overflow = '';
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeMediaModal();
    });
</script>
@endpush

@push('styles')
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush
@endsection
