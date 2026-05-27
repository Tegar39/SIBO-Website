<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Absensi</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; color: #111827; }
        h1 { margin-bottom: 4px; }
        table { width: 100%; border-collapse: collapse; margin-top: 16px; }
        th, td { border: 1px solid #d1d5db; padding: 6px; vertical-align: top; }
        th { background: #ecfdf5; text-align: left; }
        .muted { color: #6b7280; font-size: 10px; }
    </style>
</head>
<body>
    <h1>Laporan Absensi Kegiatan</h1>
    <div class="muted">Dicetak pada {{ now()->format('d/m/Y H:i') }}</div>
    <table>
        <thead>
            <tr>
                <th>No</th><th>Kegiatan</th><th>Peserta</th><th>PAC</th><th>Status</th><th>Waktu</th><th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($absensi as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->pendaftaran->kegiatan->judul ?? '-' }}</td>
                    <td>{{ $item->pendaftaran->display_name ?? '-' }}<br><span class="muted">{{ $item->pendaftaran->anggota->nomor_anggota ?? 'Peserta Umum' }}</span></td>
                    <td>{{ $item->pendaftaran->anggota->pac ?? '-' }}</td>
                    <td>{{ $item->hadir ? 'Hadir' : 'Tidak Hadir' }}</td>
                    <td>{{ $item->waktu_hadir ? \Carbon\Carbon::parse($item->waktu_hadir)->format('d/m/Y H:i') : '-' }}</td>
                    <td>{{ $item->keterangan ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
