<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password as PasswordRule;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        if ($this->requiresSensitiveOtp($request) && ! $this->hasValidSensitiveOtp($request)) {
            return back()
                ->with('status', 'otp-required')
                ->withErrors(['otp' => 'Verifikasi OTP dulu sebelum mengganti password.'], 'updatePassword');
        }

        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', PasswordRule::min(8)->mixedCase()->numbers()->symbols()->uncompromised()],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $request->session()->forget(['sensitive_otp_verified_action', 'sensitive_otp_verified_until']);

        return back()->with('status', 'password-updated');
    }

    private function requiresSensitiveOtp(Request $request): bool
    {
        $user = $request->user();
        return $user && $user->role !== 'admin' && ($user->two_factor_enabled ?? true);
    }

    private function hasValidSensitiveOtp(Request $request): bool
    {
        if ($request->session()->get('sensitive_otp_verified_action') !== 'password_update') {
            return false;
        }

        $expiresAt = $request->session()->get('sensitive_otp_verified_until');
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
