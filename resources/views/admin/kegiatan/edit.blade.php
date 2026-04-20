@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white border-4 border-gray-900 shadow-[15px_15px_0px_0px_rgba(21,128,61,1)] overflow-hidden">
            <div class="bg-gray-900 px-8 py-6 flex items-center justify-between border-b-4 border-green-700">
                <div>
                    <h1 class="text-2xl font-black text-white uppercase italic tracking-tighter">Edit <span class="text-green-500">Record</span></h1>
                    <p class="text-[9px] text-gray-400 font-bold uppercase tracking-[0.3em] mt-1">ID KEGIATAN: #{{ $kegiatan->id_kegiatan }}</p>
                </div>
                <div class="bg-green-600 text-white p-3 rotate-3 shadow-[4px_4px_0px_0px_rgba(255,255,255,0.2)]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                </div>
            </div>

            <div class="p-8 md:p-12">
                <form action="{{ route('admin.kegiatan.update', $kegiatan->id_kegiatan) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-8">
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Kategori</label>
                            <select name="id_kategori" class="w-full border-2 border-gray-900 p-3 text-sm font-bold focus:bg-green-50 outline-none" required>
                                @foreach($kategoris as $kat)
                                    <option value="{{ $kat->id_kategori }}" {{ $kegiatan->id_kategori == $kat->id_kategori ? 'selected' : '' }}>{{ $kat->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Judul</label>
                            <input type="text" name="judul" value="{{ old('judul', $kegiatan->judul) }}" class="w-full border-2 border-gray-900 p-3 text-sm font-bold focus:bg-green-50 outline-none" required>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Deskripsi</label>
                            <textarea name="deskripsi" rows="4" class="w-full border-2 border-gray-900 p-3 text-sm font-bold focus:bg-green-50 outline-none">{{ old('deskripsi', $kegiatan->deskripsi) }}</textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Tanggal</label>
                                <input type="date" name="tanggal" value="{{ old('tanggal', $kegiatan->tanggal) }}" class="w-full border-2 border-gray-900 p-3 text-sm font-bold focus:bg-green-50 outline-none" required>
                            </div>
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Waktu</label>
                                <input type="time" name="waktu" value="{{ old('waktu', $kegiatan->waktu) }}" class="w-full border-2 border-gray-900 p-3 text-sm font-bold focus:bg-green-50 outline-none">
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Lokasi</label>
                            <input type="text" name="lokasi" value="{{ old('lokasi', $kegiatan->lokasi) }}" class="w-full border-2 border-gray-900 p-3 text-sm font-bold focus:bg-green-50 outline-none">
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Status</label>
                            <select name="status" class="w-full border-2 border-gray-900 p-3 text-sm font-bold focus:bg-green-50 outline-none">
                                <option value="aktif" {{ $kegiatan->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="selesai" {{ $kegiatan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="batal" {{ $kegiatan->status == 'batal' ? 'selected' : '' }}>Batal</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Kuota</label>
                            <input type="number" name="kuota" value="{{ old('kuota', $kegiatan->kuota) }}" class="w-full border-2 border-gray-900 p-3 text-sm font-bold focus:bg-green-50 outline-none">
                        </div>

                        <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-3 gap-6 items-center border-2 border-gray-900 p-6 bg-gray-50 shadow-inner">
                            <div class="text-center">
                                @if($kegiatan->pamflet)
                                    <img src="{{ Storage::url($kegiatan->pamflet->path_file) }}" class="w-32 h-32 mx-auto object-cover border-2 border-gray-900 shadow-md grayscale group-hover:grayscale-0">
                                    <p class="text-[8px] font-black uppercase text-gray-400 mt-2">Pamflet Saat Ini</p>
                                @endif
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-3 text-center md:text-left">Ganti Pamflet Baru?</label>
                                <input type="file" name="pamflet" accept="image/*" class="block w-full text-xs font-bold text-gray-500 file:mr-4 file:py-2 file:px-6 file:border-2 file:border-gray-900 file:bg-white hover:file:bg-green-700 hover:file:text-white file:cursor-pointer transition-all">
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between items-center mt-12 pt-8 border-t-4 border-gray-100">
                        <a href="{{ route('admin.kegiatan.index') }}" class="text-[10px] font-black uppercase text-gray-400 hover:text-red-600 tracking-widest">← Kembali</a>
                        <button type="submit" class="bg-gray-900 text-white font-black py-4 px-12 uppercase tracking-[0.2em] text-[11px] shadow-[6px_6px_0px_0px_rgba(21,128,61,1)] hover:bg-green-700 transition-all active:translate-y-1">
                            Update Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection