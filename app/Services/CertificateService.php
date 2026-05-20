<?php

namespace App\Services;

use App\Models\Pendaftaran;
use App\Models\Certificate;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CertificateService
{
    public function generateForPendaftaran(Pendaftaran $pendaftaran)
    {
        if ($pendaftaran->certificate) {
            return $pendaftaran->certificate;
        }

        $peserta = $pendaftaran->anggota;
        $kegiatan = $pendaftaran->kegiatan;

        $certificateNumber = $this->generateCertificateNumber($pendaftaran);

        $data = [
            'peserta' => $peserta,
            'kegiatan' => $kegiatan,
            'certificate_number' => $certificateNumber,
        ];

        $pdf = Pdf::loadView('certificates.template', $data);
        $fileName = 'certificate_' . $certificateNumber . '.pdf';
        $filePath = 'certificates/' . $fileName;
        Storage::disk('public')->put($filePath, $pdf->output());

        return Certificate::create([
            'id_pendaftaran' => $pendaftaran->id_daftar,
            'certificate_number' => $certificateNumber,
            'file_path' => $filePath,
            'metadata' => json_encode([
                'nama_peserta' => $peserta->nama_lengkap,
                'judul_kegiatan' => $kegiatan->judul,
                'tanggal_kegiatan' => $kegiatan->tanggal,
            ]),
        ]);
    }

    protected function generateCertificateNumber($pendaftaran)
    {
        return 'SIBO-' . $pendaftaran->id_daftar . '-' . Str::random(6);
    }
}