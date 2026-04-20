

<?php $__env->startSection('content'); ?>
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border-2 border-green-700">
            <div class="bg-green-800 px-6 py-4 flex items-center gap-3 border-b-2 border-yellow-500">
                <div class="bg-yellow-500 rounded-full p-2">
                    <svg class="w-6 h-6 text-green-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </div>
                <h1 class="text-2xl md:text-3xl font-bold text-yellow-400">Edit Anggota</h1>
            </div>

            <div class="p-6 md:p-8">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                        <ul class="list-disc pl-5">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <li><?php echo e($error); ?></li>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </ul>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <form action="<?php echo e(route('admin.anggota.update', $anggota->id_anggota)); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Nomor Anggota</label>
                            <div class="bg-gray-100 px-4 py-2 rounded-lg border border-gray-300 text-gray-700">
                                <?php echo e($anggota->nomor_anggota); ?>

                            </div>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Email</label>
                            <div class="bg-gray-100 px-4 py-2 rounded-lg border border-gray-300 text-gray-700">
                                <?php echo e($anggota->user->email); ?>

                            </div>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" value="<?php echo e(old('nama_lengkap', $anggota->nama_lengkap)); ?>" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Kontak</label>
                            <input type="text" name="kontak" value="<?php echo e(old('kontak', $anggota->kontak)); ?>" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" value="<?php echo e(old('tempat_lahir', $anggota->tempat_lahir)); ?>" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Tanggal Lahir</label>
                            <input type="date" name="tgl_lahir" value="<?php echo e(old('tgl_lahir', $anggota->tgl_lahir)); ?>" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-gray-700 font-semibold mb-2">Alamat</label>
                            <textarea name="alamat" rows="2" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500"><?php echo e(old('alamat', $anggota->alamat)); ?></textarea>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">PAC</label>
                            <select name="pac" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500" required>
                                <option value="PAC-01" <?php echo e($anggota->pac == 'PAC-01' ? 'selected' : ''); ?>>PAC-01</option>
                                <option value="PAC-02" <?php echo e($anggota->pac == 'PAC-02' ? 'selected' : ''); ?>>PAC-02</option>
                                <option value="PAC-03" <?php echo e($anggota->pac == 'PAC-03' ? 'selected' : ''); ?>>PAC-03</option>
                                <option value="PAC-04" <?php echo e($anggota->pac == 'PAC-04' ? 'selected' : ''); ?>>PAC-04</option>
                                <option value="PAC-05" <?php echo e($anggota->pac == 'PAC-05' ? 'selected' : ''); ?>>PAC-05</option>
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-gray-700 font-semibold mb-2">Foto Profil</label>
                            <input type="file" name="foto_profil" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-green-600 file:text-white hover:file:bg-green-700">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($anggota->foto_profil && Storage::disk('public')->exists($anggota->foto_profil)): ?>
                                <div class="mt-3">
                                    <img src="<?php echo e(Storage::url($anggota->foto_profil)); ?>" class="w-24 h-24 object-cover rounded-full border-2 border-green-600 shadow">
                                    <p class="text-xs text-gray-500 mt-1">Foto saat ini</p>
                                </div>
                            <?php else: ?>
                                <div class="mt-3 text-gray-500 text-sm">Belum ada foto profil</div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                    <div class="flex justify-between items-center mt-8 pt-4 border-t border-gray-200">
                        <button type="submit" class="bg-green-700 hover:bg-green-800 text-white font-bold py-2 px-6 rounded-lg shadow transition">Update</button>
                        <a href="<?php echo e(route('admin.anggota.index')); ?>" class="text-gray-600 hover:text-gray-800">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Sibo\resources\views/admin/anggota/edit.blade.php ENDPATH**/ ?>