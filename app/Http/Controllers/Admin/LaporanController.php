<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Kegiatan;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use Excel;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index()
    {
        $totalAnggota = Anggota::count();
        $totalKegiatan = Kegiatan::count();
        $totalPendaftar = Pendaftaran::count();
        $anggotaByPac = Anggota::select('pac', DB::raw('count(*) as total'))
            ->groupBy('pac')
            ->get();
        $kegiatanByStatus = Kegiatan::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();

        return view('admin.laporan.index', compact(
            'totalAnggota', 'totalKegiatan', 'totalPendaftar',
            'anggotaByPac', 'kegiatanByStatus'
        ));
    }

    public function anggota(Request $request)
    {
        $query = Anggota::with('user');
        
        if ($request->pac) {
            $query->where('pac', $request->pac);
        }
        
        if ($request->search) {
            $query->where('nama_lengkap', 'like', "%{$request->search}%")
                  ->orWhere('nomor_anggota', 'like', "%{$request->search}%");
        }
        
        $anggota = $query->get();
        
        return view('admin.laporan.anggota', compact('anggota'));
    }

    public function kegiatan(Request $request)
    {
        $query = Kegiatan::with('kategori', 'pendaftarans');
        
        if ($request->status) {
            $query->where('status', $request->status);
        }
        
        if ($request->start_date) {
            $query->whereDate('tanggal', '>=', $request->start_date);
        }
        
        if ($request->end_date) {
            $query->whereDate('tanggal', '<=', $request->end_date);
        }
        
        $kegiatan = $query->get();
        
        return view('admin.laporan.kegiatan', compact('kegiatan'));
    }

    // Export Anggota ke Excel
    public function exportAnggotaExcel(Request $request)
    {
        $query = Anggota::with('user');
        
        if ($request->pac) {
            $query->where('pac', $request->pac);
        }
        
        $anggota = $query->get();
        
        return Excel::download(new class($anggota) implements \Maatwebsite\Excel\Concerns\FromCollection, \Maatwebsite\Excel\Concerns\WithHeadings {
            private $data;
            
            public function __construct($data)
            {
                $this->data = $data;
            }
            
            public function collection()
            {
                return $this->data->map(function($item) {
                    return [
                        'NOMOR ANGGOTA' => $item->nomor_anggota,
                        'NAMA LENGKAP' => $item->nama_lengkap,
                        'EMAIL' => $item->user->email ?? '-',
                        'KONTAK' => $item->kontak,
                        'TEMPAT LAHIR' => $item->tempat_lahir,
                        'TANGGAL LAHIR' => $item->tgl_lahir,
                        'ALAMAT' => $item->alamat,
                        'PAC' => $item->pac,
                        'STATUS' => $item->status ?? 'Aktif',
                    ];
                });
            }
            
            public function headings(): array
            {
                return [
                    'NOMOR ANGGOTA', 'NAMA LENGKAP', 'EMAIL', 'KONTAK', 
                    'TEMPAT LAHIR', 'TANGGAL LAHIR', 'ALAMAT', 'PAC', 'STATUS'
                ];
            }
        }, 'laporan_anggota_' . Carbon::now()->format('Ymd_His') . '.xlsx');
    }

    // Export Anggota ke CSV
    public function exportAnggotaCsv(Request $request)
    {
        $query = Anggota::with('user');
        
        if ($request->pac) {
            $query->where('pac', $request->pac);
        }
        
        $anggota = $query->get();
        
        $csvData = [];
        $csvData[] = ['NOMOR ANGGOTA', 'NAMA LENGKAP', 'EMAIL', 'KONTAK', 'TEMPAT LAHIR', 'TANGGAL LAHIR', 'ALAMAT', 'PAC', 'STATUS'];
        
        foreach ($anggota as $item) {
            $csvData[] = [
                $item->nomor_anggota,
                $item->nama_lengkap,
                $item->user->email ?? '-',
                $item->kontak,
                $item->tempat_lahir,
                $item->tgl_lahir,
                $item->alamat,
                $item->pac,
                $item->status ?? 'Aktif',
            ];
        }
        
        $filename = 'laporan_anggota_' . Carbon::now()->format('Ymd_His') . '.csv';
        $handle = fopen('php://temp', 'w');
        foreach ($csvData as $row) {
            fputcsv($handle, $row);
        }
        rewind($handle);
        $content = stream_get_contents($handle);
        fclose($handle);
        
        return response($content, 200)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }

    // Export Anggota ke PDF
    public function exportAnggotaPdf(Request $request)
    {
        $query = Anggota::with('user');
        
        if ($request->pac) {
            $query->where('pac', $request->pac);
        }
        
        $anggota = $query->get();
        
        $pdf = PDF::loadView('admin.laporan.pdf_anggota', compact('anggota'));
        $pdf->setPaper('a4', 'landscape');
        
        return $pdf->download('laporan_anggota_' . Carbon::now()->format('Ymd_His') . '.pdf');
    }

    // Export Kegiatan ke Excel
    public function exportKegiatanExcel(Request $request)
    {
        $query = Kegiatan::with('kategori', 'pendaftarans');
        
        if ($request->status) {
            $query->where('status', $request->status);
        }
        
        if ($request->start_date) {
            $query->whereDate('tanggal', '>=', $request->start_date);
        }
        
        if ($request->end_date) {
            $query->whereDate('tanggal', '<=', $request->end_date);
        }
        
        $kegiatan = $query->get();
        
        return Excel::download(new class($kegiatan) implements \Maatwebsite\Excel\Concerns\FromCollection, \Maatwebsite\Excel\Concerns\WithHeadings {
            private $data;
            
            public function __construct($data)
            {
                $this->data = $data;
            }
            
            public function collection()
            {
                return $this->data->map(function($item) {
                    return [
                        'JUDUL KEGIATAN' => $item->judul,
                        'KATEGORI' => $item->kategori->nama ?? '-',
                        'TANGGAL' => $item->tanggal,
                        'WAKTU' => $item->waktu,
                        'LOKASI' => $item->lokasi,
                        'KUOTA' => $item->kuota ?? 'Tanpa Batas',
                        'JUMLAH PESERTA' => $item->pendaftarans->count(),
                        'STATUS' => $item->status,
                    ];
                });
            }
            
            public function headings(): array
            {
                return ['JUDUL KEGIATAN', 'KATEGORI', 'TANGGAL', 'WAKTU', 'LOKASI', 'KUOTA', 'JUMLAH PESERTA', 'STATUS'];
            }
        }, 'laporan_kegiatan_' . Carbon::now()->format('Ymd_His') . '.xlsx');
    }

    // Export Kegiatan ke PDF
    public function exportKegiatanPdf(Request $request)
    {
        $query = Kegiatan::with('kategori', 'pendaftarans');
        
        if ($request->status) {
            $query->where('status', $request->status);
        }
        
        if ($request->start_date) {
            $query->whereDate('tanggal', '>=', $request->start_date);
        }
        
        if ($request->end_date) {
            $query->whereDate('tanggal', '<=', $request->end_date);
        }
        
        $kegiatan = $query->get();
        
        $pdf = PDF::loadView('admin.laporan.pdf_kegiatan', compact('kegiatan'));
        $pdf->setPaper('a4', 'landscape');
        
        return $pdf->download('laporan_kegiatan_' . Carbon::now()->format('Ymd_His') . '.pdf');
    }
}