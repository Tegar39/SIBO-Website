@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold mb-4">Edit Kategori</h1>
                <form action="{{ route('admin.kategori.update', $kategori->id_kategori) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-4"><label class="block font-medium">Nama Kategori</label><input type="text" name="nama" value="{{ old('nama', $kategori->nama) }}" class="w-full border rounded px-2 py-1" required></div>
                    <div class="mb-4"><label class="block font-medium">Deskripsi</label><textarea name="deskripsi" class="w-full border rounded px-2 py-1">{{ old('deskripsi', $kategori->deskripsi) }}</textarea></div>
                    <div class="flex gap-2"><button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button><a href="{{ route('admin.kategori.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</a></div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection