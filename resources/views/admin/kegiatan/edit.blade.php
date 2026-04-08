@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold mb-4">Edit Kegiatan</h1>

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
                        <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                    </div>
                @endif

                <form action="{{ route('admin.kegiatan.update', $kegiatan->id_kegiatan) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="mb-4"><label class="block font-medium">Kategori</label><select name="id_kategori" class="w-full border rounded px-2 py-1" required>@foreach($kategoris as $kat)<option value="{{ $kat->id_kategori }}" {{ $kegiatan->id_kategori == $kat->id_kategori ? 'selected' : '' }}>{{ $kat->nama }}</option>@endforeach</select></div>
                    <div class="mb-4"><label class="block font-medium">Judul</label><input type="text" name="judul" value="{{ old('judul', $kegiatan->judul) }}" class="w-full border rounded px-2 py-1" required></div>
                    <div class="mb-4"><label class="block font-medium">Deskripsi</label><textarea name="deskripsi" class="w-full border rounded px-2 py-1">{{ old('deskripsi', $kegiatan->deskripsi) }}</textarea></div>
                    <div class="mb-4"><label class="block font-medium">Tanggal</label><input type="date" name="tanggal" value="{{ old('tanggal', $kegiatan->tanggal) }}" class="w-full border rounded px-2 py-1" required></div>
                    <div class="mb-4"><label class="block font-medium">Waktu</label><input type="time" name="waktu" value="{{ old('waktu', $kegiatan->waktu) }}" class="w-full border rounded px-2 py-1"></div>
                    <div class="mb-4"><label class="block font-medium">Lokasi</label><input type="text" name="lokasi" value="{{ old('lokasi', $kegiatan->lokasi) }}" class="w-full border rounded px-2 py-1"></div>
                    <div class="mb-4"><label class="block font-medium">Kuota</label><input type="number" name="kuota" value="{{ old('kuota', $kegiatan->kuota) }}" class="w-full border rounded px-2 py-1"></div>
                    <div class="mb-4"><label class="block font-medium">Status</label><select name="status" class="w-full border rounded px-2 py-1"><option value="aktif" {{ $kegiatan->status=='aktif'?'selected':'' }}>Aktif</option><option value="selesai" {{ $kegiatan->status=='selesai'?'selected':'' }}>Selesai</option><option value="batal" {{ $kegiatan->status=='batal'?'selected':'' }}>Batal</option></select></div>
                    <div class="mb-4"><label class="block font-medium">Pamflet (gambar baru jika ingin ganti)</label><input type="file" name="pamflet" accept="image/*" class="w-full border rounded px-2 py-1"></div>
                    @if($kegiatan->pamflet)<div class="mb-4"><img src="{{ Storage::url($kegiatan->pamflet->path_file) }}" class="w-32 h-32 object-cover"></div>@endif
                    <div class="flex gap-2"><button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button><a href="{{ route('admin.kegiatan.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</a></div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection