<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\AuditService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class OtpController extends Controller
{
    public function show(Request $request): View|RedirectResponse
    {
        if (! $request->session()->has('otp_user_id')) {
            return redirect()->route('login');
        }
        return view('auth.otp', ['mode' => 'login']);
    }

    public function verify(Request $request, AuditService $audit): RedirectResponse
    {
        $request->validate(['otp' => ['required', 'digits:6']]);
        $userId = $request->session()->get('otp_user_id');
        $remember = (bool) $request->session()->get('otp_remember', false);
        $key = 'otp-verify:'.$userId.'|'.$request->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            throw ValidationException::withMessages(['otp' => 'Terlalu banyak percobaan OTP. Coba lagi beberapa menit lagi.']);
        }

        $user = User::find($userId);
        $this->ensureValidOtp($request, $user, $key);

        RateLimiter::clear($key);
        $this->clearOtp($user, ['last_login_at' => now(), 'last_login_ip' => $request->ip()]);

        Auth::login($user, $remember);
        $request->session()->forget(['otp_user_id', 'otp_remember']);
        $request->session()->regenerate();
        $audit->log('login_otp_verified', 'auth', $user, null, ['email' => $user->email], $request);

        return redirect()->intended(route('dashboard', absolute: false));
    }

    public function resend(Request $request, AuthenticatedSessionController $authController): RedirectResponse
    {
        $user = User::find($request->session()->get('otp_user_id'));
        if (! $user) {
            return redirect()->route('login');
        }
        $authController->sendLoginOtp($user, $request);
        return back()->with('status', 'Kode OTP baru sudah dikirim ke email kamu.');
    }

    public function requestPasswordOtp(Request $request, AuthenticatedSessionController $authController, AuditService $audit): RedirectResponse
    {
        $user = $request->user();
        if (! $user) {
            return redirect()->route('login');
        }

        if (! $this->requiresSensitiveOtp($user)) {
            $request->session()->put('sensitive_otp_verified_action', 'password_update');
            $request->session()->put('sensitive_otp_verified_until', now()->addMinutes((int) config('auth.login_otp_expires_minutes', 10))->toIso8601String());
            return redirect()->route('profile.edit')->with('status', 'otp-verified');
        }

        $authController->sendLoginOtp($user, $request);
        $request->session()->put('sensitive_otp_action', 'password_update');
        $request->session()->put('sensitive_otp_user_id', $user->id);
        $audit->log('password_change_otp_requested', 'auth', $user, null, ['email' => $user->email], $request);

        return redirect()->route('password.otp.show')->with('status', 'Kode OTP untuk ganti password sudah dikirim ke email akun kamu.');
    }

    public function showPasswordOtp(Request $request): View|RedirectResponse
    {
        if (! $request->session()->has('sensitive_otp_user_id')) {
            return redirect()->route('profile.edit')->with('status', 'otp-required');
        }

        return view('auth.otp', ['mode' => 'password']);
    }

    public function verifyPasswordOtp(Request $request, AuditService $audit): RedirectResponse
    {
        $request->validate(['otp' => ['required', 'digits:6']]);
        $user = $request->user();
        $userId = $request->session()->get('sensitive_otp_user_id');
        $key = 'password-otp-verify:'.$userId.'|'.$request->ip();

        if (! $user || (int) $user->id !== (int) $userId || $request->session()->get('sensitive_otp_action') !== 'password_update') {
            return redirect()->route('profile.edit')->with('status', 'otp-required');
        }

        if (RateLimiter::tooManyAttempts($key, 5)) {
            throw ValidationException::withMessages(['otp' => 'Terlalu banyak percobaan OTP. Coba lagi beberapa menit lagi.']);
        }

        $this->ensureValidOtp($request, $user, $key);
        RateLimiter::clear($key);
        $this->clearOtp($user);

        $request->session()->forget(['sensitive_otp_action', 'sensitive_otp_user_id']);
        $request->session()->put('sensitive_otp_verified_action', 'password_update');
        $request->session()->put('sensitive_otp_verified_until', now()->addMinutes((int) config('auth.login_otp_expires_minutes', 10))->toIso8601String());
        $audit->log('password_change_otp_verified', 'auth', $user, null, ['email' => $user->email], $request);

        return redirect()->route('profile.edit')->with('status', 'otp-verified');
    }

    public function resendPasswordOtp(Request $request, AuthenticatedSessionController $authController): RedirectResponse
    {
        $user = $request->user();
        if (! $user || (int) $request->session()->get('sensitive_otp_user_id') !== (int) $user->id) {
            return redirect()->route('profile.edit')->with('status', 'otp-required');
        }
        $authController->sendLoginOtp($user, $request);
        return back()->with('status', 'Kode OTP baru untuk ganti password sudah dikirim ke email kamu.');
    }

    private function requiresSensitiveOtp(User $user): bool
    {
        return $user->role !== 'admin' && ($user->two_factor_enabled ?? true);
    }

    private function ensureValidOtp(Request $request, ?User $user, string $key): void
    {
        if (! $user || ! $user->login_otp_code || ! $user->login_otp_expires_at || now()->gt($user->login_otp_expires_at)) {
            throw ValidationException::withMessages(['otp' => 'Kode OTP sudah kedaluwarsa. Silakan kirim ulang kode.']);
        }

        if (! Hash::check($request->otp, $user->login_otp_code)) {
            RateLimiter::hit($key, 300);
            $user->increment('login_otp_attempts');
            throw ValidationException::withMessages(['otp' => 'Kode OTP tidak sesuai.']);
        }
    }

    private function clearOtp(User $user, array $extra = []): void
    {
        $user->forceFill(array_merge([
            'login_otp_code' => null,
            'login_otp_expires_at' => null,
            'login_otp_attempts' => 0,
        ], $extra))->save();
    }
}
