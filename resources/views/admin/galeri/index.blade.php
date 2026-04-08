@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold mb-4">Galeri Kegiatan</h1>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @forelse($kegiatans as $k)
                        <a href="{{ route('admin.galeri.show', $k->id_kegiatan) }}" class="block bg-gray-50 hover:bg-gray-100 border rounded-lg p-4 transition">
                            <h3 class="font-bold text-lg">{{ $k->judul }}</h3>
                            <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($k->tanggal)->format('d M Y') }}</p>
                            <p class="text-sm mt-2">Jumlah foto: <span class="font-semibold">{{ $k->galeris->count() }}</span></p>
                        </a>
                    @empty
                        <div class="col-span-full text-center text-gray-500 py-8">Belum ada kegiatan.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection