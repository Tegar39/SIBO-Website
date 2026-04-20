@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border-2 border-green-700">
            <div class="bg-green-800 px-6 py-4 flex items-center gap-3 border-b-2 border-yellow-500">
                <div class="bg-yellow-500 rounded-full p-2">
                    <svg class="w-6 h-6 text-green-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </div>
                <h1 class="text-2xl md:text-3xl font-bold text-yellow-400">Edit Anggota</h1>
            </div>

            <div class="p-6 md:p-8">
                @if ($errors->any())
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.anggota.update', $anggota->id_anggota) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Nomor Anggota</label>
                            <div class="bg-gray-100 px-4 py-2 rounded-lg border border-gray-300 text-gray-700">
                                {{ $anggota->nomor_anggota }}
                            </div>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Email</label>
                            <div class="bg-gray-100 px-4 py-2 rounded-lg border border-gray-300 text-gray-700">
                                {{ $anggota->user->email }}
                            </div>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $anggota->nama_lengkap) }}" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Kontak</label>
                            <input type="text" name="kontak" value="{{ old('kontak', $anggota->kontak) }}" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $anggota->tempat_lahir) }}" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Tanggal Lahir</label>
                            <input type="date" name="tgl_lahir" value="{{ old('tgl_lahir', $anggota->tgl_lahir) }}" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-gray-700 font-semibold mb-2">Alamat</label>
                            <textarea name="alamat" rows="2" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500">{{ old('alamat', $anggota->alamat) }}</textarea>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">PAC</label>
                            <select name="pac" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500" required>
                                <option value="PAC-01" {{ $anggota->pac == 'PAC-01' ? 'selected' : '' }}>PAC-01</option>
                                <option value="PAC-02" {{ $anggota->pac == 'PAC-02' ? 'selected' : '' }}>PAC-02</option>
                                <option value="PAC-03" {{ $anggota->pac == 'PAC-03' ? 'selected' : '' }}>PAC-03</option>
                                <option value="PAC-04" {{ $anggota->pac == 'PAC-04' ? 'selected' : '' }}>PAC-04</option>
                                <option value="PAC-05" {{ $anggota->pac == 'PAC-05' ? 'selected' : '' }}>PAC-05</option>
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-gray-700 font-semibold mb-2">Foto Profil</label>
                            <input type="file" name="foto_profil" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-green-600 file:text-white hover:file:bg-green-700">
                            @if($anggota->foto_profil && Storage::disk('public')->exists($anggota->foto_profil))
                                <div class="mt-3">
                                    <img src="{{ Storage::url($anggota->foto_profil) }}" class="w-24 h-24 object-cover rounded-full border-2 border-green-600 shadow">
                                    <p class="text-xs text-gray-500 mt-1">Foto saat ini</p>
                                </div>
                            @else
                                <div class="mt-3 text-gray-500 text-sm">Belum ada foto profil</div>
                            @endif
                        </div>
                    </div>
                    <div class="flex justify-between items-center mt-8 pt-4 border-t border-gray-200">
                        <button type="submit" class="bg-green-700 hover:bg-green-800 text-white font-bold py-2 px-6 rounded-lg shadow transition">Update</button>
                        <a href="{{ route('admin.anggota.index') }}" class="text-gray-600 hover:text-gray-800">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection