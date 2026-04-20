<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;

class KegiatanPublikController extends Controller
{
    public function index()
    {
        $kegiatans = Kegiatan::with('kategori', 'pamflet')
            ->where('status', 'aktif')
            ->orderBy('tanggal', 'desc')
            ->paginate(3);
        return view('kegiatan.index', compact('kegiatans'));
    }

    public function show($id)
    {
        $kegiatan = Kegiatan::with('kategori', 'pamflet', 'pendaftarans')->latest()->paginate(3)->findOrFail($id);
        $jumlahPeserta = $kegiatan->pendaftarans->where('status', 'disetujui')->count();
        return view('kegiatan.show', compact('kegiatan', 'jumlahPeserta'));
    }
}