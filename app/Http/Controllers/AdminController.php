<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Kegiatan;
use App\Models\Pendaftaran;
use App\Models\Kategori;
use App\Models\Absensi;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $today = Carbon::now('Asia/Jakarta');
        $startOfMonth = $today->copy()->startOfMonth();
        $endOfMonth = $today->copy()->endOfMonth();
        $startOfYear = $today->copy()->startOfYear();
        $endOfYear = $today->copy()->endOfYear();
        $tomorrow = $today->copy()->addDay();

        // Dashboard tidak memakai filter. Semua angka adalah ringkasan bulan/tahun berjalan.
        $periodeBulanIni = $today->copy()->locale('id')->translatedFormat('F Y');
        $periodeTahunIni = $today->year;

        $this->kirimNotifikasiKegiatanH1($tomorrow);

        $totalAnggota = Anggota::count();
        $anggotaBaruBulanIni = Anggota::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();

        $totalKegiatanTahunan = Kegiatan::whereBetween('tanggal', [$startOfYear->toDateString(), $endOfYear->toDateString()])->count();
        $totalKegiatanBulanIni = Kegiatan::whereBetween('tanggal', [$startOfMonth->toDateString(), $endOfMonth->toDateString()])->count();
        $kegiatanTerlaksanaBulanIni = Kegiatan::whereBetween('tanggal', [$startOfMonth->toDateString(), $endOfMonth->toDateString()])
            ->where(function ($query) use ($today) {
                $query->where('status', 'selesai')
                    ->orWhereDate('tanggal', '<', $today->toDateString());
            })
            ->where('status', '!=', 'batal')
            ->count();
        $kegiatanTerjadwalBulanIni = Kegiatan::whereBetween('tanggal', [$startOfMonth->toDateString(), $endOfMonth->toDateString()])
            ->where(function ($query) use ($today) {
                $query->whereIn('status', ['aktif', 'tutup'])
                    ->orWhereDate('tanggal', '>=', $today->toDateString());
            })
            ->whereDate('tanggal', '>=', $today->toDateString())
            ->where('status', '!=', 'batal')
            ->count();

        $pendaftarBulanIni = Pendaftaran::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();
        $pesertaDisetujuiBulanIni = Pendaftaran::where('status', 'disetujui')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->count();
        $hadirBulanIni = Absensi::where('hadir', true)
            ->whereHas('pendaftaran.kegiatan', function ($query) use ($startOfMonth, $endOfMonth) {
                $query->whereBetween('tanggal', [$startOfMonth->toDateString(), $endOfMonth->toDateString()]);
            })
            ->count();
        $tidakHadirBulanIni = Absensi::where('hadir', false)
            ->whereHas('pendaftaran.kegiatan', function ($query) use ($startOfMonth, $endOfMonth) {
                $query->whereBetween('tanggal', [$startOfMonth->toDateString(), $endOfMonth->toDateString()]);
            })
            ->count();

        $kegiatanBelumTerlaksanaBulanIni = Kegiatan::with(['kategori'])
            ->withCount(['pendaftarans as total_pendaftar', 'pendaftarans as total_disetujui' => function ($query) {
                $query->where('status', 'disetujui');
            }])
            ->whereBetween('tanggal', [$today->toDateString(), $endOfMonth->toDateString()])
            ->whereIn('status', ['aktif', 'tutup'])
            ->orderBy('tanggal')
            ->orderBy('waktu')
            ->limit(8)
            ->get();

        $kegiatanH1 = Kegiatan::with(['kategori'])
            ->withCount(['pendaftarans as total_disetujui' => function ($query) {
                $query->where('status', 'disetujui');
            }])
            ->whereDate('tanggal', $tomorrow->toDateString())
            ->whereIn('status', ['aktif', 'tutup'])
            ->orderBy('waktu')
            ->get();

        $pendaftarTerbaruBulanIni = Pendaftaran::with(['anggota.user', 'kegiatan.kategori', 'creator'])
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->latest()
            ->limit(8)
            ->get();

        $kegiatanPerKategoriBulanIni = Kategori::withCount(['kegiatans as total_bulan_ini' => function ($query) use ($startOfMonth, $endOfMonth) {
                $query->whereBetween('tanggal', [$startOfMonth->toDateString(), $endOfMonth->toDateString()]);
            }])
            ->orderBy('nama')
            ->get();

        $trenBulanan = collect(range(5, 0))->map(function ($i) use ($today) {
            $month = $today->copy()->subMonths($i);
            $start = $month->copy()->startOfMonth();
            $end = $month->copy()->endOfMonth();

            return [
                'label' => $month->locale('id')->translatedFormat('M Y'),
                'anggota' => Anggota::whereBetween('created_at', [$start, $end])->count(),
                'kegiatan' => Kegiatan::whereBetween('tanggal', [$start->toDateString(), $end->toDateString()])->count(),
                'pendaftar' => Pendaftaran::whereBetween('created_at', [$start, $end])->count(),
            ];
        });

        $kategoriLabels = $kegiatanPerKategoriBulanIni->pluck('nama')->values();
        $kategoriData = $kegiatanPerKategoriBulanIni->pluck('total_bulan_ini')->values();
        $trenLabels = $trenBulanan->pluck('label')->values();
        $trenAnggotaData = $trenBulanan->pluck('anggota')->values();
        $trenKegiatanData = $trenBulanan->pluck('kegiatan')->values();
        $trenPendaftarData = $trenBulanan->pluck('pendaftar')->values();

        return view('admin.dashboard', compact(
            'periodeBulanIni', 'periodeTahunIni',
            'totalAnggota', 'anggotaBaruBulanIni',
            'totalKegiatanTahunan', 'totalKegiatanBulanIni', 'kegiatanTerlaksanaBulanIni', 'kegiatanTerjadwalBulanIni',
            'pendaftarBulanIni', 'pesertaDisetujuiBulanIni', 'hadirBulanIni', 'tidakHadirBulanIni',
            'kegiatanBelumTerlaksanaBulanIni', 'kegiatanH1', 'pendaftarTerbaruBulanIni',
            'kategoriLabels', 'kategoriData', 'trenLabels', 'trenAnggotaData', 'trenKegiatanData', 'trenPendaftarData'
        ));
    }

    private function kirimNotifikasiKegiatanH1(Carbon $tomorrow): void
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
