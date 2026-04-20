@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 gap-6">
            <div class="border-l-8 border-green-700 pl-6">
                <h1 class="text-3xl font-black text-gray-900 uppercase italic tracking-tighter">{{ $kegiatan->judul }}</h1>
                <p class="text-yellow-600 font-black text-xs uppercase tracking-[0.2em]">Album Dokumentasi Terpadu</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.galeri.index') }}" class="bg-white border-2 border-gray-900 px-6 py-3 text-[11px] font-black uppercase tracking-widest hover:bg-gray-100 transition-all shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                    Kembali
                </a>
                <a href="{{ route('admin.galeri.create', $kegiatan->id_kegiatan) }}" class="bg-green-700 border-2 border-gray-900 text-white px-6 py-3 text-[11px] font-black uppercase tracking-widest hover:bg-black transition-all shadow-[4px_4px_0px_0px_rgba(234,179,8,1)]">
                    + Upload Foto
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-yellow-400 border-2 border-gray-900 p-4 mb-8 font-black text-[10px] uppercase tracking-widest shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @forelse($fotos as $f)
                <div class="group relative bg-white border-2 border-gray-900 p-2 shadow-[6px_6px_0px_0px_rgba(0,0,0,0.05)] hover:shadow-[6px_6px_0px_0px_rgba(21,128,61,0.2)] transition-all">
                    <div class="aspect-square overflow-hidden bg-gray-100 mb-2">
                        <img src="{{ Storage::url($f->path_file) }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500">
                    </div>
                    
                    <div class="flex justify-between items-center px-1">
                        <p class="text-[10px] font-black uppercase text-gray-700 truncate pr-4">
                            {{ $f->judul_foto ?? 'No Title' }}
                        </p>
                        <form action="{{ route('admin.galeri.destroy', $f->id_foto) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="return confirm('Hapus foto ini?')" class="text-red-500 hover:text-black transition-colors">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                            </button>
                        </form>
                    </div>

                    @if($f->is_unggulan)
                        <span class="absolute -top-2 -right-2 bg-yellow-400 border-2 border-gray-900 text-[8px] font-black px-2 py-1 uppercase shadow-sm">Unggulan</span>
                    @endif
                </div>
            @empty
                <div class="col-span-full bg-white border-2 border-dashed border-gray-300 py-16 text-center">
                    <p class="text-gray-400 font-bold uppercase tracking-widest text-xs italic">Album masih kosong</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection