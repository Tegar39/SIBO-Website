<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Kegiatan;
use App\Models\Galeri;

class HomeController extends Controller
{
    public function index()
    {
        $totalAnggota = Anggota::count();
        $totalKegiatan = Kegiatan::count();
        $totalPac = Anggota::whereNotNull('pac')->distinct('pac')->count('pac');
        $kegiatanTerbaru = Kegiatan::with('pamflet', 'kategori')
            ->where('status', 'aktif')
            ->orderBy('tanggal', 'desc')
            ->take(6) // ambil 6 kegiatan
            ->get();
        
        // Ambil foto galeri unggulan (is_unggulan = 1) atau foto terbaru
        $galeri = Galeri::where('is_unggulan', 1)
            ->orWhere('is_unggulan', 0)
            ->latest()
            ->take(8)
            ->get();

        return view('home', compact('totalAnggota', 'totalKegiatan', 'kegiatanTerbaru', 'galeri', 'totalPac'));
    }
}