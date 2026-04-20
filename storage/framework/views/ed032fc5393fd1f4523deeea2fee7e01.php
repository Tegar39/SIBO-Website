

<?php $__env->startSection('content'); ?>
<div class="py-16 bg-[#f9f9f9] min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 border-b-4 border-gray-900 pb-6">
            <div>
                <h1 class="text-5xl font-black text-gray-900 tracking-tighter uppercase italic leading-none">
                    Daftar <span class="text-green-600">Kegiatan</span>
                </h1>
                <p class="text-gray-500 font-bold mt-3 text-xs uppercase tracking-[0.2em]">Halaman <?php echo e($kegiatans->currentPage()); ?> dari <?php echo e($kegiatans->lastPage()); ?></p>
            </div>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($kegiatans->count() > 0): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $kegiatans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kegiatan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <div class="group/card bg-white border border-gray-200 shadow-sm hover:shadow-2xl transition-all duration-500 flex flex-col h-full relative rounded-sm overflow-hidden">
                        
                        <div class="relative aspect-[4/3] overflow-hidden bg-gray-100 border-b border-gray-100">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($kegiatan->pamflet): ?>
                                <img src="<?php echo e(Storage::url($kegiatan->pamflet->path_file)); ?>" 
                                     class="w-full h-full object-cover transition-transform duration-700 ease-[cubic-bezier(0.23,1,0.32,1)] group-hover/card:scale-110 group-hover/card:rotate-2">
                            <?php else: ?>
                                <div class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-400 italic text-xs font-bold uppercase">No Image</div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <div class="absolute top-4 left-4 z-10">
                                <span class="bg-green-600 text-white text-[9px] font-black px-3 py-1 uppercase tracking-widest shadow-md">
                                    <?php echo e($kegiatan->kategori->nama); ?>

                                </span>
                            </div>
                        </div>

                        <div class="p-6 flex flex-grow flex-col">
                            <span class="text-[10px] font-bold text-gray-400 uppercase mb-2">
                                <?php echo e(\Carbon\Carbon::parse($kegiatan->tanggal)->translatedFormat('d M Y')); ?>

                            </span>
                            <h2 class="text-xl font-bold text-gray-900 leading-tight mb-3 transition-colors group-hover/card:text-green-600">
                                『<?php echo e($kegiatan->judul); ?>』
                            </h2>
                            <p class="text-sm text-gray-600 line-clamp-3 mb-6">
                                <?php echo e($kegiatan->deskripsi); ?>

                            </p>

                            <div class="mt-auto pt-4 border-t border-gray-50 text-right">
                                <a href="<?php echo e(route('kegiatan.publik.show', $kegiatan->id_kegiatan)); ?>" 
                                   class="text-[11px] font-black uppercase tracking-tighter border-b-2 border-gray-900 hover:border-green-600 hover:text-green-600 transition-all">
                                    Lihat Detail →
                                </a>
                            </div>
                        </div>
                    </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>

            <div class="mt-16 border-t border-gray-200 pt-8">
                <?php echo e($kegiatans->links()); ?>

            </div>
        <?php else: ?>
            <div class="text-center py-20 bg-white border-2 border-dashed border-gray-200 rounded-lg">
                <p class="text-gray-400 font-bold uppercase tracking-widest">Belum ada kegiatan.</p>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Sibo\resources\views/kegiatan/index.blade.php ENDPATH**/ ?>