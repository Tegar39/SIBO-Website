@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-2xl font-bold">Galeri: {{ $kegiatan->judul }}</h1>
                    <div>
                        <a href="{{ route('admin.galeri.create', $kegiatan->id_kegiatan) }}" class="bg-blue-500 text-white px-4 py-2 rounded">Upload Foto</a>
                        <a href="{{ route('admin.galeri.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">Kembali</a>
                    </div>
                </div>
                @if(session('success'))<div class="bg-green-100 border-green-400 text-green-700 px-4 py-2 rounded mb-4">{{ session('success') }}</div>@endif
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @forelse($fotos as $f)
                        <div class="border rounded p-2 relative">
                            <img src="{{ Storage::url($f->path_file) }}" class="w-full h-32 object-cover">
                            <p class="text-sm mt-1 truncate">{{ $f->judul_foto ?? 'Tanpa judul' }}</p>
                            <form action="{{ route('admin.galeri.destroy', $f->id_foto) }}" method="POST" class="absolute top-1 right-1">
                                @csrf @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-1 rounded text-xs" onclick="return confirm('Yakin hapus?')">X</button>
                            </form>
                        </div>
                    @empty
                        <div class="col-span-full text-center text-gray-500 py-8">Belum ada foto di galeri.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection