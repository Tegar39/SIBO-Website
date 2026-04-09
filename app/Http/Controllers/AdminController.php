<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Kegiatan;
use App\Models\Pendaftaran;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Total Anggota (untuk grafik garis: pertumbuhan 6 bulan terakhir)
        $anggotaPerBulan = Anggota::select(
                DB::raw('MONTH(created_at) as bulan'),
                DB::raw('YEAR(created_at) as tahun'),
                DB::raw('COUNT(*) as total')
            )
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('tahun', 'bulan')
            ->orderBy('tahun', 'asc')
            ->orderBy('bulan', 'asc')
            ->get();

        $anggotaLabels = [];
        $anggotaData = [];
        foreach ($anggotaPerBulan as $item) {
            $anggotaLabels[] = \Carbon\Carbon::create()->month($item->bulan)->isoFormat('MMMM') . ' ' . $item->tahun;
            $anggotaData[] = $item->total;
        }

        // Total Kegiatan per Kategori (lingkaran)
        $kegiatanPerKategori = Kategori::withCount('kegiatans')->get();
        $kategoriLabels = [];
        $kategoriData = [];
        foreach ($kegiatanPerKategori as $kat) {
            $kategoriLabels[] = $kat->nama;
            $kategoriData[] = $kat->kegiatans_count;
        }

        // Pendaftar baru bulan ini
        $pendaftarBaru = Pendaftaran::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Kegiatan terdekat (5 kegiatan dengan tanggal terdekat, status aktif)
        $kegiatanTerdekat = Kegiatan::where('status', 'aktif')
            ->where('tanggal', '>=', now())
            ->orderBy('tanggal', 'asc')
            ->limit(5)
            ->get();

        // Pendaftar per kegiatan (batang) -> 5 kegiatan dengan pendaftar terbanyak
        $pendaftarPerKegiatan = Kegiatan::withCount('pendaftarans')
            ->orderBy('pendaftarans_count', 'desc')
            ->limit(5)
            ->get();

        $kegiatanPendaftarLabels = [];
        $kegiatanPendaftarData = [];
        foreach ($pendaftarPerKegiatan as $k) {
            $kegiatanPendaftarLabels[] = $k->judul;
            $kegiatanPendaftarData[] = $k->pendaftarans_count;
        }

        // Log aktivitas terbaru (contoh dari pendaftaran terbaru, bisa juga dibuat model terpisah)
        $aktivitasTerbaru = Pendaftaran::with('anggota', 'kegiatan')
            ->latest()
            ->limit(10)
            ->get();

        $anggotaBolos = Pendaftaran::with(['anggota', 'kegiatan'])
        ->where('status', 'disetujui')
        ->whereDoesntHave('absensi', function ($q) {
            $q->where('hadir', true);
        })
        ->latest()
        ->limit(10)
        ->get();

        return view('admin.dashboard', compact(
            'anggotaLabels', 'anggotaData',
            'kategoriLabels', 'kategoriData',
            'pendaftarBaru',
            'kegiatanTerdekat',
            'kegiatanPendaftarLabels', 'kegiatanPendaftarData',
            'aktivitasTerbaru', 'anggotaBolos'
        ));
    }
}