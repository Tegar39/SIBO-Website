

<?php $__env->startSection('content'); ?>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold mb-4">Riwayat Pendaftaran</h1>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
                    <div class="bg-green-100 border-green-400 text-green-700 px-4 py-2 rounded mb-4"><?php echo e(session('success')); ?></div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('error')): ?>
                    <div class="bg-red-100 border-red-400 text-red-700 px-4 py-2 rounded mb-4"><?php echo e(session('error')); ?></div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($pendaftarans->count() > 0): ?>
                    <div class="overflow-x-auto">
                        <table class="min-w-full border">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="px-4 py-2 border">No</th>
                                    <th class="px-4 py-2 border">Kegiatan</th>
                                    <th class="px-4 py-2 border">Tanggal Kegiatan</th>
                                    <th class="px-4 py-2 border">Tanggal Daftar</th>
                                    <th class="px-4 py-2 border">Status</th>
                                    <th class="px-4 py-2 border">Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $pendaftarans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                    <tr>
                                        <td class="px-4 py-2 border"><?php echo e($key+1); ?></td>
                                        <td class="px-4 py-2 border"><?php echo e($p->kegiatan->judul); ?></td>
                                        <td class="px-4 py-2 border"><?php echo e(\Carbon\Carbon::parse($p->kegiatan->tanggal)->format('d M Y')); ?></td>
                                        <td class="px-4 py-2 border"><?php echo e(\Carbon\Carbon::parse($p->tgl_daftar)->format('d M Y H:i')); ?></td>
                                        <td class="px-4 py-2 border">
                                            <span class="px-2 py-1 rounded text-white text-xs
                                                <?php if($p->status=='pending'): ?> bg-yellow-500
                                                <?php elseif($p->status=='disetujui'): ?> bg-green-500
                                                <?php elseif($p->status=='ditolak'): ?> bg-red-500
                                                <?php else: ?> bg-gray-500 <?php endif; ?>">
                                                <?php echo e(ucfirst($p->status)); ?>

                                            </span>
                                        </td>
                                        <td class="px-4 py-2 border">
                                            <a href="<?php echo e(route('kegiatan.publik.show', $p->id_kegiatan)); ?>" wire:navigate class="text-blue-600 hover:underline">Lihat</a>
                                        </td>
                                    </tr>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php echo e($pendaftarans->links()); ?>

                <?php else: ?>
                    <p class="text-gray-500">Anda belum pernah mendaftar kegiatan apapun.</p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Sibo\resources\views/anggota/riwayat.blade.php ENDPATH**/ ?>