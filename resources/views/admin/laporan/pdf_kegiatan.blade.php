<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Kegiatan - IPNU IPPNU Kab. Kediri</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #059669;
            padding-bottom: 10px;
        }
        .header h1 {
            color: #059669;
            margin: 0;
            font-size: 24px;
        }
        .header p {
            margin: 5px 0;
            color: #64748b;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #059669;
            color: white;
            font-size: 11px;
        }
        td {
            font-size: 10px;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 10px;
            color: #64748b;
        }
        .status-aktif { color: green; font-weight: bold; }
        .status-selesai { color: blue; }
        .status-tutup { color: orange; }
        .status-batal { color: red; }
    </style>
</head>
<body>
    <div class="header">
        <h1>IPNU IPPNU Kab. Kediri</h1>
        <p>Laporan Data Kegiatan</p>
        <p>Tanggal Cetak: {{ \Carbon\Carbon::now()->translatedFormat('d F Y H:i:s') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Kegiatan</th>
                <th>Kategori</th>
                <th>Tanggal</th>
                <th>Lokasi</th>
                <th>Peserta</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kegiatan as $key => $k)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $k->judul }}</td>
                <td>{{ $k->kategori->nama ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($k->tanggal)->format('d/m/Y') }}</td>
                <td>{{ $k->lokasi ?? '-' }}</td>
                <td>{{ $k->pendaftarans->count() }}</td>
                <td>
                    @if($k->status == 'aktif') <span class="status-aktif">Aktif</span>
                    @elseif($k->status == 'selesai') <span class="status-selesai">Selesai</span>
                    @elseif($k->status == 'tutup') <span class="status-tutup">Ditutup</span>
                    @else <span class="status-batal">Batal</span> @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Total Kegiatan: {{ $kegiatan->count() }} kegiatan</p>
        <p>&copy; {{ date('Y') }} SIBO - IPNU IPPNU Kab. Kediri</p>
    </div>
</body>
</html>