

<?php $__env->startSection('content'); ?>
<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 border-b-4 border-gray-900 pb-4 gap-4">
            <div>
                <h1 class="text-3xl font-black text-gray-900 uppercase italic tracking-tighter">
                    Daftar <span class="text-green-600">Kategori</span>
                </h1>
                <p class="text-gray-500 text-[10px] font-black uppercase tracking-widest">Klasifikasi Kegiatan PC DESBOR</p>
            </div>
            <a href="<?php echo e(route('admin.kategori.create')); ?>" class="bg-gray-900 hover:bg-green-600 text-white text-[11px] font-black py-3 px-6 uppercase tracking-[0.2em] transition-all shadow-[4px_4px_0px_0px_rgba(0,0,0,0.2)]">
                + Tambah Baru
            </a>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
            <div class="mb-6 bg-green-600 text-white p-4 font-black text-xs uppercase tracking-widest shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div class="bg-white border-2 border-gray-900 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-900">
                    <thead class="bg-gray-50 text-gray-900 font-black uppercase text-[10px] tracking-widest">
                        <tr>
                            <th class="px-6 py-4 text-left">No</th>
                            <th class="px-6 py-4 text-left">Nama Kategori</th>
                            <th class="px-6 py-4 text-left">Keterangan</th>
                            <th class="px-6 py-4 text-right">Manajemen</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <tr class="hover:bg-green-50 transition-colors">
                            <td class="px-6 py-4 text-sm font-black text-gray-300">#<?php echo e($kategoris->firstItem() + $key); ?></td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-black text-gray-900 uppercase tracking-tighter"><?php echo e($item->nama); ?></span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-xs text-gray-500 font-medium italic line-clamp-1"><?php echo e($item->deskripsi ?? '-'); ?></p>
                            </td>
                            <td class="px-6 py-4 text-right space-x-3">
                                <a href="<?php echo e(route('admin.kategori.edit', $item->id_kategori)); ?>" class="text-[10px] font-black uppercase text-blue-600 hover:text-black transition-colors">Edit</a>
                                
                                <form action="<?php echo e(route('admin.kategori.destroy', $item->id_kategori)); ?>" method="POST" class="inline">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="text-[10px] font-black uppercase text-red-600 hover:text-black transition-colors" onclick="return confirm('Hapus kategori ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-8">
            <?php echo e($kategoris->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Sibo\resources\views/admin/kategori/index.blade.php ENDPATH**/ ?>