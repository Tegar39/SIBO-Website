@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white border-2 border-gray-900 shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] overflow-hidden">
            <div class="bg-gray-900 px-8 py-6 border-b-4 border-yellow-500 flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-black text-white uppercase italic tracking-tighter">Update <span class="text-yellow-400">Profile</span></h1>
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest font-mono">NO: {{ $anggota->nomor_anggota }}</p>
                </div>
                <div class="bg-yellow-500 p-2 rounded-sm rotate-3 shadow-md">
                    <svg class="w-6 h-6 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </div>
            </div>

            <div class="p-8">
                @if ($errors->any())
                    <div class="bg-red-50 border-l-8 border-red-600 p-4 mb-8 text-red-700 font-black text-[10px] uppercase tracking-widest">
                        Periksa kembali inputan anda!
                    </div>
                @endif

                <form action="{{ route('admin.anggota.update', $anggota->id_anggota) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-6">
                        <div class="opacity-60">
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">ID Anggota (Read Only)</label>
                            <div class="w-full border-2 border-gray-200 bg-gray-50 p-3 text-sm font-bold font-mono tracking-tighter">
                                {{ $anggota->nomor_anggota }}
                            </div>
                        </div>
                        <div class="opacity-60">
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Email Akun (Read Only)</label>
                            <div class="w-full border-2 border-gray-200 bg-gray-50 p-3 text-sm font-bold italic">
                                {{ $anggota->user->email }}
                            </div>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $anggota->nama_lengkap) }}" class="w-full border-2 border-gray-900 p-3 text-sm font-bold focus:ring-0 focus:border-green-600 transition-colors uppercase shadow-[4px_4px_0px_0px_rgba(0,0,0,0.05)]" required>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Nomor Kontak</label>
                            <input type="text" name="kontak" value="{{ old('kontak', $anggota->kontak) }}" class="w-full border-2 border-gray-900 p-3 text-sm font-bold focus:ring-0 focus:border-green-600 transition-colors shadow-[4px_4px_0px_0px_rgba(0,0,0,0.05)]" required>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $anggota->tempat_lahir) }}" class="w-full border-2 border-gray-900 p-3 text-sm font-bold focus:ring-0 focus:border-green-600 transition-colors uppercase shadow-[4px_4px_0px_0px_rgba(0,0,0,0.05)]">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Tanggal Lahir</label>
                            <input type="date" name="tgl_lahir" value="{{ old('tgl_lahir', $anggota->tgl_lahir) }}" class="w-full border-2 border-gray-900 p-3 text-sm font-bold focus:ring-0 focus:border-green-600 transition-colors shadow-[4px_4px_0px_0px_rgba(0,0,0,0.05)]">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Alamat Domisili</label>
                            <textarea name="alamat" rows="2" class="w-full border-2 border-gray-900 p-3 text-sm font-bold focus:ring-0 focus:border-green-600 transition-colors shadow-[4px_4px_0px_0px_rgba(0,0,0,0.05)]">{{ old('alamat', $anggota->alamat) }}</textarea>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Wilayah (PAC)</label>
                            <select name="pac" class="w-full border-2 border-gray-900 p-3 text-sm font-bold focus:ring-0 focus:border-green-600 transition-colors shadow-[4px_4px_0px_0px_rgba(0,0,0,0.05)]" required>
                                @for($i=1; $i<=5; $i++)
                                    <option value="PAC-0{{ $i }}" {{ $anggota->pac == "PAC-0$i" ? 'selected' : '' }}>PAC-0{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Update Foto Profil</label>
                            <div class="flex items-center gap-6">
                                <div class="flex-1">
                                    <input type="file" name="foto_profil" accept="image/*" class="block w-full text-xs font-bold text-gray-500 file:mr-4 file:py-3 file:px-6 file:border-0 file:bg-gray-900 file:text-white hover:file:bg-green-700 file:cursor-pointer file:uppercase file:tracking-widest">
                                </div>
                                @if($anggota->foto_profil)
                                    <div class="text-right">
                                        <img src="{{ Storage::url($anggota->foto_profil) }}" class="w-16 h-16 object-cover border-2 border-green-600 shadow-sm">
                                        <p class="text-[8px] font-black uppercase text-gray-400 mt-1">Current Photo</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between items-center mt-12 pt-6 border-t-2 border-gray-100">
                        <a href="{{ route('admin.anggota.index') }}" class="text-[10px] font-black uppercase text-gray-400 hover:text-red-600 tracking-widest transition-colors">
                            ← Kembali
                        </a>
                        <button type="submit" class="bg-green-700 hover:bg-black text-white font-black py-4 px-12 uppercase tracking-[0.2em] text-[11px] shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transition-all">
                            Perbarui Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection