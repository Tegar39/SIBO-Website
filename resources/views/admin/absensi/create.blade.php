@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <a href="{{ route('admin.absensi.index') }}" class="inline-flex items-center text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-gray-900 mb-4 transition-colors">
            ← Kembali ke daftar
        </a>

        <div class="bg-white border-2 border-gray-900 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] overflow-hidden">
            <div class="p-8 border-b-2 border-gray-900 bg-gray-50/50 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-black text-gray-900 uppercase italic leading-none">{{ $kegiatan->judul }}</h1>
                    <p class="text-green-600 font-bold text-xs mt-2 uppercase tracking-widest">Lembar Absensi Peserta ({{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('d/m/Y') }})</p>
                </div>
                <div class="bg-black text-white px-4 py-2 text-xs font-black uppercase">
                    Total Peserta: {{ $pendaftarans->count() }}
                </div>
            </div>

            <div class="p-8">
                @if(session('success'))
                    <div class="mb-6 bg-green-50 border-l-4 border-green-600 text-green-700 p-4 font-bold text-sm uppercase tracking-tight">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('admin.absensi.store', $kegiatan->id_kegiatan) }}" method="POST">
                    @csrf
                    <div class="overflow-x-auto border-2 border-gray-100">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-900 text-white">
                                <tr>
                                    <th class="px-6 py-4 text-left text-[10px] font-black uppercase tracking-widest">No</th>
                                    <th class="px-6 py-4 text-left text-[10px] font-black uppercase tracking-widest">Info Anggota</th>
                                    <th class="px-6 py-4 text-center text-[10px] font-black uppercase tracking-widest">Kehadiran</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($pendaftarans as $key => $p)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 text-sm font-black text-gray-400">{{ $key+1 }}</td>
                                    <td class="px-6 py-4">
                                        <div class="font-black text-gray-900 uppercase text-sm">{{ $p->anggota->nama_lengkap }}</div>
                                        <div class="text-[10px] font-bold text-gray-400 tracking-tighter">{{ $p->anggota->nomor_anggota }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <input type="checkbox" name="hadir[{{ $p->id_daftar }}]" value="1" 
                                               {{ $p->absensi && $p->absensi->hadir ? 'checked' : '' }}
                                               class="w-6 h-6 text-green-600 border-2 border-gray-900 focus:ring-green-500 rounded-sm cursor-pointer">
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-8 flex justify-end">
                        <button type="submit" class="bg-gray-900 hover:bg-green-600 text-white font-black px-8 py-3 uppercase tracking-widest text-sm transition-all transform hover:-translate-y-1 shadow-[4px_4px_0px_0px_rgba(22,163,74,0.3)]">
                            Simpan Absensi Akhir
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection