@extends('layouts.app')

@section('content')
<div class="pt-28 pb-12 bg-slate-50 min-h-screen font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">
                    Database <span class="text-emerald-600">Anggota</span>
                </h1>
                <p class="text-slate-500 text-sm mt-1 font-medium flex items-center gap-2">
                    <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                    Sistem Informasi Manajemen PC DESBOR
                </p>
            </div>
            <a href="{{ route('admin.anggota.create') }}" 
               class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold py-3 px-6 rounded-2xl transition-all shadow-lg shadow-emerald-200 hover:-translate-y-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Registrasi Anggota
            </a>
        </div>

        <div class="mb-10 bg-white/70 backdrop-blur-md border border-white/50 p-4 rounded-3xl shadow-sm">
            <form action="{{ route('admin.anggota.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" 
                        placeholder="Cari nama atau ID anggota..." 
                        class="w-full bg-slate-100/50 border-none pl-11 pr-4 py-3 rounded-2xl text-sm font-semibold text-slate-700 focus:ring-2 focus:ring-emerald-500 transition-all">
                </div>

                <div class="md:w-64">
                    <select name="pac" onchange="this.form.submit()" 
                        class="w-full bg-slate-100/50 border-none px-4 py-3 rounded-2xl text-sm font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500 appearance-none cursor-pointer">
                        <option value="">SEMUA WILAYAH</option>
                        @foreach(['BADAS','PARE','KANDANGAN','PURWOASRI','PAPAR','KUNJANG','PLEMAHAN','GAMPENGREJO','NGASEM','GURAH','PAGU','PLOSOKLATEN','WATES','KANDAT','KRAS','RINGINREJO','NGADILUWIH','SEMEN','MOJO','BANYAKAN','GROGOL','TAROKAN','KAYENKIDUL','NGANCAR','PUNCU','KEPUNG'] as $pac)
                            <option value="{{ $pac }}" {{ request('pac') == $pac ? 'selected' : '' }}>PAC {{ $pac }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="bg-slate-800 text-white px-8 py-3 rounded-2xl font-bold text-sm hover:bg-slate-900 transition-all">
                        CARI
                    </button>

                    @if(request('search') || request('pac'))
                        <a href="{{ route('admin.anggota.index') }}" 
                        class="bg-rose-50 text-rose-600 px-6 py-3 rounded-2xl font-bold text-sm flex items-center justify-center hover:bg-rose-100 transition-all">
                            RESET
                        </a>
                    @endif
                </div>
            </form>
        </div>

        @if($anggota->count() > 0)
            <div class="bg-white/70 backdrop-blur-md rounded-3xl border border-white/50 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-800/5 text-slate-600 border-b border-slate-100">
                                <th class="px-6 py-4 text-xs font-black uppercase tracking-wider">Anggota</th>
                                <th class="px-6 py-4 text-xs font-black uppercase tracking-wider">ID & Wilayah</th>
                                <th class="px-6 py-4 text-xs font-black uppercase tracking-wider">Kontak</th>
                                <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($anggota as $a)
                                <tr class="hover:bg-white/50 transition-colors group">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-4">
                                            <div class="w-10 h-10 rounded-xl bg-emerald-100 flex-shrink-0 overflow-hidden border border-emerald-200">
                                                @if($a->foto_profil && Storage::disk('public')->exists($a->foto_profil))
                                                    <img src="{{ Storage::url($a->foto_profil) }}" alt="Foto" class="w-full h-full object-cover">
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center text-emerald-600 uppercase font-bold text-xs">
                                                        {{ substr($a->nama_lengkap, 0, 1) }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="min-w-0">
                                                <p class="text-sm font-bold text-slate-800 truncate">{{ $a->nama_lengkap }}</p>
                                                <p class="text-[11px] text-slate-500 font-medium truncate">{{ $a->user->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="block text-xs font-mono font-bold text-slate-700 tracking-tight">{{ $a->nomor_anggota }}</span>
                                        <span class="inline-flex items-center px-2 py-0.5 mt-1 rounded text-[10px] font-black bg-emerald-50 text-emerald-700 border border-emerald-100 uppercase">
                                            {{ $a->pac }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-xs font-bold text-slate-600 flex items-center gap-2">
                                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                            {{ $a->kontak ?? '-' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('admin.anggota.edit', $a->id_anggota) }}" 
                                               class="p-2 bg-white border border-slate-200 rounded-lg text-blue-600 hover:bg-blue-50 transition-all"
                                               title="Edit Data">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </a>
                                            <form action="{{ route('admin.anggota.destroy', $a->id_anggota) }}" method="POST" onsubmit="return confirm('Hapus anggota ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="p-2 bg-white border border-slate-200 rounded-lg text-rose-600 hover:bg-rose-50 transition-all" title="Hapus">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-8">
                {{ $anggota->links() }}
            </div>
        @else
            <div class="text-center py-24 bg-white/70 backdrop-blur-md rounded-3xl border-2 border-dashed border-slate-200">
                <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-300">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 01-9-3.612m0-11.214a3 3 0 11-2.047 5.291"></path></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-400">Data tidak ditemukan</h3>
                <a href="{{ route('admin.anggota.index') }}" class="text-emerald-600 font-bold text-sm hover:underline uppercase tracking-widest mt-2 block">RESET FILTER</a>
            </div>
        @endif
    </div>
</div>
@endsection