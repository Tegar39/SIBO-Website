<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Kegiatan;
use App\Models\Galeri;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $totalAnggota = Anggota::count();
        $totalKegiatan = Kegiatan::count();
        $totalPac = Anggota::whereNotNull('pac')->distinct('pac')->count('pac');
        $pacList = Anggota::select('pac', DB::raw('count(*) as total_anggota'))
            ->whereNotNull('pac')
            ->where('pac', '<>', '')
            ->groupBy('pac')
            ->orderBy('pac')
            ->take(6)
            ->get();
        $kegiatanTerbaru = Kegiatan::with('pamflet', 'kategori')
            ->where('status', 'aktif')
            ->orderBy('tanggal', 'desc')
            ->take(6) // ambil 6 kegiatan
            ->get();
        
        $galeri = Galeri::with('kegiatan')
            ->whereHas('kegiatan', function($q) {
                $q->where('status', 'selesai');
            })
            ->whereNotNull('path_file')
            ->orderBy('created_at', 'desc')
            ->take(12)
            ->get();

        $galeriFolders = Kegiatan::where('status', 'selesai')
            ->whereHas('galeris')
            ->withCount('galeris')
            ->with(['galeris' => fn ($q) => $q->orderByDesc('is_unggulan')->orderByDesc('tgl_upload')->limit(1)])
            ->orderByDesc('tanggal')
            ->take(6)
            ->get();

        $homeStats = [
            [
                'label' => 'Total Anggota',
                'val' => $totalAnggota,
                'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
            ],
            [
                'label' => 'Total Kegiatan',
                'val' => $totalKegiatan,
                'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z',
            ],
            [
                'label' => 'PAC Aktif',
                'val' => $totalPac,
                'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4',
            ],
        ];

        return view('home', compact('totalAnggota', 'totalKegiatan', 'kegiatanTerbaru', 'galeri', 'galeriFolders', 'totalPac', 'pacList', 'homeStats'));
    }
}