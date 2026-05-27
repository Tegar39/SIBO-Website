<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Kategori;
use App\Models\Pamflet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\AuditService;
use Carbon\Carbon;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kategoris = Kategori::all();

        $kegiatans = Kegiatan::with('kategori', 'creator', 'pamflet')
            ->when($request->search, function ($query, $search) {
                $query->where('judul', 'like', "%{$search}%")
                    ->orWhere('lokasi', 'like', "%{$search}%");
            })
            ->when($request->kategori, function ($query, $kategori) {
                $query->where('id_kategori', $kategori);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.kegiatan.index', compact('kegiatans', 'kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.kegiatan.create', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, AuditService $audit)
    {
        $request->validate([
            'id_kategori' => 'required|exists:kategoris,id_kategori',
            'judul' => 'required|string|max:200',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date',
            'waktu' => 'nullable',
            'lokasi' => 'nullable|string|max:255',
            'kuota' => 'nullable|integer|min:0',
            'status' => 'required|in:aktif,tutup,selesai,batal',
            'pamflet' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except('pamflet');
        $data['created_by'] = auth()->id();

        $kegiatan = Kegiatan::create($data);
        $audit->log('create_kegiatan', 'kegiatan', $kegiatan, null, $kegiatan->only(['judul', 'tanggal', 'lokasi', 'status']), $request);

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

        return redirect()->route('admin.kegiatan.index')
            ->with('success', 'Kegiatan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $kegiatan = Kegiatan::with('kategori', 'pamflet', 'creator')->findOrFail($id);
        return view('admin.kegiatan.show', compact('kegiatan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kegiatan = Kegiatan::with('pamflet')->findOrFail($id);
        $kategoris = Kategori::all();
        return view('admin.kegiatan.edit', compact('kegiatan', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id, AuditService $audit)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        
        $request->validate([
            'id_kategori' => 'required|exists:kategoris,id_kategori',
            'judul' => 'required|string|max:200',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date',
            'waktu' => 'nullable',
            'lokasi' => 'nullable|string|max:255',
            'kuota' => 'nullable|integer|min:0',
            'status' => 'required|in:aktif,tutup,selesai,batal',
            'pamflet' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $old = $kegiatan->only(['judul', 'tanggal', 'lokasi', 'status']);
        $kegiatan->update($request->only([
            'id_kategori', 'judul', 'deskripsi', 'tanggal', 'waktu', 'lokasi', 'kuota', 'status'
        ]));
        $audit->log('update_kegiatan', 'kegiatan', $kegiatan, $old, $kegiatan->only(['judul', 'tanggal', 'lokasi', 'status']), $request);

        if ($request->hasFile('pamflet')) {
            // Hapus pamflet lama
            if ($kegiatan->pamflet) {
                Storage::disk('public')->delete($kegiatan->pamflet->path_file);
                $kegiatan->pamflet->delete();
            }
            
            // Upload pamflet baru
            $file = $request->file('pamflet');
            $path = $file->store('pamflets', 'public');
            Pamflet::create([
                'id_kegiatan' => $kegiatan->id_kegiatan,
                'nama_file' => $file->getClientOriginalName(),
                'path_file' => $path,
                'tgl_upload' => now(),
            ]);
        }

        return redirect()->route('admin.kegiatan.index')
            ->with('success', 'Kegiatan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, AuditService $audit)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        
        // Hapus pamflet jika ada
        if ($kegiatan->pamflet) {
            Storage::disk('public')->delete($kegiatan->pamflet->path_file);
            $kegiatan->pamflet->delete();
        }
        
        $old = $kegiatan->only(['judul', 'tanggal', 'lokasi', 'status']);
        $audit->log('delete_kegiatan', 'kegiatan', $kegiatan, $old, null, request());
        // Hapus kegiatan
        $kegiatan->delete();
        
        return redirect()->route('admin.kegiatan.index')
            ->with('success', 'Kegiatan berhasil dihapus');
    }

    /**
     * Update status kegiatan secara otomatis (manual trigger)
     */
    public function updateStatusOtomatis()
    {
        $now = Carbon::now('Asia/Jakarta');
        
        // Tutup kegiatan H-1
        $tomorrow = $now->copy()->addDay();
        $updatedTutup = Kegiatan::where('status', 'aktif')
            ->whereDate('tanggal', $tomorrow->toDateString())
            ->update(['status' => 'tutup']);
        
        // Selesai kegiatan 1 jam setelah jadwal
        $kegiatanSelesai = Kegiatan::whereIn('status', ['aktif', 'tutup'])->get();
        $updatedSelesai = 0;
        
        foreach ($kegiatanSelesai as $kegiatan) {
            $waktuKegiatan = Carbon::parse($kegiatan->tanggal . ' ' . ($kegiatan->waktu ?? '00:00:00'), 'Asia/Jakarta');
            $batasSelesai = $waktuKegiatan->copy()->addHour();
            
            if ($now->gt($batasSelesai)) {
                $kegiatan->update(['status' => 'selesai']);
                $updatedSelesai++;
            }
        }
        
        $message = "Status kegiatan diperbarui: ";
        $message .= "$updatedTutup kegiatan ditutup, ";
        $message .= "$updatedSelesai kegiatan selesai.";
        
        return redirect()->route('admin.kegiatan.index')
            ->with('success', $message);
    }
}