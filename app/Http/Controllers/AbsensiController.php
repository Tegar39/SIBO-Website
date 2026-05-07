<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Pendaftaran;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PesertaKegiatanExport;
use Illuminate\Support\Facades\Mail;
use App\Mail\AbsensiNotifikasi;

class AbsensiController extends Controller
{
    public function index()
    {
        $kegiatans = Kegiatan::where('status', 'selesai')->orderBy('tanggal', 'desc')->get();
        return view('admin.absensi.index', compact('kegiatans'));
    }

    public function create($id_kegiatan)
    {
        $kegiatan = Kegiatan::findOrFail($id_kegiatan);
        $pendaftarans = Pendaftaran::with('anggota')
            ->where('id_kegiatan', $id_kegiatan)
            ->where('status', 'disetujui')
            ->get();
        return view('admin.absensi.create', compact('kegiatan', 'pendaftarans'));
    }

    public function store(Request $request, $id_kegiatan)
    {
        $request->validate([
            'hadir' => 'required|array',
            'hadir.*' => 'boolean',
        ]);

        foreach ($request->hadir as $id_daftar => $hadir) {
            $absensi = Absensi::where('id_daftar', $id_daftar)->first();
            if ($absensi) {
                $absensi->update(['hadir' => $hadir, 'waktu_hadir' => $hadir ? now() : null]);
            } else {
                Absensi::create([
                    'id_daftar' => $id_daftar,
                    'hadir' => $hadir,
                    'waktu_hadir' => $hadir ? now() : null,
                ]);
            }
        }

        return redirect()->route('admin.absensi.index')->with('success', 'Absensi disimpan.');
    }
    public function show($id_kegiatan)
    {
        $kegiatan = Kegiatan::findOrFail($id_kegiatan);
        $pendaftarans = Pendaftaran::with(['anggota', 'absensi'])
            ->where('id_kegiatan', $id_kegiatan)
            ->where('status', 'disetujui')
            ->get();

        $hadirCount = $pendaftarans->filter(function ($p) {
            return $p->absensi && $p->absensi->hadir;
        })->count();

        return view('admin.absensi.show', compact('kegiatan', 'pendaftarans', 'hadirCount'));
    }
    
    public function export($id_kegiatan)
    {
        $kegiatan = Kegiatan::findOrFail($id_kegiatan);
        return Excel::download(new PesertaKegiatanExport($id_kegiatan), 'absensi_' . $kegiatan->slug . '.xlsx');
    }
}