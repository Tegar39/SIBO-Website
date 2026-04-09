

<?php $__env->startSection('content'); ?>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold mb-4">Edit Kegiatan</h1>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
                        <ul><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?><li><?php echo e($error); ?></li><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?></ul>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <form action="<?php echo e(route('admin.kegiatan.update', $kegiatan->id_kegiatan)); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                    <div class="mb-4"><label class="block font-medium">Kategori</label><select name="id_kategori" class="w-full border rounded px-2 py-1" required><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?><option value="<?php echo e($kat->id_kategori); ?>" <?php echo e($kegiatan->id_kategori == $kat->id_kategori ? 'selected' : ''); ?>><?php echo e($kat->nama); ?></option><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?></select></div>
                    <div class="mb-4"><label class="block font-medium">Judul</label><input type="text" name="judul" value="<?php echo e(old('judul', $kegiatan->judul)); ?>" class="w-full border rounded px-2 py-1" required></div>
                    <div class="mb-4"><label class="block font-medium">Deskripsi</label><textarea name="deskripsi" class="w-full border rounded px-2 py-1"><?php echo e(old('deskripsi', $kegiatan->deskripsi)); ?></textarea></div>
                    <div class="mb-4"><label class="block font-medium">Tanggal</label><input type="date" name="tanggal" value="<?php echo e(old('tanggal', $kegiatan->tanggal)); ?>" class="w-full border rounded px-2 py-1" required></div>
                    <div class="mb-4"><label class="block font-medium">Waktu</label><input type="time" name="waktu" value="<?php echo e(old('waktu', $kegiatan->waktu)); ?>" class="w-full border rounded px-2 py-1"></div>
                    <div class="mb-4"><label class="block font-medium">Lokasi</label><input type="text" name="lokasi" value="<?php echo e(old('lokasi', $kegiatan->lokasi)); ?>" class="w-full border rounded px-2 py-1"></div>
                    <div class="mb-4"><label class="block font-medium">Kuota</label><input type="number" name="kuota" value="<?php echo e(old('kuota', $kegiatan->kuota)); ?>" class="w-full border rounded px-2 py-1"></div>
                    <div class="mb-4"><label class="block font-medium">Status</label><select name="status" class="w-full border rounded px-2 py-1"><option value="aktif" <?php echo e($kegiatan->status=='aktif'?'selected':''); ?>>Aktif</option><option value="selesai" <?php echo e($kegiatan->status=='selesai'?'selected':''); ?>>Selesai</option><option value="batal" <?php echo e($kegiatan->status=='batal'?'selected':''); ?>>Batal</option></select></div>
                    <div class="mb-4"><label class="block font-medium">Pamflet (gambar baru jika ingin ganti)</label><input type="file" name="pamflet" accept="image/*" class="w-full border rounded px-2 py-1"></div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($kegiatan->pamflet): ?><div class="mb-4"><img src="<?php echo e(Storage::url($kegiatan->pamflet->path_file)); ?>" class="w-32 h-32 object-cover"></div><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <div class="flex gap-2"><button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button><a href="<?php echo e(route('admin.kegiatan.index')); ?>" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</a></div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Sibo\resources\views/admin/kegiatan/edit.blade.php ENDPATH**/ ?>