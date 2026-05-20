<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Notifikasi;

class DashboardAnggotaController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $anggota = $user->anggota;

        // Default values
        $jumlahPendaftaran = 0;
        $jumlahDiikuti = 0;
        $jumlahSelesai = 0;
        $agendaMendatang = collect();
        $notifikasi = collect();
        $unreadCount = 0;

        if ($anggota) {
            // 1. Total Pendaftaran
            $jumlahPendaftaran = Pendaftaran::where('id_anggota', $anggota->id_anggota)->count();

            // 2. Diikuti (status disetujui)
            $jumlahDiikuti = Pendaftaran::where('id_anggota', $anggota->id_anggota)
                ->where('status', 'disetujui')
                ->count();

            // 3. Selesai (sudah absen hadir)
            $jumlahSelesai = Pendaftaran::where('id_anggota', $anggota->id_anggota)
                ->whereHas('absensi', function($query) {
                    $query->where('hadir', 1);
                })->count();

            // 4. Agenda mendatang (kegiatan yang akan datang)
            $agendaMendatang = Pendaftaran::where('id_anggota', $anggota->id_anggota)
                ->where('status', 'disetujui')
                ->whereHas('kegiatan', function($query) {
                    $query->where('tanggal', '>=', now());
                })
                ->with('kegiatan')
                ->get();

            // 5. Notifikasi alfa
            $notifikasi = Notifikasi::where('id_anggota', $anggota->id_anggota)
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();
            $unreadCount = Notifikasi::where('id_anggota', $anggota->id_anggota)
                ->where('is_read', false)
                ->count();
        }

        return view('anggota.dashboard', compact(
            'user',
            'anggota',
            'jumlahPendaftaran',
            'jumlahDiikuti',
            'jumlahSelesai',
            'agendaMendatang',
            'notifikasi',
            'unreadCount'
        ));
    }
}