<?php

namespace App\Services;

use App\Models\Certificate;
use App\Models\Pendaftaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CertificateService
{
    public function generateForPendaftaran(Pendaftaran $pendaftaran): Certificate
    {
        $pendaftaran->loadMissing(['anggota', 'kegiatan', 'certificate']);

        if ($pendaftaran->certificate) {
            return $pendaftaran->certificate;
        }

        $kegiatan = $pendaftaran->kegiatan;
        $namaPeserta = $pendaftaran->display_name;
        $certificateNumber = $this->generateCertificateNumber($pendaftaran);

        $pdf = Pdf::loadView('certificates.template', [
            'nama_peserta' => $namaPeserta,
            'kegiatan' => $kegiatan,
            'certificate_number' => $certificateNumber,
        ]);

        $fileName = 'certificate_' . $certificateNumber . '.pdf';
        $filePath = 'certificates/' . $fileName;

        Storage::disk('public')->put($filePath, $pdf->output());

        return Certificate::create([
            'id_pendaftaran' => $pendaftaran->id_daftar,
            'certificate_number' => $certificateNumber,
            'file_path' => $filePath,
            'metadata' => [
                'nama_peserta' => $namaPeserta,
                'judul_kegiatan' => $kegiatan?->judul,
                'tanggal_kegiatan' => optional($kegiatan?->tanggal)->format('Y-m-d'),
            ],
        ]);
    }

    protected function generateCertificateNumber(Pendaftaran $pendaftaran): string
    {
        return 'SIBO-' . now()->format('Ymd') . '-' . $pendaftaran->id_daftar . '-' . Str::upper(Str::random(6));
    }
}
