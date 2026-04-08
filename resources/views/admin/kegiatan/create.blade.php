@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold mb-4">Tambah Kegiatan</h1>

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
                        <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                    </div>
                @endif

                <form action="{{ route('admin.kegiatan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4"><label class="block font-medium">Kategori</label><select name="id_kategori" class="w-full border rounded px-2 py-1" required>@foreach($kategoris as $kat)<option value="{{ $kat->id_kategori }}">{{ $kat->nama }}</option>@endforeach</select></div>
                    <div class="mb-4"><label class="block font-medium">Judul</label><input type="text" name="judul" class="w-full border rounded px-2 py-1" required></div>
                    <div class="mb-4"><label class="block font-medium">Deskripsi</label><textarea name="deskripsi" class="w-full border rounded px-2 py-1"></textarea></div>
                    <div class="mb-4"><label class="block font-medium">Tanggal</label><input type="date" name="tanggal" class="w-full border rounded px-2 py-1" required></div>
                    <div class="mb-4"><label class="block font-medium">Waktu</label><input type="time" name="waktu" class="w-full border rounded px-2 py-1"></div>
                    <div class="mb-4"><label class="block font-medium">Lokasi</label><input type="text" name="lokasi" class="w-full border rounded px-2 py-1"></div>
                    <div class="mb-4"><label class="block font-medium">Kuota (0 = tidak terbatas)</label><input type="number" name="kuota" value="0" class="w-full border rounded px-2 py-1"></div>
                    <div class="mb-4"><label class="block font-medium">Status</label><select name="status" class="w-full border rounded px-2 py-1"><option value="aktif">Aktif</option><option value="selesai">Selesai</option><option value="batal">Batal</option></select></div>
                    <div class="mb-4"><label class="block font-medium">Pamflet (gambar)</label><input type="file" name="pamflet" accept="image/*" class="w-full border rounded px-2 py-1"></div>
                    <div class="flex gap-2"><button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button><a href="{{ route('admin.kegiatan.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</a></div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection