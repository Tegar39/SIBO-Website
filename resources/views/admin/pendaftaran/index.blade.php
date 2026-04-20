@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 border-b-4 border-gray-900 pb-6 gap-4">
            <div>
                <h1 class="text-4xl font-black text-gray-900 uppercase italic tracking-tighter">
                    Kelola <span class="text-green-700">Pendaftaran</span>
                </h1>
                <p class="text-gray-500 text-[10px] font-black uppercase tracking-[0.3em] mt-1">Sistem Informasi Budaya & Olahraga - Admin Panel</p>
            </div>
        </div>

        @if($kegiatans->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($kegiatans as $k)
                    <div class="group bg-white border-2 border-gray-900 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-1 hover:translate-y-1 transition-all flex flex-col overflow-hidden">
                        
                        <div class="h-48 bg-gray-200 relative overflow-hidden border-b-2 border-gray-900">
                            @if($k->pamflet && Storage::disk('public')->exists($k->pamflet->path_file))
                                <img src="{{ Storage::url($k->pamflet->path_file) }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gray-100 italic font-black text-gray-300 uppercase tracking-tighter text-sm">No Image</div>
                            @endif
                            
                            <span class="absolute bottom-4 right-4 bg-yellow-400 text-gray-900 text-[10px] font-black px-3 py-1 uppercase tracking-widest shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] border border-gray-900">
                                {{ $k->pendaftarans_count }} PENDAFTAR
                            </span>
                        </div>

                        <div class="p-6 flex-1">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="text-[10px] font-black uppercase tracking-widest text-gray-400">
                                    {{ \Carbon\Carbon::parse($k->tanggal)->format('d M Y') }}
                                </span>
                            </div>

                            <h3 class="text-xl font-black text-gray-900 uppercase tracking-tighter leading-tight mb-4 group-hover:text-green-700 transition-colors line-clamp-2">
                                {{ $k->judul }}
                            </h3>
                        </div>

                        <div class="border-t-2 border-gray-900">
                            <a href="{{ route('admin.pendaftaran.show', $k->id_kegiatan) }}" class="block p-4 text-center text-[10px] font-black uppercase tracking-widest bg-white hover:bg-black hover:text-white transition-colors">
                                Kelola Peserta →
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-12 font-black uppercase">
                {{ $kegiatans->links() }}
            </div>
        @else
            <div class="border-4 border-dashed border-gray-200 py-24 text-center">
                <p class="text-gray-400 font-black uppercase italic tracking-widest text-xl text-center">Belum ada kegiatan untuk dikelola</p>
            </div>
        @endif
    </div>
</div>
@endsection