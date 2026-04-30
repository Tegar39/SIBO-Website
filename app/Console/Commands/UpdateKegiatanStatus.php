<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Kegiatan;
use Carbon\Carbon;

class UpdateKegiatanStatus extends Command
{
    protected $signature = 'kegiatan:update-status';
    protected $description = 'Update status kegiatan berdasarkan tanggal dan waktu';

    public function handle()
    {
        $now = Carbon::now('Asia/Jakarta');
        
        // 1. Update kegiatan yang H-1 -> status menjadi 'tutup' (tidak bisa daftar)
        $tomorrow = $now->copy()->addDay();
        $kegiatanTutup = Kegiatan::where('status', 'aktif')
            ->whereDate('tanggal', $tomorrow->toDateString())
            ->get();
        
        foreach ($kegiatanTutup as $kegiatan) {
            $kegiatan->update(['status' => 'tutup']);
            $this->info("Kegiatan '{$kegiatan->judul}' ditutup (H-1)");
        }
        
        // 2. Update kegiatan yang sudah lewat 1 jam dari jadwal -> status 'selesai'
        $kegiatanSelesai = Kegiatan::where('status', 'tutup')
            ->orWhere('status', 'aktif')
            ->get();
        
        foreach ($kegiatanSelesai as $kegiatan) {
            $waktuKegiatan = Carbon::parse($kegiatan->tanggal . ' ' . ($kegiatan->waktu ?? '00:00:00'), 'Asia/Jakarta');
            $batasAbsen = $waktuKegiatan->copy()->addHour();
            
            // Jika sekarang sudah melebihi batas absen (1 jam setelah kegiatan selesai)
            if ($now->gt($batasAbsen) && $kegiatan->status != 'selesai') {
                $kegiatan->update(['status' => 'selesai']);
                $this->info("Kegiatan '{$kegiatan->judul}' selesai (melebihi 1 jam)");
            }
        }
        
        $this->info('Status kegiatan berhasil diperbarui!');
        
        return Command::SUCCESS;
    }
}