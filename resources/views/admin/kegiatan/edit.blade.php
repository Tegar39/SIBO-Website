@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <!-- Card dengan border hijau dan header hijau, isi putih -->
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border-2 border-green-700">
            <!-- Header hijau dengan aksen emas -->
            <div class="bg-green-800 px-6 py-4 flex items-center gap-3 border-b-2 border-yellow-500">
                <div class="bg-yellow-500 rounded-full p-2">
                    <svg class="w-6 h-6 text-green-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </div>
                <h1 class="text-2xl md:text-3xl font-bold text-yellow-400">Edit Kegiatan</h1>
            </div>

            <!-- Body putih untuk form -->
            <div class="p-6 md:p-8">
                <!-- Error messages -->
                @if ($errors->any())
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.kegiatan.update', $kegiatan->id_kegiatan) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Kategori -->
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Kategori</label>
                            <select name="id_kategori" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500" required>
                                @foreach($kategoris as $kat)
                                    <option value="{{ $kat->id_kategori }}" {{ $kegiatan->id_kategori == $kat->id_kategori ? 'selected' : '' }}>{{ $kat->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Judul -->
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Judul</label>
                            <input type="text" name="judul" value="{{ old('judul', $kegiatan->judul) }}" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500" required>
                        </div>
                        <!-- Deskripsi -->
                        <div class="md:col-span-2">
                            <label class="block text-gray-700 font-semibold mb-2">Deskripsi</label>
                            <textarea name="deskripsi" rows="3" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500">{{ old('deskripsi', $kegiatan->deskripsi) }}</textarea>
                        </div>
                        <!-- Tanggal -->
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Tanggal</label>
                            <input type="date" name="tanggal" value="{{ old('tanggal', $kegiatan->tanggal) }}" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500" required>
                        </div>
                        <!-- Waktu -->
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Waktu</label>
                            <input type="time" name="waktu" value="{{ old('waktu', $kegiatan->waktu) }}" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        </div>
                        <!-- Lokasi -->
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Lokasi</label>
                            <input type="text" name="lokasi" value="{{ old('lokasi', $kegiatan->lokasi) }}" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        </div>
                        <!-- Kuota -->
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Kuota (0 = tak terbatas)</label>
                            <input type="number" name="kuota" value="{{ old('kuota', $kegiatan->kuota) }}" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        </div>
                        <!-- Status -->
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Status</label>
                            <select name="status" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                <option value="aktif" {{ $kegiatan->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="selesai" {{ $kegiatan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="batal" {{ $kegiatan->status == 'batal' ? 'selected' : '' }}>Batal</option>
                            </select>
                        </div>
                        <!-- Pamflet -->
                        <div class="md:col-span-2">
                            <label class="block text-gray-700 font-semibold mb-2">Pamflet (gambar baru jika ingin ganti)</label>
                            <input type="file" name="pamflet" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-green-600 file:text-white hover:file:bg-green-700">
                            @if($kegiatan->pamflet)
                                <div class="mt-3">
                                    <img src="{{ Storage::url($kegiatan->pamflet->path_file) }}" class="w-32 h-32 object-cover rounded border-2 border-green-600 shadow">
                                    <p class="text-xs text-gray-500 mt-1">Pamflet saat ini</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Tombol aksi -->
                    <div class="flex justify-between items-center mt-8 pt-4 border-t border-gray-200">
                        <button type="submit" class="bg-green-700 hover:bg-green-800 text-white font-bold py-2 px-6 rounded-lg shadow transition">Update Kegiatan</button>
                        <a href="{{ route('admin.kegiatan.index') }}" class="text-gray-600 hover:text-gray-800">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection