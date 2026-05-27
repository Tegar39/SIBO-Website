<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Mail\LoginOtpMail;
use App\Models\User;
use App\Services\AuditService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request, AuditService $audit): RedirectResponse
    {
        $request->authenticate();

        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (($user->account_status ?? 'aktif') !== 'aktif') {
            Auth::guard('web')->logout();
            return back()->withErrors(['email' => 'Akun kamu tidak aktif. Hubungi admin.'])->onlyInput('email');
        }

        // Login tidak lagi meminta OTP. OTP dipakai hanya untuk aksi sensitif
        // seperti ganti password, supaya alurnya lebih ringan saat demo/operasional.
        $request->session()->regenerate();
        $user->forceFill(['last_login_at' => now(), 'last_login_ip' => $request->ip()])->save();
        $audit->log('login_success', 'auth', $user, null, ['email' => $user->email], $request);
        return redirect()->intended(route('dashboard', absolute: false));
    }

    public function sendLoginOtp(User $user, Request $request): void
    {
        $code = (string) random_int(100000, 999999);
        $user->forceFill([
            'login_otp_code' => Hash::make($code),
            'login_otp_expires_at' => now()->addMinutes((int) config('auth.login_otp_expires_minutes', 10)),
            'login_otp_attempts' => 0,
        ])->save();

        try {
            Mail::to($user->email)->send(new LoginOtpMail($user, $code));
        } catch (\Throwable $e) {
            Log::warning('Gagal mengirim OTP login', ['user_id' => $user->id, 'email' => $user->email, 'error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
