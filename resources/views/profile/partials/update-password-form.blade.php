<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
        @if(auth()->user()->role !== 'admin' && auth()->user()->two_factor_enabled)
            <p class="mt-2 text-sm text-amber-700 font-semibold">
                Untuk anggota/PAC, ganti password wajib verifikasi OTP satu kali terlebih dahulu.
            </p>
        @endif
    </header>

    @if (session('status') === 'otp-required')
        <div class="mt-4 rounded-xl bg-amber-50 px-4 py-3 text-sm font-semibold text-amber-700">
            Verifikasi OTP dulu sebelum menyimpan password baru.
        </div>
    @endif

    @if (session('status') === 'otp-verified')
        <div class="mt-4 rounded-xl bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-700">
            OTP berhasil diverifikasi. Silakan isi dan simpan password baru.
        </div>
    @endif

    @if(auth()->user()->role !== 'admin' && auth()->user()->two_factor_enabled)
        <form method="post" action="{{ route('password.otp.request') }}" class="mt-6">
            @csrf
            <button type="submit" class="inline-flex items-center rounded-md bg-slate-900 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition hover:bg-slate-700">
                Kirim OTP untuk Ganti Password
            </button>
        </form>
    @endif

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Current Password')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('New Password')" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
            <x-input-error :messages="$errors->updatePassword->get('otp')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
