

<?php $__env->startSection('content'); ?>
<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 border-b-4 border-gray-900 pb-6 gap-4">
            <div>
                <h1 class="text-4xl font-black text-gray-900 uppercase italic tracking-tighter">
                    Kelola <span class="text-green-700">Pendaftaran</span>
                </h1>
                <p class="text-gray-500 text-[10px] font-black uppercase tracking-[0.3em] mt-1">Sistem Informasi Budaya & Olahraga - Admin Panel</p>
            </div>
        </div>

        <div class="mb-10 bg-white border-4 border-gray-900 p-6 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
            <form action="<?php echo e(route('admin.pendaftaran.index')); ?>" method="GET" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input type="text" name="search" value="<?php echo e(request('search')); ?>" 
                        placeholder="CARI JUDUL KEGIATAN..." 
                        class="w-full bg-gray-50 border-2 border-gray-900 pl-12 pr-4 py-3 font-black uppercase italic text-xs tracking-widest focus:ring-0 focus:border-green-700 transition-all">
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="bg-gray-900 text-white px-8 py-3 font-black uppercase italic text-[10px] hover:bg-green-700 transition-all shadow-[4px_4px_0px_0px_rgba(234,179,8,1)] active:shadow-none active:translate-x-[2px] active:translate-y-[2px]">
                        CARI
                    </button>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(request('search')): ?>
                        <a href="<?php echo e(route('admin.pendaftaran.index')); ?>" class="bg-red-500 text-white border-2 border-gray-900 px-6 py-3 font-black uppercase italic text-[10px] flex items-center justify-center hover:bg-red-600 transition-all shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] active:shadow-none active:translate-x-[2px] active:translate-y-[2px]">
                            RESET
                        </a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </form>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($kegiatans->count() > 0): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $kegiatans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <div class="group bg-white border-2 border-gray-900 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-1 hover:translate-y-1 transition-all flex flex-col overflow-hidden">
                        
                        <div class="h-48 bg-gray-200 relative overflow-hidden border-b-2 border-gray-900">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($k->pamflet && Storage::disk('public')->exists($k->pamflet->path_file)): ?>
                                <img src="<?php echo e(Storage::url($k->pamflet->path_file)); ?>" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500">
                            <?php else: ?>
                                <div class="w-full h-full flex items-center justify-center bg-gray-100 italic font-black text-gray-300 uppercase tracking-tighter text-sm text-center px-4">No Image Cover</div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            
                            <div class="absolute bottom-4 right-4 flex flex-col items-end gap-1">
                                <span class="bg-yellow-400 text-gray-900 text-[10px] font-black px-3 py-1 uppercase tracking-widest shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] border border-gray-900">
                                    <?php echo e($k->pendaftarans_count); ?> PENDAFTAR
                                </span>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($k->kuota > 0): ?>
                                    <span class="bg-white text-gray-900 text-[8px] font-bold px-2 py-0.5 uppercase border border-gray-900">
                                        Kuota: <?php echo e($k->kuota); ?>

                                    </span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>

                        <div class="p-6 flex-1 flex flex-col">
                            <div class="mb-2">
                                <span class="text-[10px] font-black uppercase tracking-widest text-green-700">
                                    <?php echo e(\Carbon\Carbon::parse($k->tanggal)->format('d M Y')); ?>

                                </span>
                            </div>

                            <h3 class="text-xl font-black text-gray-900 uppercase tracking-tighter leading-tight mb-4 group-hover:text-green-700 transition-colors line-clamp-2 min-h-[3rem]">
                                <?php echo e($k->judul); ?>

                            </h3>
                            
                            <div class="mt-auto">
                                <div class="w-full bg-gray-100 h-2 border border-gray-900 mb-2">
                                    <?php
                                        $persen = $k->kuota > 0 ? min(($k->pendaftarans_count / $k->kuota) * 100, 100) : 0;
                                    ?>
                                    <div class="bg-green-500 h-full transition-all duration-500" style="width: <?php echo e($persen); ?>%"></div>
                                </div>
                                <p class="text-[9px] font-black uppercase text-gray-500 italic">Progress Keterisian Kuota</p>
                            </div>
                        </div>

                        <div class="border-t-2 border-gray-900">
                            <a href="<?php echo e(route('admin.pendaftaran.show', $k->id_kegiatan)); ?>" class="block p-4 text-center text-[10px] font-black uppercase tracking-[0.2em] bg-white hover:bg-black hover:text-white transition-colors group-hover:bg-gray-900 group-hover:text-white">
                                KELOLA PESERTA →
                            </a>
                        </div>
                    </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>

            <div class="mt-12">
                <?php echo e($kegiatans->links()); ?>

            </div>
        <?php else: ?>
            <div class="border-4 border-dashed border-gray-200 py-24 text-center">
                <p class="text-gray-400 font-black uppercase italic tracking-widest text-xl mb-4">Hasil tidak ditemukan</p>
                <a href="<?php echo e(route('admin.pendaftaran.index')); ?>" class="text-green-700 underline font-black text-xs uppercase">Lihat Semua Kegiatan</a>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Sibo\resources\views/admin/pendaftaran/index.blade.php ENDPATH**/ ?>