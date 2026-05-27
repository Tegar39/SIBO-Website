@extends('layouts.app')

@section('content')
<div class="pt-28 pb-12 bg-slate-50 min-h-screen font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8 flex flex-col md:flex-row md:items-end md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-800">Laporan <span class="text-emerald-600">Absensi</span></h1>
                <p class="text-slate-500 text-sm mt-1">Rekap kehadiran anggota berdasarkan kegiatan dan PAC.</p>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('admin.laporan.absensi.export.excel', request()->query()) }}" class="bg-green-600 text-white px-4 py-2 rounded-xl text-xs font-bold">Excel</a>
                <a href="{{ route('admin.laporan.absensi.export.csv', request()->query()) }}" class="bg-blue-600 text-white px-4 py-2 rounded-xl text-xs font-bold">CSV</a>
                <a href="{{ route('admin.laporan.absensi.export.pdf', request()->query()) }}" class="bg-red-600 text-white px-4 py-2 rounded-xl text-xs font-bold">PDF</a>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6 mb-8">
            <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <select name="id_kegiatan" class="rounded-2xl border-slate-200 text-sm">
                    <option value="">Semua Kegiatan</option>
                    @foreach($kegiatans as $kegiatan)
                        <option value="{{ $kegiatan->id_kegiatan }}" @selected(request('id_kegiatan') == $kegiatan->id_kegiatan)>{{ $kegiatan->judul }}</option>
                    @endforeach
                </select>
                <select name="status_kehadiran" class="rounded-2xl border-slate-200 text-sm">
                    <option value="">Semua Status</option>
                    <option value="1" @selected(request('status_kehadiran') === '1')>Hadir</option>
                    <option value="0" @selected(request('status_kehadiran') === '0')>Tidak Hadir</option>
                </select>
                <input type="text" name="pac" value="{{ request('pac') }}" placeholder="Filter PAC" class="rounded-2xl border-slate-200 text-sm">
                <button class="bg-slate-800 hover:bg-emerald-600 text-white rounded-2xl text-xs font-black uppercase tracking-widest">Terapkan</button>
            </form>
        </div>

        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-slate-50 text-[10px] uppercase tracking-widest text-slate-500 font-black">
                        <tr>
                            <th class="px-6 py-4">Kegiatan</th>
                            <th class="px-6 py-4">Peserta</th>
                            <th class="px-6 py-4">PAC</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Waktu</th>
                            <th class="px-6 py-4">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse($absensi as $item)
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-4 font-bold text-slate-800">{{ $item->pendaftaran->kegiatan->judul ?? '-' }}</td>
                                <td class="px-6 py-4">{{ $item->pendaftaran->display_name ?? '-' }}<div class="text-xs text-slate-400">{{ $item->pendaftaran->anggota->nomor_anggota ?? 'Peserta Umum' }}</div></td>
                                <td class="px-6 py-4">{{ $item->pendaftaran->anggota->pac ?? '-' }}</td>
                                <td class="px-6 py-4">@if($item->hadir)<span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-xs font-black">HADIR</span>@else<span class="bg-rose-100 text-rose-700 px-3 py-1 rounded-full text-xs font-black">TIDAK HADIR</span>@endif</td>
                                <td class="px-6 py-4 text-slate-500">{{ $item->waktu_hadir ? \Carbon\Carbon::parse($item->waktu_hadir)->format('d/m/Y H:i') : '-' }}</td>
                                <td class="px-6 py-4 text-slate-500">{{ $item->keterangan ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="px-6 py-14 text-center text-slate-400 font-bold">Belum ada data absensi.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-6">{{ $absensi->links() }}</div>
        </div>
    </div>
</div>
@endsection
