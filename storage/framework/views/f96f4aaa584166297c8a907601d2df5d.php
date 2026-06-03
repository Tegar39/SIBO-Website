<?php $__env->startSection('content'); ?>
<div class="pt-28 pb-12 bg-slate-50 min-h-screen font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">
                    Kelola <span class="text-emerald-600">Pendaftaran</span>
                </h1>
                <p class="text-slate-500 text-sm mt-1 font-medium flex items-center gap-2">
                    <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                    Sistem Informasi Budaya & Olahraga - Admin Panel
                </p>
            </div>
        </div>
<form method="GET" action="<?php echo e(route('admin.pendaftaran.index')); ?>" class="mb-8 bg-white rounded-3xl border border-slate-100 shadow-sm p-5">
            <div class="flex items-center justify-between flex-wrap gap-3 mb-4">
                <div>
                    <h2 class="text-sm font-black uppercase tracking-wider text-slate-700">Filter Kelola Peserta</h2>
                </div>
                <a href="<?php echo e(route('admin.pendaftaran.index')); ?>" class="text-xs font-black uppercase tracking-widest text-emerald-700 hover:text-emerald-900">Reset Filter</a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-5 gap-3">
                <input type="text" name="q" value="<?php echo e(request('q')); ?>" placeholder="Cari kegiatan/lokasi..." class="md:col-span-2 rounded-2xl border-slate-200 text-sm focus:border-emerald-500 focus:ring-emerald-500">
                <select name="status_kegiatan" class="rounded-2xl border-slate-200 text-sm focus:border-emerald-500 focus:ring-emerald-500">
                    <option value="">Semua Status</option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = ['aktif' => 'Aktif', 'tutup' => 'Ditutup', 'selesai' => 'Selesai', 'batal' => 'Batal']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <option value="<?php echo e($value); ?>" <?php echo e(request('status_kegiatan') === $value ? 'selected' : ''); ?>><?php echo e($label); ?></option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </select>
                <select name="bulan" class="rounded-2xl border-slate-200 text-sm focus:border-emerald-500 focus:ring-emerald-500">
                    <option value="">Semua Bulan</option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = range(1,12); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <option value="<?php echo e($m); ?>" <?php echo e((int) request('bulan') === $m ? 'selected' : ''); ?>><?php echo e(\Carbon\Carbon::create(null, $m, 1)->locale('id')->translatedFormat('F')); ?></option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </select>
                <div class="flex gap-3">
                    <select name="tahun" class="w-full rounded-2xl border-slate-200 text-sm focus:border-emerald-500 focus:ring-emerald-500">
                        <option value="">Tahun</option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $availableYears; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <option value="<?php echo e($year); ?>" <?php echo e((int) request('tahun') === (int) $year ? 'selected' : ''); ?>><?php echo e($year); ?></option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </select>
                    <button type="submit" class="px-5 rounded-2xl bg-slate-900 hover:bg-emerald-600 text-white text-xs font-black uppercase tracking-widest">Filter</button>
                </div>
            </div>
        </form>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($kegiatans->count() > 0): ?>
            <div class="bg-white/70 backdrop-blur-md rounded-[2rem] border border-white/50 shadow-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-slate-50/50 border-b border-white">
                            <tr>
                                <th class="px-8 py-6 text-xs font-bold uppercase tracking-widest text-slate-500">Info Kegiatan</th>
                                <th class="px-6 py-6 text-xs font-bold uppercase tracking-widest text-slate-500 text-center">Status Kapasitas</th>
                                <th class="px-6 py-6 text-xs font-bold uppercase tracking-widest text-slate-500 text-center">Pendaftar</th>
                                <th class="px-8 py-6 text-xs font-bold uppercase tracking-widest text-slate-500 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/60">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $kegiatans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-4">
                                        <div class="w-14 h-14 rounded-2xl bg-slate-100 overflow-hidden flex-shrink-0 border-2 border-white shadow-sm">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($k->pamflet && Storage::disk('public')->exists($k->pamflet->path_file)): ?>
                                                <img src="<?php echo e(Storage::url($k->pamflet->path_file)); ?>" class="w-full h-full object-cover">
                                            <?php else: ?>
                                                <div class="w-full h-full flex flex-col items-center justify-center text-slate-300 bg-slate-50/50">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                </div>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-slate-800 text-sm group-hover:text-emerald-600 transition-colors line-clamp-1 mb-1">
                                                <?php echo e($k->judul); ?>

                                            </h3>
                                            <div class="flex items-center gap-1.5 text-[11px] font-bold text-slate-400 uppercase tracking-tight">
                                                <svg class="w-3.5 h-3.5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                <?php echo e(\Carbon\Carbon::parse($k->tanggal)->format('d M Y')); ?>

                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-5 align-middle">
                                    <div class="max-w-[140px] mx-auto">
                                        <?php
                                            $persen = $k->kuota > 0 ? min(($k->pendaftarans_count / $k->kuota) * 100, 100) : 0;
                                        ?>
                                        <div class="flex justify-between items-center mb-2">
                                            <span class="text-[10px] font-bold uppercase text-slate-400 tracking-wider">Progress</span>
                                            <span class="text-[10px] font-black text-slate-600 italic"><?php echo e(round($persen)); ?>%</span>
                                        </div>
                                        <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden border border-slate-200/50">
                                            <div class="bg-emerald-500 h-full transition-all duration-700 ease-out rounded-full" style="width: <?php echo e($persen); ?>%"></div>
                                        </div>
                                        <p class="text-[10px] font-bold text-slate-400 mt-1.5 text-center">
                                            Kuota: <?php echo e($k->kuota ?: '∞'); ?>

                                        </p>
                                    </div>
                                </td>

                                <td class="px-6 py-5 text-center align-middle">
                                    <span class="inline-flex items-center justify-center bg-emerald-50/80 text-emerald-600 font-black text-xs px-4 py-2 rounded-xl border border-emerald-100/50 shadow-sm shadow-emerald-100/20">
                                        <?php echo e($k->pendaftarans_count); ?> <span class="text-[10px] opacity-70 ml-1 font-bold uppercase">Orang</span>
                                    </span>
                                </td>

                                <td class="px-8 py-5 text-right align-middle">
                                    <a href="<?php echo e(route('admin.pendaftaran.show', $k->id_kegiatan)); ?>" 
                                       class="inline-flex items-center justify-center gap-2 bg-white border border-slate-200 hover:border-emerald-500 hover:bg-emerald-50 text-slate-600 hover:text-emerald-600 font-bold py-2.5 px-5 rounded-xl text-[11px] uppercase tracking-wider transition-all shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                        </svg>
                                        Peserta
                                    </a>
                                </td>
                            </tr>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-8 px-2">
                <?php echo e($kegiatans->links()); ?>

            </div>
        <?php else: ?>
            <div class="text-center py-24 bg-white/70 backdrop-blur-md rounded-[2rem] border-2 border-dashed border-slate-200/60 shadow-sm">
                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-300 border border-slate-100">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <h3 class="text-sm font-bold text-slate-400 uppercase tracking-[0.2em]">Hasil tidak ditemukan</h3>
                <a href="<?php echo e(route('admin.pendaftaran.index')); ?>" class="text-emerald-600 font-bold text-xs hover:underline mt-4 inline-block tracking-widest">
                    LIHAT SEMUA KEGIATAN
                </a>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</div>

<style>
    /* Kustomisasi scrollbar table yang lebih halus */
    .overflow-x-auto::-webkit-scrollbar { height: 6px; }
    .overflow-x-auto::-webkit-scrollbar-track { background: transparent; }
    .overflow-x-auto::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    .overflow-x-auto::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Sibo\resources\views/admin/pendaftaran/index.blade.php ENDPATH**/ ?>