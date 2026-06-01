<?php $__env->startSection('content'); ?>
<div class="pt-28 pb-12 bg-slate-50 min-h-screen font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-6 flex items-center justify-between">
            <div>
                <a href="<?php echo e(route('admin.laporan.index')); ?>" class="text-sm text-emerald-600 hover:underline mb-2 inline-block">← Kembali</a>
                <h1 class="text-2xl font-bold text-slate-800">Laporan Data Kegiatan</h1>
            </div>
            <div class="flex gap-2">
                <a href="<?php echo e(route('admin.laporan.kegiatan.export.excel', request()->all())); ?>" class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm">Export Excel</a>
                <a href="<?php echo e(route('admin.laporan.kegiatan.export.pdf', request()->all())); ?>" class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm">Export PDF</a>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-bold text-slate-500">No</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-slate-500">Judul Kegiatan</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-slate-500">Kategori</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-slate-500">Tanggal</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-slate-500">Lokasi</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-slate-500">Peserta</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-slate-500">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $kegiatan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <tr class="hover:bg-slate-50">
                            <td class="px-4 py-3 text-sm"><?php echo e($key + 1); ?></td>
                            <td class="px-4 py-3 text-sm font-medium"><?php echo e($k->judul); ?></td>
                            <td class="px-4 py-3 text-sm"><?php echo e($k->kategori->nama ?? '-'); ?></td>
                            <td class="px-4 py-3 text-sm"><?php echo e(\Carbon\Carbon::parse($k->tanggal)->format('d M Y')); ?></td>
                            <td class="px-4 py-3 text-sm"><?php echo e($k->lokasi ?? '-'); ?></td>
                            <td class="px-4 py-3 text-sm"><?php echo e($k->pendaftarans->count()); ?></td>
                            <td class="px-4 py-3 text-sm">
                                <span class="px-2 py-1 rounded text-xs font-bold
                                    <?php if($k->status == 'aktif'): ?> bg-green-100 text-green-700
                                    <?php elseif($k->status == 'tutup'): ?> bg-orange-100 text-orange-700
                                    <?php elseif($k->status == 'selesai'): ?> bg-slate-100 text-slate-500
                                    <?php else: ?> bg-rose-100 text-rose-600 <?php endif; ?>">
                                    <?php echo e($k->status); ?>

                                </span>
                            </td>
                        </tr>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Sibo\resources\views/admin/laporan/kegiatan.blade.php ENDPATH**/ ?>