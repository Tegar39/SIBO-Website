@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold mb-4">Tambah Anggota</h1>

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
                        <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                    </div>
                @endif

                <form action="{{ route('admin.anggota.store') }}" method="POST">
                    @csrf
                    <div class="mb-4"><label class="block font-medium">Nama Lengkap</label><input type="text" name="nama_lengkap" class="w-full border rounded px-2 py-1" required></div>
                    <div class="mb-4"><label class="block font-medium">Email</label><input type="email" name="email" class="w-full border rounded px-2 py-1" required></div>
                    <div class="mb-4"><label class="block font-medium">Nomor Anggota</label><input type="text" name="nomor_anggota" class="w-full border rounded px-2 py-1" required></div>
                    <div class="mb-4"><label class="block font-medium">Password</label><input type="password" name="password" class="w-full border rounded px-2 py-1" required></div>
                    <div class="mb-4"><label class="block font-medium">Tempat Lahir</label><input type="text" name="tempat_lahir" class="w-full border rounded px-2 py-1"></div>
                    <div class="mb-4"><label class="block font-medium">Tanggal Lahir</label><input type="date" name="tgl_lahir" class="w-full border rounded px-2 py-1"></div>
                    <div class="mb-4"><label class="block font-medium">Alamat</label><textarea name="alamat" class="w-full border rounded px-2 py-1"></textarea></div>
                    <div class="mb-4"><label class="block font-medium">Kontak</label><input type="text" name="kontak" class="w-full border rounded px-2 py-1"></div>
                    <div class="mb-4"><label class="block font-medium">PAC</label><input type="text" name="pac" class="w-full border rounded px-2 py-1" placeholder="Contoh: PAC-01"></div>
                    <div class="flex gap-2">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
                        <a href="{{ route('admin.anggota.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection