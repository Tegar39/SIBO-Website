<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class GaleriPublikController extends Controller
{
    public function index(Request $request)
    {
        $kegiatanId = $request->integer('kegiatan');

        $kegiatans = Kegiatan::query()
            ->where('status', 'selesai')
            ->whereHas('galeris')
            ->withCount('galeris')
            ->with(['galeris' => fn ($q) => $q->orderByDesc('is_unggulan')->orderByDesc('tgl_upload')->limit(1)])
            ->orderByDesc('tanggal')
            ->paginate(9);

        $selectedKegiatan = null;
        $galeri = collect();

        if ($kegiatanId) {
            $selectedKegiatan = Kegiatan::where('status', 'selesai')
                ->whereHas('galeris')
                ->findOrFail($kegiatanId);

            $galeri = Galeri::with('kegiatan')
                ->where('id_kegiatan', $kegiatanId)
                ->orderByDesc('is_unggulan')
                ->orderByDesc('tgl_upload')
                ->paginate(12);
        }

        return view('galeri.index', compact('kegiatans', 'selectedKegiatan', 'galeri', 'kegiatanId'));
    }

    public function show($id)
    {
        $galeri = Galeri::with('kegiatan')->findOrFail($id);

        if ($galeri->kegiatan->status !== 'selesai') {
            abort(404);
        }

        return view('galeri.show', compact('galeri'));
    }
}
