<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardPacController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $anggota = $user->anggota;

        abort_if(! $anggota || blank($anggota->pac), 403, 'Akun ini belum memiliki data PAC. Lengkapi data anggota terlebih dahulu.');

        $pac = $anggota->pac;

        $totalAnggota = Anggota::where('pac', $pac)->count();
        $totalKegiatan = Kegiatan::whereHas('pendaftarans.anggota', fn ($q) => $q->where('pac', $pac))->count();
        $totalHadir = DB::table('absensis')
            ->join('pendaftarans', 'absensis.id_daftar', '=', 'pendaftarans.id_daftar')
            ->join('anggotas', 'pendaftarans.id_anggota', '=', 'anggotas.id_anggota')
            ->where('anggotas.pac', $pac)
            ->where('absensis.hadir', true)
            ->count();
        $totalTidakHadir = DB::table('absensis')
            ->join('pendaftarans', 'absensis.id_daftar', '=', 'pendaftarans.id_daftar')
            ->join('anggotas', 'pendaftarans.id_anggota', '=', 'anggotas.id_anggota')
            ->where('anggotas.pac', $pac)
            ->where('absensis.hadir', false)
            ->count();

        $kegiatanTerbaru = Kegiatan::with('kategori')
            ->whereHas('pendaftarans.anggota', fn ($q) => $q->where('pac', $pac))
            ->withCount(['pendaftarans as peserta_pac_count' => fn ($q) => $q->whereHas('anggota', fn ($sub) => $sub->where('pac', $pac))])
            ->orderBy('tanggal', 'desc')
            ->limit(8)
            ->get();

        return view('pac.dashboard', compact('pac', 'totalAnggota', 'totalKegiatan', 'totalHadir', 'totalTidakHadir', 'kegiatanTerbaru'));
    }
}
