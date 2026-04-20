@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white border-4 border-gray-900 shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] overflow-hidden">
            <div class="bg-green-700 px-8 py-6 border-b-4 border-gray-900 flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-4">
                    <div class="bg-yellow-400 border-2 border-gray-900 p-2 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                        <svg class="w-8 h-8 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h1 class="text-3xl font-black text-white uppercase italic tracking-tighter">Profil Saya</h1>
                </div>
            </div>

            <div class="p-8">
                @if(session('success'))
                    <div class="bg-yellow-400 border-4 border-gray-900 p-4 mb-8 font-black uppercase text-xs italic shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('anggota.profil.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf @method('PUT')
                    
                    <div class="border-b-4 border-gray-900 pb-2 mb-6">
                        <h2 class="text-xl font-black uppercase tracking-widest text-gray-900">1. Data Personal</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Nomor Anggota (Read Only)</label>
                            <div class="bg-gray-100 border-2 border-gray-900 px-4 py-3 font-black text-gray-500 italic">
                                {{ $anggota->nomor_anggota }}
                            </div>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Email Akun</label>
                            <div class="bg-gray-100 border-2 border-gray-900 px-4 py-3 font-black text-gray-500 italic">
                                {{ $user->email }}
                            </div>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-900 mb-2">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $anggota->nama_lengkap) }}" class="w-full border-2 border-gray-900 p-3 focus:bg-yellow-50 focus:outline-none font-bold" required>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-900 mb-2">WhatsApp / Kontak</label>
                            <input type="text" name="kontak" value="{{ old('kontak', $anggota->kontak) }}" class="w-full border-2 border-gray-900 p-3 focus:bg-yellow-50 focus:outline-none font-bold" required>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-900 mb-2">Tanggal Lahir</label>
                            <input type="date" name="tgl_lahir" value="{{ old('tgl_lahir', $anggota->tgl_lahir) }}" class="w-full border-2 border-gray-900 p-3 focus:bg-yellow-50 focus:outline-none font-bold">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-900 mb-2">Foto Profil</label>
                            <div class="flex items-center gap-6 p-4 border-2 border-dashed border-gray-900 bg-gray-50">
                                @if($anggota->foto_profil && Storage::disk('public')->exists($anggota->foto_profil))
                                    <img src="{{ Storage::url($anggota->foto_profil) }}" class="w-20 h-20 border-2 border-gray-900 object-cover shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                                @else
                                    <div class="w-20 h-20 bg-gray-200 border-2 border-gray-900 flex items-center justify-center font-black text-xs text-gray-400 uppercase text-center p-2">No Photo</div>
                                @endif
                                <input type="file" name="foto_profil" class="text-xs font-bold uppercase file:bg-gray-900 file:text-white file:border-0 file:px-4 file:py-2 file:mr-4 file:cursor-pointer hover:file:bg-green-700">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="bg-green-700 border-2 border-gray-900 text-white px-8 py-3 font-black uppercase italic tracking-widest shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-1 hover:translate-y-1 transition-all">
                        Update Data Diri
                    </button>
                </form>

                <form action="{{ route('anggota.profil.update-password') }}" method="POST" class="mt-16 bg-gray-900 p-8 shadow-[8px_8px_0px_0px_rgba(250,204,21,1)]">
                    @csrf @method('PUT')
                    <div class="border-b-2 border-yellow-400 pb-2 mb-6 text-yellow-400">
                        <h2 class="text-xl font-black uppercase tracking-widest">2. Keamanan Akun</h2>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-black uppercase tracking-widest text-yellow-400 mb-2">Password Saat Ini</label>
                            <input type="password" name="current_password" class="w-full border-2 border-yellow-400 bg-transparent text-white p-3 focus:outline-none" required>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-yellow-400 mb-2">Password Baru</label>
                            <input type="password" name="new_password" class="w-full border-2 border-yellow-400 bg-transparent text-white p-3 focus:outline-none" required>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-yellow-400 mb-2">Konfirmasi Password Baru</label>
                            <input type="password" name="new_password_confirmation" class="w-full border-2 border-yellow-400 bg-transparent text-white p-3 focus:outline-none" required>
                        </div>
                    </div>
                    
                    <button type="submit" class="bg-yellow-400 text-gray-900 border-2 border-yellow-400 px-8 py-3 font-black uppercase italic tracking-widest hover:bg-white hover:text-gray-900 transition-all shadow-[4px_4px_0px_0px_rgba(255,255,255,0.2)]">
                        Ganti Password
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection