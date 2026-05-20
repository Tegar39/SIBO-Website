<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Kegiatan;
use App\Models\Pendaftaran;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PendaftaranApiController extends Controller
{
    public function listMe(Request $request): JsonResponse
    {
        $user = $request->user();

        $anggota = Anggota::query()
            ->where('id_user', $user->id)
            ->firstOrFail();

        $pendaftarans = Pendaftaran::query()
            ->with(['kegiatan', 'absensi'])
            ->where('id_anggota', $anggota->id_anggota ?? $anggota->id_anggota)
            ->orderByDesc('tgl_daftar')
            ->get();

        return response()->json([
            'data' => $pendaftarans,
        ]);
    }

    public function createMe(Request $request): JsonResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'id_kegiatan' => ['required', 'integer'],
        ]);

        $anggota = Anggota::query()
            ->where('id_user', $user->id)
            ->firstOrFail();

        $kegiatan = Kegiatan::query()->findOrFail($validated['id_kegiatan']);

        // validasi sederhana: kegiatan aktif & kuota belum habis (status disetujui)
        $jumlahPeserta = $kegiatan->pendaftarans()
            ->where('status', 'disetujui')
            ->count();

        if ($kegiatan->status !== 'aktif') {
            return response()->json(['message' => 'Kegiatan tidak aktif.'], 422);
        }

        if ($kegiatan->kuota > 0 && $jumlahPeserta >= $kegiatan->kuota) {
            return response()->json(['message' => 'Kuota kegiatan sudah penuh.'], 422);
        }

        $existing = Pendaftaran::query()
            ->where('id_anggota', $anggota->id_anggota ?? $anggota->id_anggota)
            ->where('id_kegiatan', $kegiatan->id_kegiatan ?? $kegiatan->id_kegiatan)
            ->first();

        if ($existing) {
            return response()->json([
                'message' => 'Anda sudah terdaftar untuk kegiatan ini.',
                'data' => $existing,
            ], 409);
        }

        $tglDaftar = now()->format('Y-m-d H:i:s');

        $pendaftaran = Pendaftaran::create([
            'id_kegiatan' => $kegiatan->id_kegiatan,
            'id_anggota' => $anggota->id_anggota,
            'tgl_daftar' => $tglDaftar,
            'status' => 'pending',
        ]);

        return response()->json([
            'data' => $pendaftaran,
        ], 201);
    }
}
