<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Pendaftaran;

class KegiatanPublikController extends Controller
{
    public function index()
    {
        $kegiatans = Kegiatan::with('kategori', 'pamflet')
            ->orderBy('tanggal', 'desc')
            ->paginate(9);
        return view('kegiatan.index', compact('kegiatans'));
    }

    public function show($id)
    {
        $kegiatan = Kegiatan::with('kategori', 'pamflet', 'pendaftarans')
            ->findOrFail($id);
        $jumlahPeserta = $kegiatan->pendaftarans()->where('status', 'disetujui')->count();
        return view('kegiatan.show', compact('kegiatan', 'jumlahPeserta'));
    }
}