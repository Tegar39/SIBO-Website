<?php $__env->startSection('content'); ?>
<div class="pt-28 pb-12 bg-slate-50 min-h-screen font-sans">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white/70 backdrop-blur-md border border-white/50 rounded-[2.5rem] shadow-xl overflow-hidden">
            
            <div class="bg-emerald-600 px-8 py-10 flex justify-between items-center relative overflow-hidden">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-emerald-500 rounded-full opacity-20"></div>
                
                <div class="relative z-10">
                    <h1 class="text-3xl font-black text-white uppercase italic tracking-tighter">
                        Entry <span class="text-emerald-200">Kegiatan</span> Baru
                    </h1>
                    <p class="text-[10px] text-emerald-100 font-bold uppercase tracking-[0.3em] mt-1 opacity-80">
                        Formulir Input Data Terpusat
                    </p>
                </div>
                
                <div class="relative z-10 bg-white/20 backdrop-blur-md p-3 rounded-2xl rotate-3 border border-white/30 shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>

            <div class="p-8 md:p-12">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
                    <div class="bg-rose-50 border border-rose-100 p-6 mb-8 rounded-2xl flex items-center gap-4 shadow-sm text-rose-700 font-bold text-[11px] uppercase tracking-wider">
                        <svg class="w-5 h-5 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Ada kesalahan input, silakan periksa field kembali!
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <form action="<?php echo e(route('admin.kegiatan.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-8">
                        
                        <div class="space-y-8">
                            <div class="space-y-2">
                                <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Pilih Kategori</label>
                                <select name="id_kategori" class="w-full bg-slate-100/50 border-none rounded-2xl p-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500 transition-all outline-none" required>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <option value="<?php echo e($kat->id_kategori); ?>"><?php echo e($kat->nama); ?></option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </select>
                            </div>
                            
                            <div class="space-y-2">
                                <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Judul Kegiatan</label>
                                <input type="text" name="judul" class="w-full bg-slate-100/50 border-none rounded-2xl p-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500 transition-all placeholder:text-slate-300" placeholder="Contoh: Turnamen Futsal Desa" required>
                            </div>
                        </div>

                        <div class="space-y-8">
                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Tanggal</label>
                                    <input type="date" name="tanggal" class="w-full bg-slate-100/50 border-none rounded-2xl p-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500 transition-all" required>
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Waktu (WIB)</label>
                                    <input type="time" name="waktu" class="w-full bg-slate-100/50 border-none rounded-2xl p-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500 transition-all">
                                </div>
                            </div>
                            
                            <div class="space-y-2">
                                <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Lokasi Pelaksanaan</label>
                                <input type="text" name="lokasi" class="w-full bg-slate-100/50 border-none rounded-2xl p-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500 transition-all placeholder:text-slate-300" placeholder="Nama lapangan / aula">
                            </div>
                        </div>

                        <div class="md:col-span-2 space-y-2">
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Deskripsi Detail</label>
                            <textarea name="deskripsi" rows="4" class="w-full bg-slate-100/50 border-none rounded-2xl p-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500 transition-all placeholder:text-slate-300 leading-relaxed" placeholder="Jelaskan detail acara..."></textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-6 md:col-span-2">
                            <div class="space-y-2">
                                <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Kuota Peserta</label>
                                <input type="number" name="kuota" value="0" class="w-full bg-slate-100/50 border-none rounded-2xl p-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500 transition-all">
                            </div>
                            <div class="space-y-2">
                                <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Status Publikasi</label>
                                <select name="status" class="w-full bg-slate-100/50 border-none rounded-2xl p-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500 transition-all">
                                    <option value="aktif">Aktif / Publikasikan</option>
                                    <option value="selesai">Selesai</option>
                                    <option value="batal">Batal</option>
                                </select>
                            </div>
                        </div>

                        <div class="md:col-span-2 bg-slate-50 border-2 border-dashed border-slate-200 p-8 rounded-[2rem] mt-4">
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest mb-4 text-center italic">Unggah Pamflet Kegiatan (JPG/PNG)</label>
                            <input type="file" name="pamflet" accept="image/*" class="block w-full text-xs font-bold text-slate-400 file:mr-6 file:py-3 file:px-8 file:rounded-xl file:border-0 file:bg-emerald-600 file:text-white hover:file:bg-emerald-700 file:cursor-pointer file:uppercase file:tracking-widest transition-all">
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row justify-between items-center mt-12 pt-8 border-t border-slate-100 gap-6">
                        <a href="<?php echo e(route('admin.kegiatan.index')); ?>" class="group flex items-center gap-2 text-[11px] font-black uppercase text-slate-400 hover:text-rose-600 tracking-widest transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            Batal
                        </a>
                        
                        <button type="submit" class="w-full md:w-auto bg-slate-800 hover:bg-emerald-600 text-white font-bold py-4 px-14 rounded-2xl text-[11px] uppercase tracking-[0.2em] transition-all shadow-lg hover:shadow-emerald-200 hover:-translate-y-1">
                            Simpan Kegiatan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\sibo\resources\views/admin/kegiatan/create.blade.php ENDPATH**/ ?>