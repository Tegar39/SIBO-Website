<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran; // Pastikan model ini ada

class DashboardAnggotaController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $anggota = $user->anggota;

        // Default value biar gak error Undefined Variable di Blade
        $jumlahPendaftaran = 0;
        $jumlahDiikuti = 0;
        $jumlahSelesai = 0;
        $agendaMendatang = collect();

        if ($anggota) {
            // 1. Total Pendaftaran (Berdasarkan id_anggota)
            $jumlahPendaftaran = \App\Models\Pendaftaran::where('id_anggota', $anggota->id_anggota)->count();

            // 2. Diikuti (Pakai kolom 'status' dan value 'disetujui' sesuai gambar)
            $jumlahDiikuti = \App\Models\Pendaftaran::where('id_anggota', $anggota->id_anggota)
                ->where('status', 'disetujui') 
                ->count();

            // 3. Selesai (Menghitung pendaftaran yang sudah ada recordnya di tabel absensis dan hadir=1)
            // Ini pakai relasi 'absensi' yang ada di model Pendaftaran
            $jumlahSelesai = \App\Models\Pendaftaran::where('id_anggota', $anggota->id_anggota)
                ->whereHas('absensi', function($query) {
                    $query->where('hadir', 1);
                })->count();

            // 4. Ambil Agenda Mendatang
            $agendaMendatang = \App\Models\Pendaftaran::where('id_anggota', $anggota->id_anggota)
                ->where('status', 'disetujui') // Cuma yang sudah disetujui admin
                ->whereHas('kegiatan', function($query) {
                    $query->where('tanggal', '>=', now());
                })
                ->with('kegiatan')
                ->get();
        }

        return view('anggota.dashboard', compact(
            'user', 
            'anggota', 
            'jumlahPendaftaran', 
            'jumlahDiikuti', 
            'jumlahSelesai', 
            'agendaMendatang'
        ));
    }
}