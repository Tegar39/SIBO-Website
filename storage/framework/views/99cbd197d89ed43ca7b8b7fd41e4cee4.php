<?php $__env->startSection('content'); ?>
<div class="pt-28 pb-12 bg-slate-50 min-h-screen font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-16 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">
                    Galeri <span class="text-emerald-600">Kegiatan</span>
                </h1>
                <p class="text-slate-500 text-sm mt-1 font-medium flex items-center gap-2">
                    <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                    Dokumentasi Budaya & Olahraga PC DESBOR
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-24">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $kegiatans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <div class="group relative">
                    
                    <div class="absolute inset-0 -translate-y-2 opacity-0 group-hover:opacity-100 group-hover:-translate-y-20 transition-all duration-700 ease-[cubic-bezier(0.34,1.56,0.64,1)] pointer-events-none">
                        <?php
                            $fotos = $k->galeris->take(3);
                            $stackItems = [];

                            if($fotos->isEmpty()) {
                                $img = $k->pamflet ? Storage::url($k->pamflet->path_file) : 'https://via.placeholder.com/400x300?text=No+Image';
                                $stackItems = [$img, $img, $img];
                            } else {
                                foreach($fotos as $f) {
                                    $stackItems[] = Storage::url($f->path_file);
                                }
                            }
                        ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $stackItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-52 h-36 rounded-2xl border-4 border-white bg-white shadow-2xl overflow-hidden transition-transform duration-500 ring-1 ring-slate-200"
                                 style="z-index: <?php echo e(10 - $index); ?>; 
                                        transform: translateX(-50%) rotate(<?php echo e(($index - 1) * 12); ?>deg) translateY(<?php echo e($index * -15); ?>px);">
                                <img src="<?php echo e($url); ?>" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700 scale-110 group-hover:scale-100">
                            </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </div>

                    <a href="<?php echo e(route('admin.galeri.show', $k->id_kegiatan)); ?>" 
                       class="relative z-30 block bg-white/80 backdrop-blur-md border border-white rounded-3xl shadow-sm transition-all duration-300 hover:shadow-xl group-hover:border-emerald-200">
                        
                        <div class="p-8">
                            <div class="flex justify-between items-start mb-6">
                                <span class="bg-emerald-50 text-emerald-600 text-[10px] font-black px-3 py-1.5 rounded-xl border border-emerald-100 uppercase tracking-widest">
                                    <?php echo e(\Carbon\Carbon::parse($k->tanggal)->format('d M Y')); ?>

                                </span>
                                <span class="text-emerald-600/10 font-black text-2xl italic">#<?php echo e($loop->iteration); ?></span>
                            </div>
                            
                            <h3 class="text-xl font-extrabold text-slate-800 leading-tight mb-8 group-hover:text-emerald-600 transition-colors line-clamp-2">
                                <?php echo e($k->judul); ?>

                            </h3>
                            
                            <div class="flex items-center justify-between mt-6 pt-6 border-t border-slate-100">
                                <div class="flex items-center gap-2">
                                    <div class="p-2 bg-emerald-50 rounded-lg text-emerald-600">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <span class="text-[11px] font-black uppercase text-slate-500 tracking-wider">
                                        <?php echo e($k->galeris->count()); ?> Koleksi Foto
                                    </span>
                                </div>
                                <span class="text-emerald-500 transform group-hover:translate-x-1 transition-transform">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </span>
                            </div>
                        </div>

                        <div class="h-2 bg-emerald-600 w-full rounded-b-3xl"></div>
                    </a>
                </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <div class="col-span-full py-32 text-center bg-white/70 backdrop-blur-md rounded-[3rem] border-2 border-dashed border-slate-200">
                    <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-300">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <p class="text-slate-400 font-extrabold uppercase tracking-[0.2em] text-xl">Belum Ada Album Kegiatan</p>
                    <p class="text-slate-400 text-xs font-medium mt-2">Silahkan tambah dokumentasi melalui menu detail kegiatan</p>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <div class="mt-24">
            <?php echo e($kegiatans->links()); ?>

        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Sibo\resources\views/admin/galeri/index.blade.php ENDPATH**/ ?>