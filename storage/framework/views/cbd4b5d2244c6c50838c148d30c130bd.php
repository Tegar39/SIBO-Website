

<?php $__env->startSection('content'); ?>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-2xl font-bold">Upload Foto: <?php echo e($kegiatan->judul); ?></h1>
                    <a href="<?php echo e(route('admin.galeri.show', $kegiatan->id_kegiatan)); ?>" class="bg-gray-500 text-white px-4 py-2 rounded">Kembali</a>
                </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
                        <ul><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?><li><?php echo e($error); ?></li><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?></ul>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <form action="<?php echo e(route('admin.galeri.store', $kegiatan->id_kegiatan)); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="mb-4">
                        <label class="block font-medium">Pilih foto (bisa multiple)</label>
                        <input type="file" name="fotos[]" accept="image/*" multiple required class="w-full border rounded px-2 py-1">
                        <p class="text-sm text-gray-500">Maksimal 5MB per file, format JPG/PNG.</p>
                    </div>
                    <div class="mb-4">
                        <label class="block font-medium">Judul (opsional, satu per foto)</label>
                        <div id="judul-fields">
                            <input type="text" name="judul[]" placeholder="Judul foto 1" class="w-full border rounded px-2 py-1 mb-1">
                            <input type="text" name="judul[]" placeholder="Judul foto 2" class="w-full border rounded px-2 py-1 mb-1">
                            <input type="text" name="judul[]" placeholder="Judul foto 3" class="w-full border rounded px-2 py-1 mb-1">
                        </div>
                        <p class="text-sm text-gray-500">Isi sesuai urutan file yang dipilih (maksimal sesuai jumlah file).</p>
                    </div>
                    <div class="mb-4">
                        <label class="block font-medium">Tandai sebagai unggulan</label>
                        <div id="unggulan-fields">
                            <label><input type="checkbox" name="unggulan[]" value="1"> Foto 1</label><br>
                            <label><input type="checkbox" name="unggulan[]" value="1"> Foto 2</label><br>
                            <label><input type="checkbox" name="unggulan[]" value="1"> Foto 3</label><br>
                        </div>
                        <p class="text-sm text-gray-500">Centang sesuai urutan file yang dipilih.</p>
                    </div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Upload</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Sibo\resources\views/admin/galeri/create.blade.php ENDPATH**/ ?>