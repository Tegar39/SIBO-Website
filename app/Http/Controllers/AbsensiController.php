<?php

namespace App\Http\Controllers;

use App\Exports\PesertaKegiatanExport;
use App\Models\Absensi;
use App\Models\Kegiatan;
use App\Models\Notifikasi;
use App\Models\Pendaftaran;
use App\Services\CertificateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class AbsensiController extends Controller
{
    public function index()
    {
        $kegiatans = Kegiatan::whereIn('status', ['selesai', 'tutup'])->orderBy('tanggal', 'desc')->get();
        return view('admin.absensi.index', compact('kegiatans'));
    }

    public function create($id_kegiatan)
    {
        $kegiatan = Kegiatan::findOrFail($id_kegiatan);
        $pendaftarans = Pendaftaran::with(['anggota', 'absensi'])
            ->where('id_kegiatan', $id_kegiatan)
            ->where('status', 'disetujui')
            ->orderBy('nama_peserta')
            ->get();

        return view('admin.absensi.create', compact('kegiatan', 'pendaftarans'));
    }

    public function store(Request $request, $id_kegiatan)
    {
        $request->validate([
            'hadir' => 'nullable|array',
            'hadir.*' => 'nullable|boolean',
            'keterangan' => 'nullable|array',
            'keterangan.*' => 'nullable|string|max:255',
        ]);

        $kegiatan = Kegiatan::findOrFail($id_kegiatan);
        $certificateService = app(CertificateService::class);
        $hadirInput = $request->input('hadir', []);
        $keteranganInput = $request->input('keterangan', []);

        $pendaftarans = Pendaftaran::with(['anggota.user', 'certificate'])
            ->where('id_kegiatan', $id_kegiatan)
            ->where('status', 'disetujui')
            ->get();

        $hadirCount = 0;
        $tidakHadirCount = 0;

        foreach ($pendaftarans as $pendaftaran) {
            $idDaftar = $pendaftaran->id_daftar;
            $hadir = (bool) ($hadirInput[$idDaftar] ?? false);
            $keterangan = $keteranganInput[$idDaftar] ?? null;

            $absensi = Absensi::updateOrCreate(
                ['id_daftar' => $idDaftar],
                [
                    'hadir' => $hadir,
                    'waktu_hadir' => $hadir ? now() : null,
                    'keterangan' => $keterangan,
                ]
            );

            if ($hadir) {
                $hadirCount++;
                if (! $pendaftaran->certificate) {
                    $certificateService->generateForPendaftaran($pendaftaran->fresh(['anggota', 'kegiatan', 'certificate']));
                }
                continue;
            }

            $tidakHadirCount++;
            if ($pendaftaran->anggota) {
                $this->kirimNotifikasiTidakHadir($pendaftaran, $kegiatan, $keterangan);
            }
        }

        return redirect()->route('admin.absensi.show', $kegiatan->id_kegiatan)
            ->with('success', "Absensi disimpan. Hadir: {$hadirCount}, tidak hadir: {$tidakHadirCount}. Sertifikat dan notifikasi diproses otomatis.");
    }

    public function show($id_kegiatan)
    {
        $kegiatan = Kegiatan::findOrFail($id_kegiatan);
        $pendaftarans = Pendaftaran::with(['anggota', 'absensi', 'certificate'])
            ->where('id_kegiatan', $id_kegiatan)
            ->where('status', 'disetujui')
            ->get();

        $hadirCount = $pendaftarans->filter(fn ($p) => $p->absensi && $p->absensi->hadir)->count();

        return view('admin.absensi.show', compact('kegiatan', 'pendaftarans', 'hadirCount'));
    }

    public function export($id_kegiatan)
    {
        $kegiatan = Kegiatan::findOrFail($id_kegiatan);
        return Excel::download(new PesertaKegiatanExport($id_kegiatan), 'absensi_' . Str::slug($kegiatan->judul) . '.xlsx');
    }

    private function kirimNotifikasiTidakHadir(Pendaftaran $pendaftaran, Kegiatan $kegiatan, ?string $keterangan = null): void
    {
        $pesan = "Anda dinyatakan tidak hadir pada kegiatan '{$kegiatan->judul}'.";
        if ($keterangan) {
            $pesan .= " Keterangan: {$keterangan}";
        }

        Notifikasi::updateOrCreate(
            [
                'id_anggota' => $pendaftaran->anggota->id_anggota,
                'tipe' => 'ketidakhadiran',
                'judul' => 'Notifikasi Ketidakhadiran',
                'pesan' => $pesan,
            ],
            ['is_read' => false]
        );

        if ($pendaftaran->anggota->user?->email) {
            try {
                Mail::to($pendaftaran->anggota->user->email)
                    ->send(new \App\Mail\AbsensiNotifikasi($pendaftaran, $kegiatan));
            } catch (\Throwable $e) {
                report($e);
            }
        }
    }
}
