@extends('layouts.app')

@section('content')
<div class="pt-28 pb-16 bg-slate-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-br from-slate-900 to-emerald-900 rounded-[2rem] p-8 md:p-12 text-white shadow-xl">
            <p class="text-emerald-300 text-xs font-black uppercase tracking-[0.25em]">Dashboard PAC</p>
            <h1 class="mt-3 text-4xl md:text-5xl font-black">{{ $pac }}</h1>
            <p class="mt-4 text-slate-200 max-w-2xl">Ringkasan anggota, kegiatan, dan absensi khusus PAC kamu.</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8">
            <div class="bg-white rounded-3xl p-6 border border-slate-100"><p class="text-xs font-black uppercase text-slate-400">Anggota</p><p class="text-3xl font-black text-slate-900">{{ $totalAnggota }}</p></div>
            <div class="bg-white rounded-3xl p-6 border border-slate-100"><p class="text-xs font-black uppercase text-slate-400">Kegiatan</p><p class="text-3xl font-black text-slate-900">{{ $totalKegiatan }}</p></div>
            <div class="bg-white rounded-3xl p-6 border border-slate-100"><p class="text-xs font-black uppercase text-slate-400">Hadir</p><p class="text-3xl font-black text-emerald-600">{{ $totalHadir ?? 0 }}</p></div>
            <div class="bg-white rounded-3xl p-6 border border-slate-100"><p class="text-xs font-black uppercase text-slate-400">Tidak Hadir</p><p class="text-3xl font-black text-rose-600">{{ $totalTidakHadir ?? 0 }}</p></div>
        </div>

        <div class="mt-8 bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center">
                <h2 class="font-black text-slate-800">Kegiatan Terbaru PAC</h2>
                <a href="{{ route('pac.public.show', urlencode($pac)) }}" class="text-xs font-black text-emerald-600 uppercase tracking-widest">Lihat Profil Publik</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-slate-50 text-[10px] uppercase tracking-widest text-slate-500 font-black">
                        <tr><th class="px-6 py-4">Kegiatan</th><th class="px-6 py-4">Tanggal</th><th class="px-6 py-4">Kategori</th><th class="px-6 py-4">Peserta PAC</th><th class="px-6 py-4">Status</th></tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse($kegiatanTerbaru as $kegiatan)
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-4 font-bold text-slate-800">{{ $kegiatan->judul }}</td>
                                <td class="px-6 py-4 text-slate-500">{{ optional($kegiatan->tanggal)->translatedFormat('d F Y') }}</td>
                                <td class="px-6 py-4">{{ $kegiatan->kategori->nama ?? '-' }}</td>
                                <td class="px-6 py-4 font-bold">{{ $kegiatan->peserta_pac_count ?? 0 }}</td>
                                <td class="px-6 py-4"><span class="bg-slate-100 text-slate-700 px-3 py-1 rounded-full text-xs font-black">{{ strtoupper($kegiatan->status) }}</span></td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="px-6 py-16 text-center text-slate-400 font-bold">Belum ada kegiatan terkait PAC ini.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
