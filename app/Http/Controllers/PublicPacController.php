<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicPacController extends Controller
{
    public function index(Request $request)
    {
        $pacList = Anggota::query()
            ->select('pac', DB::raw('COUNT(*) as total_anggota'))
            ->whereNotNull('pac')
            ->where('pac', '<>', '')
            ->when($request->search, fn ($q, $search) => $q->where('pac', 'like', "%{$search}%"))
            ->groupBy('pac')
            ->orderBy('pac')
            ->get()
            ->map(function ($row) {
                $row->total_kegiatan = Kegiatan::whereHas('pendaftarans.anggota', function ($q) use ($row) {
                    $q->where('pac', $row->pac);
                })->distinct('id_kegiatan')->count('id_kegiatan');
                return $row;
            });

        return view('pac.public-index', compact('pacList'));
    }

    public function show(string $pac)
    {
        $pac = urldecode($pac);

        $anggota = Anggota::with('user')
            ->where('pac', $pac)
            ->orderBy('nama_lengkap')
            ->get();

        abort_if($anggota->isEmpty(), 404, 'PAC tidak ditemukan atau belum memiliki anggota aktif.');

        $kegiatanTerbaru = Kegiatan::with('kategori')
            ->whereHas('pendaftarans.anggota', fn ($q) => $q->where('pac', $pac))
            ->withCount(['pendaftarans as peserta_pac_count' => function ($q) use ($pac) {
                $q->whereHas('anggota', fn ($sub) => $sub->where('pac', $pac));
            }])
            ->orderByDesc('tanggal')
            ->limit(10)
            ->get();

        $statistik = [
            'total_anggota' => $anggota->count(),
            'total_kegiatan' => $kegiatanTerbaru->count(),
            'hadir' => DB::table('absensis')
                ->join('pendaftarans', 'absensis.id_daftar', '=', 'pendaftarans.id_daftar')
                ->join('anggotas', 'pendaftarans.id_anggota', '=', 'anggotas.id_anggota')
                ->where('anggotas.pac', $pac)
                ->where('absensis.hadir', true)
                ->count(),
            'tidak_hadir' => DB::table('absensis')
                ->join('pendaftarans', 'absensis.id_daftar', '=', 'pendaftarans.id_daftar')
                ->join('anggotas', 'pendaftarans.id_anggota', '=', 'anggotas.id_anggota')
                ->where('anggotas.pac', $pac)
                ->where('absensis.hadir', false)
                ->count(),
        ];

        return view('pac.public-show', compact('pac', 'anggota', 'kegiatanTerbaru', 'statistik'));
    }
}
