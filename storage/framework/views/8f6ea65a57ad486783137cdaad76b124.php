

<?php $__env->startSection('content'); ?>
<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white border-4 border-gray-900 shadow-[15px_15px_0px_0px_rgba(234,179,8,1)] overflow-hidden">
            <div class="bg-green-800 px-8 py-6 border-b-4 border-gray-900 flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-black text-white uppercase italic tracking-tighter">Entry <span class="text-yellow-400">Kegiatan</span> Baru</h1>
                    <p class="text-[9px] text-green-100 font-bold uppercase tracking-[0.3em] mt-1">Formulir Input Data Terpusat</p>
                </div>
                <svg class="w-10 h-10 text-yellow-400 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>

            <div class="p-8 md:p-12">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
                    <div class="bg-red-600 text-white p-4 mb-8 font-bold text-xs uppercase tracking-widest shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                        Ada kesalahan input, periksa kembali field merah!
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <form action="<?php echo e(route('admin.kegiatan.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-8">
                        <div class="space-y-8">
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Pilih Kategori</label>
                                <select name="id_kategori" class="w-full border-2 border-gray-900 p-3 text-sm font-bold focus:ring-0 focus:bg-yellow-50 outline-none" required>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <option value="<?php echo e($kat->id_kategori); ?>"><?php echo e($kat->nama); ?></option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </select>
                            </div>
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Judul Kegiatan</label>
                                <input type="text" name="judul" class="w-full border-2 border-gray-900 p-3 text-sm font-bold focus:ring-0 focus:bg-yellow-50 outline-none" placeholder="Contoh: Turnamen Futsal Desa" required>
                            </div>
                        </div>

                        <div class="space-y-8">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Tanggal</label>
                                    <input type="date" name="tanggal" class="w-full border-2 border-gray-900 p-3 text-sm font-bold focus:ring-0 focus:bg-yellow-50" required>
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Waktu (WIB)</label>
                                    <input type="time" name="waktu" class="w-full border-2 border-gray-900 p-3 text-sm font-bold focus:ring-0 focus:bg-yellow-50">
                                </div>
                            </div>
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Lokasi Pelaksanaan</label>
                                <input type="text" name="lokasi" class="w-full border-2 border-gray-900 p-3 text-sm font-bold focus:ring-0 focus:bg-yellow-50" placeholder="Nama lapangan / aula">
                            </div>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Deskripsi Detail</label>
                            <textarea name="deskripsi" rows="4" class="w-full border-2 border-gray-900 p-3 text-sm font-bold focus:ring-0 focus:bg-yellow-50 outline-none" placeholder="Jelaskan detail acara..."></textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-4 md:col-span-2">
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Kuota Peserta</label>
                                <input type="number" name="kuota" value="0" class="w-full border-2 border-gray-900 p-3 text-sm font-bold focus:ring-0 focus:bg-yellow-50">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Status Publikasi</label>
                                <select name="status" class="w-full border-2 border-gray-900 p-3 text-sm font-bold focus:ring-0 focus:bg-yellow-50">
                                    <option value="aktif">Aktif / Publikasikan</option>
                                    <option value="selesai">Selesai</option>
                                    <option value="batal">Batal</option>
                                </select>
                            </div>
                        </div>

                        <div class="md:col-span-2 border-2 border-dashed border-gray-300 p-6 bg-gray-50">
                            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-4 text-center italic">Unggah Pamflet Kegiatan (JPG/PNG)</label>
                            <input type="file" name="pamflet" accept="image/*" class="block w-full text-xs font-bold text-gray-500 file:mr-4 file:py-2 file:px-6 file:border-2 file:border-gray-900 file:bg-white file:text-gray-900 hover:file:bg-black hover:file:text-white file:cursor-pointer file:uppercase file:font-black">
                        </div>
                    </div>

                    <div class="flex justify-between items-center mt-12 pt-8 border-t-4 border-gray-100">
                        <a href="<?php echo e(route('admin.kegiatan.index')); ?>" class="text-[10px] font-black uppercase text-gray-400 hover:text-red-600 tracking-widest">← Batal</a>
                        <button type="submit" class="bg-green-700 text-white font-black py-4 px-12 uppercase tracking-[0.2em] text-[11px] border-2 border-gray-900 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:bg-black transition-all">
                            Simpan Kegiatan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Sibo\resources\views/admin/kegiatan/create.blade.php ENDPATH**/ ?>