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

        return view('home', compact('totalAnggota', 'totalKegiatan', 'kegiatanTerbaru', 'galeri', 'galeriFolders', 'totalPac', 'pacList'));
    }
}