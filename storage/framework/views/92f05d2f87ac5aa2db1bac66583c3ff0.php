

<?php $__env->startSection('content'); ?>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold">Selamat Datang, <?php echo e(Auth::user()->name); ?></h1>
                <p class="mt-2">Anda login sebagai anggota.</p>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(Auth::user()->anggota): ?>
                    <div class="mt-4 p-4 bg-gray-100 rounded">
                        <p><strong>Nomor Anggota:</strong> <?php echo e(Auth::user()->anggota->nomor_anggota); ?></p>
                        <p><strong>PAC:</strong> <?php echo e(Auth::user()->anggota->pac ?? 'Belum diatur'); ?></p>
                    </div>
                <?php else: ?>
                    <p class="text-red-500 mt-2">Data anggota belum lengkap. Silakan hubungi admin.</p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <div class="mt-6 flex gap-2">
                    <a href="<?php echo e(route('kegiatan.publik.index')); ?>" wire:navigate class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Lihat Kegiatan</a>
                    <a href="<?php echo e(route('anggota.riwayat')); ?>" wire:navigate class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">Riwayat Pendaftaran</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Sibo\resources\views/anggota/dashboard.blade.php ENDPATH**/ ?>