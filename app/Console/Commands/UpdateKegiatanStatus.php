<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Kegiatan;
use App\Models\Notifikasi;
use Carbon\Carbon;

class UpdateKegiatanStatus extends Command
{
    protected $signature = 'kegiatan:update-status';
    protected $description = 'Update status kegiatan dan kirim notifikasi pengingat H-1';

    public function handle()
    {
        $now = Carbon::now('Asia/Jakarta');

        // 1. Kegiatan yang H-1 dari sekarang -> tutup (tidak bisa daftar)
        $tomorrow = $now->copy()->addDay();
        Kegiatan::where('status', 'aktif')
            ->whereDate('tanggal', $tomorrow->toDateString())
            ->update(['status' => 'tutup']);

        $this->kirimNotifikasiH1($tomorrow);

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

        $this->info('Status kegiatan dan notifikasi H-1 diperbarui.');
        return Command::SUCCESS;
    }

    private function kirimNotifikasiH1(Carbon $tomorrow): void
    {
        $kegiatans = Kegiatan::with(['pendaftarans' => function ($query) {
                $query->where('status', 'disetujui')->whereNotNull('id_anggota');
            }])
            ->whereDate('tanggal', $tomorrow->toDateString())
            ->whereIn('status', ['aktif', 'tutup'])
            ->get();

        foreach ($kegiatans as $kegiatan) {
            foreach ($kegiatan->pendaftarans as $pendaftaran) {
                $kode = 'KGT-' . $kegiatan->id_kegiatan . '-' . $tomorrow->format('Ymd');
                $sudahAda = Notifikasi::where('id_anggota', $pendaftaran->id_anggota)
                    ->where('tipe', 'reminder')
                    ->where('pesan', 'like', "%{$kode}%")
                    ->exists();

                if ($sudahAda) {
                    continue;
                }

                Notifikasi::create([
                    'id_anggota' => $pendaftaran->id_anggota,
                    'judul' => 'Pengingat Kegiatan Besok',
                    'pesan' => "Besok ada kegiatan {$kegiatan->judul} di {$kegiatan->lokasi}. Jangan lupa hadir tepat waktu. Kode: {$kode}",
                    'tipe' => 'reminder',
                    'is_read' => false,
                ]);
            }
        }
    }
}
