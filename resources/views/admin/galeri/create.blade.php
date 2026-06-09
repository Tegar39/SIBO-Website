@extends('layouts.app')

@section('content')
<div class="pt-20 pb-12 bg-slate-50 min-h-screen font-sans">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-6">
            <a href="{{ route('admin.galeri.show', $kegiatan->id_kegiatan) }}" class="inline-flex items-center gap-2 text-[11px] font-black uppercase tracking-[0.2em] text-slate-400 hover:text-rose-500 transition-colors group">
                <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Batal & Kembali
            </a>
        </div>

        <div class="bg-white/70 backdrop-blur-md rounded-[2.5rem] border border-white/50 shadow-xl overflow-hidden">
            
            <div class="p-8 md:p-10 border-b border-white flex flex-col md:flex-row md:items-center justify-between gap-6 bg-white/30 text-center md:text-left">
                <div>
                    <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight leading-none">
                        Bulk <span class="text-emerald-600">Upload</span>
                    </h1>
                    <div class="flex items-center justify-center md:justify-start gap-2 mt-3 text-slate-400">
                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span class="text-xs font-bold uppercase tracking-widest">{{ $kegiatan->judul }}</span>
                    </div>
                </div>
                <div class="w-16 h-16 bg-emerald-600 rounded-2xl mx-auto md:mx-0 flex items-center justify-center text-white shadow-lg shadow-emerald-200">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                </div>
            </div>

            <div class="p-8 md:p-10">
                <form action="{{ route('admin.galeri.store', $kegiatan->id_kegiatan) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-10 p-10 bg-slate-50/50 border-2 border-dashed border-slate-200 rounded-[2rem] relative group transition-all hover:border-emerald-400 hover:bg-white text-center">
                        <label class="block cursor-pointer">
                            <div class="mb-4 flex justify-center">
                                <div class="p-4 bg-emerald-50 text-emerald-600 rounded-full group-hover:scale-110 transition-transform">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                </div>
                            </div>
                            <span class="block text-[11px] font-black text-slate-500 uppercase tracking-[0.3em] mb-2 group-hover:text-emerald-600 transition-colors">Pilih Foto / Video Kegiatan</span>
                            <span class="block text-[9px] font-medium text-slate-400 uppercase tracking-widest mb-6">Anda dapat memilih banyak file sekaligus. Format: JPG, PNG, WEBP, MP4, MOV, M4V, WEBM.</span>
                            
                            <input type="file" id="fotos" name="fotos[]" accept="image/*,video/*" multiple required 
                                   class="block w-full text-xs font-bold text-slate-400
                                          file:mr-4 file:py-2.5 file:px-6
                                          file:rounded-xl file:border-0
                                          file:text-[10px] file:font-black file:uppercase file:tracking-widest
                                          file:bg-slate-800 file:text-white
                                          hover:file:bg-emerald-600 file:transition-all file:cursor-pointer">
                        </label>
                    </div>

                    <div id="dynamic-container" class="space-y-4">
                        <div class="text-center py-12 rounded-3xl border border-slate-100 bg-slate-50/30">
                            <div class="opacity-30 flex justify-center mb-3">
                                <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            </div>
                            <p class="text-slate-400 font-bold text-[10px] uppercase tracking-[0.2em]">Form detail dokumentasi akan muncul secara otomatis</p>
                        </div>
                    </div>

                    <div class="mt-12 pt-8 border-t border-white flex justify-end">
                        <button type="submit" class="group relative bg-slate-800 hover:bg-emerald-600 text-white font-black px-12 py-4 rounded-2xl text-[11px] uppercase tracking-[0.2em] transition-all hover:shadow-xl hover:shadow-emerald-200 active:scale-95 flex items-center gap-3">
                            <span>Mulai Proses Upload</span>
                            <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('fotos').addEventListener('change', function(e) {
        const container = document.getElementById('dynamic-container');
        container.innerHTML = '';
        
        const files = e.target.files;
        if (files.length > 0) {
            const header = document.createElement('div');
            header.className = 'flex items-center gap-2 mb-6 px-2';
            header.innerHTML = `
                <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                <h3 class="text-[10px] font-black uppercase tracking-widest text-emerald-700 italic">Lengkapi Informasi Dokumentasi (${files.length} Item):</h3>
            `;
            container.appendChild(header);
            
            for (let i = 0; i < files.length; i++) {
                const row = document.createElement('div');
                row.className = 'grid grid-cols-1 md:grid-cols-3 gap-6 items-center p-6 bg-white/50 border border-white rounded-3xl shadow-sm transition-all hover:shadow-md hover:bg-white';
                row.innerHTML = `
                    <div class="flex items-center gap-3 overflow-hidden">
                        <div class="min-w-[40px] h-10 bg-slate-100 rounded-xl flex items-center justify-center text-[10px] font-black text-slate-400">
                            ${i+1}
                        </div>
                        <div class="text-[10px] font-bold truncate text-slate-500 italic uppercase">${files[i].name}</div>
                    </div>
                    <div class="relative space-y-2">
                        <input type="text" name="judul[]" placeholder="Berikan judul dokumentasi..." 
                            class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-[10px] font-bold uppercase focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all placeholder:text-slate-300">
                        <input type="text" name="deskripsi[]" placeholder="Deskripsi singkat opsional..." 
                            class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-[10px] font-semibold focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all placeholder:text-slate-300">
                    </div>
                    <div class="flex justify-center md:justify-end">
                        <label class="relative inline-flex items-center cursor-pointer group/item">
                            <input type="checkbox" name="unggulan[]" value="${i}" class="sr-only peer">
                            <div class="w-10 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-emerald-500"></div>
                            <span class="ml-3 text-[9px] font-black uppercase tracking-widest text-slate-400 peer-checked:text-emerald-600 transition-colors">Utama</span>
                        </label>
                    </div>
                `;
                container.appendChild(row);
            }
        }
    });
</script>

<style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    #dynamic-container > div { animation: fade-in 0.3s ease-out forwards; }
</style>
@endsection