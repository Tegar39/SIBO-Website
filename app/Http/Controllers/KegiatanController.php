<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Kategori;
use App\Models\Pamflet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KegiatanController extends Controller
{
    public function index()
    {
        $kegiatans = Kegiatan::with('kategori', 'creator', 'pamflet')->latest()->paginate(10);
        return view('admin.kegiatan.index', compact('kegiatans'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.kegiatan.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kategori' => 'required|exists:kategoris,id_kategori',
            'judul' => 'required|string|max:200',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date',
            'waktu' => 'nullable',
            'lokasi' => 'nullable|string',
            'kuota' => 'nullable|integer|min:0',
            'status' => 'required|in:aktif,selesai,batal',
            'pamflet' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except('pamflet');
        $data['created_by'] = auth()->id();

        if (!$data['created_by']) {
            return back()->withErrors('Anda harus login sebagai admin.')->withInput();
        }

        $kegiatan = Kegiatan::create($data);

        if ($request->hasFile('pamflet')) {
            $file = $request->file('pamflet');
            $path = $file->store('pamflets', 'public');
            Pamflet::create([
                'id_kegiatan' => $kegiatan->id_kegiatan,
                'nama_file' => $file->getClientOriginalName(),
                'path_file' => $path,
                'tgl_upload' => now(),
            ]);
        }

        return redirect()->route('admin.kegiatan.index')->with('success', 'Kegiatan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kegiatan = Kegiatan::with('pamflet')->findOrFail($id);
        $kategoris = Kategori::all();
        return view('admin.kegiatan.edit', compact('kegiatan', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        $request->validate([
            'id_kategori' => 'required|exists:kategoris,id_kategori',
            'judul' => 'required|string|max:200',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date',
            'waktu' => 'nullable',
            'lokasi' => 'nullable|string',
            'kuota' => 'nullable|integer|min:0',
            'status' => 'required|in:aktif,selesai,batal',
            'pamflet' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $kegiatan->update($request->only([
            'id_kategori', 'judul', 'deskripsi', 'tanggal', 'waktu', 'lokasi', 'kuota', 'status'
        ]));

        if ($request->hasFile('pamflet')) {
            if ($kegiatan->pamflet) {
                Storage::disk('public')->delete($kegiatan->pamflet->path_file);
                $kegiatan->pamflet->delete();
            }
            $file = $request->file('pamflet');
            $path = $file->store('pamflets', 'public');
            Pamflet::create([
                'id_kegiatan' => $kegiatan->id_kegiatan,
                'nama_file' => $file->getClientOriginalName(),
                'path_file' => $path,
                'tgl_upload' => now(),
            ]);
        }

        return redirect()->route('admin.kegiatan.index')->with('success', 'Kegiatan berhasil diupdate');
    }

    public function destroy($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        if ($kegiatan->pamflet) {
            Storage::disk('public')->delete($kegiatan->pamflet->path_file);
            $kegiatan->pamflet->delete();
        }
        $kegiatan->delete();
        return redirect()->route('admin.kegiatan.index')->with('success', 'Kegiatan berhasil dihapus');
    }
}