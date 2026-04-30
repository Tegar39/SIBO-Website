<?php $__env->startSection('content'); ?>
<div class="pt-28 pb-12 bg-slate-50 min-h-screen font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex items-center gap-5 mb-10 pb-8 border-b border-slate-200">
            <div class="bg-emerald-600 text-white p-4 rounded-2xl shadow-lg shadow-emerald-200">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <h1 class="text-4xl font-extrabold text-slate-800 tracking-tight uppercase leading-none">
                    Riwayat <span class="text-emerald-600">Pendaftaran</span>
                </h1>
                <p class="text-slate-400 text-[10px] font-bold uppercase tracking-[0.3em] mt-2">Daftar kegiatan yang pernah Anda ajukan</p>
            </div>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
            <div class="mb-8 flex items-center gap-3 bg-emerald-50 border border-emerald-100 text-emerald-700 px-6 py-4 rounded-2xl font-bold text-sm animate-fade-in shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div class="bg-white/80 backdrop-blur-md rounded-[2.5rem] border border-white shadow-xl overflow-hidden">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($pendaftarans->count() > 0): ?>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50 border-b border-slate-100">
                                <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 text-center w-20">No</th>
                                <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Info Kegiatan</th>
                                <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 text-center">Waktu Pelaksanaan</th>
                                <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 text-center">Waktu Daftar</th>
                                <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 text-center">Status</th>
                                <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $pendaftarans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <tr class="hover:bg-emerald-50/30 transition-all group">
                                    <td class="px-8 py-8 text-center">
                                        <span class="text-slate-300 font-black italic text-lg"><?php echo e($pendaftarans->firstItem() + $key); ?></span>
                                    </td>

                                    <td class="px-8 py-8">
                                        <div class="flex items-center gap-5">
                                            <div class="relative shrink-0">
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($p->kegiatan->pamflet && $p->kegiatan->pamflet->path_file): ?>
                                                    <img src="<?php echo e(asset('storage/'.$p->kegiatan->pamflet->path_file)); ?>" class="w-14 h-14 rounded-2xl object-cover shadow-md group-hover:scale-105 transition-transform duration-300 border-2 border-white">
                                                <?php else: ?>
                                                    <div class="w-14 h-14 bg-slate-100 rounded-2xl flex items-center justify-center border-2 border-white shadow-sm">
                                                        <svg class="w-6 h-6 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                    </div>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </div>
                                            <div>
                                                <p class="font-extrabold text-slate-800 uppercase tracking-tight group-hover:text-emerald-600 transition-colors text-base leading-tight">
                                                    <?php echo e($p->kegiatan->judul); ?>

                                                </p>
                                                <span class="text-[9px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-md mt-1 inline-block uppercase tracking-wider">
                                                    <?php echo e($p->kegiatan->kategori->nama ?? 'Umum'); ?>

                                                </span>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-8 py-8 text-center">
                                        <div class="inline-flex flex-col items-center gap-1">
                                            <div class="flex items-center gap-1.5 text-slate-400 uppercase text-[9px] font-black tracking-widest mb-1">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                Pelaksanaan
                                            </div>
                                            <span class="text-sm font-bold text-slate-700 bg-slate-100 px-4 py-1.5 rounded-xl border border-slate-200/50">
                                                <?php echo e(\Carbon\Carbon::parse($p->kegiatan->tanggal)->translatedFormat('d M Y')); ?>

                                            </span>
                                        </div>
                                    </td>

                                    <td class="px-8 py-8 text-center">
                                        <div class="flex flex-col gap-0.5">
                                            <span class="text-[11px] text-slate-500 font-bold tracking-wider">
                                                <?php echo e(\Carbon\Carbon::parse($p->tgl_daftar)->format('d/m/y')); ?>

                                            </span>
                                            <span class="text-[10px] text-slate-300 font-medium tracking-tight">
                                                <?php echo e(\Carbon\Carbon::parse($p->tgl_daftar)->format('H:i')); ?> WIB
                                            </span>
                                        </div>
                                    </td>

                                    <td class="px-8 py-8 text-center">
                                        <?php
                                            $statusClasses = [
                                                'pending' => 'bg-amber-50 text-amber-600 border-amber-100',
                                                'disetujui' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                                                'ditolak' => 'bg-rose-50 text-rose-600 border-rose-100',
                                            ];
                                            $currentClass = $statusClasses[$p->status] ?? 'bg-slate-50 text-slate-500 border-slate-100';
                                        ?>
                                        <span class="px-5 py-2 rounded-2xl border <?php echo e($currentClass); ?> text-[10px] font-black uppercase italic tracking-widest shadow-sm inline-block min-w-[100px]">
                                            <?php echo e($p->status); ?>

                                        </span>
                                    </td>

                                    <td class="px-8 py-8 text-right">
                                        <a href="<?php echo e(route('kegiatan.publik.show', $p->id_kegiatan)); ?>" 
                                           class="inline-flex items-center gap-2 bg-white border border-slate-200 text-slate-600 hover:bg-emerald-600 hover:text-white hover:border-emerald-600 px-6 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all active:scale-95 shadow-sm group/btn">
                                            Detail
                                            <svg class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                                        </a>
                                    </td>
                                </tr>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </tbody>
                    </table>
                </div>
                
                <div class="p-8 bg-slate-50/30 border-t border-slate-100">
                    <?php echo e($pendaftarans->links()); ?>

                </div>

            <?php else: ?>
                <div class="p-24 text-center flex flex-col items-center justify-center">
                    <div class="w-24 h-24 bg-slate-50 rounded-[2.5rem] flex items-center justify-center mb-6 border-2 border-dashed border-slate-200 shadow-inner">
                        <svg class="w-10 h-10 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <p class="font-extrabold uppercase italic text-slate-300 tracking-[0.3em] text-xs">Belum ada jejak pendaftaran</p>
                    <a href="<?php echo e(route('kegiatan.publik.index')); ?>" class="mt-8 inline-flex bg-emerald-600 text-white px-8 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-slate-800 transition-all shadow-lg shadow-emerald-100 active:scale-95">
                        Cari kegiatan sekarang
                    </a>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
</div>

<style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in { animation: fade-in 0.4s ease-out forwards; }
    
    /* Pagination styling */
    .pagination svg { width: 1.25rem; height: 1.25rem; }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\sibo\resources\views/anggota/riwayat.blade.php ENDPATH**/ ?>