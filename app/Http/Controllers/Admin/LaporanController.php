<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Anggota;
use App\Models\Kegiatan;
use App\Models\Pendaftaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function index()
    {
        $totalAnggota = Anggota::count();
        $totalKegiatan = Kegiatan::count();
        $totalPendaftar = Pendaftaran::count();
        $anggotaByPac = Anggota::select('pac', DB::raw('count(*) as total'))->groupBy('pac')->get();
        $kegiatanByStatus = Kegiatan::select('status', DB::raw('count(*) as total'))->groupBy('status')->get();
        $totalHadir = Absensi::where('hadir', true)->count();
        $totalTidakHadir = Absensi::where('hadir', false)->count();

        return view('admin.laporan.index', compact(
            'totalAnggota', 'totalKegiatan', 'totalPendaftar',
            'anggotaByPac', 'kegiatanByStatus', 'totalHadir', 'totalTidakHadir'
        ));
    }

    public function anggota(Request $request)
    {
        $anggota = $this->anggotaQuery($request)->get();
        return view('admin.laporan.anggota', compact('anggota'));
    }

    public function kegiatan(Request $request)
    {
        $kegiatan = $this->kegiatanQuery($request)->get();
        return view('admin.laporan.kegiatan', compact('kegiatan'));
    }

    public function absensi(Request $request)
    {
        $absensi = $this->absensiQuery($request)->paginate(25)->withQueryString();
        $kegiatans = Kegiatan::orderByDesc('tanggal')->get();
        return view('admin.laporan.absensi', compact('absensi', 'kegiatans'));
    }

    public function exportAnggotaExcel(Request $request)
    {
        $anggota = $this->anggotaQuery($request)->get();
        return Excel::download($this->collectionExport($this->mapAnggota($anggota), $this->headingAnggota()), 'laporan_anggota_' . now()->format('Ymd_His') . '.xlsx');
    }

    public function exportAnggotaCsv(Request $request)
    {
        return $this->downloadCsv($this->headingAnggota(), $this->mapAnggota($this->anggotaQuery($request)->get()), 'laporan_anggota');
    }

    public function exportAnggotaPdf(Request $request)
    {
        $anggota = $this->anggotaQuery($request)->get();
        return Pdf::loadView('admin.laporan.pdf_anggota', compact('anggota'))
            ->setPaper('a4', 'landscape')
            ->download('laporan_anggota_' . now()->format('Ymd_His') . '.pdf');
    }

    public function exportKegiatanExcel(Request $request)
    {
        $kegiatan = $this->kegiatanQuery($request)->get();
        return Excel::download($this->collectionExport($this->mapKegiatan($kegiatan), $this->headingKegiatan()), 'laporan_kegiatan_' . now()->format('Ymd_His') . '.xlsx');
    }

    public function exportKegiatanCsv(Request $request)
    {
        return $this->downloadCsv($this->headingKegiatan(), $this->mapKegiatan($this->kegiatanQuery($request)->get()), 'laporan_kegiatan');
    }

    public function exportKegiatanPdf(Request $request)
    {
        $kegiatan = $this->kegiatanQuery($request)->get();
        return Pdf::loadView('admin.laporan.pdf_kegiatan', compact('kegiatan'))
            ->setPaper('a4', 'landscape')
            ->download('laporan_kegiatan_' . now()->format('Ymd_His') . '.pdf');
    }

    public function exportAbsensiExcel(Request $request)
    {
        $absensi = $this->absensiQuery($request)->get();
        return Excel::download($this->collectionExport($this->mapAbsensi($absensi), $this->headingAbsensi()), 'laporan_absensi_' . now()->format('Ymd_His') . '.xlsx');
    }

    public function exportAbsensiCsv(Request $request)
    {
        return $this->downloadCsv($this->headingAbsensi(), $this->mapAbsensi($this->absensiQuery($request)->get()), 'laporan_absensi');
    }

    public function exportAbsensiPdf(Request $request)
    {
        $absensi = $this->absensiQuery($request)->get();
        return Pdf::loadView('admin.laporan.pdf_absensi', compact('absensi'))
            ->setPaper('a4', 'landscape')
            ->download('laporan_absensi_' . now()->format('Ymd_His') . '.pdf');
    }

    private function anggotaQuery(Request $request)
    {
        return Anggota::with('user')
            ->when($request->pac, fn ($q, $pac) => $q->where('pac', $pac))
            ->when($request->search, function ($q, $search) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('nama_lengkap', 'like', "%{$search}%")
                        ->orWhere('nomor_anggota', 'like', "%{$search}%")
                        ->orWhere('kontak', 'like', "%{$search}%");
                });
            })
            ->orderBy('nama_lengkap');
    }

    private function kegiatanQuery(Request $request)
    {
        return Kegiatan::with(['kategori', 'pendaftarans.absensi'])
            ->when($request->status, fn ($q, $status) => $q->where('status', $status))
            ->when($request->start_date, fn ($q, $date) => $q->whereDate('tanggal', '>=', $date))
            ->when($request->end_date, fn ($q, $date) => $q->whereDate('tanggal', '<=', $date))
            ->orderByDesc('tanggal');
    }

    private function absensiQuery(Request $request)
    {
        return Absensi::with(['pendaftaran.anggota.user', 'pendaftaran.kegiatan.kategori'])
            ->when($request->id_kegiatan, fn ($q, $id) => $q->whereHas('pendaftaran', fn ($sub) => $sub->where('id_kegiatan', $id)))
            ->when($request->status_kehadiran !== null && $request->status_kehadiran !== '', fn ($q) => $q->where('hadir', request('status_kehadiran')))
            ->when($request->pac, fn ($q, $pac) => $q->whereHas('pendaftaran.anggota', fn ($sub) => $sub->where('pac', $pac)))
            ->orderByDesc('created_at');
    }

    private function headingAnggota(): array
    {
        return ['NOMOR ANGGOTA', 'NAMA LENGKAP', 'EMAIL', 'KONTAK', 'TEMPAT LAHIR', 'TANGGAL LAHIR', 'ALAMAT', 'PAC'];
    }

    private function mapAnggota($anggota)
    {
        return $anggota->map(fn ($item) => [
            $item->nomor_anggota,
            $item->nama_lengkap,
            $item->user->email ?? '-',
            $item->kontak ?? '-',
            $item->tempat_lahir ?? '-',
            optional($item->tgl_lahir)->format('Y-m-d') ?: $item->tgl_lahir,
            $item->alamat ?? '-',
            $item->pac ?? '-',
        ]);
    }

    private function headingKegiatan(): array
    {
        return ['JUDUL KEGIATAN', 'KATEGORI', 'TANGGAL', 'WAKTU', 'LOKASI', 'KUOTA', 'PENDAFTAR', 'HADIR', 'TIDAK HADIR', 'STATUS'];
    }

    private function mapKegiatan($kegiatan)
    {
        return $kegiatan->map(function ($item) {
            $hadir = $item->pendaftarans->filter(fn ($p) => $p->absensi && $p->absensi->hadir)->count();
            $tidakHadir = $item->pendaftarans->filter(fn ($p) => $p->absensi && ! $p->absensi->hadir)->count();
            return [
                $item->judul,
                $item->kategori->nama ?? '-',
                optional($item->tanggal)->format('Y-m-d') ?: $item->tanggal,
                $item->waktu ? Carbon::parse($item->waktu)->format('H:i') : '-',
                $item->lokasi ?? '-',
                $item->kuota ?: 'Tanpa Batas',
                $item->pendaftarans->count(),
                $hadir,
                $tidakHadir,
                $item->status,
            ];
        });
    }

    private function headingAbsensi(): array
    {
        return ['KEGIATAN', 'NAMA PESERTA', 'NOMOR ANGGOTA', 'PAC', 'KONTAK', 'STATUS KEHADIRAN', 'WAKTU HADIR', 'KETERANGAN'];
    }

    private function mapAbsensi($absensi)
    {
        return $absensi->map(function ($item) {
            $pendaftaran = $item->pendaftaran;
            $anggota = $pendaftaran?->anggota;
            return [
                $pendaftaran?->kegiatan?->judul ?? '-',
                $pendaftaran?->display_name ?? '-',
                $anggota?->nomor_anggota ?? '-',
                $anggota?->pac ?? '-',
                $pendaftaran?->display_contact ?? '-',
                $item->hadir ? 'Hadir' : 'Tidak Hadir',
                $item->waktu_hadir ? Carbon::parse($item->waktu_hadir)->format('Y-m-d H:i') : '-',
                $item->keterangan ?? '-',
            ];
        });
    }

    private function collectionExport($rows, array $headings)
    {
        return new class($rows, $headings) implements \Maatwebsite\Excel\Concerns\FromCollection, \Maatwebsite\Excel\Concerns\WithHeadings {
            public function __construct(private $rows, private array $headings) {}
            public function collection() { return collect($this->rows); }
            public function headings(): array { return $this->headings; }
        };
    }

    private function downloadCsv(array $headings, $rows, string $prefix)
    {
        $filename = $prefix . '_' . now()->format('Ymd_His') . '.csv';
        $handle = fopen('php://temp', 'w+');
        fputcsv($handle, $headings);
        foreach ($rows as $row) {
            fputcsv($handle, $row);
        }
        rewind($handle);
        $content = stream_get_contents($handle);
        fclose($handle);

        return response($content, 200)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }
}
