@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 border-b-4 border-gray-900 pb-6 gap-4">
            <div>
                <p class="text-green-700 text-[10px] font-black uppercase tracking-[0.3em] mb-1">Pendaftar Kegiatan</p>
                <h1 class="text-3xl font-black text-gray-900 uppercase tracking-tighter italic">
                    {{ $kegiatan->judul }}
                </h1>
            </div>
            <a href="{{ route('admin.pendaftaran.index') }}" class="bg-white border-2 border-gray-900 text-gray-900 px-6 py-2 text-[10px] font-black uppercase tracking-widest hover:bg-black hover:text-white transition-all shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                Kembali
            </a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white border-2 border-gray-900 p-4 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                <p class="text-[8px] font-black text-gray-500 uppercase">Kuota</p>
                <p class="text-lg font-black">{{ $kegiatan->kuota ?: '∞' }}</p>
            </div>
            <div class="bg-white border-2 border-gray-900 p-4 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                <p class="text-[8px] font-black text-gray-500 uppercase">Status Kegiatan</p>
                <p class="text-lg font-black uppercase text-green-700">{{ $kegiatan->status }}</p>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-400 border-2 border-gray-900 p-4 mb-8 font-black text-[10px] uppercase tracking-widest shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white border-2 border-gray-900 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-yellow-400 border-b-2 border-gray-900">
                        <tr>
                            <th class="px-4 py-4 text-left text-[10px] font-black uppercase tracking-widest border-r-2 border-gray-900">No</th>
                            <th class="px-4 py-4 text-left text-[10px] font-black uppercase tracking-widest border-r-2 border-gray-900">Nama & NIA</th>
                            <th class="px-4 py-4 text-left text-[10px] font-black uppercase tracking-widest border-r-2 border-gray-900">PAC</th>
                            <th class="px-4 py-4 text-center text-[10px] font-black uppercase tracking-widest border-r-2 border-gray-900">Status</th>
                            <th class="px-4 py-4 text-center text-[10px] font-black uppercase tracking-widest">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y-2 divide-gray-900">
                        @foreach($pendaftarans as $key => $p)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-4 text-xs font-black border-r-2 border-gray-900 text-center">{{ $pendaftarans->firstItem() + $key }}</td>
                            <td class="px-4 py-4 border-r-2 border-gray-900">
                                <div class="text-[11px] font-black uppercase">{{ $p->anggota->nama_lengkap }}</div>
                                <div class="text-[9px] font-bold text-gray-500">{{ $p->anggota->nomor_anggota }}</div>
                            </td>
                            <td class="px-4 py-4 border-r-2 border-gray-900 text-[10px] font-black uppercase">{{ $p->anggota->pac ?? '-' }}</td>
                            <td class="px-4 py-4 border-r-2 border-gray-900 text-center">
                                <span class="px-3 py-1 text-[9px] font-black uppercase border-2 border-gray-900 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]
                                    @if($p->status=='pending') bg-white
                                    @elseif($p->status=='disetujui') bg-green-400
                                    @elseif($p->status=='ditolak') bg-red-400 text-white
                                    @else bg-gray-200 @endif">
                                    {{ $p->status }}
                                </span>
                            </td>
                            <td class="px-4 py-4">
                                <form action="{{ route('admin.pendaftaran.update', $p->id_daftar) }}" method="POST" class="flex gap-2 justify-center">
                                    @csrf @method('PUT')
                                    <select name="status" class="text-[9px] font-black border-2 border-gray-900 focus:ring-0 focus:border-gray-900 py-1 px-2 uppercase">
                                        <option value="pending" {{ $p->status=='pending'?'selected':'' }}>Pending</option>
                                        <option value="disetujui" {{ $p->status=='disetujui'?'selected':'' }}>Setujui</option>
                                        <option value="ditolak" {{ $p->status=='ditolak'?'selected':'' }}>Tolak</option>
                                        <option value="batal" {{ $p->status=='batal'?'selected':'' }}>Batal</option>
                                    </select>
                                    <button type="submit" class="bg-black text-white px-3 py-1 text-[9px] font-black uppercase hover:bg-green-700 transition-colors">
                                        Update
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-8 font-black">
            {{ $pendaftarans->links() }}
        </div>
    </div>
</div>
@endsection