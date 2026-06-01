<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthApiController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('email', $credentials['email'])->first();
        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Kredensial tidak valid.'],
            ]);
        }

        if (($user->account_status ?? 'aktif') !== 'aktif') {
            throw ValidationException::withMessages([
                'email' => ['Akun tidak aktif. Hubungi admin.'],
            ]);
        }

        $user->forceFill(['last_login_at' => now(), 'last_login_ip' => $request->ip()])->save();

        // Sanctum personal access token
        $token = $user->createToken('sibo-mobile')->plainTextToken;

        $anggota = $user->anggota;

        return response()->json([
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'anggota' => $anggota ? [
                    'id_anggota' => $anggota->id_anggota,
                    'nomor_anggota' => $anggota->nomor_anggota,
                    'nama_lengkap' => $anggota->nama_lengkap,
                    'pac' => $anggota->pac,
                    'kontak' => $anggota->kontak,
                    'foto_profil' => $anggota->foto_profil,
                    'foto_profil_url' => $anggota->foto_profil ? asset('storage/' . $anggota->foto_profil) : asset('images/logo-sibo.png'),
                ] : null,
            ],
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()?->currentAccessToken()?->delete();
        return response()->json(['message' => 'Logout berhasil.']);
    }
}
