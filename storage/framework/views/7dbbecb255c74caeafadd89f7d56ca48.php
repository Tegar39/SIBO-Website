<?php $__env->startSection('content'); ?>
<div class="pt-20 pb-12 bg-slate-50 min-h-screen font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-6 flex items-center justify-between">
            <div>
                <a href="<?php echo e(route('admin.laporan.index')); ?>" class="text-sm text-emerald-600 hover:underline mb-2 inline-block">← Kembali</a>
                <h1 class="text-2xl font-bold text-slate-800">Laporan Data Anggota</h1>
            </div>
            <div class="flex gap-2">
                <a href="<?php echo e(route('admin.laporan.anggota.export.excel', request()->all())); ?>" class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm">Export Excel</a>
                <a href="<?php echo e(route('admin.laporan.anggota.export.csv', request()->all())); ?>" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">Export CSV</a>
                <a href="<?php echo e(route('admin.laporan.anggota.export.pdf', request()->all())); ?>" class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm">Export PDF</a>
            </div>
        </div>

        
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6 mb-8">
            <form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4 items-end">
                <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Cari nama/nomor/kontak..." class="rounded-2xl border-slate-200 text-sm">
                <select name="pac" class="rounded-2xl border-slate-200 text-sm">
                    <option value="">Semua PAC</option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = ($pacList ?? []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pac): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <option value="<?php echo e($pac); ?>" <?php if(request('pac') == $pac): echo 'selected'; endif; ?>><?php echo e($pac); ?></option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </select>
                <select name="bulan" class="rounded-2xl border-slate-200 text-sm">
                    <option value="">Semua Bulan</option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = range(1,12); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <option value="<?php echo e($b); ?>" <?php if((string)request('bulan') === (string)$b): echo 'selected'; endif; ?>><?php echo e(\Carbon\Carbon::create()->month($b)->translatedFormat('F')); ?></option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </select>
                <input type="number" name="tahun" value="<?php echo e(request('tahun', now()->year)); ?>" placeholder="Tahun" class="rounded-2xl border-slate-200 text-sm">
                <button class="bg-slate-900 hover:bg-emerald-600 text-white rounded-2xl py-3 text-xs font-black uppercase tracking-widest">Filter</button>
            </form>
        </div>

        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-bold text-slate-500">No</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-slate-500">Nomor Anggota</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-slate-500">Nama Lengkap</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-slate-500">Email</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-slate-500">Kontak</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-slate-500">PAC</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $anggota; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <tr class="hover:bg-slate-50">
                            <td class="px-4 py-3 text-sm"><?php echo e($key + 1); ?></td>
                            <td class="px-4 py-3 text-sm font-mono"><?php echo e($a->nomor_anggota); ?></td>
                            <td class="px-4 py-3 text-sm font-medium"><?php echo e($a->nama_lengkap); ?></td>
                            <td class="px-4 py-3 text-sm"><?php echo e($a->user->email ?? '-'); ?></td>
                            <td class="px-4 py-3 text-sm"><?php echo e($a->kontak); ?></td>
                            <td class="px-4 py-3 text-sm"><?php echo e($a->pac); ?></td>
                        </tr>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Sibo\resources\views/admin/laporan/anggota.blade.php ENDPATH**/ ?>