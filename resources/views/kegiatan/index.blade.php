@extends('layouts.app')
@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold mb-6">Daftar Kegiatan</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($kegiatans as $k)
            <div class="bg-white rounded-lg shadow p-4">
                @if($k->pamflet)<img src="{{ Storage::url($k->pamflet) }}" class="w-full h-40 object-cover rounded">@endif
                <h2 class="text-xl font-bold mt-2">{{ $k->judul }}</h2>
                <p class="text-gray-600">{{ $k->tanggal }} | {{ $k->kategori->nama }}</p>
                <p class="mt-2">Peserta: {{ $k->jumlah_peserta }} / {{ $k->kuota == 0 ? '∞' : $k->kuota }}</p>
                <a href="{{ route('kegiatan.publik.show', $k->id_kegiatan) }}" class="mt-3 inline-block bg-blue-500 text-white px-3 py-1 rounded">Detail</a>
            </div>
            @endforeach
        </div>
        {{ $kegiatans->links() }}
    </div>
</div>
@endsection