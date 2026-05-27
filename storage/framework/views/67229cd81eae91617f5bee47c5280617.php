<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sertifikat Kegiatan</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 1.5cm;
        }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            background: white;
            margin: 0;
            padding: 0;
        }
        .certificate {
            border: 5px solid #047857;
            padding: 30px 40px;
            position: relative;
            background: #fff;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
        }
        .kementerian {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .polinema {
            font-size: 18px;
            font-weight: bold;
        }
        .title {
            font-size: 40px;
            font-weight: bold;
            color: #047857;
            margin: 20px 0;
            text-transform: uppercase;
        }
        .nomor {
            font-size: 14px;
            border: 1px solid #ccc;
            display: inline-block;
            padding: 6px 20px;
            background: #f5f5f5;
            margin-bottom: 20px;
        }
        .nama {
            font-size: 32px;
            font-weight: bold;
            margin: 30px 0 10px;
            text-transform: uppercase;
        }
        .sebagai {
            font-size: 14px;
            font-style: italic;
        }
        .kegiatan {
            font-size: 18px;
            font-weight: bold;
            margin: 20px 0;
        }
        .tanggal {
            font-size: 14px;
            margin: 20px 0;
        }
        .footer {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
            align-items: end;
        }
        .logo {
            width: 100px;
            height: auto;
        }
        .ttd {
            text-align: center;
            font-size: 12px;
        }
        .ttd p {
            margin: 5px 0;
        }
        .signature-line {
            margin-top: 30px;
            width: 200px;
            border-top: 1px solid #000;
            display: inline-block;
        }
        .clearfix {
            clear: both;
        }
    </style>
</head>
<body>
    <div class="certificate">
        <div class="header">
            <div class="kementerian">KEMENTERIAN PENDIDIKAN TINGGI, SAINS, DAN TEKNOLOGI</div>
            <div class="polinema">POLITEKNIK NEGERI MALANG</div>
            <div class="polinema" style="font-size:14px">PROGRAM STUDI DILUAR KAMPUS UTAMA KOTA KEDIRI</div>
            <div style="font-size:9px">Kampus 1: Jl. Mayor Bismo No.27, Kediri | Kampus 2: Jl. Lingkar Maskumambang, Kediri</div>
            <div style="font-size:9px">Telp (0354) 6023869 | www.polinema.ac.id</div>
        </div>

        <div class="title">SERTIFIKAT</div>

        <div class="nomor">NOMOR : <?php echo e($certificate_number); ?></div>

        <div class="nama"><?php echo e($nama_peserta); ?></div>
        <div class="sebagai">sebagai</div>
        <div class="sebagai" style="font-weight:bold; margin-bottom:20px">PESERTA</div>

        <div class="kegiatan">
            Kegiatan Anjangsana dengan tema<br>
            “<?php echo e($kegiatan->judul); ?>”<br>
            <?php echo e($kegiatan->deskripsi ?? ''); ?>

        </div>

        <div class="tanggal">
            pada tanggal <?php echo e(\Carbon\Carbon::parse($kegiatan->tanggal)->translatedFormat('d F Y')); ?>

        </div>

        <div class="footer">
            <div class="logo">
                <!-- Logo dari public/images/logo-desbor.png -->
                <img src="<?php echo e(public_path('images/logo-desbor.png')); ?>" width="100">
            </div>
            <div class="ttd">
                <p>Kediri, <?php echo e(\Carbon\Carbon::now()->translatedFormat('d F Y')); ?></p>
                <p>Koordinator Pengelola Kampus Kediri</p>
                <div class="signature-line"></div>
                <p><strong>Drs. Mohamad Arief Setiawan, M.Kom.</strong></p>
                <p>NIP 196611181993031001</p>
            </div>
        </div>
    </div>
</body>
</html><?php /**PATH D:\laragon\www\Sibo\resources\views/certificates/template.blade.php ENDPATH**/ ?>