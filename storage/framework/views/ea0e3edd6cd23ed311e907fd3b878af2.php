<?php $__env->startSection('content'); ?>
<div class="pt-28 pb-12 bg-slate-50 min-h-screen font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-10">
            <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">
                Laporan <span class="text-emerald-600">Data</span>
            </h1>
            <p class="text-slate-500 text-sm mt-1">Export data anggota dan kegiatan ke berbagai format</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="px-6 py-5 bg-gradient-to-r from-emerald-600 to-emerald-500">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-white font-bold text-lg">Laporan Anggota</h2>
                            <p class="text-emerald-100 text-xs">Total: <?php echo e($totalAnggota); ?> Anggota</p>
                        </div>
                    </div>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex flex-wrap gap-3">
                        <a href="<?php echo e(route('admin.laporan.anggota')); ?>" class="flex-1 text-center bg-slate-800 hover:bg-emerald-600 text-white px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition-all">
                            Lihat Detail
                        </a>
                    </div>
                    <div class="border-t pt-4">
                        <p class="text-xs font-semibold text-slate-500 mb-3">Ekspor ke:</p>
                        <div class="flex flex-wrap gap-2">
                            <a href="<?php echo e(route('admin.laporan.anggota.export.excel')); ?>" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-xs font-bold flex items-center gap-2 transition">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6z"/><path d="M14 2v6h6"/><path d="M12 18v-4M8 18v-4M16 18v-4"/></svg>
                                Excel
                            </a>
                            <a href="<?php echo e(route('admin.laporan.anggota.export.csv')); ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-xs font-bold flex items-center gap-2 transition">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6z"/><path d="M14 2v6h6"/></svg>
                                CSV
                            </a>
                            <a href="<?php echo e(route('admin.laporan.anggota.export.pdf')); ?>" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-xs font-bold flex items-center gap-2 transition">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M4 4h16v16H4z"/><path d="M8 8h8M8 12h6M8 16h4"/></svg>
                                PDF
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="px-6 py-5 bg-gradient-to-r from-slate-800 to-slate-700">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-white font-bold text-lg">Laporan Kegiatan</h2>
                            <p class="text-slate-300 text-xs">Total: <?php echo e($totalKegiatan); ?> Kegiatan</p>
                        </div>
                    </div>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex flex-wrap gap-3">
                        <a href="<?php echo e(route('admin.laporan.kegiatan')); ?>" class="flex-1 text-center bg-slate-800 hover:bg-emerald-600 text-white px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition-all">
                            Lihat Detail
                        </a>
                    </div>
                    <div class="border-t pt-4">
                        <p class="text-xs font-semibold text-slate-500 mb-3">Ekspor ke:</p>
                        <div class="flex flex-wrap gap-2">
                            <a href="<?php echo e(route('admin.laporan.kegiatan.export.excel')); ?>" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-xs font-bold flex items-center gap-2 transition">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6z"/><path d="M14 2v6h6"/><path d="M12 18v-4M8 18v-4M16 18v-4"/></svg>
                                Excel
                            </a>
                            <a href="<?php echo e(route('admin.laporan.kegiatan.export.pdf')); ?>" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-xs font-bold flex items-center gap-2 transition">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M4 4h16v16H4z"/><path d="M8 8h8M8 12h6M8 16h4"/></svg>
                                PDF
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-6">
                <h3 class="font-bold text-slate-800 mb-4">📊 Anggota per PAC</h3>
                <div class="space-y-3">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $anggotaByPac; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pac): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-semibold text-slate-600"><?php echo e($pac->pac ?? 'Tidak Terdaftar'); ?></span>
                        <span class="text-sm font-bold text-emerald-600"><?php echo e($pac->total); ?> Anggota</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2">
                        <div class="bg-emerald-500 h-2 rounded-full" style="width: <?php echo e(($pac->total / max($totalAnggota, 1)) * 100); ?>%"></div>
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-6">
                <h3 class="font-bold text-slate-800 mb-4">📋 Status Kegiatan</h3>
                <div class="space-y-3">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $kegiatanByStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-semibold text-slate-600">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($status->status == 'aktif'): ?> ✅ Aktif
                            <?php elseif($status->status == 'tutup'): ?> ⏰ Ditutup
                            <?php elseif($status->status == 'selesai'): ?> ✓ Selesai
                            <?php else: ?> ❌ Batal <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </span>
                        <span class="text-sm font-bold text-slate-700"><?php echo e($status->total); ?> Kegiatan</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2">
                        <div class="bg-slate-600 h-2 rounded-full" style="width: <?php echo e(($status->total / max($totalKegiatan, 1)) * 100); ?>%"></div>
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\sibo\resources\views/admin/laporan/index.blade.php ENDPATH**/ ?>