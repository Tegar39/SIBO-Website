<?php $__env->startSection('content'); ?>
<div class="pt-28 pb-20 bg-slate-50 min-h-screen font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 pb-8 border-b border-slate-200">
            <div>
                <h1 class="text-5xl font-extrabold text-slate-800 tracking-tight uppercase leading-none">
                    Daftar <span class="text-emerald-600">Kegiatan</span>
                </h1>
                <p class="text-slate-400 font-bold mt-4 text-[10px] uppercase tracking-[0.3em]">
                    Halaman <?php echo e($kegiatans->currentPage()); ?> dari <?php echo e($kegiatans->lastPage()); ?> • Total <?php echo e($kegiatans->total()); ?> Kegiatan
                </p>
            </div>
            
            </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($kegiatans->count() > 0): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $kegiatans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kegiatan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <div class="group/card bg-white/70 backdrop-blur-md border border-white rounded-[2.5rem] shadow-xl hover:shadow-2xl hover:shadow-emerald-100 transition-all duration-500 flex flex-col h-full relative overflow-hidden">
                        
                        <div class="relative aspect-[4/3] overflow-hidden m-3 rounded-[2rem] bg-slate-100">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($kegiatan->pamflet): ?>
                                <img src="<?php echo e(Storage::url($kegiatan->pamflet->path_file)); ?>" 
                                     class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover/card:scale-110">
                            <?php else: ?>
                                <div class="w-full h-full flex flex-col items-center justify-center bg-slate-200 text-slate-400 gap-2">
                                    <svg class="w-8 h-8 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span class="italic text-[10px] font-black uppercase tracking-widest">No Image</span>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            
                            <div class="absolute top-4 left-4">
                                <span class="bg-emerald-600/90 backdrop-blur-md text-white text-[9px] font-black px-4 py-1.5 rounded-full uppercase tracking-widest shadow-lg">
                                    <?php echo e($kegiatan->kategori->nama); ?>

                                </span>
                            </div>
                        </div>

                        <div class="p-8 pt-4 flex flex-grow flex-col">
                            <div class="flex items-center gap-2 mb-3">
                                <svg class="w-3.5 h-3.5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                    <?php echo e(\Carbon\Carbon::parse($kegiatan->tanggal)->translatedFormat('d M Y')); ?>

                                </span>
                            </div>

                            <h2 class="text-xl font-extrabold text-slate-800 leading-tight mb-4 transition-colors group-hover/card:text-emerald-600 uppercase tracking-tight">
                                <?php echo e($kegiatan->judul); ?>

                            </h2>

                            <p class="text-sm text-slate-500 line-clamp-3 mb-8 leading-relaxed">
                                <?php echo e($kegiatan->deskripsi); ?>

                            </p>

                            <div class="mt-auto">
                                <a href="<?php echo e(route('kegiatan.publik.show', $kegiatan->id_kegiatan)); ?>" 
                                   class="w-full inline-flex items-center justify-center gap-2 bg-slate-50 border border-slate-100 text-slate-600 hover:bg-emerald-600 hover:text-white hover:border-emerald-600 py-4 rounded-2xl text-[11px] font-black uppercase tracking-[0.2em] transition-all active:scale-95 group/btn">
                                    Lihat Detail
                                    <svg class="w-4 h-4 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>

            <div class="mt-20 p-8 bg-white/50 backdrop-blur-sm rounded-[2.5rem] border border-white shadow-sm">
                <?php echo e($kegiatans->links()); ?>

            </div>
        <?php else: ?>
            <div class="text-center py-32 bg-white/70 backdrop-blur-md border border-white rounded-[3rem] shadow-xl">
                <div class="w-24 h-24 bg-slate-50 rounded-[2.5rem] flex items-center justify-center mx-auto mb-6 border-2 border-dashed border-slate-200">
                    <svg class="w-10 h-10 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
                <p class="text-slate-300 font-black uppercase italic tracking-[0.3em] text-xs">Belum ada kegiatan yang tersedia saat ini.</p>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</div>

<style>
    /* Menyelaraskan tampilan pagination agar sesuai tema Emerald */
    .pagination svg { width: 1.25rem; height: 1.25rem; }
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;  
        overflow: hidden;
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Sibo\resources\views/kegiatan/index.blade.php ENDPATH**/ ?>