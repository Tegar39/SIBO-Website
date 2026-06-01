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

        $pdf = $this->makePdf($namaPeserta, $kegiatan, $certificateNumber);

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

    public function refreshFile(Certificate $certificate): Certificate
    {
        $certificate->loadMissing('pendaftaran.anggota', 'pendaftaran.kegiatan');

        $pendaftaran = $certificate->pendaftaran;
        if (! $pendaftaran) {
            return $certificate;
        }

        $kegiatan = $pendaftaran->kegiatan;
        $namaPeserta = $pendaftaran->display_name;
        $certificateNumber = $certificate->certificate_number;

        $filePath = $certificate->file_path ?: 'certificates/certificate_' . $certificateNumber . '.pdf';
        $pdf = $this->makePdf($namaPeserta, $kegiatan, $certificateNumber);

        Storage::disk('public')->put($filePath, $pdf->output());

        if ($certificate->file_path !== $filePath) {
            $certificate->file_path = $filePath;
            $certificate->save();
        }

        return $certificate->refresh();
    }

    protected function makePdf(string $namaPeserta, $kegiatan, string $certificateNumber)
    {
        return Pdf::loadView('certificates.template', [
            'nama_peserta' => $namaPeserta,
            'kegiatan' => $kegiatan,
            'certificate_number' => $certificateNumber,
        ])->setPaper('a4', 'landscape')->setOptions([
            'isRemoteEnabled' => true,
            'isHtml5ParserEnabled' => true,
            'defaultFont' => 'DejaVu Sans',
        ]);
    }

    protected function generateCertificateNumber(Pendaftaran $pendaftaran): string
    {
        return 'SIBO-' . now()->format('Ymd') . '-' . $pendaftaran->id_daftar . '-' . Str::upper(Str::random(6));
    }
}
