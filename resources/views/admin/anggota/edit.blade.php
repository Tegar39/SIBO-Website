@extends('layouts.app')

@section('content')
<div class="pt-28 pb-12 bg-slate-50 min-h-screen font-sans">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white/70 backdrop-blur-md border border-white/50 rounded-[2.5rem] shadow-xl overflow-hidden">
            
            <div class="bg-emerald-600 px-8 py-10 flex justify-between items-center relative overflow-hidden">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-emerald-500 rounded-full opacity-20"></div>
                
                <div class="relative z-10">
                    <h1 class="text-3xl font-black text-white uppercase italic tracking-tighter">
                        Update <span class="text-emerald-200">Profile</span>
                    </h1>
                    <p class="text-[10px] text-emerald-100 font-bold uppercase tracking-[0.3em] mt-1 opacity-80 font-mono">
                        NO: {{ $anggota->nomor_anggota }}
                    </p>
                </div>
                
                <div class="relative z-10 bg-white/20 backdrop-blur-md p-3 rounded-2xl rotate-3 border border-white/30 shadow-lg text-white">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </div>
            </div>

            <div class="p-8 md:p-12">
                @if ($errors->any())
                    <div class="bg-rose-50 border border-rose-100 p-6 mb-8 rounded-2xl flex items-start gap-4">
                        <div class="bg-rose-500 p-1 rounded-full text-white">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </div>
                        <span class="text-rose-700 font-bold text-[11px] uppercase tracking-wider">Periksa kembali inputan Anda!</span>
                    </div>
                @endif

                <form action="{{ route('admin.anggota.update', $anggota->id_anggota) }}" method="POST" enctype="multipart/form-data" id="editForm">
                    @csrf @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-8">
                        
                        <div class="space-y-2 opacity-70">
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">ID Anggota (Read Only)</label>
                            <div class="w-full bg-slate-200/50 border-2 border-dashed border-slate-300 rounded-2xl p-4 text-sm font-bold font-mono text-slate-500 tracking-tighter">
                                {{ $anggota->nomor_anggota }}
                            </div>
                        </div>

                        <div class="space-y-2 opacity-70">
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Email Akun (Read Only)</label>
                            <div class="w-full bg-slate-200/50 border-2 border-dashed border-slate-300 rounded-2xl p-4 text-sm font-bold italic text-slate-500">
                                {{ $anggota->user->email }}
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $anggota->nama_lengkap) }}" class="w-full bg-slate-100/50 border-none rounded-2xl p-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500 transition-all uppercase" required>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Nomor Kontak</label>
                            <input type="text" name="kontak" value="{{ old('kontak', $anggota->kontak) }}" class="w-full bg-slate-100/50 border-none rounded-2xl p-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500 transition-all" required>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $anggota->tempat_lahir) }}" class="w-full bg-slate-100/50 border-none rounded-2xl p-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500 transition-all uppercase">
                        </div>

                        <div class="space-y-2" id="tanggalLahirGroup">
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Tanggal Lahir</label>
                            <input type="date" name="tgl_lahir" id="tgl_lahir" value="{{ old('tgl_lahir', $anggota->tgl_lahir) }}" class="w-full bg-slate-100/50 border-none rounded-2xl p-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500 transition-all">
                            <p id="umurAlert" class="text-[10px] font-bold mt-2 px-1 hidden"></p>
                        </div>

                        <div class="md:col-span-2 space-y-2">
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Alamat Domisili</label>
                            <textarea name="alamat" rows="2" class="w-full bg-slate-100/50 border-none rounded-2xl p-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500 transition-all leading-relaxed">{{ old('alamat', $anggota->alamat) }}</textarea>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Wilayah (PAC)</label>
                            <select name="pac" class="w-full bg-slate-100/50 border-none rounded-2xl p-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500 transition-all" required>
                                @for($i=1; $i<=5; $i++)
                                    <option value="PAC-0{{ $i }}" {{ $anggota->pac == "PAC-0$i" ? 'selected' : '' }}>PAC-0{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="md:col-span-2 bg-slate-50 border-2 border-dashed border-slate-200 p-8 rounded-[2rem] mt-4">
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest mb-6 ml-1 text-center">Update Foto Profil</label>
                            <div class="flex flex-col md:flex-row items-center gap-10">
                                <div class="flex-1 w-full">
                                    <input type="file" name="foto_profil" accept="image/*" class="block w-full text-xs font-bold text-slate-400 file:mr-6 file:py-3 file:px-8 file:rounded-xl file:border-0 file:bg-emerald-600 file:text-white hover:file:bg-emerald-700 file:cursor-pointer file:uppercase file:tracking-widest transition-all">
                                </div>
                                @if($anggota->foto_profil)
                                    <div class="flex flex-col items-center gap-2">
                                        <div class="relative">
                                            <img src="{{ Storage::url($anggota->foto_profil) }}" class="w-24 h-24 object-cover rounded-2xl border-4 border-white shadow-lg ring-1 ring-emerald-100">
                                            <div class="absolute -top-2 -right-2 bg-emerald-500 text-white p-1 rounded-full shadow-md">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path></svg>
                                            </div>
                                        </div>
                                        <p class="text-[9px] font-black uppercase text-emerald-600 tracking-widest">Active Photo</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row justify-between items-center mt-12 pt-8 border-t border-slate-100 gap-6">
                        <a href="{{ route('admin.anggota.index') }}" class="group flex items-center gap-2 text-[11px] font-black uppercase text-slate-400 hover:text-rose-600 tracking-widest transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            Kembali
                        </a>
                        
                        <button type="submit" id="submitBtn" class="w-full md:w-auto bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-4 px-14 rounded-2xl text-[11px] uppercase tracking-[0.2em] transition-all shadow-lg shadow-emerald-200 hover:-translate-y-1">
                            Perbarui Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tglLahirInput = document.getElementById('tgl_lahir');
        const umurAlert = document.getElementById('umurAlert');
        const submitBtn = document.getElementById('submitBtn');
        const form = document.getElementById('editForm');
        
        // Simpan nilai tanggal lahir awal (original)
        const originalTglLahir = tglLahirInput.value;
        
        // Fungsi untuk menghitung umur
        function hitungUmur(tanggalLahir) {
            const today = new Date();
            const birthDate = new Date(tanggalLahir);
            let age = today.getFullYear() - birthDate.getFullYear();
            const monthDiff = today.getMonth() - birthDate.getMonth();
            
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            return age;
        }
        
        // Fungsi untuk validasi real-time
        function validasiUmur() {
            const tglLahir = tglLahirInput.value;
            
            if (!tglLahir) {
                umurAlert.classList.add('hidden');
                umurAlert.innerHTML = '';
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                tglLahirInput.classList.remove('border-2', 'border-rose-500', 'bg-rose-50');
                tglLahirInput.classList.add('bg-slate-100/50');
                return true;
            }
            
            const umur = hitungUmur(tglLahir);
            
            if (umur > 24) {
                // Tampilkan alert
                umurAlert.classList.remove('hidden');
                umurAlert.innerHTML = '⚠️ Maaf, umur anda sudah melebihi batas maksimal (24 tahun)!';
                umurAlert.classList.add('text-rose-600', 'font-bold');
                
                // Ubah style input menjadi merah
                tglLahirInput.classList.add('border-2', 'border-rose-500', 'bg-rose-50');
                tglLahirInput.classList.remove('bg-slate-100/50');
                
                // Nonaktifkan tombol submit
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
                
                return false;
            } else {
                // Sembunyikan alert
                umurAlert.classList.add('hidden');
                umurAlert.innerHTML = '';
                
                // Kembalikan style input normal
                tglLahirInput.classList.remove('border-2', 'border-rose-500', 'bg-rose-50');
                tglLahirInput.classList.add('bg-slate-100/50');
                
                // Aktifkan tombol submit
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                
                return true;
            }
        }
        
        // Fungsi untuk validasi sebelum submit (khusus untuk data yang sudah ada)
        function validasiSubmit() {
            const tglLahir = tglLahirInput.value;
            const umur = hitungUmur(tglLahir);
            
            if (umur > 24) {
                alert('⚠️ Maaf, data tidak dapat diupdate! Umur anggota melebihi batas maksimal 24 tahun.');
                return false;
            }
            return true;
        }
        
        // Event listener untuk perubahan tanggal lahir (real-time)
        tglLahirInput.addEventListener('change', validasiUmur);
        tglLahirInput.addEventListener('input', validasiUmur);
        
        // Validasi sebelum submit form
        form.addEventListener('submit', function(e) {
            const tglLahir = tglLahirInput.value;
            const umur = hitungUmur(tglLahir);
            
            if (tglLahir && umur > 24) {
                e.preventDefault();
                // Scroll ke field tanggal lahir
                document.getElementById('tanggalLahirGroup').scrollIntoView({ behavior: 'smooth', block: 'center' });
                // Tampilkan alert
                alert('⚠️ Maaf, update gagal! Umur anggota melebihi batas maksimal 24 tahun.');
            }
        });
        
        // Validasi awal untuk data yang sudah ada
        // Catatan: Data yang sudah tersimpan sebelumnya akan tetap bisa diupdate
        // karena kita hanya memvalidasi jika ada perubahan pada tanggal lahir
        
        // Trigger validasi awal untuk mengecek data saat ini
        if (tglLahirInput.value) {
            const umurAwal = hitungUmur(tglLahirInput.value);
            if (umurAwal > 24) {
                // Tampilkan warning tapi tidak nonaktifkan submit (karena data sudah ada sebelumnya)
                umurAlert.classList.remove('hidden');
                umurAlert.innerHTML = '⚠️ Peringatan: Umur anggota saat ini melebihi 24 tahun. Disarankan untuk mengganti tanggal lahir!';
                umurAlert.classList.add('text-orange-600', 'font-bold');
                umurAlert.classList.remove('text-rose-600');
                
                // Beri warna oranye pada input (warning)
                tglLahirInput.classList.add('border-2', 'border-orange-500', 'bg-orange-50');
                tglLahirInput.classList.remove('bg-slate-100/50');
                
                // Tetap aktifkan tombol submit untuk data lama
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            }
        }
    });
</script>
@endpush
@endsection