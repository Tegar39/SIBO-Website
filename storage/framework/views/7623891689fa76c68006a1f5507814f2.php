

<?php $__env->startSection('content'); ?>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-2xl font-bold">Pendaftar: <?php echo e($kegiatan->judul); ?></h1>
                    <a href="<?php echo e(route('admin.pendaftaran.index')); ?>" class="bg-gray-500 text-white px-3 py-1 rounded">Kembali</a>
                </div>
                <p>Tanggal: <?php echo e(\Carbon\Carbon::parse($kegiatan->tanggal)->format('d M Y')); ?> | Kuota: <?php echo e($kegiatan->kuota == 0 ? 'Tak terbatas' : $kegiatan->kuota); ?></p>
                <p class="mb-4">Status kegiatan: <?php echo e(ucfirst($kegiatan->status)); ?></p>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?><div class="bg-green-100 border-green-400 text-green-700 px-4 py-2 rounded mb-4"><?php echo e(session('success')); ?></div><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('error')): ?><div class="bg-red-100 border-red-400 text-red-700 px-4 py-2 rounded mb-4"><?php echo e(session('error')); ?></div><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <div class="overflow-x-auto">
                    <table class="min-w-full border">
                        <thead class="bg-gray-200">
                            <tr><th class="px-4 py-2 border">No</th><th class="px-4 py-2 border">Nama</th><th class="px-4 py-2 border">Nomor Anggota</th><th class="px-4 py-2 border">PAC</th><th class="px-4 py-2 border">Tgl Daftar</th><th class="px-4 py-2 border">Status</th><th class="px-4 py-2 border">Aksi</th></tr>
                        </thead>
                        <tbody>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $pendaftarans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <tr>
                                <td class="px-4 py-2 border"><?php echo e($key+1); ?></td>
                                <td class="px-4 py-2 border"><?php echo e($p->anggota->nama_lengkap); ?></td>
                                <td class="px-4 py-2 border"><?php echo e($p->anggota->nomor_anggota); ?></td>
                                <td class="px-4 py-2 border"><?php echo e($p->anggota->pac ?? '-'); ?></td>
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
                                    <form action="<?php echo e(route('admin.pendaftaran.update', $p->id_daftar)); ?>" method="POST" class="flex gap-1">
                                        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                                        <select name="status" class="border rounded px-1 py-1 text-sm">
                                            <option value="pending" <?php echo e($p->status=='pending'?'selected':''); ?>>Pending</option>
                                            <option value="disetujui" <?php echo e($p->status=='disetujui'?'selected':''); ?>>Disetujui</option>
                                            <option value="ditolak" <?php echo e($p->status=='ditolak'?'selected':''); ?>>Ditolak</option>
                                            <option value="batal" <?php echo e($p->status=='batal'?'selected':''); ?>>Batal</option>
                                        </select>
                                        <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded text-sm">Update</button>
                                    </form>
                                </td>
                            </tr>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <?php echo e($pendaftarans->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Sibo\resources\views/admin/pendaftaran/show.blade.php ENDPATH**/ ?>