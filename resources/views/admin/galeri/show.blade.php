@extends('layouts.app')

@section('content')
<div class="pt-20 pb-12 bg-slate-50 min-h-screen font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-6">
            <div>
                <a href="{{ route('admin.galeri.index') }}" class="inline-flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 hover:text-emerald-600 mb-4 transition-colors group">
                    <svg class="w-3 h-3 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Album
                </a>
                <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight leading-none uppercase">
                    {{ $kegiatan->judul }}
                </h1>
                <p class="text-emerald-600 font-bold text-[11px] uppercase tracking-[0.2em] mt-3 flex items-center gap-2">
                    <span class="w-8 h-[2px] bg-emerald-600"></span>
                    Dokumentasi Terpadu
                </p>
            </div>
            
            <div class="flex gap-3">
                <a href="{{ route('admin.galeri.create', $kegiatan->id_kegiatan) }}" class="group bg-slate-800 hover:bg-emerald-600 text-white px-8 py-4 rounded-2xl text-[11px] font-black uppercase tracking-[0.2em] transition-all hover:shadow-xl hover:shadow-emerald-100 flex items-center gap-3">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Upload Dokumentasi
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-8 flex items-center gap-3 bg-emerald-50 border border-emerald-100 text-emerald-700 px-6 py-4 rounded-2xl font-bold text-sm animate-fade-in shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @forelse($fotos as $f)
                <div class="group relative bg-white/70 backdrop-blur-md border border-white rounded-[2rem] p-3 shadow-sm hover:shadow-xl hover:shadow-emerald-100 transition-all duration-500 overflow-hidden">
                    
                    <div class="aspect-square overflow-hidden rounded-[1.5rem] bg-slate-100 mb-4 relative">
                        @php
                            $isVideo = ($f->jenis_media ?? 'foto') === 'video' || str_starts_with((string) $f->mime_type, 'video/');
                        @endphp
                        @if($isVideo)
                            <video src="{{ Storage::url($f->path_file) }}" class="w-full h-full object-cover" muted preload="metadata"></video>
                            <div class="absolute inset-0 flex items-center justify-center bg-black/20">
                                <span class="w-14 h-14 rounded-full bg-white/90 text-emerald-700 flex items-center justify-center shadow-lg text-xl">▶</span>
                            </div>
                        @else
                            <img src="{{ Storage::url($f->path_file) }}" 
                                 class="w-full h-full object-cover transition-all duration-700 scale-110 group-hover:scale-100">
                        @endif
                        
                        <div class="absolute inset-0 bg-emerald-900/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <form action="{{ route('admin.galeri.destroy', $f->id_foto) }}" method="POST" class="translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Hapus dokumentasi ini?')" class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-red-500 hover:bg-red-500 hover:text-white transition-all shadow-lg">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <div class="px-2 pb-2">
                        <div class="flex justify-between items-start gap-4">
                            <div>
                                <p class="text-[10px] font-black uppercase text-slate-800 tracking-wider truncate max-w-[120px]">
                                    {{ $f->judul_foto ?? 'Dokumentasi' }}
                                </p>
                                <p class="text-[8px] font-bold text-slate-400 uppercase mt-1">
                                    {{ (($f->jenis_media ?? 'foto') === 'video') ? 'Video' : 'Foto' }} · {{ $f->created_at->format('d M Y') }}
                                </p>
                            </div>
                            
                            @if($f->is_unggulan)
                                <div class="bg-emerald-100 text-emerald-600 p-1.5 rounded-lg">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if($f->is_unggulan)
                        <div class="absolute top-6 left-6 z-10">
                            <span class="bg-slate-800/80 backdrop-blur-sm text-white text-[8px] font-black px-3 py-1 rounded-full uppercase tracking-widest shadow-lg">
                                Utama
                            </span>
                        </div>
                    @endif
                </div>
            @empty
                <div class="col-span-full py-16 bg-white/50 backdrop-blur-sm border-2 border-dashed border-slate-200 rounded-[3rem] text-center">
                    <div class="flex justify-center mb-4">
                        <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center text-slate-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    </div>
                    <p class="text-slate-400 font-bold uppercase tracking-widest text-[10px] italic">Album masih kosong</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in { animation: fade-in 0.4s ease-out forwards; }
</style>
@endsection