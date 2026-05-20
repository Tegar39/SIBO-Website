<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        if (! $user || !Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => ['Kredensial tidak valid.'],
            ]);
        }

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
                ] : null,
            ],
        ]);
    }
}
