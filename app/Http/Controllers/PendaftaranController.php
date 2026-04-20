<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendaftaranController extends Controller
{
    // Anggota mendaftar ke kegiatan
    public function daftar($id_kegiatan)
    {
        $anggota = Auth::user()->anggota;
        if (!$anggota) {
            return back()->with('error', 'Data anggota belum lengkap. Hubungi admin.');
        }

        $kegiatan = Kegiatan::findOrFail($id_kegiatan);
        if ($kegiatan->status != 'aktif') {
            return back()->with('error', 'Kegiatan tidak aktif.');
        }

        // Cek sudah daftar
        $sudah = Pendaftaran::where('id_anggota', $anggota->id_anggota)
            ->where('id_kegiatan', $id_kegiatan)->exists();
        if ($sudah) {
            return back()->with('error', 'Anda sudah mendaftar kegiatan ini.');
        }

        // Cek kuota
        $disetujui = Pendaftaran::where('id_kegiatan', $id_kegiatan)
            ->where('status', 'disetujui')->count();
        if ($kegiatan->kuota > 0 && $disetujui >= $kegiatan->kuota) {
            return back()->with('error', 'Kuota sudah penuh.');
        }

        Pendaftaran::create([
            'id_anggota' => $anggota->id_anggota,
            'id_kegiatan' => $id_kegiatan,
            'tgl_daftar' => now(),
            'status' => 'pending',
        ]);

        return back()->with('success', 'Pendaftaran berhasil, menunggu konfirmasi admin.');
    }

    // Admin: daftar kegiatan yang memiliki pendaftar
    public function index()
    {
        // Kita ganti get() jadi paginate(3) biar konsisten sama request kamu
        $kegiatans = Kegiatan::withCount('pendaftarans')
            ->with('pamflet') // Eager load pamflet biar gak berat
            ->orderBy('tanggal', 'desc')
            ->paginate(3); 

        return view('admin.pendaftaran.index', compact('kegiatans'));
    }

    // Admin: daftar pendaftar per kegiatan
    public function show($id_kegiatan)
    {
        $kegiatan = Kegiatan::findOrFail($id_kegiatan);
        $pendaftarans = Pendaftaran::with('anggota.user')
            ->where('id_kegiatan', $id_kegiatan)
            ->latest()
            ->paginate(20);
        return view('admin.pendaftaran.show', compact('kegiatan', 'pendaftarans'));
    }

    // Admin: update status pendaftaran
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

    // Anggota: riwayat pendaftaran
    public function riwayat()
    {
        $anggota = Auth::user()->anggota;
        if (!$anggota) {
            return redirect()->route('home')->with('error', 'Data anggota tidak ditemukan.');
        }
        $pendaftarans = Pendaftaran::with('kegiatan')
            ->where('id_anggota', $anggota->id_anggota)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('anggota.riwayat', compact('pendaftarans'));
    }
}