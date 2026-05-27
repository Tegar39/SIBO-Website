<?php $__env->startSection('content'); ?>
<div class="pt-28 pb-12 bg-slate-50 min-h-screen font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8 flex flex-col md:flex-row md:items-end md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-800">Laporan <span class="text-emerald-600">Absensi</span></h1>
                <p class="text-slate-500 text-sm mt-1">Rekap kehadiran anggota berdasarkan kegiatan dan PAC.</p>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="<?php echo e(route('admin.laporan.absensi.export.excel', request()->query())); ?>" class="bg-green-600 text-white px-4 py-2 rounded-xl text-xs font-bold">Excel</a>
                <a href="<?php echo e(route('admin.laporan.absensi.export.csv', request()->query())); ?>" class="bg-blue-600 text-white px-4 py-2 rounded-xl text-xs font-bold">CSV</a>
                <a href="<?php echo e(route('admin.laporan.absensi.export.pdf', request()->query())); ?>" class="bg-red-600 text-white px-4 py-2 rounded-xl text-xs font-bold">PDF</a>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6 mb-8">
            <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <select name="id_kegiatan" class="rounded-2xl border-slate-200 text-sm">
                    <option value="">Semua Kegiatan</option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $kegiatans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kegiatan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <option value="<?php echo e($kegiatan->id_kegiatan); ?>" <?php if(request('id_kegiatan') == $kegiatan->id_kegiatan): echo 'selected'; endif; ?>><?php echo e($kegiatan->judul); ?></option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </select>
                <select name="status_kehadiran" class="rounded-2xl border-slate-200 text-sm">
                    <option value="">Semua Status</option>
                    <option value="1" <?php if(request('status_kehadiran') === '1'): echo 'selected'; endif; ?>>Hadir</option>
                    <option value="0" <?php if(request('status_kehadiran') === '0'): echo 'selected'; endif; ?>>Tidak Hadir</option>
                </select>
                <input type="text" name="pac" value="<?php echo e(request('pac')); ?>" placeholder="Filter PAC" class="rounded-2xl border-slate-200 text-sm">
                <button class="bg-slate-800 hover:bg-emerald-600 text-white rounded-2xl text-xs font-black uppercase tracking-widest">Terapkan</button>
            </form>
        </div>

        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-slate-50 text-[10px] uppercase tracking-widest text-slate-500 font-black">
                        <tr>
                            <th class="px-6 py-4">Kegiatan</th>
                            <th class="px-6 py-4">Peserta</th>
                            <th class="px-6 py-4">PAC</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Waktu</th>
                            <th class="px-6 py-4">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $absensi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-4 font-bold text-slate-800"><?php echo e($item->pendaftaran->kegiatan->judul ?? '-'); ?></td>
                                <td class="px-6 py-4"><?php echo e($item->pendaftaran->display_name ?? '-'); ?><div class="text-xs text-slate-400"><?php echo e($item->pendaftaran->anggota->nomor_anggota ?? 'Peserta Umum'); ?></div></td>
                                <td class="px-6 py-4"><?php echo e($item->pendaftaran->anggota->pac ?? '-'); ?></td>
                                <td class="px-6 py-4"><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->hadir): ?><span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-xs font-black">HADIR</span><?php else: ?><span class="bg-rose-100 text-rose-700 px-3 py-1 rounded-full text-xs font-black">TIDAK HADIR</span><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></td>
                                <td class="px-6 py-4 text-slate-500"><?php echo e($item->waktu_hadir ? \Carbon\Carbon::parse($item->waktu_hadir)->format('d/m/Y H:i') : '-'); ?></td>
                                <td class="px-6 py-4 text-slate-500"><?php echo e($item->keterangan ?? '-'); ?></td>
                            </tr>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            <tr><td colspan="6" class="px-6 py-14 text-center text-slate-400 font-bold">Belum ada data absensi.</td></tr>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="p-6"><?php echo e($absensi->links()); ?></div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Sibo\resources\views/admin/laporan/absensi.blade.php ENDPATH**/ ?>