@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white border-2 border-gray-900 shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] overflow-hidden">
            <div class="bg-green-800 px-8 py-6 border-b-4 border-yellow-500 flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-black text-white uppercase italic tracking-tighter">Entry <span class="text-yellow-400">New Member</span></h1>
                    <p class="text-[10px] text-green-200 font-bold uppercase tracking-widest">Sistem Informasi Keanggotaan PC DESBOR</p>
                </div>
                <div class="bg-yellow-500 p-2 rounded-sm rotate-3 shadow-md">
                    <svg class="w-6 h-6 text-green-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                </div>
            </div>

            <div class="p-8">
                @if ($errors->any())
                    <div class="bg-red-50 border-l-8 border-red-600 p-4 mb-8 text-red-700 font-black text-[10px] uppercase tracking-widest">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.anggota.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-6">
                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" class="w-full border-2 border-gray-900 p-3 text-sm font-bold focus:ring-0 focus:border-green-600 transition-colors uppercase shadow-[4px_4px_0px_0px_rgba(0,0,0,0.05)]" required>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Email Official</label>
                            <input type="email" name="email" class="w-full border-2 border-gray-900 p-3 text-sm font-bold focus:ring-0 focus:border-green-600 transition-colors shadow-[4px_4px_0px_0px_rgba(0,0,0,0.05)]" required>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Password Akses</label>
                            <input type="password" name="password" class="w-full border-2 border-gray-900 p-3 text-sm font-bold focus:ring-0 focus:border-green-600 transition-colors shadow-[4px_4px_0px_0px_rgba(0,0,0,0.05)]" required>
                            <p class="text-[9px] text-gray-400 mt-1 font-bold italic uppercase">Minimal 8 Karakter</p>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Nomor Kontak (WhatsApp)</label>
                            <input type="text" name="kontak" class="w-full border-2 border-gray-900 p-3 text-sm font-bold focus:ring-0 focus:border-green-600 transition-colors shadow-[4px_4px_0px_0px_rgba(0,0,0,0.05)]" placeholder="08..." required>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="w-full border-2 border-gray-900 p-3 text-sm font-bold focus:ring-0 focus:border-green-600 transition-colors uppercase shadow-[4px_4px_0px_0px_rgba(0,0,0,0.05)]">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Tanggal Lahir</label>
                            <input type="date" name="tgl_lahir" class="w-full border-2 border-gray-900 p-3 text-sm font-bold focus:ring-0 focus:border-green-600 transition-colors shadow-[4px_4px_0px_0px_rgba(0,0,0,0.05)]">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Alamat Domisili Lengkap</label>
                            <textarea name="alamat" rows="2" class="w-full border-2 border-gray-900 p-3 text-sm font-bold focus:ring-0 focus:border-green-600 transition-colors shadow-[4px_4px_0px_0px_rgba(0,0,0,0.05)]"></textarea>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Pilih Wilayah (PAC)</label>
                            <select name="pac" class="w-full border-2 border-gray-900 p-3 text-sm font-bold focus:ring-0 focus:border-green-600 transition-colors shadow-[4px_4px_0px_0px_rgba(0,0,0,0.05)]" required>
                                <option value="">- SELECT REGION -</option>
                                @for($i=1; $i<=5; $i++)
                                    <option value="PAC-0{{ $i }}">PAC-0{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Unggah Foto Profil</label>
                            <input type="file" name="foto_profil" accept="image/*" class="block w-full text-xs font-bold text-gray-500 file:mr-4 file:py-3 file:px-6 file:border-0 file:bg-gray-900 file:text-white hover:file:bg-green-700 file:cursor-pointer file:uppercase file:tracking-widest">
                            <p class="text-[9px] text-gray-400 mt-2 font-bold italic uppercase">Format: JPG/PNG, Max Size: 2MB</p>
                        </div>
                    </div>

                    <div class="flex justify-between items-center mt-12 pt-6 border-t-2 border-gray-100">
                        <a href="{{ route('admin.anggota.index') }}" class="text-[10px] font-black uppercase text-gray-400 hover:text-red-600 tracking-widest transition-colors">
                            ← Batal
                        </a>
                        <button type="submit" class="bg-gray-900 hover:bg-green-700 text-white font-black py-4 px-12 uppercase tracking-[0.2em] text-[11px] shadow-[4px_4px_0px_0px_rgba(234,179,8,1)] transition-all active:translate-y-1">
                            Simpan Anggota
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection