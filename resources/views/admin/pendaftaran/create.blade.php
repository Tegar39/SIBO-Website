@extends('layouts.app')

@section('content')
<div class="py-10 sibo-page-shell min-h-screen">
    <div class="max-w-2xl mx-auto mt-4 px-4 sm:px-6 lg:px-8">
        <div class="bg-white/95 backdrop-blur rounded-[2rem] shadow-2xl shadow-slate-200/70 overflow-hidden border border-emerald-100">
            <div class="bg-gradient-to-r from-emerald-700 via-emerald-600 to-emerald-500 px-6 py-6">
                <h2 class="text-xl font-bold text-white">Tambah Peserta untuk {{ $kegiatan->judul }}</h2>
                <p class="text-emerald-100 text-xs mt-1">*Peserta tidak perlu memiliki akun</p>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.pendaftaran.store', $kegiatan->id_kegiatan) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap Peserta</label>
                        <input type="text" name="nama_peserta" class="w-full border border-slate-200 rounded-2xl p-4 bg-slate-50/70 focus:bg-white focus:ring-emerald-500 focus:border-emerald-500 transition" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Nomor Kontak (HP)</label>
                        <input type="text" name="kontak_peserta" class="w-full border border-slate-200 rounded-2xl p-4 bg-slate-50/70 focus:bg-white focus:ring-emerald-500 focus:border-emerald-500 transition" required>
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Status Pendaftaran</label>
                        <select name="status" class="w-full border border-slate-200 rounded-2xl p-4 bg-slate-50/70 focus:bg-white focus:ring-emerald-500 focus:border-emerald-500 transition">
                            <option value="pending">Pending (Menunggu Konfirmasi)</option>
                            <option value="disetujui">Disetujui</option>
                            <option value="ditolak">Ditolak</option>
                            <option value="batal">Batal</option>
                        </select>
                    </div>
                    <div class="flex gap-4">
                        <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 px-8 rounded-2xl transition shadow-lg shadow-emerald-200 hover:-translate-y-0.5">Simpan</button>
                        <a href="{{ route('admin.pendaftaran.show', $kegiatan->id_kegiatan) }}" class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold py-3 px-8 rounded-2xl transition">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection