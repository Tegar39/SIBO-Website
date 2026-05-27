<?php

namespace App\Listeners;

use App\Events\PendaftaranSelesai;
use App\Services\CertificateService;

class GenerateCertificate
{
    public function __construct(protected CertificateService $certificateService)
    {
    }

    public function handle(PendaftaranSelesai $event): void
    {
        $pendaftaran = $event->pendaftaran->loadMissing('absensi');

        // Sertifikat hanya layak dibuat setelah peserta benar-benar hadir.
        // Approval pendaftaran saja belum cukup untuk mendapatkan sertifikat.
        if (! $pendaftaran->absensi || ! $pendaftaran->absensi->hadir) {
            return;
        }

        $this->certificateService->generateForPendaftaran($pendaftaran);
    }
}
