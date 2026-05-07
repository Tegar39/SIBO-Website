<?php

namespace App\Exports;

use App\Models\Pendaftaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PesertaKegiatanExport implements FromCollection, WithHeadings, WithMapping
{
    protected $id_kegiatan;

    public function __construct($id_kegiatan)
    {
        $this->id_kegiatan = $id_kegiatan;
    }

    public function collection()
    {
        return Pendaftaran::with(['anggota', 'absensi'])
            ->where('id_kegiatan', $this->id_kegiatan)
            ->where('status', 'disetujui')
            ->get();
    }

    public function headings(): array
    {
        return ['No', 'Nama Peserta', 'Kontak', 'Status Hadir', 'Waktu Absen', 'Keterangan'];
    }

    public function map($row): array
    {
        static $i = 1;
        return [
            $i++,
            $row->display_name,
            $row->display_contact,
            $row->absensi && $row->absensi->hadir ? 'Hadir' : 'Tidak Hadir',
            $row->absensi && $row->absensi->waktu_hadir ? \Carbon\Carbon::parse($row->absensi->waktu_hadir)->format('d/m/Y H:i') : '-',
            $row->absensi->keterangan ?? '-',
        ];
    }
}