<?php

namespace App\Mail;

use App\Models\Pendaftaran;
use App\Models\Kegiatan;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AbsensiNotifikasi extends Mailable
{
    use Queueable, SerializesModels;

    public $peserta;
    public $kegiatan;

    public function __construct(Pendaftaran $peserta, Kegiatan $kegiatan)
    {
        $this->peserta = $peserta;
        $this->kegiatan = $kegiatan;
    }

    public function build()
    {
        return $this->subject('Informasi Ketidakhadiran Kegiatan')
                    ->view('emails.absensi_notifikasi');
    }
}