@extends('layouts.app')

@section('content')
<div class="pt-28 pb-12 bg-slate-50 min-h-screen font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8">
            <a href="{{ route('admin.absensi.index') }}" class="inline-flex items-center gap-2 text-[11px] font-black uppercase tracking-[0.2em] text-slate-400 hover:text-emerald-600 transition-all group">
                <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali
            </a>
        </div>

        <div class="bg-white/80 backdrop-blur-xl rounded-[2.5rem] border border-white shadow-2xl overflow-hidden">
            <div class="p-8 md:p-12 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-8">
                <div>
                    <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">{{ $kegiatan->judul }}</h1>
                    <p class="text-slate-500 mt-2">{{ \Carbon\Carbon::parse($kegiatan->tanggal)->translatedFormat('l, d F Y') }}</p>
                </div>
                <div class="flex items-center gap-4">
                    <div class="bg-emerald-50 text-emerald-700 px-5 py-3 rounded-2xl text-center">
                        <p class="text-[10px] font-black uppercase tracking-wider">Hadir</p>
                        <p class="text-2xl font-black">{{ $hadirCount }}/{{ $pendaftarans->count() }}</p>
                    </div>
                    <a href="{{ route('admin.absensi.export', $kegiatan->id_kegiatan) }}" class="bg-slate-800 hover:bg-emerald-600 text-white px-6 py-3 rounded-2xl text-xs font-bold uppercase tracking-wider transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        Export Excel
                    </a>
                </div>
            </div>

            <div class="p-8 md:p-12">
                <div class="overflow-hidden rounded-[2rem] border border-slate-100 bg-slate-50/30">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-100/50">
                                    <th class="px-6 py-4 text-[10px] font-black uppercase tracking-wider">No</th>
                                    <th class="px-6 py-4 text-[10px] font-black uppercase tracking-wider">Nama Peserta</th>
                                    <th class="px-6 py-4 text-[10px] font-black uppercase tracking-wider">Kontak</th>
                                    <th class="px-6 py-4 text-[10px] font-black uppercase tracking-wider text-center">Status</th>
                                    <th class="px-6 py-4 text-[10px] font-black uppercase tracking-wider">Waktu Absen</th>
                                    <th class="px-6 py-4 text-[10px] font-black uppercase tracking-wider">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 bg-white/40">
                                @foreach($pendaftarans as $key => $p)
                                <tr class="hover:bg-slate-50/80 transition">
                                    <td class="px-6 py-4 text-sm font-bold text-slate-400">{{ $key+1 }}</td>
                                    <td class="px-6 py-4 font-bold text-slate-800">{{ $p->display_name }}</td>
                                    <td class="px-6 py-4 text-slate-600">{{ $p->display_contact }}</td>
                                    <td class="px-6 py-4 text-center">
                                        @if($p->absensi && $p->absensi->hadir)
                                            <span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-xs font-black">HADIR</span>
                                        @else
                                            <span class="bg-rose-100 text-rose-600 px-3 py-1 rounded-full text-xs font-black">TIDAK HADIR</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-slate-500 text-sm">
                                        {{ $p->absensi && $p->absensi->waktu_hadir ? \Carbon\Carbon::parse($p->absensi->waktu_hadir)->format('H:i, d/m/Y') : '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-slate-500">{{ $p->absensi->keterangan ?? '-' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection