

<?php $__env->startSection('content'); ?>
<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-8 border-b-4 border-gray-900 pb-4">
            <h1 class="text-3xl font-black text-gray-900 uppercase italic tracking-tighter">
                Manajemen <span class="text-green-600">Absensi</span>
            </h1>
            <p class="text-gray-500 text-xs font-bold uppercase tracking-widest mt-1">Pilih kegiatan untuk mengelola kehadiran</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $kegiatans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <a href="<?php echo e(route('admin.absensi.create', $k->id_kegiatan)); ?>" 
                   class="group bg-white border-2 border-gray-900 p-6 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[8px_8px_0px_0px_rgba(22,163,74,1)] transition-all transform hover:-translate-y-1">
                    <div class="flex justify-between items-start mb-4">
                        <span class="bg-gray-100 text-gray-800 text-[10px] font-black px-2 py-1 uppercase"><?php echo e(\Carbon\Carbon::parse($k->tanggal)->translatedFormat('M Y')); ?></span>
                        <svg class="w-5 h-5 text-gray-300 group-hover:text-green-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </div>
                    <h3 class="font-black text-xl text-gray-900 leading-tight uppercase group-hover:text-green-600 transition-colors"><?php echo e($k->judul); ?></h3>
                    <p class="text-sm font-bold text-gray-500 mt-2"><?php echo e(\Carbon\Carbon::parse($k->tanggal)->translatedFormat('d F Y')); ?></p>
                    <div class="mt-4 pt-4 border-t border-gray-100 flex items-center text-[10px] font-black uppercase text-gray-400">
                        <span class="group-hover:text-gray-900">Input Absensi Sekarang →</span>
                    </div>
                </a>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <div class="col-span-full bg-white border-2 border-dashed border-gray-300 rounded-lg p-12 text-center text-gray-400 font-bold uppercase tracking-widest">
                    Belum ada kegiatan yang tersedia untuk absensi.
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Sibo\resources\views/admin/absensi/index.blade.php ENDPATH**/ ?>