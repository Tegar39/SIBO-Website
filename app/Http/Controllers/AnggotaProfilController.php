<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\Rules\Password as PasswordRule;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Services\AuditService;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Carbon;
use App\Models\Anggota;
use App\Models\User;

class AnggotaProfilController extends Controller
{
    // Halaman Profil (Edit Data Personal)
    public function index()
    {
        $user = Auth::user();
        $anggota = $user->anggota; // relasi di model User
        return view('anggota.profil.index', compact('user', 'anggota'));
    }

    // Halaman Keamanan (Ganti Password + OTP)
    public function keamanan(Request $request)
    {
        $otpVerified = $this->hasValidPasswordOtp($request);
        $otpPending = $request->session()->has('anggota_password_otp_user_id');
        return view('anggota.profil.keamanan', compact('otpVerified', 'otpPending'));
    }

    // Update Profil
    public function update(Request $request)
    {
        $user = Auth::user();
        $anggota = $user->anggota;

        $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'tempat_lahir' => 'nullable|string|max:50',
            'tgl_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'kontak' => ['required', 'regex:/^(08|\+62)[0-9]{8,}$/'],
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'kontak.required' => 'Kontak wajib diisi.',
            'kontak.regex' => 'Format kontak harus diawali 08 atau +62 dan minimal 10 digit.',
            'foto_profil.image' => 'File harus berupa gambar.',
            'foto_profil.mimes' => 'Format gambar harus JPEG, PNG, atau JPG.',
            'foto_profil.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        // Update data user (nama)
        $user->update(['name' => $request->nama_lengkap]);

        // Siapkan data anggota
        $dataAnggota = [
            'nama_lengkap' => $request->nama_lengkap,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'alamat' => $request->alamat,
            'kontak' => $request->kontak,
        ];

        // Proses upload foto profil
        if ($request->hasFile('foto_profil')) {
            // Hapus foto lama jika ada
            if ($anggota->foto_profil && Storage::disk('public')->exists($anggota->foto_profil)) {
                Storage::disk('public')->delete($anggota->foto_profil);
            }
            $path = $request->file('foto_profil')->store('foto_profil', 'public');
            $dataAnggota['foto_profil'] = $path;
        }

        $anggota->update($dataAnggota);

        return redirect()->route('anggota.profil')->with('success', 'Profil berhasil diperbarui.');
    }

    public function requestPasswordOtp(Request $request, AuthenticatedSessionController $authController, AuditService $audit)
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('login');
        }

        if ($user->role === 'admin' || !($user->two_factor_enabled ?? true)) {
            $this->markPasswordOtpVerified($request);
            return redirect()->route('anggota.keamanan')->with('success', 'OTP tidak diwajibkan untuk akun ini. Silakan ubah password.');
        }

        if (! $user->email) {
            return back()->withErrors(['otp' => 'Email akun belum tersedia. Lengkapi email terlebih dahulu agar OTP bisa dikirim.']);
        }

        $authController->sendLoginOtp($user, $request);
        $request->session()->put('anggota_password_otp_user_id', $user->id);
        $audit->log('anggota_password_otp_requested', 'auth', $user, null, ['email' => $user->email], $request);

        return redirect()->route('anggota.keamanan')->with('success', 'Kode OTP untuk ganti password sudah dikirim ke email akun.');
    }

    public function verifyPasswordOtp(Request $request, AuditService $audit)
    {
        $request->validate([
            'otp' => ['required', 'digits:6'],
        ], [
            'otp.required' => 'Kode OTP wajib diisi.',
            'otp.digits' => 'Kode OTP harus 6 digit.',
        ]);

        $user = $request->user();
        $sessionUserId = $request->session()->get('anggota_password_otp_user_id');
        $key = 'anggota-password-otp:'.($sessionUserId ?: 'none').'|'.$request->ip();

        if (! $user || (int) $user->id !== (int) $sessionUserId) {
            return redirect()->route('anggota.keamanan')->withErrors(['otp' => 'Sesi OTP tidak valid. Silakan kirim ulang OTP.']);
        }

        if (RateLimiter::tooManyAttempts($key, 5)) {
            throw ValidationException::withMessages(['otp' => 'Terlalu banyak percobaan OTP. Coba lagi beberapa menit lagi.']);
        }

        if (! $user->login_otp_code || ! $user->login_otp_expires_at || now()->gt($user->login_otp_expires_at)) {
            throw ValidationException::withMessages(['otp' => 'Kode OTP sudah kedaluwarsa. Silakan kirim ulang kode.']);
        }

        if (! Hash::check($request->otp, $user->login_otp_code)) {
            RateLimiter::hit($key, 300);
            $user->increment('login_otp_attempts');
            throw ValidationException::withMessages(['otp' => 'Kode OTP tidak sesuai.']);
        }

        RateLimiter::clear($key);
        $user->forceFill([
            'login_otp_code' => null,
            'login_otp_expires_at' => null,
            'login_otp_attempts' => 0,
        ])->save();

        $request->session()->forget('anggota_password_otp_user_id');
        $this->markPasswordOtpVerified($request);
        $audit->log('anggota_password_otp_verified', 'auth', $user, null, ['email' => $user->email], $request);

        return redirect()->route('anggota.keamanan')->with('success', 'OTP berhasil diverifikasi. Silakan simpan password baru.');
    }

    public function resendPasswordOtp(Request $request, AuthenticatedSessionController $authController)
    {
        $user = $request->user();
        if (! $user || (int) $request->session()->get('anggota_password_otp_user_id') !== (int) $user->id) {
            return redirect()->route('anggota.keamanan')->withErrors(['otp' => 'Sesi OTP tidak valid. Silakan kirim OTP kembali.']);
        }

        $authController->sendLoginOtp($user, $request);
        return redirect()->route('anggota.keamanan')->with('success', 'Kode OTP baru sudah dikirim ke email akun.');
    }

    // Update Password (dari halaman keamanan)
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        if ($user && $user->role !== 'admin' && ($user->two_factor_enabled ?? true) && ! $this->hasValidPasswordOtp($request)) {
            return back()->withErrors(['otp' => 'Verifikasi OTP terlebih dahulu sebelum mengganti password.']);
        }

        $request->validate([
            'current_password' => 'required',
            'new_password' => ['required', 'confirmed', PasswordRule::min(8)->mixedCase()->numbers()->symbols()],
        ], [
            'current_password.required' => 'Password lama wajib diisi.',
            'new_password.required' => 'Password baru wajib diisi.',
            'new_password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
        }

        $user->update(['password' => Hash::make($request->new_password)]);
        $request->session()->forget(['anggota_password_otp_verified_until', 'anggota_password_otp_verified_action']);

        return redirect()->route('anggota.keamanan')->with('success', 'Password berhasil diubah.');
    }

    private function markPasswordOtpVerified(Request $request): void
    {
        $request->session()->put('anggota_password_otp_verified_action', 'password_update');
        $request->session()->put('anggota_password_otp_verified_until', now()->addMinutes((int) config('auth.login_otp_expires_minutes', 10))->toIso8601String());
    }

    private function hasValidPasswordOtp(Request $request): bool
    {
        if ($request->session()->get('anggota_password_otp_verified_action') !== 'password_update') {
            return false;
        }

        $expiresAt = $request->session()->get('anggota_password_otp_verified_until');
        if (! $expiresAt) {
            return false;
        }

        try {
            return Carbon::parse($expiresAt)->isFuture();
        } catch (\Throwable) {
            return false;
        }
    }
}