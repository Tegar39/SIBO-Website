

<?php $__env->startSection('content'); ?>
<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 border-b-4 border-gray-900 pb-6 gap-4">
            <div>
                <h1 class="text-4xl font-black text-gray-900 uppercase italic tracking-tighter">
                    Galeri <span class="text-green-700">Kegiatan</span>
                </h1>
                <p class="text-gray-500 text-[10px] font-black uppercase tracking-[0.3em] mt-1">Dokumentasi Budaya & Olahraga PC DESBOR</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-20">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $kegiatans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <div class="group relative">
                    
                    <div class="absolute inset-0 -translate-y-2 opacity-0 group-hover:opacity-100 group-hover:-translate-y-16 transition-all duration-500 ease-out pointer-events-none">
                        <?php
                            $fotos = $k->galeris->take(3);
                            $stackItems = [];

                            if($fotos->isEmpty()) {
                                // Fallback ke pamflet jika galeri kosong
                                $img = $k->pamflet ? Storage::url($k->pamflet) : 'https://via.placeholder.com/400x300?text=No+Image';
                                $stackItems = [$img, $img, $img];
                            } else {
                                foreach($fotos as $f) {
                                    $stackItems[] = Storage::url($f->path_file);
                                }
                            }
                        ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $stackItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-48 h-32 border-2 border-gray-900 bg-white shadow-xl overflow-hidden transition-transform duration-500"
                                 style="z-index: <?php echo e(10 - $index); ?>; 
                                        transform: translateX(-50%) rotate(<?php echo e(($index - 1) * 12); ?>deg) translateY(<?php echo e($index * -12); ?>px);">
                                <img src="<?php echo e($url); ?>" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500">
                            </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </div>

                    <a href="<?php echo e(route('admin.galeri.show', $k->id_kegiatan)); ?>" 
                       class="relative z-30 block bg-white border-4 border-gray-900 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] group-hover:shadow-none group-hover:translate-x-1 group-hover:translate-y-1 transition-all">
                        
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <span class="bg-yellow-400 text-gray-900 text-[10px] font-black px-2 py-1 border-2 border-gray-900 uppercase tracking-widest">
                                    <?php echo e(\Carbon\Carbon::parse($k->tanggal)->format('d M Y')); ?>

                                </span>
                                <span class="text-green-700 font-black text-xl italic opacity-10">#<?php echo e($k->id_kegiatan); ?></span>
                            </div>
                            
                            <h3 class="text-xl font-black text-gray-900 uppercase tracking-tighter mb-2 group-hover:text-green-700 transition-colors">
                                <?php echo e($k->judul); ?>

                            </h3>
                            
                            <div class="flex items-center gap-2 mt-6 pt-4 border-t-2 border-gray-900">
                                <svg class="w-5 h-5 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-[10px] font-black uppercase text-gray-900 tracking-widest">
                                    <?php echo e($k->galeris->count()); ?> Koleksi Foto
                                </span>
                            </div>
                        </div>
                        <div class="h-3 bg-green-700 w-full border-t-4 border-gray-900"></div>
                    </a>
                </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <div class="col-span-full border-4 border-dashed border-gray-300 py-24 text-center">
                    <p class="text-gray-400 font-black uppercase italic tracking-widest text-2xl">Belum Ada Album Kegiatan</p>
                    <p class="text-gray-400 text-xs uppercase mt-2">Silahkan tambah dokumentasi melalui menu kegiatan</p>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <div class="mt-20">
            <?php echo e($kegiatans->links()); ?>

        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Sibo\resources\views/admin/galeri/index.blade.php ENDPATH**/ ?>