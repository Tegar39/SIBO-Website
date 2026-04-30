<?php $__env->startSection('content'); ?>
<div class="pt-28 pb-12 bg-slate-50 min-h-screen font-sans">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white/70 backdrop-blur-md border border-white/50 rounded-[2.5rem] shadow-xl p-8 md:p-12">
            
            <div class="mb-10 text-center md:text-left">
                <div class="flex items-center justify-center md:justify-start gap-3 mb-2">
                    <span class="p-2 bg-emerald-50 rounded-lg text-emerald-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </span>
                    <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">
                        Edit <span class="text-emerald-600">Category</span>
                    </h1>
                </div>
                <p class="text-slate-500 text-sm font-medium">Perbarui informasi klasifikasi kegiatan Anda</p>
                <div class="h-1 w-20 bg-emerald-500 rounded-full mt-4 mx-auto md:mx-0"></div>
            </div>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
                <div class="mb-8 bg-rose-50 border border-rose-100 text-rose-700 p-4 rounded-2xl flex items-center gap-3 shadow-sm">
                    <svg class="w-5 h-5 text-rose-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="font-bold text-xs uppercase tracking-wider">Mohon periksa kembali inputan Anda!</span>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <form action="<?php echo e(route('admin.kategori.update', $kategori->id_kategori)); ?>" method="POST" class="space-y-8">
                <?php echo csrf_field(); ?> 
                <?php echo method_field('PUT'); ?>

                <div class="space-y-2">
                    <label class="block text-[11px] font-black text-slate-400 uppercase tracking-[0.15em] ml-1">Category Name</label>
                    <input type="text" name="nama" value="<?php echo e(old('nama', $kategori->nama)); ?>" 
                           class="w-full bg-slate-100/50 border-none rounded-2xl p-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500 transition-all uppercase tracking-tight" 
                           required>
                </div>

                <div class="space-y-2">
                    <label class="block text-[11px] font-black text-slate-400 uppercase tracking-[0.15em] ml-1">Short Description</label>
                    <textarea name="deskripsi" rows="4" 
                              class="w-full bg-slate-100/50 border-none rounded-2xl p-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500 transition-all leading-relaxed"><?php echo e(old('deskripsi', $kategori->deskripsi)); ?></textarea>
                </div>

                <div class="flex flex-col md:flex-row items-center gap-6 pt-4">
                    <button type="submit" class="w-full md:w-auto bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-4 px-12 rounded-2xl text-xs uppercase tracking-widest transition-all shadow-lg shadow-emerald-200 hover:-translate-y-1">
                        Update Category
                    </button>
                    
                    <a href="<?php echo e(route('admin.kategori.index')); ?>" class="group flex items-center gap-2 text-[11px] font-black uppercase text-slate-400 hover:text-rose-600 tracking-widest transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\sibo\resources\views/admin/kategori/edit.blade.php ENDPATH**/ ?>