@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 border-b-4 border-gray-900 pb-6 gap-4">
            <div>
                <h1 class="text-4xl font-black text-gray-900 uppercase italic tracking-tighter">
                    Galeri <span class="text-green-700">Kegiatan</span>
                </h1>
                <p class="text-gray-500 text-[10px] font-black uppercase tracking-[0.3em] mt-1">Dokumentasi Budaya & Olahraga PC DESBOR</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($kegiatans as $k)
                <a href="{{ route('admin.galeri.show', $k->id_kegiatan) }}" 
                   class="group relative bg-white border-2 border-gray-900 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-1 hover:translate-y-1 transition-all overflow-hidden">
                    
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <span class="bg-yellow-400 text-gray-900 text-[10px] font-black px-2 py-1 uppercase tracking-widest">
                                {{ \Carbon\Carbon::parse($k->tanggal)->format('d/m/Y') }}
                            </span>
                            <span class="text-green-700 font-black text-xl italic opacity-20">#{{ $loop->iteration }}</span>
                        </div>
                        
                        <h3 class="text-xl font-black text-gray-900 uppercase tracking-tighter mb-2 group-hover:text-green-700 transition-colors">
                            {{ $k->judul }}
                        </h3>
                        
                        <div class="flex items-center gap-2 mt-6 pt-4 border-t border-gray-100">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-[10px] font-black uppercase text-gray-500 tracking-widest">
                                {{ $k->galeris->count() }} Koleksi Foto
                            </span>
                        </div>
                    </div>

                    <div class="h-2 bg-green-700 w-full"></div>
                </a>
            @empty
                <div class="col-span-full border-4 border-dashed border-gray-200 py-20 text-center">
                    <p class="text-gray-400 font-black uppercase italic tracking-widest text-xl">Belum Ada Album Kegiatan</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection