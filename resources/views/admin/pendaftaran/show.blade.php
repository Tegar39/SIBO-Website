@extends('layouts.app')

@section('content')
<div class="pt-28 pb-12 bg-slate-50 min-h-screen font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 gap-6">
            <div>
                <p class="text-emerald-600 text-[10px] font-black uppercase tracking-[0.3em] mb-1">Manajemen Peserta</p>
                <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">
                    {{ $kegiatan->judul }}
                </h1>
                <p class="text-slate-500 text-sm mt-1 font-medium flex items-center gap-2">
                    <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                    Daftar pendaftar yang masuk ke sistem
                </p>
            </div>
            <a href="{{ route('admin.pendaftaran.index') }}" class="inline-flex items-center gap-2 bg-white border border-slate-200 text-slate-600 px-6 py-3 rounded-2xl text-[11px] font-black uppercase tracking-widest hover:bg-slate-50 transition-all shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-10">
            <div class="bg-white/70 backdrop-blur-md border border-white/50 p-6 rounded-3xl shadow-sm">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Total Kuota</p>
                <p class="text-2xl font-black text-slate-800">{{ $kegiatan->kuota ?: '∞' }}</p>
            </div>
            <div class="bg-emerald-600 p-6 rounded-3xl shadow-lg shadow-emerald-100">
                <p class="text-[10px] font-bold text-emerald-100 uppercase tracking-wider mb-1">Status Kegiatan</p>
                <p class="text-2xl font-black text-white uppercase">{{ $kegiatan->status }}</p>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-8 flex items-center gap-3 bg-emerald-50 border border-emerald-100 text-emerald-700 px-6 py-4 rounded-2xl font-bold text-sm shadow-sm animate-fade-in">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white/70 backdrop-blur-md rounded-[2rem] border border-white/50 shadow-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50/50 border-b border-white">
                        <tr>
                            <th class="px-6 py-6 text-[10px] font-bold uppercase tracking-widest text-slate-500 text-center">No</th>
                            <th class="px-6 py-6 text-[10px] font-bold uppercase tracking-widest text-slate-500">Informasi Anggota</th>
                            <th class="px-6 py-6 text-[10px] font-bold uppercase tracking-widest text-slate-500">PAC</th>
                            <th class="px-6 py-6 text-[10px] font-bold uppercase tracking-widest text-slate-500 text-center">Status</th>
                            <th class="px-6 py-6 text-[10px] font-bold uppercase tracking-widest text-slate-500 text-center">Aksi Manajemen</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/60">
                        @foreach($pendaftarans as $key => $p)
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="px-6 py-5 text-xs font-bold text-slate-400 text-center">
                                {{ $pendaftarans->firstItem() + $key }}
                            </td>
                            <td class="px-6 py-5">
                                <div class="text-sm font-bold text-slate-800 group-hover:text-emerald-600 transition-colors uppercase">{{ $p->anggota->nama_lengkap }}</div>
                                <div class="text-[11px] font-medium text-slate-400">{{ $p->anggota->nomor_anggota }}</div>
                            </td>
                            <td class="px-6 py-5">
                                <span class="text-xs font-bold text-slate-600 uppercase">{{ $p->anggota->pac ?? '-' }}</span>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <span class="inline-block px-4 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-wider
                                    @if($p->status=='pending') bg-slate-100 text-slate-500
                                    @elseif($p->status=='disetujui') bg-emerald-100 text-emerald-600
                                    @elseif($p->status=='ditolak') bg-rose-100 text-rose-600
                                    @else bg-gray-100 text-gray-500 @endif">
                                    {{ $p->status }}
                                </span>
                            </td>
                            <td class="px-6 py-5">
                                <form action="{{ route('admin.pendaftaran.update', $p->id_daftar) }}" method="POST" class="flex items-center gap-2 justify-center">
                                    @csrf @method('PUT')
                                    <select name="status" class="text-[11px] font-bold bg-white/50 border border-slate-200 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 rounded-xl py-2 px-3 uppercase outline-none transition-all">
                                        <option value="pending" {{ $p->status=='pending'?'selected':'' }}>Pending</option>
                                        <option value="disetujui" {{ $p->status=='disetujui'?'selected':'' }}>Setujui</option>
                                        <option value="ditolak" {{ $p->status=='ditolak'?'selected':'' }}>Tolak</option>
                                        <option value="batal" {{ $p->status=='batal'?'selected':'' }}>Batal</option>
                                    </select>
                                    <button type="submit" class="bg-slate-800 text-white p-2.5 rounded-xl hover:bg-emerald-600 transition-all shadow-sm group/btn">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-8">
            {{ $pendaftarans->links() }}
        </div>
    </div>
</div>

<style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in { animation: fade-in 0.4s ease-out forwards; }
    
    .overflow-x-auto::-webkit-scrollbar { height: 6px; }
    .overflow-x-auto::-webkit-scrollbar-track { background: transparent; }
    .overflow-x-auto::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
</style>
@endsection