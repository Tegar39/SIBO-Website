@extends('layouts.app')

@section('content')
<div class="pt-28 pb-20 bg-slate-50 min-h-screen font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-10">
            <a href="{{ route('kegiatan.publik.index') }}" wire:navigate class="group inline-flex items-center text-[10px] font-black uppercase tracking-[0.3em] text-slate-400 hover:text-emerald-600 transition-all">
                <svg class="w-4 h-4 mr-2 transition-transform group-hover:-translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Bulletin
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            <div class="lg:col-span-8">
                <div class="bg-white/70 backdrop-blur-md p-4 rounded-[3rem] shadow-2xl shadow-slate-200/50 border border-white mb-12">
                    <div class="overflow-hidden rounded-[2.2rem]">
                        @if($kegiatan->pamflet)
                            <img src="{{ Storage::url($kegiatan->pamflet->path_file) }}" class="w-full h-auto object-cover hover:scale-105 transition-transform duration-700">
                        @else
                            <div class="w-full h-96 bg-slate-100 flex flex-col items-center justify-center text-slate-300 gap-4">
                                <svg class="w-16 h-16 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span class="uppercase font-black tracking-[0.3em] italic text-xs">No Poster Provided</span>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mb-10 px-2">
                    <span class="bg-emerald-50 text-emerald-600 text-[10px] font-black px-5 py-2 rounded-full uppercase tracking-widest mb-6 inline-block border border-emerald-100/50">
                        {{ $kegiatan->kategori->nama }}
                    </span>
                    <h1 class="text-4xl md:text-6xl font-extrabold text-slate-800 leading-[1.1] tracking-tighter uppercase italic">
                        {{ $kegiatan->judul }}
                    </h1>
                </div>

                <div class="bg-white/50 backdrop-blur-sm p-8 rounded-[2.5rem] border border-white/50">
                    <h2 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] flex items-center gap-3 mb-6">
                        <span class="w-8 h-[1px] bg-slate-200"></span>
                        Deskripsi Kegiatan
                    </h2>
                    <div class="text-slate-600 leading-relaxed text-lg whitespace-pre-line font-medium">
                        {{ e($kegiatan->deskripsi) }}
                    </div>
                </div>
            </div>

            <div class="lg:col-span-4">
                <div class="sticky top-28">
                    <div class="bg-white/80 backdrop-blur-xl p-8 rounded-[3rem] border border-white shadow-2xl shadow-emerald-100/50 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-full -mr-16 -mt-16 blur-3xl opacity-50"></div>
                        
                        <h3 class="text-xl font-black text-slate-800 uppercase tracking-tight mb-8 relative">Detail Logistik</h3>
                        
                        <div class="space-y-8 relative">
                            <div class="flex items-center gap-5">
                                <div class="bg-emerald-600 text-white p-3 rounded-2xl shadow-lg shadow-emerald-100 min-w-[60px] text-center">
                                    <span class="block text-xl font-black leading-none">{{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('d') }}</span>
                                    <span class="text-[9px] font-bold uppercase tracking-wider">{{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('M') }}</span>
                                </div>
                                <div>
                                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Waktu Pelaksanaan</p>
                                    <p class="text-sm font-extrabold text-slate-700 italic">
                                        {{ \Carbon\Carbon::parse($kegiatan->waktu)->format('H:i') }} WIB - Selesai
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center gap-5">
                                <div class="bg-slate-100 p-3 rounded-2xl text-slate-400 min-w-[60px] flex items-center justify-center">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Lokasi</p>
                                    <p class="text-sm font-extrabold text-slate-700 leading-tight">{{ $kegiatan->lokasi ?: 'Lokasi belum ditentukan' }}</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-5 pb-8 border-b border-slate-50">
                                <div class="bg-slate-100 p-3 rounded-2xl text-slate-400 min-w-[60px] flex items-center justify-center">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Ketersediaan Kuota</p>
                                    <p class="text-sm font-extrabold text-slate-700">
                                        {{ $jumlahPeserta }} / {{ $kegiatan->kuota == 0 ? '∞' : $kegiatan->kuota }} <span class="text-slate-400 font-medium">Peserta</span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-10">
                            @auth
                                @if(auth()->user()->role == 'anggota')
                                    @php
                                        $pendaftaran = \App\Models\Pendaftaran::where('id_anggota', auth()->user()->anggota->id_anggota)
                                            ->where('id_kegiatan', $kegiatan->id_kegiatan)
                                            ->first();
                                        
                                        $bisaDaftar = $kegiatan->status == 'aktif' && $kegiatan->bisaDaftar;
                                    @endphp

                                    @if($pendaftaran)
                                        <div class="p-6 rounded-[2rem] border text-center shadow-inner
                                            @if($pendaftaran->status == 'disetujui') bg-emerald-50 border-emerald-100 text-emerald-600 
                                            @elseif($pendaftaran->status == 'ditolak') bg-rose-50 border-rose-100 text-rose-600 
                                            @else bg-amber-50 border-amber-100 text-amber-600 @endif">
                                            <p class="text-[10px] font-black uppercase tracking-widest mb-1 italic">Status Pendaftaran</p>
                                            <p class="text-lg font-black uppercase tracking-tighter">{{ $pendaftaran->status }}</p>
                                            <p class="text-[9px] font-bold opacity-70 mt-2 leading-tight">
                                                {{ $pendaftaran->status == 'pending' ? 'Mohon tunggu konfirmasi administrator.' : 'Silakan cek email atau dashboard riwayat.' }}
                                            </p>
                                        </div>
                                    @elseif($kegiatan->status == 'tutup')
                                        <div class="w-full bg-orange-50 text-orange-600 text-center py-4 rounded-2xl font-black uppercase text-[10px] tracking-widest border border-orange-100">
                                            ⏰ Pendaftaran Ditutup (H-1 Kegiatan)
                                        </div>
                                    @elseif($kegiatan->status == 'selesai')
                                        <div class="w-full bg-slate-100 text-slate-400 text-center py-4 rounded-2xl font-black uppercase text-[10px] tracking-widest border border-slate-200">
                                            ✓ Kegiatan Telah Selesai
                                        </div>
                                    @elseif($kegiatan->status != 'aktif')
                                        <div class="w-full bg-slate-100 text-slate-400 text-center py-4 rounded-2xl font-black uppercase text-[10px] tracking-widest border border-slate-200">
                                            Pendaftaran {{ strtoupper($kegiatan->status) }}
                                        </div>
                                    @elseif($kegiatan->kuota > 0 && $jumlahPeserta >= $kegiatan->kuota)
                                        <div class="w-full bg-rose-50 text-rose-600 text-center py-4 rounded-2xl font-black uppercase text-[10px] tracking-widest border border-rose-100">
                                            Mohon Maaf, Kuota Penuh
                                        </div>
                                    @elseif(!$bisaDaftar)
                                        <div class="w-full bg-amber-50 text-amber-600 text-center py-4 rounded-2xl font-black uppercase text-[10px] tracking-widest border border-amber-100">
                                            ⚠️ Pendaftaran Ditutup (Waktu Habis)
                                        </div>
                                    @else
                                        <form action="{{ route('anggota.daftar', $kegiatan->id_kegiatan) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="w-full bg-emerald-600 hover:bg-slate-800 text-white font-black py-5 rounded-2xl uppercase tracking-[0.2em] transition-all transform active:scale-95 shadow-xl shadow-emerald-100 flex items-center justify-center gap-3 group">
                                                Daftar Sekarang
                                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                            </button>
                                        </form>
                                    @endif
                                @else
                                    <div class="p-5 bg-sky-50 rounded-2xl border border-sky-100 text-sky-700 text-[10px] font-black uppercase leading-relaxed text-center italic">
                                        Anda login sebagai Administrator
                                    </div>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="block w-full bg-slate-800 hover:bg-emerald-600 text-white text-center font-black py-5 rounded-2xl uppercase tracking-[0.2em] transition-all shadow-xl active:scale-95">
                                    Login untuk Mendaftar
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection