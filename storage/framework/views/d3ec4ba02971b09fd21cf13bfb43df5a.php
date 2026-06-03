<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Anggota - IPNU IPPNU Kab. Kediri</title>
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
        .watermark {
            position: fixed;
            bottom: 50%;
            right: 0;
            opacity: 0.1;
            font-size: 50px;
            transform: rotate(-45deg);
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>IPNU IPPNU Kab. Kediri</h1>
        <p>Laporan Data Anggota</p>
        <p>Tanggal Cetak: <?php echo e(\Carbon\Carbon::now()->translatedFormat('d F Y H:i:s')); ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor Anggota</th>
                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>Kontak</th>
                <th>PAC</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $anggota; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <tr>
                <td><?php echo e($key + 1); ?></td>
                <td><?php echo e($a->nomor_anggota); ?></td>
                <td><?php echo e($a->nama_lengkap); ?></td>
                <td><?php echo e($a->user->email ?? '-'); ?></td>
                <td><?php echo e($a->kontak); ?></td>
                <td><?php echo e($a->pac); ?></td>
                <td><?php echo e($a->status ?? 'Aktif'); ?></td>
            </tr>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </tbody>
    </table>

    <div class="footer">
        <p>Total Anggota: <?php echo e($anggota->count()); ?> orang</p>
        <p>&copy; <?php echo e(date('Y')); ?> SIBO - IPNU IPPNU Kab. Kediri</p>
    </div>
</body>
</html><?php /**PATH D:\laragon\www\Sibo\resources\views/admin/laporan/pdf_anggota.blade.php ENDPATH**/ ?>