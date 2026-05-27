@php
    $mode = $mode ?? 'login';
    $isPasswordMode = $mode === 'password';
@endphp

<x-guest-layout>
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-black text-slate-800">{{ $isPasswordMode ? 'Verifikasi OTP Ganti Password' : 'Verifikasi OTP' }}</h1>
        <p class="mt-2 text-sm text-slate-500">
            {{ $isPasswordMode ? 'Masukkan 6 digit kode sebelum mengganti password akun.' : 'Masukkan 6 digit kode yang dikirim ke email akun kamu.' }}
        </p>
    </div>
    @if (session('status'))
        <div class="mb-4 rounded-xl bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-700">{{ session('status') }}</div>
    @endif
    <form method="POST" action="{{ $isPasswordMode ? route('password.otp.verify') : route('otp.verify') }}">
        @csrf
        <div>
            <x-input-label for="otp" value="Kode OTP" />
            <x-text-input id="otp" class="block mt-1 w-full text-center tracking-[0.6em] text-xl font-black" type="text" name="otp" maxlength="6" inputmode="numeric" required autofocus />
            <x-input-error :messages="$errors->get('otp')" class="mt-2" />
        </div>
        <div class="mt-6">
            <button type="submit" class="inline-flex items-center rounded-xl bg-emerald-600 px-5 py-3 text-xs font-black uppercase tracking-widest text-white hover:bg-emerald-700">Verifikasi</button>
            @if($isPasswordMode)
                <a href="{{ route('profile.edit') }}" class="ml-3 text-sm font-bold text-slate-500 hover:text-slate-800">Kembali ke profil</a>
            @endif
        </div>
    </form>
    <form method="POST" action="{{ $isPasswordMode ? route('password.otp.resend') : route('otp.resend') }}" class="mt-4">
        @csrf
        <button type="submit" class="text-sm font-bold text-emerald-700 hover:text-emerald-900">Kirim ulang kode OTP</button>
    </form>
</x-guest-layout>
