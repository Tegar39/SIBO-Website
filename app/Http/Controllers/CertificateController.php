<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
    public function download($id)
    {
        $certificate = Certificate::findOrFail($id);
        
        // Pastikan file PDF benar-benar ada
        if (!Storage::disk('public')->exists($certificate->file_path)) {
            abort(404, 'File sertifikat tidak ditemukan.');
        }

        return Storage::disk('public')->download($certificate->file_path, "sertifikat_{$certificate->certificate_number}.pdf");
    }
}