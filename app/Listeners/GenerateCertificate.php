<?php

namespace App\Listeners;

use App\Events\PendaftaranSelesai;
use App\Services\CertificateService;

class GenerateCertificate
{
    protected $certificateService;

    public function __construct(CertificateService $certificateService)
    {
        $this->certificateService = $certificateService;
    }

    public function handle(PendaftaranSelesai $event)
    {
        $this->certificateService->generateForPendaftaran($event->pendaftaran);
    }
}