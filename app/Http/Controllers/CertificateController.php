<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Services\CertificateService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
    public function download($id, CertificateService $certificateService)
    {
        $certificate = Certificate::with('pendaftaran.anggota')->findOrFail($id);
        $user = Auth::user();
        $anggota = $user?->anggota;

        if ($user?->role !== 'admin') {
            abort_unless(
                $anggota && $certificate->pendaftaran?->id_anggota === $anggota->id_anggota,
                403,
                'Sertifikat ini bukan milik akun Anda.'
            );
        }

        // Regenerate sebelum download agar sertifikat lama otomatis memakai desain PDF terbaru.
        $certificate = $certificateService->refreshFile($certificate);

        if (! Storage::disk('public')->exists($certificate->file_path)) {
            abort(404, 'File sertifikat tidak ditemukan.');
        }

        return Storage::disk('public')->download($certificate->file_path, "sertifikat_{$certificate->certificate_number}.pdf");
    }
}
