@extends('layouts.app')

@section('content')
<div class="py-12 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <h1 class="text-2xl font-bold">Dashboard PAC {{ $pac }}</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                <div class="bg-emerald-50 p-6 rounded-2xl">
                    <p class="text-emerald-600 text-sm">Total Anggota di PAC</p>
                    <p class="text-4xl font-black">{{ $totalAnggota }}</p>
                </div>
                <div class="bg-slate-100 p-6 rounded-2xl">
                    <p class="text-slate-600 text-sm">Total Kegiatan yang Diikuti</p>
                    <p class="text-4xl font-black">{{ $totalKegiatan }}</p>
                </div>
            </div>
            <div class="mt-8">
                <h3 class="font-bold text-lg">Kegiatan Terbaru</h3>
                <ul class="mt-4 space-y-2">
                    @foreach($kegiatanTerbaru as $k)
                    <li class="border-b py-2">{{ $k->judul }} - {{ $k->tanggal->format('d M Y') }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection 