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

        // 1. Kegiatan yang H-1 dari sekarang -> tutup (tidak bisa daftar)
        $tomorrow = $now->copy()->addDay();
        Kegiatan::where('status', 'aktif')
            ->whereDate('tanggal', $tomorrow->toDateString())
            ->update(['status' => 'tutup']);

        // 2. Kegiatan yang sudah lewat 1 jam dari jadwal selesai -> selesai
        $kegiatanSelesai = Kegiatan::whereIn('status', ['aktif', 'tutup'])->get();
        foreach ($kegiatanSelesai as $kegiatan) {
            $waktuKegiatan = Carbon::parse($kegiatan->tanggal . ' ' . ($kegiatan->waktu ?? '00:00:00'), 'Asia/Jakarta');
            $batasAbsen = $waktuKegiatan->copy()->addHour();
            if ($now->gt($batasAbsen) && $kegiatan->status != 'selesai') {
                $kegiatan->update(['status' => 'selesai']);
                $this->info("Kegiatan '{$kegiatan->judul}' telah selesai.");
            }
        }

        $this->info('Status kegiatan diperbarui.');
        return Command::SUCCESS;
    }
}