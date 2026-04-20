@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 border-b-4 border-gray-900 pb-6 gap-4">
            <div>
                <h1 class="text-4xl font-black text-gray-900 uppercase italic tracking-tighter">
                    Kelola <span class="text-green-700">Kegiatan</span>
                </h1>
                <p class="text-gray-500 text-[10px] font-black uppercase tracking-[0.3em] mt-1">Sistem Informasi Budaya & Olahraga - Admin Panel</p>
            </div>
            <a href="{{ route('admin.kegiatan.create') }}" class="bg-yellow-400 border-2 border-gray-900 text-gray-900 px-6 py-3 text-[11px] font-black uppercase tracking-widest hover:bg-black hover:text-white transition-all shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                Tambah Kegiatan
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-2 border-gray-900 p-4 mb-8 font-black text-[10px] uppercase tracking-widest shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                {{ session('success') }}
            </div>
        @endif

        @if($kegiatans->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($kegiatans as $k)
                    <div class="group bg-white border-2 border-gray-900 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-1 hover:translate-y-1 transition-all flex flex-col overflow-hidden">
                        <div class="h-48 bg-gray-200 relative overflow-hidden border-b-2 border-gray-900">
                            @if($k->pamflet && Storage::disk('public')->exists($k->pamflet->path_file))
                                <img src="{{ Storage::url($k->pamflet->path_file) }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gray-100 italic font-black text-gray-300 uppercase tracking-tighter">No Image</div>
                            @endif
                            
                            <span class="absolute top-4 left-4 bg-green-700 text-white text-[9px] font-black px-3 py-1 uppercase tracking-widest shadow-[3px_3px_0px_0px_rgba(0,0,0,1)]">
                                {{ $k->kategori->nama ?? 'Umum' }}
                            </span>
                        </div>

                        <div class="p-6 flex-1">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="px-2 py-0.5 text-[8px] font-black rounded border border-gray-900 uppercase
                                    @if($k->status == 'aktif') bg-green-400 text-gray-900
                                    @elseif($k->status == 'selesai') bg-gray-200 text-gray-600
                                    @else bg-red-400 text-white @endif">
                                    {{ $k->status }}
                                </span>
                                <span class="text-[10px] font-bold text-gray-400">{{ \Carbon\Carbon::parse($k->tanggal)->format('d M Y') }}</span>
                            </div>

                            <h3 class="text-xl font-black text-gray-900 uppercase tracking-tighter leading-tight mb-4 group-hover:text-green-700 transition-colors line-clamp-1">
                                {{ $k->judul }}
                            </h3>

                            <div class="space-y-2 mb-6">
                                <div class="flex items-center gap-2 text-xs font-bold text-gray-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                    <span class="truncate">{{ $k->lokasi ?: 'Internal' }}</span>
                                </div>
                                <div class="flex items-center gap-2 text-xs font-bold text-gray-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                    <span>Kuota: {{ $k->kuota ?: '∞' }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 border-t-2 border-gray-900">
                            <a href="{{ route('admin.kegiatan.edit', $k->id_kegiatan) }}" class="p-4 text-center text-[10px] font-black uppercase tracking-widest hover:bg-yellow-400 transition-colors border-r-2 border-gray-900">
                                Edit Data
                            </a>
                            <form action="{{ route('admin.kegiatan.destroy', $k->id_kegiatan) }}" method="POST" onsubmit="return confirm('Hapus kegiatan ini?')" class="flex">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-full p-4 text-center text-[10px] font-black uppercase tracking-widest text-red-600 hover:bg-red-600 hover:text-white transition-colors">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $kegiatans->links() }}
            </div>
        @else
            <div class="border-4 border-dashed border-gray-200 py-24 text-center">
                <p class="text-gray-400 font-black uppercase italic tracking-widest text-xl">Database Kosong Melompong</p>
            </div>
        @endif
    </div>
</div>
@endsection