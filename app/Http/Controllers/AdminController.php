<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Kegiatan;
use App\Models\Pendaftaran;
class AdminController extends Controller
{
    public function dashboard()
    {
        $totalAnggota = Anggota::count();
        $totalKegiatan = Kegiatan::count();
        $pendingPendaftar = Pendaftaran::where('status', 'pending')->count();
        $anggotaTerbaru = Anggota::with('user')->latest()->take(5)->get();
        return view('admin.dashboard', compact('totalAnggota', 'totalKegiatan', 'pendingPendaftar', 'anggotaTerbaru'));
    }
}