@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold mb-4">Edit Kegiatan</h1>

                @if ($errors->any())
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.kegiatan.update', $kegiatan->id_kegiatan) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Kategori</label>
                            <select name="id_kategori" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                @foreach($kategoris as $kat)
                                    <option value="{{ $kat->id_kategori }}" {{ $kegiatan->id_kategori == $kat->id_kategori ? 'selected' : '' }}>{{ $kat->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Judul</label>
                            <input type="text" name="judul" value="{{ old('judul', $kegiatan->judul) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <div class="col-span-2">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Deskripsi</label>
                            <textarea name="deskripsi" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('deskripsi', $kegiatan->deskripsi) }}</textarea>
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Tanggal</label>
                            <input type="date" name="tanggal" value="{{ old('tanggal', $kegiatan->tanggal) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Waktu</label>
                            <input type="time" name="waktu" value="{{ old('waktu', $kegiatan->waktu) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Lokasi</label>
                            <input type="text" name="lokasi" value="{{ old('lokasi', $kegiatan->lokasi) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Kuota</label>
                            <input type="number" name="kuota" value="{{ old('kuota', $kegiatan->kuota) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Status</label>
                            <select name="status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="aktif" {{ $kegiatan->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="selesai" {{ $kegiatan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="batal" {{ $kegiatan->status == 'batal' ? 'selected' : '' }}>Batal</option>
                            </select>
                        </div>
                        <div class="col-span-2">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Pamflet (gambar baru jika ingin ganti)</label>
                            <input type="file" name="pamflet" accept="image/*" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @if($kegiatan->pamflet)
                                <div class="mt-2">
                                    <img src="{{ Storage::url($kegiatan->pamflet->path_file) }}" class="w-32 h-32 object-cover rounded shadow">
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="flex items-center justify-between mt-6">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update</button>
                        <a href="{{ route('admin.kegiatan.index') }}" class="text-gray-600 hover:text-gray-800">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection