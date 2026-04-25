

<?php $__env->startSection('content'); ?>
<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 border-b-4 border-gray-900 pb-6 gap-4">
            <div>
                <h1 class="text-4xl font-black text-gray-900 uppercase italic tracking-tighter">
                    Database <span class="text-green-700">Kategori</span>
                </h1>
                <p class="text-gray-500 text-[10px] font-black uppercase tracking-[0.3em] mt-1">Klasifikasi Kegiatan PC DESBOR</p>
            </div>
            <a href="<?php echo e(route('admin.kategori.create')); ?>" 
               class="bg-gray-900 text-white text-[11px] font-black py-4 px-8 uppercase tracking-widest hover:bg-green-700 transition-all shadow-[6px_6px_0px_0px_rgba(234,179,8,1)] active:shadow-none active:translate-x-[4px] active:translate-y-[4px]">
                + Tambah Kategori
            </a>
        </div>

        <div class="mb-10 bg-white border-4 border-gray-900 p-6 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
            <form action="<?php echo e(route('admin.kategori.index')); ?>" method="GET" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input type="text" name="search" value="<?php echo e(request('search')); ?>" 
                        placeholder="CARI NAMA KATEGORI ATAU DESKRIPSI..." 
                        class="w-full bg-gray-50 border-2 border-gray-900 pl-12 pr-4 py-3 font-black uppercase italic text-xs tracking-widest focus:ring-0 focus:border-green-700 transition-all">
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="bg-gray-900 text-white px-8 py-3 font-black uppercase italic text-[10px] hover:bg-green-700 transition-all shadow-[4px_4px_0px_0px_rgba(234,179,8,1)] active:shadow-none active:translate-x-[4px] active:translate-y-[4px]">
                        FILTER
                    </button>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(request('search')): ?>
                        <a href="<?php echo e(route('admin.kategori.index')); ?>" class="bg-red-500 text-white border-2 border-gray-900 px-6 py-3 font-black uppercase italic text-[10px] flex items-center justify-center hover:bg-red-600 transition-all shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] active:shadow-none active:translate-x-[4px] active:translate-y-[4px]">
                            RESET
                        </a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </form>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
            <div class="mb-8 bg-green-700 text-yellow-400 p-4 font-black text-xs uppercase tracking-widest shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] flex items-center gap-3">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div class="bg-white border-4 border-gray-900 shadow-[10px_10px_0px_0px_rgba(0,0,0,1)] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y-4 divide-gray-900">
                    <thead class="bg-gray-900">
                        <tr>
                            <th class="px-6 py-5 text-left text-[11px] font-black text-yellow-400 uppercase tracking-[0.2em]">No</th>
                            <th class="px-6 py-5 text-left text-[11px] font-black text-white uppercase tracking-[0.2em]">Nama Kategori</th>
                            <th class="px-6 py-5 text-left text-[11px] font-black text-white uppercase tracking-[0.2em]">Deskripsi</th>
                            <th class="px-6 py-5 text-center text-[11px] font-black text-white uppercase tracking-[0.2em]">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y-2 divide-gray-900 bg-white">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <tr class="hover:bg-green-50 transition-colors group">
                            <td class="px-6 py-4 text-sm font-black text-gray-400 group-hover:text-gray-900">
                                <?php echo e($kategoris->firstItem() + $key); ?>

                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-black text-gray-900 uppercase italic tracking-tight group-hover:text-green-700 transition-colors">
                                    <?php echo e($item->nama); ?>

                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-[11px] text-gray-500 font-bold italic line-clamp-1">
                                    <?php echo e($item->deskripsi ?? '--- Tidak ada deskripsi ---'); ?>

                                </p>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center items-center gap-4">
                                    <a href="<?php echo e(route('admin.kategori.edit', $item->id_kategori)); ?>" 
                                       class="text-[10px] font-black uppercase text-blue-600 hover:underline tracking-tighter">
                                        Edit
                                    </a>
                                    <div class="w-[2px] h-4 bg-gray-300"></div>
                                    <form action="<?php echo e(route('admin.kategori.destroy', $item->id_kategori)); ?>" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="text-[10px] font-black uppercase text-red-600 hover:underline tracking-tighter">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <tr>
                            <td colspan="4" class="px-6 py-20 text-center">
                                <p class="text-sm font-black text-gray-300 uppercase italic tracking-widest">Kategori Tidak Ditemukan</p>
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