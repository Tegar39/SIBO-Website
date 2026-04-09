

<?php $__env->startSection('content'); ?>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold mb-6">Daftar Kegiatan</h1>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($kegiatans->count() > 0): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $kegiatans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kegiatan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($kegiatan->pamflet): ?>
                            <img src="<?php echo e(Storage::url($kegiatan->pamflet->path_file)); ?>" class="w-full h-48 object-cover">
                        <?php else: ?>
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">Tidak ada gambar</div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <div class="p-4">
                            <h2 class="text-xl font-bold mb-1"><?php echo e($kegiatan->judul); ?></h2>
                            <p class="text-gray-600 text-sm mb-2"><?php echo e($kegiatan->kategori->nama); ?> | <?php echo e(\Carbon\Carbon::parse($kegiatan->tanggal)->format('d M Y')); ?></p>
                            <p class="text-gray-700 mb-3 line-clamp-2"><?php echo e(Str::limit($kegiatan->deskripsi, 100)); ?></p>
                            <p class="text-sm font-semibold">Peserta: <?php echo e($kegiatan->pendaftarans->where('status', 'disetujui')->count()); ?> / <?php echo e($kegiatan->kuota == 0 ? '∞' : $kegiatan->kuota); ?></p>
                            <a href="<?php echo e(route('kegiatan.publik.show', $kegiatan->id_kegiatan)); ?>" wire:navigate class="mt-3 inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm transition">Detail & Daftar</a>
                        </div>
                    </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
            <div class="mt-6"><?php echo e($kegiatans->links()); ?></div>
        <?php else: ?>
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded">Belum ada kegiatan yang tersedia saat ini.</div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Sibo\resources\views/kegiatan/index.blade.php ENDPATH**/ ?>