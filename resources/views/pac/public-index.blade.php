@extends('layouts.app')

@section('content')
<div class="pt-20 pb-16 bg-slate-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <span class="text-emerald-600 font-black uppercase tracking-[0.25em] text-xs">Direktori PAC Aktif</span>
            <h1 class="mt-3 text-4xl md:text-5xl font-black text-slate-900">Informasi PAC</h1>
            <p class="mt-4 text-slate-500 max-w-2xl mx-auto">Klik salah satu PAC untuk melihat nama PAC, jumlah anggota aktif, kegiatan yang diikuti, dan ringkasan absensi.</p>
        </div>

        <form method="GET" class="max-w-xl mx-auto mb-10 flex gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama PAC" class="flex-1 rounded-2xl border-slate-200 focus:border-emerald-500 focus:ring-emerald-500">
            <button class="bg-emerald-600 text-white px-6 rounded-2xl text-xs font-black uppercase tracking-widest">Cari</button>
        </form>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($pacList as $pac)
                <a href="{{ route('pac.public.show', urlencode($pac->pac)) }}" class="group bg-white rounded-3xl border border-slate-100 p-7 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all">
                    <div class="flex items-center justify-between mb-6">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-black">PAC</div>
                        <span class="text-[10px] font-black uppercase tracking-widest text-emerald-600">Aktif</span>
                    </div>
                    <h2 class="text-2xl font-black text-slate-900 group-hover:text-emerald-600 transition">{{ $pac->pac }}</h2>
                    <div class="mt-6 grid grid-cols-2 gap-3">
                        <div class="bg-slate-50 rounded-2xl p-4"><p class="text-[10px] uppercase font-black text-slate-400">Anggota</p><p class="text-2xl font-black text-slate-800">{{ $pac->total_anggota }}</p></div>
                        <div class="bg-slate-50 rounded-2xl p-4"><p class="text-[10px] uppercase font-black text-slate-400">Kegiatan</p><p class="text-2xl font-black text-slate-800">{{ $pac->total_kegiatan }}</p></div>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center bg-white rounded-3xl p-12 text-slate-400 font-bold">Belum ada data PAC aktif.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
