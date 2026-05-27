<?php $__env->startSection('content'); ?>
<div class="pt-28 pb-12 bg-slate-50 min-h-screen font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-extrabold text-slate-800">Riwayat <span class="text-emerald-600">Kegiatan & Absensi</span></h1>
            <p class="text-slate-500 text-sm mt-1">Pantau status pendaftaran, kehadiran, dan sertifikat digital kamu.</p>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
            <div class="mb-6 bg-emerald-50 border border-emerald-100 text-emerald-700 px-5 py-4 rounded-2xl text-sm font-semibold"><?php echo e(session('success')); ?></div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('error')): ?>
            <div class="mb-6 bg-rose-50 border border-rose-100 text-rose-700 px-5 py-4 rounded-2xl text-sm font-semibold"><?php echo e(session('error')); ?></div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-slate-50 text-[10px] uppercase tracking-widest text-slate-500 font-black">
                        <tr>
                            <th class="px-6 py-4">Kegiatan</th>
                            <th class="px-6 py-4">Tanggal</th>
                            <th class="px-6 py-4">Pendaftaran</th>
                            <th class="px-6 py-4">Absensi</th>
                            <th class="px-6 py-4">Sertifikat</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $pendaftarans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pendaftaran): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-slate-800"><?php echo e($pendaftaran->kegiatan->judul ?? '-'); ?></div>
                                    <div class="text-xs text-slate-400">Peserta: <?php echo e($pendaftaran->display_name); ?></div>
                                </td>
                                <td class="px-6 py-4 text-slate-500"><?php echo e($pendaftaran->kegiatan?->tanggal ? \Carbon\Carbon::parse($pendaftaran->kegiatan->tanggal)->translatedFormat('d F Y') : '-'); ?></td>
                                <td class="px-6 py-4">
                                    <?php $status = $pendaftaran->status; ?>
                                    <span class="px-3 py-1 rounded-full text-xs font-black <?php echo e($status === 'disetujui' ? 'bg-emerald-100 text-emerald-700' : ($status === 'pending' ? 'bg-amber-100 text-amber-700' : 'bg-rose-100 text-rose-700')); ?>"><?php echo e(strtoupper($status)); ?></span>
                                </td>
                                <td class="px-6 py-4">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($pendaftaran->absensi): ?>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($pendaftaran->absensi->hadir): ?>
                                            <span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-xs font-black">HADIR</span>
                                            <div class="text-xs text-slate-400 mt-1"><?php echo e(\Carbon\Carbon::parse($pendaftaran->absensi->waktu_hadir)->format('d/m/Y H:i')); ?></div>
                                        <?php else: ?>
                                            <span class="bg-rose-100 text-rose-700 px-3 py-1 rounded-full text-xs font-black">TIDAK HADIR</span>
                                            <div class="text-xs text-slate-400 mt-1"><?php echo e($pendaftaran->absensi->keterangan ?? 'Tanpa keterangan'); ?></div>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php else: ?>
                                        <span class="bg-slate-100 text-slate-500 px-3 py-1 rounded-full text-xs font-black">BELUM DIABSEN</span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($pendaftaran->certificate): ?>
                                        <a href="<?php echo e(route('certificate.download', $pendaftaran->certificate->id)); ?>" class="inline-flex bg-slate-800 hover:bg-emerald-600 text-white px-4 py-2 rounded-xl text-xs font-bold transition">Download</a>
                                    <?php elseif($pendaftaran->absensi && $pendaftaran->absensi->hadir): ?>
                                        <span class="text-xs text-slate-400 font-bold">Sedang diproses</span>
                                    <?php else: ?>
                                        <span class="text-xs text-slate-400 font-bold">Belum tersedia</span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </td>
                            </tr>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            <tr><td colspan="5" class="px-6 py-16 text-center text-slate-400 font-bold">Belum ada riwayat kegiatan.</td></tr>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="p-6"><?php echo e($pendaftarans->links()); ?></div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Sibo\resources\views/anggota/riwayat.blade.php ENDPATH**/ ?>