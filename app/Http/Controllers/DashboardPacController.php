<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Kegiatan;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Auth;

class DashboardPacController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $anggota = $user->anggota;
        $pac = $anggota->pac;

        $totalAnggota = Anggota::where('pac', $pac)->count();
        $totalKegiatan = Kegiatan::whereHas('pendaftarans.anggota', function($q) use ($pac) {
            $q->where('pac', $pac);
        })->distinct()->count();

        $kegiatanTerbaru = Kegiatan::whereHas('pendaftarans.anggota', function($q) use ($pac) {
            $q->where('pac', $pac);
        })->orderBy('tanggal', 'desc')->limit(5)->get();

        return view('pac.dashboard', compact('pac', 'totalAnggota', 'totalKegiatan', 'kegiatanTerbaru'));
    }
}