

<?php $__env->startSection('content'); ?>
<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white border-2 border-gray-900 shadow-[10px_10px_0px_0px_rgba(0,0,0,1)] p-8">
            <h1 class="text-3xl font-black text-gray-900 uppercase italic tracking-tighter mb-8 border-b-2 border-gray-900 pb-2">
                Edit <span class="text-green-600">Category</span>
            </h1>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
                <div class="mb-6 bg-red-50 border-l-4 border-red-600 text-red-700 p-4 font-bold text-xs uppercase tracking-tight">
                    Check your inputs!
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <form action="<?php echo e(route('admin.kategori.update', $kategori->id_kategori)); ?>" method="POST">
                <?php echo csrf_field(); ?> 
                <?php echo method_field('PUT'); ?>

                <div class="mb-6">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Category Name</label>
                    <input type="text" name="nama" value="<?php echo e(old('nama', $kategori->nama)); ?>" 
                           class="w-full border-2 border-gray-900 p-3 text-sm font-bold focus:ring-0 focus:border-green-600 transition-colors uppercase shadow-[4px_4px_0px_0px_rgba(0,0,0,0.05)]" 
                           required>
                </div>

                <div class="mb-8">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Short Description</label>
                    <textarea name="deskripsi" rows="4" 
                              class="w-full border-2 border-gray-900 p-3 text-sm font-bold focus:ring-0 focus:border-green-600 transition-colors shadow-[4px_4px_0px_0px_rgba(0,0,0,0.05)]"><?php echo e(old('deskripsi', $kategori->deskripsi)); ?></textarea>
                </div>

                <div class="flex flex-col md:flex-row items-center gap-4">
                    <button type="submit" class="w-full md:w-auto bg-green-600 hover:bg-black text-white font-black py-3 px-10 uppercase tracking-widest text-xs transition-all shadow-[4px_4px_0px_0px_rgba(0,0,0,0.1)]">
                        Update Category
                    </button>
                    <a href="<?php echo e(route('admin.kategori.index')); ?>" class="text-[10px] font-black uppercase text-gray-400 hover:text-red-600 tracking-widest">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Sibo\resources\views/admin/kategori/edit.blade.php ENDPATH**/ ?>