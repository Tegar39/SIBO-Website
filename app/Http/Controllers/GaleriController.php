<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;

class GaleriController extends Controller
{
    public function index()
    {
        $kegiatans = Kegiatan::withCount('galeris')
            ->with(['galeris' => fn ($q) => $q->latest('tgl_upload')->limit(1)])
            ->orderBy('tanggal', 'desc')
            ->paginate(6);

        return view('admin.galeri.index', compact('kegiatans'));
    }

    public function show($id_kegiatan)
    {
        $kegiatan = Kegiatan::findOrFail($id_kegiatan);
        $fotos = Galeri::where('id_kegiatan', $id_kegiatan)
            ->orderByDesc('tgl_upload')
            ->get();

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
            'fotos' => ['required', 'array'],
            'fotos.*' => [
                'required',
                File::types(['jpg', 'jpeg', 'png', 'webp', 'mp4', 'mov', 'm4v', 'webm'])
                    ->max(51200),
            ],
            'judul' => ['nullable', 'array'],
            'deskripsi' => ['nullable', 'array'],
            'unggulan' => ['nullable', 'array'],
        ]);

        foreach ($request->file('fotos') as $index => $file) {
            $mime = (string) $file->getMimeType();
            $jenisMedia = str_starts_with($mime, 'video/') ? 'video' : 'foto';
            $path = $file->store('galeri', 'public');

            Galeri::create([
                'id_kegiatan' => $id_kegiatan,
                'judul_foto' => $request->judul[$index] ?? null,
                'deskripsi' => $request->deskripsi[$index] ?? null,
                'path_file' => $path,
                'jenis_media' => $jenisMedia,
                'mime_type' => $mime,
                'ukuran_file' => $file->getSize(),
                'tgl_upload' => now(),
                'is_unggulan' => in_array((string) $index, array_map('strval', $request->input('unggulan', [])), true),
            ]);
        }

        return redirect()
            ->route('admin.galeri.show', $id_kegiatan)
            ->with('success', 'Dokumentasi kegiatan berhasil diunggah.');
    }

    public function destroy($id_foto)
    {
        $foto = Galeri::findOrFail($id_foto);
        if ($foto->path_file) {
            Storage::disk('public')->delete($foto->path_file);
        }
        $foto->delete();
        return back()->with('success', 'Dokumentasi berhasil dihapus.');
    }
}
