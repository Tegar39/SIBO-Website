

<?php $__env->startSection('content'); ?>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold mb-4">Dashboard Admin</h1>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div class="bg-blue-500 text-white p-4 rounded-lg">
                        <h3 class="text-lg">Total Anggota</h3>
                        <p class="text-3xl font-bold"><?php echo e($totalAnggota); ?></p>
                    </div>
                    <div class="bg-green-500 text-white p-4 rounded-lg">
                        <h3 class="text-lg">Total Kegiatan</h3>
                        <p class="text-3xl font-bold"><?php echo e($totalKegiatan); ?></p>
                    </div>
                    <div class="bg-yellow-500 text-white p-4 rounded-lg">
                        <h3 class="text-lg">Pendaftar Pending</h3>
                        <p class="text-3xl font-bold"><?php echo e($pendingPendaftar); ?></p>
                    </div>
                </div>

                <div class="mb-6 flex gap-2">
                    <a href="<?php echo e(route('admin.anggota.index')); ?>" wire:navigate class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Kelola Anggota</a>
                    <a href="<?php echo e(route('admin.kegiatan.index')); ?>" wire:navigate class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Kelola Kegiatan</a>
                    <a href="<?php echo e(route('admin.pendaftaran.index')); ?>" wire:navigate class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">Kelola Pendaftaran</a>
                </div>

                <h2 class="text-xl font-semibold mb-2">Anggota Terbaru</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full border">
                        <thead class="bg-gray-200">
                            <tr><th class="px-4 py-2 border">Nama</th><th class="px-4 py-2 border">Nomor Anggota</th><th class="px-4 py-2 border">PAC</th></tr>
                        </thead>
                        <tbody>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $anggotaTerbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <tr><td class="px-4 py-2 border"><?php echo e($a->nama_lengkap); ?></td><td class="px-4 py-2 border"><?php echo e($a->nomor_anggota); ?></td><td class="px-4 py-2 border"><?php echo e($a->pac); ?></td></tr>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Sibo\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>