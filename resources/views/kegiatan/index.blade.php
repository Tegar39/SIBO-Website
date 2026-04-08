@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold mb-6">Daftar Kegiatan</h1>
        @if($kegiatans->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($kegiatans as $kegiatan)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                        @if($kegiatan->pamflet)
                            <img src="{{ Storage::url($kegiatan->pamflet->path_file) }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">Tidak ada gambar</div>
                        @endif
                        <div class="p-4">
                            <h2 class="text-xl font-bold mb-1">{{ $kegiatan->judul }}</h2>
                            <p class="text-gray-600 text-sm mb-2">{{ $kegiatan->kategori->nama }} | {{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('d M Y') }}</p>
                            <p class="text-gray-700 mb-3 line-clamp-2">{{ Str::limit($kegiatan->deskripsi, 100) }}</p>
                            <p class="text-sm font-semibold">Peserta: {{ $kegiatan->pendaftarans->where('status', 'disetujui')->count() }} / {{ $kegiatan->kuota == 0 ? '∞' : $kegiatan->kuota }}</p>
                            <a href="{{ route('kegiatan.publik.show', $kegiatan->id_kegiatan) }}" wire:navigate class="mt-3 inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm transition">Detail & Daftar</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-6">{{ $kegiatans->links() }}</div>
        @else
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded">Belum ada kegiatan yang tersedia saat ini.</div>
        @endif
    </div>
</div>
@endsection