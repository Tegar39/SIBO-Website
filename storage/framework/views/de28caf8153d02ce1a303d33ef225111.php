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
    <div class="muted">Dicetak pada <?php echo e(now()->format('d/m/Y H:i')); ?></div>
    <table>
        <thead>
            <tr>
                <th>No</th><th>Kegiatan</th><th>Peserta</th><th>PAC</th><th>Status</th><th>Waktu</th><th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $absensi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <tr>
                    <td><?php echo e($index + 1); ?></td>
                    <td><?php echo e($item->pendaftaran->kegiatan->judul ?? '-'); ?></td>
                    <td><?php echo e($item->pendaftaran->display_name ?? '-'); ?><br><span class="muted"><?php echo e($item->pendaftaran->anggota->nomor_anggota ?? 'Peserta Umum'); ?></span></td>
                    <td><?php echo e($item->pendaftaran->anggota->pac ?? '-'); ?></td>
                    <td><?php echo e($item->hadir ? 'Hadir' : 'Tidak Hadir'); ?></td>
                    <td><?php echo e($item->waktu_hadir ? \Carbon\Carbon::parse($item->waktu_hadir)->format('d/m/Y H:i') : '-'); ?></td>
                    <td><?php echo e($item->keterangan ?? '-'); ?></td>
                </tr>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </tbody>
    </table>
</body>
</html>
<?php /**PATH D:\laragon\www\Sibo\resources\views/admin/laporan/pdf_absensi.blade.php ENDPATH**/ ?>