<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class GaleriPublikController extends Controller
{
    public function index(Request $request)
    {
        $kegiatanId = $request->get('kegiatan');
        
        // Hanya galeri dari kegiatan yang statusnya 'selesai'
        $query = Galeri::with(['kegiatan'])
            ->whereHas('kegiatan', function ($q) {
                $q->where('status', 'selesai');
            });
        
        if ($kegiatanId) {
            $query->where('id_kegiatan', $kegiatanId);
        }
        
        $galeri = $query->orderBy('created_at', 'desc')->paginate(12);
        
        // Dropdown filter hanya menampilkan kegiatan yang selesai
        $kegiatans = Kegiatan::where('status', 'selesai')
            ->orderBy('tanggal', 'desc')
            ->get(['id_kegiatan', 'judul']);
        
        return view('galeri.index', compact('galeri', 'kegiatans', 'kegiatanId'));
    }
    
    public function show($id)
    {
        $galeri = Galeri::with('kegiatan')->findOrFail($id);
        
        // Pastikan kegiatan yang terkait sudah selesai, jika tidak tampilkan 404
        if ($galeri->kegiatan->status != 'selesai') {
            abort(404);
        }
        
        return view('galeri.show', compact('galeri'));
    }
}