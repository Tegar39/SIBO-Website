<?php $__env->startSection('content'); ?>
<div class="pt-28 pb-12 bg-slate-50 min-h-screen font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">
                    Database <span class="text-emerald-600">Kategori</span>
                </h1>
                <p class="text-slate-500 text-sm mt-1 font-medium flex items-center gap-2">
                    <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                    Klasifikasi Kegiatan PC DESBOR
                </p>
            </div>
            <a href="<?php echo e(route('admin.kategori.create')); ?>" 
               class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold py-3 px-6 rounded-2xl transition-all shadow-lg shadow-emerald-200 hover:-translate-y-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Kategori
            </a>
        </div>

        
        <div class="mb-8 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-3xl px-6 py-4 flex items-start gap-3">
            <svg class="w-5 h-5 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <div>
                <p class="text-sm font-black">Filter cepat tetap tersedia.</p>
                <p class="text-xs font-semibold mt-1 text-emerald-600">Cari kategori langsung dari halaman ini; analisis detail tetap tersedia di menu Laporan.</p>
            </div>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
            <div class="bg-emerald-50 border border-emerald-100 text-emerald-700 px-6 py-4 rounded-2xl mb-8 flex items-center gap-3">
                <div class="w-8 h-8 bg-emerald-500 text-white rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <span class="text-sm font-bold"><?php echo e(session('success')); ?></span>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div class="bg-white/70 backdrop-blur-md rounded-3xl border border-white/50 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-800/5 text-slate-600 border-b border-slate-100 text-xs font-black uppercase tracking-wider">
                            <th class="px-6 py-5 text-center">No</th>
                            <th class="px-6 py-5">Nama Kategori</th>
                            <th class="px-6 py-5">Deskripsi</th>
                            <th class="px-6 py-5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <tr class="hover:bg-white/50 transition-colors group">
                            <td class="px-6 py-4 text-center">
                                <span class="text-xs font-bold text-slate-400 group-hover:text-emerald-600 transition-colors">
                                    <?php echo e($kategoris->firstItem() + $key); ?>

                                </span>
                            </td>
                            <td class="px-6 py-4 font-bold text-slate-800">
                                <div class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-emerald-400 rounded-full"></span>
                                    <?php echo e($item->nama); ?>

                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-xs text-slate-500 font-medium line-clamp-1 italic">
                                    <?php echo e($item->deskripsi ?? '--- Tidak ada deskripsi ---'); ?>

                                </p>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="<?php echo e(route('admin.kategori.edit', $item->id_kategori)); ?>" 
                                       class="p-2 bg-white border border-slate-200 rounded-xl text-blue-600 hover:bg-blue-50 transition-all shadow-sm"
                                       title="Edit Kategori">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    <form action="<?php echo e(route('admin.kategori.destroy', $item->id_kategori)); ?>" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="p-2 bg-white border border-slate-200 rounded-xl text-rose-600 hover:bg-rose-50 transition-all shadow-sm" title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <tr>
                            <td colspan="4" class="px-6 py-20 text-center">
                                <div class="flex flex-col items-center justify-center text-slate-300">
                                    <svg class="w-12 h-12 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                    </svg>
                                    <p class="text-sm font-bold uppercase tracking-widest text-slate-400">Kategori Tidak Ditemukan</p>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-10">
            <?php echo e($kategoris->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Sibo\resources\views/admin/kategori/index.blade.php ENDPATH**/ ?>