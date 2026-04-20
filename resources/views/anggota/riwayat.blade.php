@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <div class="flex items-center gap-4 mb-10 border-b-4 border-gray-900 pb-6">
            <div class="bg-green-700 text-white p-3 border-2 border-gray-900 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <h1 class="text-4xl font-black text-gray-900 uppercase italic tracking-tighter">Riwayat <span class="text-green-700">Pendaftaran</span></h1>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-4 border-gray-900 p-4 mb-6 font-black uppercase text-xs shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white border-4 border-gray-900 shadow-[10px_10px_0px_0px_rgba(0,0,0,1)] overflow-hidden">
            @if($pendaftarans->count() > 0)
                <div class="overflow-x-auto text-left">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-900 text-white">
                                <th class="px-6 py-4 text-[10px] font-black uppercase tracking-[0.2em]">No</th>
                                <th class="px-6 py-4 text-[10px] font-black uppercase tracking-[0.2em]">Nama Kegiatan</th>
                                <th class="px-6 py-4 text-[10px] font-black uppercase tracking-[0.2em]">Waktu Pelaksanaan</th>
                                <th class="px-6 py-4 text-[10px] font-black uppercase tracking-[0.2em]">Waktu Daftar</th>
                                <th class="px-6 py-4 text-[10px] font-black uppercase tracking-[0.2em]">Status</th>
                                <th class="px-6 py-4 text-[10px] font-black uppercase tracking-[0.2em]">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y-4 divide-gray-900 font-bold">
                            @foreach($pendaftarans as $key => $p)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 text-gray-400 font-black italic">{{ $key+1 }}</td>
                                    <td class="px-6 py-4 uppercase tracking-tighter text-lg text-gray-900">{{ $p->kegiatan->judul }}</td>
                                    <td class="px-6 py-4 text-xs">
                                        <span class="bg-yellow-400 border border-gray-900 px-2 py-1 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                                            {{ \Carbon\Carbon::parse($p->kegiatan->tanggal)->format('d M Y') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-[10px] text-gray-500 font-black uppercase">
                                        {{ \Carbon\Carbon::parse($p->tgl_daftar)->format('d/m/y - H:i') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-4 py-1 border-2 border-gray-900 text-[10px] font-black uppercase italic
                                            @if($p->status=='pending') bg-blue-400
                                            @elseif($p->status=='disetujui') bg-green-500
                                            @elseif($p->status=='ditolak') bg-red-500
                                            @else bg-gray-400 @endif">
                                            {{ $p->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('kegiatan.publik.show', $p->id_kegiatan) }}" class="bg-white border-2 border-gray-900 text-gray-900 px-4 py-2 text-[10px] font-black uppercase shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-0.5 hover:translate-y-0.5 transition-all">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-4 bg-gray-50 border-t-4 border-gray-900">
                    {{ $pendaftarans->links() }}
                </div>
            @else
                <div class="p-20 text-center flex flex-col items-center justify-center">
                    <div class="w-20 h-20 bg-gray-100 border-4 border-dashed border-gray-400 flex items-center justify-center mb-4">
                        <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <p class="font-black uppercase italic text-gray-400 tracking-widest">Belum ada jejak pendaftaran</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection