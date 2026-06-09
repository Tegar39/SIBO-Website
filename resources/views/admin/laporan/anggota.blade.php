@extends('layouts.app')

@section('content')
<div class="pt-20 pb-12 bg-slate-50 min-h-screen font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-6 flex items-center justify-between">
            <div>
                <a href="{{ route('admin.laporan.index') }}" class="text-sm text-emerald-600 hover:underline mb-2 inline-block">← Kembali</a>
                <h1 class="text-2xl font-bold text-slate-800">Laporan Data Anggota</h1>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.laporan.anggota.export.excel', request()->all()) }}" class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm">Export Excel</a>
                <a href="{{ route('admin.laporan.anggota.export.csv', request()->all()) }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">Export CSV</a>
                <a href="{{ route('admin.laporan.anggota.export.pdf', request()->all()) }}" class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm">Export PDF</a>
            </div>
        </div>

        
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6 mb-8">
            <form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4 items-end">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama/nomor/kontak..." class="rounded-2xl border-slate-200 text-sm">
                <select name="pac" class="rounded-2xl border-slate-200 text-sm">
                    <option value="">Semua PAC</option>
                    @foreach(($pacList ?? []) as $pac)
                        <option value="{{ $pac }}" @selected(request('pac') == $pac)>{{ $pac }}</option>
                    @endforeach
                </select>
                <select name="bulan" class="rounded-2xl border-slate-200 text-sm">
                    <option value="">Semua Bulan</option>
                    @foreach(range(1,12) as $b)
                        <option value="{{ $b }}" @selected((string)request('bulan') === (string)$b)>{{ \Carbon\Carbon::create()->month($b)->translatedFormat('F') }}</option>
                    @endforeach
                </select>
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
                            <th class="px-4 py-3 text-left text-xs font-bold text-slate-500">Nomor Anggota</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-slate-500">Nama Lengkap</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-slate-500">Email</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-slate-500">Kontak</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-slate-500">PAC</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($anggota as $key => $a)
                        <tr class="hover:bg-slate-50">
                            <td class="px-4 py-3 text-sm">{{ $key + 1 }}</td>
                            <td class="px-4 py-3 text-sm font-mono">{{ $a->nomor_anggota }}</td>
                            <td class="px-4 py-3 text-sm font-medium">{{ $a->nama_lengkap }}</td>
                            <td class="px-4 py-3 text-sm">{{ $a->user->email ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm">{{ $a->kontak }}</td>
                            <td class="px-4 py-3 text-sm">{{ $a->pac }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection