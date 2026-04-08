@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold mb-4">Kelola Pendaftaran</h1>
                @if(session('success'))<div class="bg-green-100 border-green-400 text-green-700 px-4 py-2 rounded mb-4">{{ session('success') }}</div>@endif
                @if(session('error'))<div class="bg-red-100 border-red-400 text-red-700 px-4 py-2 rounded mb-4">{{ session('error') }}</div>@endif
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @forelse($kegiatans as $k)
                        <a href="{{ route('admin.pendaftaran.show', $k->id_kegiatan) }}" class="block bg-gray-50 hover:bg-gray-100 border rounded-lg p-4 transition">
                            <h3 class="font-bold text-lg">{{ $k->judul }}</h3>
                            <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($k->tanggal)->format('d M Y') }}</p>
                            <p class="text-sm mt-2">Jumlah pendaftar: <span class="font-semibold">{{ $k->pendaftarans_count }}</span></p>
                        </a>
                    @empty
                        <div class="col-span-full text-center text-gray-500 py-8">Belum ada kegiatan dengan pendaftar.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection