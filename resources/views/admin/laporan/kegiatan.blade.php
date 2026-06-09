@extends('layouts.app')

@section('content')
<div class="pt-20 pb-12 bg-slate-50 min-h-screen font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-6 flex items-center justify-between">
            <div>
                <a href="{{ route('admin.laporan.index') }}" class="text-sm text-emerald-600 hover:underline mb-2 inline-block">← Kembali</a>
                <h1 class="text-2xl font-bold text-slate-800">Laporan Data Kegiatan</h1>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.laporan.kegiatan.export.excel', request()->all()) }}" class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm">Export Excel</a>
                <a href="{{ route('admin.laporan.kegiatan.export.pdf', request()->all()) }}" class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm">Export PDF</a>
            </div>
        </div>

        
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6 mb-8">
            <form method="GET" class="grid grid-cols-1 md:grid-cols-6 gap-4 items-end">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul/lokasi..." class="rounded-2xl border-slate-200 text-sm">
                <select name="pac" class="rounded-2xl border-slate-200 text-sm"><option value="">Semua PAC</option>@foreach(($pacList ?? []) as $pac)<option value="{{ $pac }}" @selected(request('pac') == $pac)>{{ $pac }}</option>@endforeach</select>
                <select name="status" class="rounded-2xl border-slate-200 text-sm"><option value="">Semua Status</option>@foreach(['aktif','tutup','selesai','batal'] as $st)<option value="{{ $st }}" @selected(request('status') == $st)>{{ ucfirst($st) }}</option>@endforeach</select>
                <select name="bulan" class="rounded-2xl border-slate-200 text-sm"><option value="">Semua Bulan</option>@foreach(range(1,12) as $b)<option value="{{ $b }}" @selected((string)request('bulan') === (string)$b)>{{ \Carbon\Carbon::create()->month($b)->translatedFormat('F') }}</option>@endforeach</select>
                <input type="number" name="tahun" value="{{ request('tahun', now()->year) }}" placeholder="Tahun" class="rounded-2xl border-slate-200 text-sm">
                <button class="bg-slate-900 hover:bg-emerald-600 text-white rounded-2xl py-3 text-xs font-black uppercase tracking-widest">Filter</button>
            </form>
        </div>

        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-bold text-slate-500">No</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-slate-500">Judul Kegiatan</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-slate-500">Kategori</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-slate-500">Tanggal</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-slate-500">Lokasi</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-slate-500">Peserta</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-slate-500">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($kegiatan as $key => $k)
                        <tr class="hover:bg-slate-50">
                            <td class="px-4 py-3 text-sm">{{ $key + 1 }}</td>
                            <td class="px-4 py-3 text-sm font-medium">{{ $k->judul }}</td>
                            <td class="px-4 py-3 text-sm">{{ $k->kategori->nama ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm">{{ \Carbon\Carbon::parse($k->tanggal)->format('d M Y') }}</td>
                            <td class="px-4 py-3 text-sm">{{ $k->lokasi ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm">{{ $k->pendaftarans->count() }}</td>
                            <td class="px-4 py-3 text-sm">
                                <span class="px-2 py-1 rounded text-xs font-bold
                                    @if($k->status == 'aktif') bg-green-100 text-green-700
                                    @elseif($k->status == 'tutup') bg-orange-100 text-orange-700
                                    @elseif($k->status == 'selesai') bg-slate-100 text-slate-500
                                    @else bg-rose-100 text-rose-600 @endif">
                                    {{ $k->status }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection