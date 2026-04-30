@extends('layouts.app')

@section('content')
<div class="pt-28 pb-12 bg-slate-50 min-h-screen font-sans">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white/70 backdrop-blur-md border border-white/50 rounded-[2.5rem] shadow-xl overflow-hidden">
            
            <div class="bg-emerald-600 px-8 py-10 flex justify-between items-center relative overflow-hidden">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-emerald-500 rounded-full opacity-20"></div>
                
                <div class="relative z-10">
                    <h1 class="text-3xl font-black text-white uppercase italic tracking-tighter">
                        Entry <span class="text-emerald-200">New Member</span>
                    </h1>
                    <p class="text-[10px] text-emerald-100 font-bold uppercase tracking-[0.3em] mt-1 opacity-80">
                        Sistem Informasi Keanggotaan PC DESBOR
                    </p>
                </div>
                
                <div class="relative z-10 bg-white/20 backdrop-blur-md p-3 rounded-2xl rotate-3 border border-white/30 shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                </div>
            </div>

            <div class="p-8 md:p-12">
                @if ($errors->any())
                    <div class="bg-rose-50 border border-rose-100 p-6 mb-8 rounded-2xl flex items-start gap-4">
                        <div class="bg-rose-500 p-1 rounded-full text-white">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </div>
                        <ul class="text-rose-700 font-bold text-[11px] uppercase tracking-wider space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.anggota.store') }}" method="POST" enctype="multipart/form-data" id="anggotaForm">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-8">
                        
                        <div class="space-y-2">
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" class="w-full bg-slate-100/50 border-none rounded-2xl p-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500 transition-all uppercase" placeholder="JOHN DOE" required>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Email Official</label>
                            <input type="email" name="email" class="w-full bg-slate-100/50 border-none rounded-2xl p-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500 transition-all" placeholder="admin@desbor.com" required>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Password Akses</label>
                            <input type="password" name="password" class="w-full bg-slate-100/50 border-none rounded-2xl p-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500 transition-all" required>
                            <p class="text-[9px] text-slate-400 mt-1 font-bold italic uppercase tracking-wider px-1">Minimal 8 Karakter</p>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Nomor WhatsApp</label>
                            <input type="text" name="kontak" class="w-full bg-slate-100/50 border-none rounded-2xl p-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500 transition-all" placeholder="08123456789" required>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="w-full bg-slate-100/50 border-none rounded-2xl p-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500 transition-all uppercase">
                        </div>

                        <div class="space-y-2" id="tanggalLahirGroup">
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Tanggal Lahir</label>
                            <input type="date" name="tgl_lahir" id="tgl_lahir" class="w-full bg-slate-100/50 border-none rounded-2xl p-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500 transition-all" required>
                            <p id="umurAlert" class="text-[10px] font-bold mt-2 px-1 hidden"></p>
                        </div>

                        <div class="md:col-span-2 space-y-2">
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Alamat Domisili Lengkap</label>
                            <textarea name="alamat" rows="2" class="w-full bg-slate-100/50 border-none rounded-2xl p-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500 transition-all" placeholder="Jalan Raya No. 123..."></textarea>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Pilih Wilayah (PAC)</label>
                            <select name="pac" class="w-full bg-slate-100/50 border-none rounded-2xl p-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500 transition-all" required>
                                <option value="">- SELECT REGION -</option>
                                @for($i=1; $i<=5; $i++)
                                    <option value="PAC-0{{ $i }}">PAC-0{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="md:col-span-2 bg-slate-50 border-2 border-dashed border-slate-200 p-6 rounded-[2rem] mt-4">
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest mb-4 ml-1 text-center">Unggah Foto Profil</label>
                            <input type="file" name="foto_profil" accept="image/*" class="block w-full text-xs font-bold text-slate-400 file:mr-6 file:py-3 file:px-8 file:rounded-xl file:border-0 file:bg-emerald-600 file:text-white hover:file:bg-emerald-700 file:cursor-pointer file:uppercase file:tracking-widest transition-all">
                            <p class="text-[9px] text-slate-400 mt-4 font-bold italic uppercase text-center tracking-widest">Format: JPG/PNG, Max Size: 2MB</p>
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row justify-between items-center mt-12 pt-8 border-t border-slate-100 gap-6">
                        <a href="{{ route('admin.anggota.index') }}" class="group flex items-center gap-2 text-[11px] font-black uppercase text-slate-400 hover:text-rose-600 tracking-widest transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            Kembali
                        </a>
                        
                        <button type="submit" id="submitBtn" class="w-full md:w-auto bg-slate-800 hover:bg-emerald-600 text-white font-bold py-4 px-14 rounded-2xl text-[11px] uppercase tracking-[0.2em] transition-all shadow-lg hover:shadow-emerald-200 hover:-translate-y-1">
                            Simpan Anggota
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
        const form = document.getElementById('anggotaForm');
        
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
                
                // Tampilkan alert browser (opsional)
                // alert('Maaf, umur anda sudah melebihi batas maksimal (24 tahun)!');
                
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
                
                // Tampilkan info umur jika diperlukan
                if (umur >= 0) {
                    // Opsional: tampilkan info umur saat ini
                    // umurAlert.classList.remove('hidden');
                    // umurAlert.innerHTML = `✅ Umur: ${umur} tahun (Memenuhi syarat)`;
                    // umurAlert.classList.add('text-emerald-600');
                }
                
                return true;
            }
        }
        
        // Event listener untuk perubahan tanggal lahir (real-time)
        tglLahirInput.addEventListener('change', validasiUmur);
        tglLahirInput.addEventListener('input', validasiUmur);
        
        // Validasi sebelum submit form
        form.addEventListener('submit', function(e) {
            if (!validasiUmur()) {
                e.preventDefault();
                // Scroll ke field tanggal lahir
                document.getElementById('tanggalLahirGroup').scrollIntoView({ behavior: 'smooth', block: 'center' });
                // Tampilkan alert tambahan
                alert('⚠️ Maaf, pendaftaran gagal! Umur anda melebihi batas maksimal 24 tahun.');
            }
        });
        
        // Validasi awal jika sudah ada nilai
        if (tglLahirInput.value) {
            validasiUmur();
        }
    });
</script>
@endpush
@endsection