@extends('layouts.app')

@section('content')
<div class="pt-20 pb-12 bg-slate-50 min-h-screen font-sans">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
            <div class="flex items-center gap-4">
                <div class="bg-amber-500 p-3 rounded-2xl shadow-lg shadow-amber-200">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight leading-none uppercase">Keamanan <span class="text-amber-500">Akun</span></h1>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('anggota.profil') }}" class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 hover:text-emerald-600 transition-colors flex items-center gap-2 group bg-white/50 px-4 py-2 rounded-xl">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    Edit Profil
                </a>
                <a href="{{ route('anggota.dashboard') }}" class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 hover:text-rose-500 transition-colors flex items-center gap-2 group">
                    <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Dashboard
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-8 flex items-center gap-3 bg-emerald-50 border border-emerald-100 text-emerald-700 px-6 py-4 rounded-2xl font-bold text-sm animate-fade-in shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round"stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-8 flex items-center gap-3 bg-rose-50 border border-rose-100 text-rose-600 px-6 py-4 rounded-2xl font-bold text-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <div class="bg-white/70 backdrop-blur-md rounded-[2.5rem] border border-white/50 shadow-xl overflow-hidden">
            <div class="p-8 md:p-12">
                
                {{-- Verifikasi OTP untuk aksi sensitif: ganti password --}}
                @php
                    $otpVerified = $otpVerified ?? false;
                    $otpPending = $otpPending ?? false;
                @endphp

                <div class="mb-8 bg-emerald-50 border border-emerald-100 rounded-[2rem] p-6">
                    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-5">
                        <div>
                            <div class="flex items-center gap-3 mb-2">
                                <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                                <h2 class="text-xs font-black uppercase tracking-[0.3em] text-emerald-700">Verifikasi OTP</h2>
                            </div>
                            <p class="text-sm text-slate-600 leading-relaxed">
                                Untuk menjaga keamanan akun, anggota wajib melakukan verifikasi OTP satu kali sebelum mengganti password.
                                Kode dikirim ke email akun dan berlaku {{ config('auth.login_otp_expires_minutes', 10) }} menit.
                            </p>
                        </div>

                        @if($otpVerified)
                            <div class="shrink-0 bg-white text-emerald-700 border border-emerald-200 px-5 py-3 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] shadow-sm">
                                OTP Terverifikasi
                            </div>
                        @else
                            <form action="{{ route('anggota.keamanan.otp.request') }}" method="POST" class="shrink-0">
                                @csrf
                                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-black px-6 py-3 rounded-2xl text-[10px] uppercase tracking-[0.2em] transition-all shadow-lg shadow-emerald-100">
                                    Kirim OTP
                                </button>
                            </form>
                        @endif
                    </div>

                    @if(!$otpVerified && $otpPending)
                        <div class="mt-6 bg-white border border-emerald-100 rounded-2xl p-4">
                            <form action="{{ route('anggota.keamanan.otp.verify') }}" method="POST" class="grid grid-cols-1 md:grid-cols-[1fr_auto] gap-3 items-end">
                                @csrf
                                <div>
                                    <label class="block text-[9px] font-black uppercase tracking-widest text-slate-400 mb-2">Kode OTP</label>
                                    <input type="text" name="otp" inputmode="numeric" maxlength="6"
                                           class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-3.5 text-sm text-slate-800 focus:ring-2 focus:ring-emerald-500 outline-none transition-all tracking-[0.35em] font-black"
                                           placeholder="000000" required>
                                </div>
                                <button type="submit" class="bg-slate-900 hover:bg-emerald-700 text-white font-black px-6 py-4 rounded-2xl text-[10px] uppercase tracking-[0.2em] transition-all">
                                    Verifikasi
                                </button>
                            </form>

                            <form action="{{ route('anggota.keamanan.otp.resend') }}" method="POST" class="mt-3">
                                @csrf
                                <button type="submit" class="text-[10px] font-black uppercase tracking-[0.2em] text-emerald-700 hover:text-emerald-900">
                                    Kirim ulang OTP
                                </button>
                            </form>
                        </div>
                    @endif
                </div>

                <form action="{{ route('anggota.keamanan.update-password') }}" method="POST">
                    @csrf 
                    @method('PUT')
                    
                    <div class="flex items-center gap-3 mb-8 px-2">
                        <span class="w-2 h-2 bg-amber-500 rounded-full animate-pulse"></span>
                        <h2 class="text-xs font-black uppercase tracking-[0.3em] text-slate-400">Ganti Password</h2>
                    </div>

                    @if(!$otpVerified)
                        <div class="mb-6 bg-amber-500/10 border border-amber-500/20 rounded-2xl p-4 text-amber-300 text-[10px] font-bold uppercase tracking-widest">
                            Verifikasi OTP terlebih dahulu agar form ganti password aktif.
                        </div>
                    @endif
                    
                    <div class="bg-slate-900 rounded-[2.5rem] p-8 md:p-10 shadow-2xl relative overflow-hidden">
                        <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-white/5 rounded-full blur-3xl"></div>
                        
                        <div class="space-y-6 relative z-10">
                            <div>
                                <label class="block text-[9px] font-black uppercase tracking-widest text-amber-400 mb-3 ml-1">Password Saat Ini</label>
                                <input type="password" name="current_password" 
                                       class="w-full bg-white/10 border border-white/10 rounded-2xl px-5 py-3.5 text-sm text-white focus:ring-2 focus:ring-amber-400 focus:bg-white/20 outline-none transition-all" 
                                       placeholder="Masukkan password lama Anda" required {{ $otpVerified ? '' : 'disabled' }}>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-[9px] font-black uppercase tracking-widest text-slate-400 mb-3 ml-1">Password Baru</label>
                                    <input type="password" name="new_password" id="new_password"
                                           class="w-full bg-white/10 border border-white/10 rounded-2xl px-5 py-3.5 text-sm text-white focus:ring-2 focus:ring-amber-400 focus:bg-white/20 outline-none transition-all" 
                                           placeholder="Minimal 8 karakter, huruf besar/kecil, angka, simbol" required {{ $otpVerified ? '' : 'disabled' }}>
                                </div>
                                <div>
                                    <label class="block text-[9px] font-black uppercase tracking-widest text-slate-400 mb-3 ml-1">Konfirmasi Password Baru</label>
                                    <input type="password" name="new_password_confirmation" id="password_confirmation"
                                           class="w-full bg-white/10 border border-white/10 rounded-2xl px-5 py-3.5 text-sm text-white focus:ring-2 focus:ring-amber-400 focus:bg-white/20 outline-none transition-all" 
                                           placeholder="Ulangi password baru" required {{ $otpVerified ? '' : 'disabled' }}>
                                    <p id="passwordMatchAlert" class="text-[9px] font-bold mt-2 px-1 hidden"></p>
                                </div>
                            </div>
                            
                            <div class="bg-amber-500/10 border border-amber-500/20 rounded-2xl p-4 mt-4">
                                <p class="text-[9px] text-amber-400 font-bold uppercase tracking-widest flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Tips Keamanan:
                                </p>
                                <ul class="text-[8px] text-slate-400 mt-2 space-y-1 list-disc list-inside">
                                    <li>Gunakan minimal 8 karakter</li>
                                    <li>Kombinasikan huruf besar, huruf kecil, angka, dan simbol</li>
                                    <li>Jangan gunakan password yang sama dengan akun lain</li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="flex justify-between items-center mt-10 pt-4 relative z-10">
                            <a href="{{ route('anggota.profil') }}" class="text-[10px] font-black uppercase text-slate-400 hover:text-amber-400 transition-colors">
                                ← Kembali ke Profil
                            </a>
                            <button type="submit" id="submitBtn" {{ $otpVerified ? '' : 'disabled' }} class="group relative bg-amber-500 hover:bg-white text-slate-900 font-black px-10 py-4 rounded-2xl text-[10px] uppercase tracking-[0.2em] transition-all flex items-center gap-3 {{ $otpVerified ? '' : 'opacity-50 cursor-not-allowed' }}">
                                Simpan Password Baru
                                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in { animation: fade-in 0.4s ease-out forwards; }
</style>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const newPassword = document.getElementById('new_password');
        const confirmPassword = document.getElementById('password_confirmation');
        const passwordMatchAlert = document.getElementById('passwordMatchAlert');
        const submitBtn = document.getElementById('submitBtn');

        function checkPasswordMatch() {
            const newPass = newPassword.value;
            const confirmPass = confirmPassword.value;

            if (confirmPass === '') {
                passwordMatchAlert.classList.add('hidden');
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                return;
            }

            if (newPass !== confirmPass) {
                passwordMatchAlert.classList.remove('hidden');
                passwordMatchAlert.innerHTML = '⚠️ Password baru dan konfirmasi tidak sama!';
                passwordMatchAlert.classList.add('text-rose-400');
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
            } else {
                passwordMatchAlert.classList.add('hidden');
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            }
        }

        newPassword.addEventListener('keyup', checkPasswordMatch);
        confirmPassword.addEventListener('keyup', checkPasswordMatch);
    });
</script>
@endpush
@endsection