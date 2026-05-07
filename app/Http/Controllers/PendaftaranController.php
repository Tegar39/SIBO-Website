<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendaftaranController extends Controller
{
    // ========== ANGGOTA ==========
    public function daftar(Request $request, $id_kegiatan)
    {
        $user = Auth::user();
        $anggota = $user->anggota;
        if (!$anggota) {
            return back()->with('error', 'Data anggota belum lengkap. Hubungi admin.');
        }

        $kegiatan = Kegiatan::findOrFail($id_kegiatan);
        if ($kegiatan->status != 'aktif' || !$kegiatan->bisaDaftar) {
            return back()->with('error', 'Pendaftaran kegiatan sudah ditutup.');
        }

        $request->validate([
            'jenis_daftar' => 'required|in:self,other',
            'nama_peserta' => 'required_if:jenis_daftar,other|nullable|string|max:100',
            'kontak_peserta' => 'required_if:jenis_daftar,other|nullable|string|max:20',
        ]);

        // Cek kuota (hitung yang sudah disetujui)
        $jumlahDisetujui = Pendaftaran::where('id_kegiatan', $id_kegiatan)
            ->where('status', 'disetujui')->count();
        if ($kegiatan->kuota > 0 && $jumlahDisetujui >= $kegiatan->kuota) {
            return back()->with('error', 'Kuota kegiatan sudah penuh.');
        }

        $data = [
            'id_kegiatan' => $kegiatan->id_kegiatan,
            'tgl_daftar' => now(),
            'status' => 'pending',
            'created_by' => $user->id,
        ];

        if ($request->jenis_daftar == 'self') {
            $data['id_anggota'] = $anggota->id_anggota;
            $data['nama_peserta'] = $anggota->nama_lengkap;
            $data['kontak_peserta'] = $anggota->kontak;
        } else {
            $data['id_anggota'] = $anggota->id_anggota; // tetap catat pendaftar
            $data['nama_peserta'] = $request->nama_peserta;
            $data['kontak_peserta'] = $request->kontak_peserta;
        }

        Pendaftaran::create($data);

        return redirect()->route('anggota.riwayat')->with('success', 'Pendaftaran berhasil dikirim.');
    }

    public function riwayat()
    {
        $user = Auth::user();
        $anggota = $user->anggota;
        if (!$anggota) {
            return redirect()->route('home')->with('error', 'Data anggota tidak ditemukan.');
        }
        $pendaftarans = Pendaftaran::with('kegiatan')
            ->where(function ($q) use ($anggota, $user) {
                $q->where('id_anggota', $anggota->id_anggota)
                  ->orWhere('created_by', $user->id);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('anggota.riwayat', compact('pendaftarans'));
    }

    // ========== ADMIN ==========
    public function index(Request $request)
    {
        $kegiatans = Kegiatan::withCount('pendaftarans')
            ->with('pamflet')
            ->when($request->search, fn($q, $s) => $q->where('judul', 'like', "%{$s}%"))
            ->orderBy('created_at', 'desc')
            ->paginate(3)
            ->withQueryString();
        return view('admin.pendaftaran.index', compact('kegiatans'));
    }

    public function show($id_kegiatan)
    {
        $kegiatan = Kegiatan::findOrFail($id_kegiatan);
        $pendaftarans = Pendaftaran::with('anggota.user', 'creator')
            ->where('id_kegiatan', $id_kegiatan)
            ->latest()
            ->paginate(20);
        return view('admin.pendaftaran.show', compact('kegiatan', 'pendaftarans'));
    }

    public function createByAdmin($id_kegiatan)
    {
        $kegiatan = Kegiatan::findOrFail($id_kegiatan);
        return view('admin.pendaftaran.create', compact('kegiatan'));
    }

    public function storeByAdmin(Request $request, $id_kegiatan)
    {
        $kegiatan = Kegiatan::findOrFail($id_kegiatan);
        $request->validate([
            'nama_peserta' => 'required|string|max:100',
            'kontak_peserta' => 'required|string|max:20',
            'status' => 'required|in:pending,disetujui,batal,ditolak',
        ]);

        if ($request->status == 'disetujui') {
            $jumlahDisetujui = Pendaftaran::where('id_kegiatan', $id_kegiatan)
                ->where('status', 'disetujui')->count();
            if ($kegiatan->kuota > 0 && $jumlahDisetujui >= $kegiatan->kuota) {
                return back()->with('error', 'Kuota penuh, tidak bisa menyetujui.');
            }
        }

        Pendaftaran::create([
            'id_kegiatan' => $kegiatan->id_kegiatan,
            'nama_peserta' => $request->nama_peserta,
            'kontak_peserta' => $request->kontak_peserta,
            'tgl_daftar' => now(),
            'status' => $request->status,
            'created_by' => Auth::id(),
            'id_anggota' => null,
        ]);

        return redirect()->route('admin.pendaftaran.show', $id_kegiatan)
            ->with('success', 'Peserta berhasil ditambahkan.');
    }

    public function updateStatus(Request $request, $id_daftar)
    {
        $request->validate(['status' => 'required|in:disetujui,ditolak,batal']);
        $pendaftaran = Pendaftaran::findOrFail($id_daftar);
        $kegiatan = $pendaftaran->kegiatan;

        if ($request->status == 'disetujui' && $pendaftaran->status != 'disetujui') {
            $disetujui = Pendaftaran::where('id_kegiatan', $kegiatan->id_kegiatan)
                ->where('status', 'disetujui')->count();
            if ($kegiatan->kuota > 0 && $disetujui >= $kegiatan->kuota) {
                return back()->with('error', 'Kuota penuh, tidak bisa menyetujui.');
            }
        }

        $pendaftaran->update(['status' => $request->status]);
        return back()->with('success', 'Status pendaftaran diupdate.');
    }
}