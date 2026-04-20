@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border-2 border-green-700">
            <div class="bg-green-800 px-6 py-4 flex items-center gap-3 border-b-2 border-yellow-500">
                <div class="bg-yellow-500 rounded-full p-2">
                    <svg class="w-6 h-6 text-green-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <h1 class="text-2xl md:text-3xl font-bold text-yellow-400">Profil Saya</h1>
            </div>

            <div class="p-6 md:p-8">
                @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Form Edit Data Diri -->
                <form action="{{ route('anggota.profil.update') }}" method="POST" enctype="multipart/form-data" class="mb-10">
                    @csrf @method('PUT')
                    <h2 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">Data Diri</h2>
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
                                {{ $user->email }}
                            </div>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $anggota->nama_lengkap) }}" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Kontak</label>
                            <input type="text" name="kontak" value="{{ old('kontak', $anggota->kontak) }}" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500" required>
                            <p class="text-xs text-gray-500 mt-1">Contoh: 081234567890 atau +6281234567890</p>
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
                    <div class="mt-6">
                        <button type="submit" class="bg-green-700 hover:bg-green-800 text-white font-bold py-2 px-6 rounded-lg shadow transition">Simpan Perubahan</button>
                    </div>
                </form>

                <!-- Form Ganti Password -->
                <form action="{{ route('anggota.profil.update-password') }}" method="POST">
                    @csrf @method('PUT')
                    <h2 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">Ganti Password</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Password Lama</label>
                            <input type="password" name="current_password" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Password Baru</label>
                            <input type="password" name="new_password" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Konfirmasi Password Baru</label>
                            <input type="password" name="new_password_confirmation" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500" required>
                        </div>
                    </div>
                    <div class="mt-6">
                        <button type="submit" class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-6 rounded-lg shadow transition">Ganti Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection