@extends('layouts.app')

@section('content')
<div class="pt-28 pb-16 bg-slate-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('pac.public.index') }}" class="text-xs font-black uppercase tracking-widest text-slate-400 hover:text-emerald-600">← Kembali ke daftar PAC</a>
        <div class="mt-6 bg-gradient-to-br from-slate-900 to-emerald-900 rounded-[2rem] text-white p-8 md:p-12 shadow-xl">
            <p class="text-emerald-300 text-xs font-black uppercase tracking-[0.25em]">Profil PAC Aktif</p>
            <h1 class="mt-3 text-4xl md:text-5xl font-black">{{ $pac }}</h1>
            <p class="mt-4 text-slate-200 max-w-2xl">Halaman ini menampilkan informasi PAC yang datanya aktif di sistem SIBO berdasarkan anggota dan riwayat kegiatan.</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8">
            <div class="bg-white rounded-3xl p-6 border border-slate-100"><p class="text-xs font-black uppercase text-slate-400">Anggota</p><p class="text-3xl font-black text-slate-900">{{ $statistik['total_anggota'] }}</p></div>
            <div class="bg-white rounded-3xl p-6 border border-slate-100"><p class="text-xs font-black uppercase text-slate-400">Kegiatan</p><p class="text-3xl font-black text-slate-900">{{ $statistik['total_kegiatan'] }}</p></div>
            <div class="bg-white rounded-3xl p-6 border border-slate-100"><p class="text-xs font-black uppercase text-slate-400">Hadir</p><p class="text-3xl font-black text-emerald-600">{{ $statistik['hadir'] }}</p></div>
            <div class="bg-white rounded-3xl p-6 border border-slate-100"><p class="text-xs font-black uppercase text-slate-400">Tidak Hadir</p><p class="text-3xl font-black text-rose-600">{{ $statistik['tidak_hadir'] }}</p></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-8">
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100"><h2 class="font-black text-slate-800">Anggota PAC</h2></div>
                <div class="divide-y divide-slate-100 max-h-[520px] overflow-auto">
                    @foreach($anggota as $item)
                        <div class="px-6 py-4 flex justify-between gap-4">
                            <div><p class="font-bold text-slate-800">{{ $item->nama_lengkap }}</p><p class="text-xs text-slate-400">{{ $item->nomor_anggota }} · {{ $item->kontak ?? '-' }}</p></div>
                            <span class="text-[10px] font-black uppercase text-emerald-600">Aktif</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100"><h2 class="font-black text-slate-800">Kegiatan Terkait</h2></div>
                <div class="divide-y divide-slate-100 max-h-[520px] overflow-auto">
                    @forelse($kegiatanTerbaru as $kegiatan)
                        <div class="px-6 py-4">
                            <p class="font-bold text-slate-800">{{ $kegiatan->judul }}</p>
                            <p class="text-xs text-slate-400">{{ optional($kegiatan->tanggal)->translatedFormat('d F Y') }} · {{ $kegiatan->kategori->nama ?? '-' }}</p>
                            <p class="mt-2 text-xs font-bold text-emerald-600">Peserta dari PAC ini: {{ $kegiatan->peserta_pac_count }}</p>
                        </div>
                    @empty
                        <div class="px-6 py-12 text-center text-slate-400 font-bold">Belum ada kegiatan terkait.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
