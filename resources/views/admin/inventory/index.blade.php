@extends('layouts.app')

@section('content')
<div class="pt-20 pb-12 bg-slate-50 min-h-screen font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8 flex flex-col md:flex-row md:items-end md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-800">Integrasi <span class="text-emerald-600">Inventaris Eksternal</span></h1>
                <p class="text-slate-500 text-sm mt-1">Pantau ketersediaan alat/barang dari sistem inventaris eksternal.</p>
            </div>
            <a href="{{ route('admin.inventory.sync') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-3 rounded-2xl text-xs font-black uppercase tracking-widest transition">Tes Koneksi / Sinkron</a>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-emerald-50 border border-emerald-100 text-emerald-700 px-5 py-4 rounded-2xl text-sm font-semibold">{{ session('success') }}</div>
        @endif
        @if(session('warning'))
            <div class="mb-6 bg-amber-50 border border-amber-100 text-amber-700 px-5 py-4 rounded-2xl text-sm font-semibold">{{ session('warning') }}</div>
        @endif

        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6 mb-8">
            <form method="GET" class="flex flex-col md:flex-row gap-3">
                <input type="text" name="keyword" value="{{ $keyword }}" placeholder="Cari nama barang, kode, kategori, atau status" class="flex-1 rounded-2xl border-slate-200 focus:border-emerald-500 focus:ring-emerald-500">
                <button class="bg-slate-800 hover:bg-emerald-600 text-white px-6 py-3 rounded-2xl text-xs font-black uppercase tracking-widest transition">Filter</button>
            </form>
            <p class="mt-4 text-xs text-slate-500">Status: {{ $inventory['message'] }}</p>
        </div>

        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
                <h2 class="font-bold text-slate-800">Daftar Inventaris</h2>
                <span class="text-xs font-black text-emerald-600 uppercase tracking-widest">{{ count($inventory['items']) }} Item</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-slate-50 text-[10px] uppercase tracking-widest text-slate-500 font-black">
                        <tr>
                            <th class="px-6 py-4">No</th>
                            <th class="px-6 py-4">Nama/Kode</th>
                            <th class="px-6 py-4">Kategori</th>
                            <th class="px-6 py-4">Stok</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Raw Data</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse($inventory['items'] as $index => $item)
                            @php
                                $nama = $item['nama'] ?? $item['name'] ?? $item['item_name'] ?? '-';
                                $kode = $item['kode'] ?? $item['code'] ?? $item['sku'] ?? '-';
                                $kategori = $item['kategori'] ?? $item['category'] ?? '-';
                                $stok = $item['stok'] ?? $item['stock'] ?? $item['quantity'] ?? '-';
                                $status = $item['status'] ?? $item['availability'] ?? '-';
                            @endphp
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-4 font-bold text-slate-400">{{ $index + 1 }}</td>
                                <td class="px-6 py-4"><div class="font-bold text-slate-800">{{ $nama }}</div><div class="text-xs text-slate-400">{{ $kode }}</div></td>
                                <td class="px-6 py-4">{{ $kategori }}</td>
                                <td class="px-6 py-4 font-bold">{{ $stok }}</td>
                                <td class="px-6 py-4"><span class="bg-emerald-50 text-emerald-700 px-3 py-1 rounded-full text-xs font-bold">{{ $status }}</span></td>
                                <td class="px-6 py-4"><code class="text-[10px] text-slate-500">{{ \Illuminate\Support\Str::limit(json_encode($item), 120) }}</code></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-16 text-center text-slate-400 font-bold">Belum ada data. Atur INVENTORY_API_URL di .env atau cek koneksi sistem eksternal.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
