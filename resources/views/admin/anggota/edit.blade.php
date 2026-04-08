@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold mb-4">Edit Anggota</h1>

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
                        <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                    </div>
                @endif

                <form action="{{ route('admin.anggota.update', $anggota->id_anggota) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-4"><label class="block font-medium">Nama Lengkap</label><input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $anggota->nama_lengkap) }}" class="w-full border rounded px-2 py-1" required></div>
                    <div class="mb-4"><label class="block font-medium">Nomor Anggota</label><input type="text" name="nomor_anggota" value="{{ old('nomor_anggota', $anggota->nomor_anggota) }}" class="w-full border rounded px-2 py-1" required></div>
                    <div class="mb-4"><label class="block font-medium">Tempat Lahir</label><input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $anggota->tempat_lahir) }}" class="w-full border rounded px-2 py-1"></div>
                    <div class="mb-4"><label class="block font-medium">Tanggal Lahir</label><input type="date" name="tgl_lahir" value="{{ old('tgl_lahir', $anggota->tgl_lahir) }}" class="w-full border rounded px-2 py-1"></div>
                    <div class="mb-4"><label class="block font-medium">Alamat</label><textarea name="alamat" class="w-full border rounded px-2 py-1">{{ old('alamat', $anggota->alamat) }}</textarea></div>
                    <div class="mb-4"><label class="block font-medium">Kontak</label><input type="text" name="kontak" value="{{ old('kontak', $anggota->kontak) }}" class="w-full border rounded px-2 py-1"></div>
                    <div class="mb-4"><label class="block font-medium">PAC</label><input type="text" name="pac" value="{{ old('pac', $anggota->pac) }}" class="w-full border rounded px-2 py-1"></div>
                    <div class="flex gap-2">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
                        <a href="{{ route('admin.anggota.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection