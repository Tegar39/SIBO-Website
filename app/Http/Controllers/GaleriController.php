<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index()
    {
        $kegiatans = Kegiatan::with('galeris')->orderBy('tanggal', 'desc')->get();
        return view('admin.galeri.index', compact('kegiatans'));
    }

    public function show($id_kegiatan)
    {
        $kegiatan = Kegiatan::findOrFail($id_kegiatan);
        $fotos = Galeri::where('id_kegiatan', $id_kegiatan)->get();
        return view('admin.galeri.show', compact('kegiatan', 'fotos'));
    }

    public function create($id_kegiatan)
    {
        $kegiatan = Kegiatan::findOrFail($id_kegiatan);
        return view('admin.galeri.create', compact('kegiatan'));
    }

    public function store(Request $request, $id_kegiatan)
    {
        $request->validate([
            'fotos' => 'required|array',
            'fotos.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        foreach ($request->file('fotos') as $index => $file) {
            $path = $file->store('galeri', 'public');
            Galeri::create([
                'id_kegiatan' => $id_kegiatan,
                'judul_foto' => $request->judul[$index] ?? null,
                'path_file' => $path,
                'tgl_upload' => now(),
                'is_unggulan' => isset($request->unggulan[$index]),
            ]);
        }

        return redirect()->route('admin.galeri.show', $id_kegiatan)->with('success', 'Foto diupload.');
    }

    public function destroy($id_foto)
    {
        $foto = Galeri::findOrFail($id_foto);
        Storage::disk('public')->delete($foto->path_file);
        $foto->delete();
        return back()->with('success', 'Foto dihapus.');
    }
}