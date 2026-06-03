<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Sertifikat {{ $certificate_number ?? '-' }}</title>
    <style>
        @page { size: A4 landscape; margin: 0; }

        * { box-sizing: border-box; }

        html, body {
            width: 297mm;
            height: 210mm;
            margin: 0;
            padding: 0;
            font-family: DejaVu Serif, serif;
            color: #0f172a;
            background: #ffffff;
        }

        .page {
            position: relative;
            width: 297mm;
            height: 210mm;
            overflow: hidden;
            background: #f8fafc;
        }

        .blue-band-left {
            position: absolute;
            left: 0;
            top: 0;
            width: 47mm;
            height: 210mm;
            background: #0f172a;
        }

        .blue-band-bottom {
            position: absolute;
            left: 0;
            bottom: 0;
            width: 297mm;
            height: 23mm;
            background: #0f172a;
        }

        .pattern-left-a,
        .pattern-left-b,
        .pattern-bottom-a {
            position: absolute;
            border: 1px solid rgba(255,255,255,.10);
            border-radius: 50%;
        }

        .pattern-left-a {
            width: 75mm;
            height: 75mm;
            left: -30mm;
            top: 20mm;
        }

        .pattern-left-b {
            width: 115mm;
            height: 115mm;
            left: -64mm;
            top: 65mm;
        }

        .pattern-bottom-a {
            width: 180mm;
            height: 180mm;
            left: 42mm;
            bottom: -130mm;
        }

        .gold-border {
            position: absolute;
            left: 8mm;
            top: 8mm;
            right: 8mm;
            bottom: 17mm;
            border: 2px solid #f59e0b;
        }

        .white-panel {
            position: absolute;
            left: 39mm;
            top: 8mm;
            right: 8mm;
            bottom: 17mm;
            background: #ffffff;
            border-left: 1px solid #d1fae5;
            overflow: hidden;
        }

        .soft-pattern {
            position: absolute;
            left: 39mm;
            top: 8mm;
            right: 8mm;
            bottom: 17mm;
            opacity: .30;
            background-image:
                radial-gradient(circle at 10px 10px, #bbf7d0 1.1px, transparent 1.2px),
                radial-gradient(circle at 26px 26px, #d1fae5 1.1px, transparent 1.2px);
            background-size: 18px 18px;
        }

        .diagonal-white {
            position: absolute;
            left: 32mm;
            top: -4mm;
            width: 19mm;
            height: 75mm;
            background: #ffffff;
            transform: rotate(39deg);
            border-right: 3px solid #f59e0b;
        }

        .gold-ribbon {
            position: absolute;
            left: 21mm;
            top: 40mm;
            width: 27mm;
            height: 27mm;
            border: 5px solid #f59e0b;
            transform: rotate(45deg);
            background: transparent;
        }

        .gold-ribbon.second {
            top: 76mm;
        }

        .logo-wrap {
            position: absolute;
            right: 18mm;
            top: 15mm;
            width: 45mm;
            height: 22mm;
            text-align: right;
        }

        .logo {
            max-height: 19mm;
            max-width: 40mm;
            object-fit: contain;
        }

        .content {
            position: absolute;
            left: 62mm;
            top: 17mm;
            width: 197mm;
            height: 157mm;
            text-align: center;
        }

        .main-title {
            margin: 0;
            font-size: 35pt;
            line-height: 1;
            letter-spacing: 8px;
            color: #059669;
            text-transform: uppercase;
            font-weight: 700;
        }

        .main-subtitle {
            margin-top: 8mm;
            font-size: 22pt;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #0f172a;
            font-weight: 700;
        }

        .certificate-number {
            margin-top: 3mm;
            font-size: 10pt;
            color: #475569;
            font-family: DejaVu Sans, sans-serif;
            letter-spacing: .4px;
        }

        .given {
            margin-top: 11mm;
            font-size: 14pt;
            color: #475569;
        }

        .recipient {
            margin: 5mm auto 0 auto;
            width: 155mm;
            padding-bottom: 3mm;
            border-bottom: 2px solid #f59e0b;
            font-size: 25pt;
            line-height: 1.1;
            color: #0f172a;
            font-style: italic;
            font-weight: 700;
            text-transform: uppercase;
        }

        .role-line {
            margin-top: 4mm;
            font-size: 12pt;
            color: #475569;
        }

        .role-line strong {
            font-family: DejaVu Sans, sans-serif;
            color: #059669;
            letter-spacing: 2px;
            text-transform: uppercase;
            font-size: 13pt;
        }

        .activity-text {
            margin: 8mm auto 0 auto;
            width: 168mm;
            font-size: 13pt;
            line-height: 1.45;
            color: #0f172a;
        }

        .activity-title {
            display: block;
            margin: 2mm 0 1.5mm 0;
            font-size: 17pt;
            font-weight: 700;
            color: #059669;
        }

        .activity-desc {
            display: block;
            font-family: DejaVu Sans, sans-serif;
            font-size: 10pt;
            color: #64748b;
            line-height: 1.35;
        }

        .date-line {
            margin-top: 4mm;
            font-family: DejaVu Sans, sans-serif;
            font-size: 11pt;
            color: #0f172a;
        }

        .validation {
            position: absolute;
            left: 84mm;
            bottom: 21mm;
            width: 152mm;
            padding: 4mm 7mm;
            border: 1px solid #10b981;
            background: rgba(236, 253, 245, .86);
            text-align: center;
            font-family: DejaVu Sans, sans-serif;
        }

        .validation-title {
            margin-bottom: 1.5mm;
            color: #059669;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            font-size: 9pt;
        }

        .validation-text {
            margin: 0;
            color: #475569;
            font-size: 8.4pt;
            line-height: 1.35;
        }

        .issued {
            position: absolute;
            left: 84mm;
            right: 35mm;
            bottom: 8mm;
            text-align: center;
            font-family: DejaVu Sans, sans-serif;
            font-size: 9pt;
            color: #475569;
        }

        .seal {
            position: absolute;
            left: 8mm;
            bottom: 8mm;
            width: 35mm;
            height: 35mm;
            border-radius: 50%;
            background: #059669;
            border: 4px solid #f59e0b;
            color: #ffffff;
            text-align: center;
            font-family: DejaVu Sans, sans-serif;
            padding-top: 8mm;
            font-size: 7pt;
            line-height: 1.3;
            text-transform: uppercase;
            font-weight: 700;
        }

        .bottom-note {
            position: absolute;
            right: 10mm;
            bottom: 5.5mm;
            color: rgba(255,255,255,.88);
            font-family: DejaVu Sans, sans-serif;
            font-size: 7.2pt;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
    </style>
</head>
<body>
@php
    $tanggalKegiatan = $kegiatan?->tanggal
        ? \Carbon\Carbon::parse($kegiatan->tanggal)->translatedFormat('d F Y')
        : '-';

    $tanggalTerbit = \Carbon\Carbon::now()->translatedFormat('d F Y');
    $deskripsi = trim(strip_tags((string) ($kegiatan->deskripsi ?? '')));
    $deskripsi = \Illuminate\Support\Str::limit($deskripsi, 100);
    $logoPath = public_path('images/logo-sibo.png');
    if (! file_exists($logoPath)) {
        $logoPath = public_path('images/logo-desbor.png');
    }

    $logoData = null;
    if (file_exists($logoPath)) {
        $extension = strtolower(pathinfo($logoPath, PATHINFO_EXTENSION));
        $mime = match ($extension) {
            'jpg', 'jpeg' => 'image/jpeg',
            'svg' => 'image/svg+xml',
            default => 'image/png',
        };
        $logoData = 'data:' . $mime . ';base64,' . base64_encode(file_get_contents($logoPath));
    }
@endphp

<div class="page">
    <div class="blue-band-left"></div>
    <div class="blue-band-bottom"></div>
    <div class="pattern-left-a"></div>
    <div class="pattern-left-b"></div>
    <div class="pattern-bottom-a"></div>
    <div class="white-panel"></div>
    <div class="soft-pattern"></div>
    <div class="gold-border"></div>
    <div class="diagonal-white"></div>
    <div class="gold-ribbon"></div>
    <div class="gold-ribbon second"></div>

    <div class="logo-wrap">
        @if($logoData)
            <img class="logo" src="{{ $logoData }}" alt="Logo SIBO">
        @else
            <strong>SIBO</strong>
        @endif
    </div>

    <div class="content">
        <h1 class="main-title">Sertifikat</h1>
        <div class="main-subtitle">Penghargaan Partisipasi</div>
        <div class="certificate-number">NO : {{ $certificate_number ?? '-' }}</div>

        <div class="given">Diberikan kepada :</div>
        <div class="recipient">{{ $nama_peserta ?? 'Nama Peserta' }}</div>

        <div class="role-line">sebagai <strong>Peserta</strong></div>

        <div class="activity-text">
            Atas partisipasinya dalam kegiatan
            <span class="activity-title">{{ $kegiatan->judul ?? 'Nama Kegiatan' }}</span>
            @if($deskripsi !== '')
                <span class="activity-desc">{{ $deskripsi }}</span>
            @endif
        </div>

        <div class="date-line">Tanggal kegiatan : <strong>{{ $tanggalKegiatan }}</strong></div>
    </div>

    <div class="validation">
        <div class="validation-title">Validasi Sertifikat Digital</div>
        <p class="validation-text">
            Sertifikat ini diterbitkan otomatis oleh Sistem Informasi Seni, Budaya, dan Olahraga (SIBO).
            Nomor sertifikat digunakan sebagai kode validasi dokumen digital dan bukti keikutsertaan kegiatan.
        </p>
    </div>

    <div class="issued">
        Kediri, {{ $tanggalTerbit }} &nbsp; | &nbsp; Diterbitkan oleh Sistem SIBO
    </div>

    <div class="seal">
        Sistem<br>Informasi<br>SIBO
    </div>

    <div class="bottom-note">
        Terdokumentasi - Terverifikasi - Digital
    </div>
</div>
</body>
</html>