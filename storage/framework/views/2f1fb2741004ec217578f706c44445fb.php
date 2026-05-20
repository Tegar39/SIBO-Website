<?php $__env->startSection('content'); ?>
<div class="pt-28 pb-12 bg-slate-50 min-h-screen font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($kegiatan->status == 'selesai'): ?>
            
            <div class="mb-8">
                <a href="<?php echo e(route('admin.absensi.index')); ?>" class="inline-flex items-center gap-2 text-[11px] font-black uppercase tracking-[0.2em] text-slate-400 hover:text-emerald-600 transition-all group">
                    <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke daftar
                </a>
            </div>

            
            <div class="bg-white/80 backdrop-blur-xl rounded-[2.5rem] border border-white shadow-2xl shadow-slate-200/50 overflow-hidden transition-all">
                
                
                <div class="p-8 md:p-12 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-8 bg-gradient-to-br from-white/50 to-transparent">
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <span class="px-3 py-1.5 bg-emerald-100 text-emerald-700 rounded-lg text-[10px] font-black uppercase tracking-widest">
                                Lembar Absensi
                            </span>
                            <span class="text-slate-400 text-xs font-bold flex items-center gap-2">
                                <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
                                <?php echo e(\Carbon\Carbon::parse($kegiatan->tanggal)->translatedFormat('d F Y')); ?>

                            </span>
                        </div>
                        <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight">
                            <?php echo e($kegiatan->judul); ?>

                        </h1>
                    </div>
                    
                    
                    <div class="flex items-center gap-5 bg-slate-900 text-white px-7 py-5 rounded-[2rem] shadow-2xl shadow-slate-900/20">
                        <div class="text-right">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Total Peserta</p>
                            <p class="text-3xl font-black leading-none"><?php echo e($pendaftarans->count()); ?></p>
                        </div>
                        <div class="w-12 h-12 bg-emerald-500 rounded-2xl flex items-center justify-center shadow-lg shadow-emerald-500/40">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="p-8 md:p-12">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
                        <div class="mb-10 flex items-center gap-4 bg-emerald-50 border border-emerald-100 text-emerald-800 px-7 py-5 rounded-3xl font-bold text-sm animate-fade-in">
                            <div class="w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <form action="<?php echo e(route('admin.absensi.store', $kegiatan->id_kegiatan)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="overflow-hidden rounded-[2rem] border border-slate-100 bg-slate-50/30 shadow-inner">
                            <div class="overflow-x-auto">
                                <table class="w-full text-left border-collapse">
                                    <thead>
                                        <tr class="bg-slate-100/50">
                                            <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.25em] text-slate-500 w-24 text-center">No</th>
                                            <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.25em] text-slate-500">Data Anggota</th>
                                            <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.25em] text-slate-500 text-center">Status Kehadiran</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100 bg-white/40">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $pendaftarans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <tr class="hover:bg-emerald-50/40 transition-all group/row">
                                            <td class="px-8 py-6 text-center">
                                                <span class="text-sm font-black text-slate-300 group-hover/row:text-emerald-500 transition-colors tracking-tighter">
                                                    <?php echo e(str_pad($key + 1, 2, '0', STR_PAD_LEFT)); ?>

                                                </span>
                                            </td>
                                            <td class="px-8 py-6">
                                                <div class="font-bold text-slate-800 uppercase text-[13px] group-hover/row:text-emerald-700 transition-colors">
                                                    <?php echo e($p->anggota->nama_lengkap); ?>

                                                </div>
                                                <div class="text-[10px] font-bold text-slate-400 mt-1 flex items-center gap-1.5">
                                                    <span class="w-1 h-1 bg-slate-200 rounded-full"></span>
                                                    ID: <?php echo e($p->anggota->nomor_anggota); ?>

                                                </div>
                                            </td>
                                            <td class="px-8 py-6">
                                                <div class="flex justify-center">
                                                    <label class="relative inline-flex items-center cursor-pointer group/toggle select-none">
                                                        <input type="checkbox" name="hadir[<?php echo e($p->id_daftar); ?>]" value="1" 
                                                            <?php echo e($p->absensi && $p->absensi->hadir ? 'checked' : ''); ?>

                                                            class="sr-only peer">
                                                        <div class="w-14 h-7 bg-slate-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-white after:rounded-full after:h-[20px] after:w-[20px] after:transition-all after:duration-300 peer-checked:bg-emerald-500 shadow-inner"></div>
                                                        <span class="ml-4 text-[10px] font-black uppercase text-slate-400 peer-checked:text-emerald-600 tracking-[0.15em] transition-colors w-12">
                                                            <?php echo e($p->absensi && $p->absensi->hadir ? 'Hadir' : 'Absen'); ?>

                                                        </span>
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        
                        <div class="mt-12 flex flex-col md:flex-row items-center justify-between gap-6 px-4">
                            <div class="flex items-center gap-3 text-slate-400">
                                <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                </svg>
                                <p class="text-[11px] font-bold italic tracking-wide">
                                    Verifikasi kembali kehadiran peserta sebelum finalisasi data.
                                </p>
                            </div>
                            <button type="submit" class="group bg-slate-900 hover:bg-emerald-600 text-white font-black px-12 py-5 rounded-[1.5rem] text-[11px] uppercase tracking-[0.25em] transition-all hover:shadow-2xl hover:shadow-emerald-500/30 active:scale-[0.98] flex items-center gap-4">
                                Simpan Absensi Akhir
                                <svg class="w-4 h-4 transition-transform group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        <?php else: ?>
            
            <div class="text-center py-32 bg-white/80 backdrop-blur-xl rounded-[3rem] border border-white shadow-2xl shadow-slate-200/50">
                <div class="w-24 h-24 rounded-[2rem] flex items-center justify-center mx-auto mb-8 shadow-inner
                    <?php echo e($kegiatan->status == 'tutup' ? 'bg-orange-50 text-orange-500' : 
                       ($kegiatan->status == 'aktif' ? 'bg-emerald-50 text-emerald-500' : 'bg-slate-100 text-slate-400')); ?>">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($kegiatan->status == 'tutup'): ?>
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <?php elseif($kegiatan->status == 'aktif'): ?>
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    <?php else: ?>
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                
                <h3 class="text-2xl font-black uppercase tracking-widest mb-3
                    <?php echo e($kegiatan->status == 'tutup' ? 'text-orange-600' : 
                       ($kegiatan->status == 'aktif' ? 'text-emerald-600' : 'text-slate-600')); ?>">
                    Kegiatan <?php echo e($kegiatan->status == 'tutup' ? 'Ditutup' : ($kegiatan->status == 'aktif' ? 'Sedang Berlangsung' : ucfirst($kegiatan->status))); ?>

                </h3>
                
                <p class="text-slate-500 font-bold text-sm max-w-xs mx-auto leading-relaxed">
                    <?php echo e($kegiatan->status == 'tutup' ? 'Absensi tersedia 1 jam setelah kegiatan selesai.' : 
                       ($kegiatan->status == 'aktif' ? 'Harap tunggu hingga kegiatan selesai untuk memulai absensi.' : 'Data absensi tidak tersedia untuk status kegiatan ini.')); ?>

                </p>

                <div class="mt-10">
                    <a href="<?php echo e(route('admin.absensi.index')); ?>" class="inline-flex items-center gap-2 text-[11px] font-black uppercase tracking-[0.2em] text-emerald-600 bg-emerald-50 px-8 py-4 rounded-2xl hover:bg-emerald-600 hover:text-white transition-all">
                        ← Kembali ke Dashboard
                    </a>
                </div>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</div>

<style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in { animation: fade-in 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
    
    .overflow-x-auto::-webkit-scrollbar { height: 8px; }
    .overflow-x-auto::-webkit-scrollbar-track { background: #f8fafc; }
    .overflow-x-auto::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 20px; border: 2px solid #f8fafc; }
    .overflow-x-auto::-webkit-scrollbar-thumb:hover { background: #cbd5e1; }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\sibo\resources\views/admin/absensi/create.blade.php ENDPATH**/ ?>