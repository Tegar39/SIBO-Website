<?php $__env->startSection('content'); ?>
<div class="pt-28 pb-12 bg-slate-50 min-h-screen font-sans">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white/70 backdrop-blur-md border border-white/50 rounded-[2.5rem] shadow-xl overflow-hidden">
            
            <div class="bg-emerald-600 px-8 py-10 flex justify-between items-center relative overflow-hidden">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-emerald-500 rounded-full opacity-20"></div>
                
                <div class="relative z-10">
                    <h1 class="text-3xl font-black text-white uppercase italic tracking-tighter">
                        Edit <span class="text-emerald-200">Record</span>
                    </h1>
                    <p class="text-[10px] text-emerald-100 font-bold uppercase tracking-[0.3em] mt-1 opacity-80 font-mono">
                        ID KEGIATAN: #<?php echo e($kegiatan->id_kegiatan); ?>

                    </p>
                </div>
                
                <div class="relative z-10 bg-white/20 backdrop-blur-md p-3 rounded-2xl rotate-3 border border-white/30 shadow-lg text-white">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </div>
            </div>

            <div class="p-8 md:p-12">
                <form action="<?php echo e(route('admin.kegiatan.update', $kegiatan->id_kegiatan)); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-8">
                        <div class="space-y-2">
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Kategori</label>
                            <select name="id_kategori" class="w-full bg-slate-100/50 border-none rounded-2xl p-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500 transition-all outline-none" required>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                    <option value="<?php echo e($kat->id_kategori); ?>" <?php echo e($kegiatan->id_kategori == $kat->id_kategori ? 'selected' : ''); ?>><?php echo e($kat->nama); ?></option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Judul Kegiatan</label>
                            <input type="text" name="judul" value="<?php echo e(old('judul', $kegiatan->judul)); ?>" class="w-full bg-slate-100/50 border-none rounded-2xl p-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500 transition-all" required>
                        </div>

                        <div class="md:col-span-2 space-y-2">
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Deskripsi</label>
                            <textarea name="deskripsi" rows="4" class="w-full bg-slate-100/50 border-none rounded-2xl p-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500 transition-all leading-relaxed"><?php echo e(old('deskripsi', $kegiatan->deskripsi)); ?></textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Tanggal</label>
                                <input type="date" name="tanggal" value="<?php echo e(old('tanggal', $kegiatan->tanggal)); ?>" class="w-full bg-slate-100/50 border-none rounded-2xl p-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500 transition-all" required>
                            </div>
                            <div class="space-y-2">
                                <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Waktu</label>
                                <input type="time" name="waktu" value="<?php echo e(old('waktu', $kegiatan->waktu)); ?>" class="w-full bg-slate-100/50 border-none rounded-2xl p-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500 transition-all">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Lokasi</label>
                            <input type="text" name="lokasi" value="<?php echo e(old('lokasi', $kegiatan->lokasi)); ?>" class="w-full bg-slate-100/50 border-none rounded-2xl p-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500 transition-all">
                        </div>

                        <div class="space-y-2">
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Status</label>
                            <select name="status" class="w-full bg-slate-100/50 border-none rounded-2xl p-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500 transition-all outline-none">
                                <option value="aktif" <?php echo e($kegiatan->status == 'aktif' ? 'selected' : ''); ?>>Aktif</option>
                                <option value="tutup" <?php echo e($kegiatan->status == 'tutup' ? 'selected' : ''); ?>>Tutup Pendaftaran</option>
                                <option value="selesai" <?php echo e($kegiatan->status == 'selesai' ? 'selected' : ''); ?>>Selesai</option>
                                <option value="batal" <?php echo e($kegiatan->status == 'batal' ? 'selected' : ''); ?>>Batal</option>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Kuota</label>
                            <input type="number" name="kuota" value="<?php echo e(old('kuota', $kegiatan->kuota)); ?>" class="w-full bg-slate-100/50 border-none rounded-2xl p-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500 transition-all">
                        </div>

                        <div class="md:col-span-2 bg-slate-50 border-2 border-dashed border-slate-200 p-8 rounded-[2rem] mt-4 shadow-inner">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center">
                                <div class="text-center">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($kegiatan->pamflet): ?>
                                        <div class="relative inline-block">
                                            <img src="<?php echo e(Storage::url($kegiatan->pamflet->path_file)); ?>" class="w-32 h-32 mx-auto object-cover rounded-2xl border-4 border-white shadow-lg ring-1 ring-emerald-100">
                                            <div class="absolute -top-2 -right-2 bg-emerald-500 text-white p-1 rounded-full shadow-md">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path></svg>
                                            </div>
                                        </div>
                                        <p class="text-[9px] font-black uppercase text-emerald-600 tracking-widest mt-3">Pamflet Saat Ini</p>
                                    <?php else: ?>
                                        <div class="w-32 h-32 mx-auto bg-slate-200 rounded-2xl flex items-center justify-center border-2 border-dashed border-slate-300">
                                            <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                                <div class="md:col-span-2 space-y-3">
                                    <label class="block text-[11px] font-black uppercase tracking-widest text-slate-400 text-center md:text-left ml-1">Ganti Pamflet Baru?</label>
                                    <input type="file" name="pamflet" accept="image/*" class="block w-full text-xs font-bold text-slate-400 file:mr-6 file:py-3 file:px-8 file:rounded-xl file:border-0 file:bg-emerald-600 file:text-white hover:file:bg-emerald-700 file:cursor-pointer transition-all uppercase tracking-widest">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row justify-between items-center mt-12 pt-8 border-t border-slate-100 gap-6">
                        <a href="<?php echo e(route('admin.kegiatan.index')); ?>" class="group flex items-center gap-2 text-[11px] font-black uppercase text-slate-400 hover:text-rose-600 tracking-widest transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            Kembali
                        </a>
                        
                        <button type="submit" class="w-full md:w-auto bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-4 px-14 rounded-2xl text-[11px] uppercase tracking-[0.2em] transition-all shadow-lg shadow-emerald-100 hover:-translate-y-1">
                            Update Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Sibo\resources\views/admin/kegiatan/edit.blade.php ENDPATH**/ ?>