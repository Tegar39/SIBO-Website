<?php $__env->startSection('content'); ?>
<div class="pt-28 pb-12 bg-slate-50 min-h-screen font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 gap-6">
            <div>
                <p class="text-emerald-600 text-[10px] font-black uppercase tracking-[0.3em] mb-1">Manajemen Peserta</p>
                <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">
                    <?php echo e($kegiatan->judul); ?>

                </h1>
                <p class="text-slate-500 text-sm mt-1 font-medium flex items-center gap-2">
                    <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                    Daftar pendaftar yang masuk ke sistem
                </p>
            </div>
            <div class="flex gap-3">
                <a href="<?php echo e(route('admin.pendaftaran.create', $kegiatan->id_kegiatan)); ?>" 
                   class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-2xl text-[11px] font-black uppercase tracking-widest transition-all shadow-md shadow-emerald-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Peserta
                </a>
                <a href="<?php echo e(route('admin.pendaftaran.index')); ?>" class="inline-flex items-center gap-2 bg-white border border-slate-200 text-slate-600 px-6 py-3 rounded-2xl text-[11px] font-black uppercase tracking-widest hover:bg-slate-50 transition-all shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-10">
            <div class="bg-white/70 backdrop-blur-md border border-white/50 p-6 rounded-3xl shadow-sm">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Total Kuota</p>
                <p class="text-2xl font-black text-slate-800"><?php echo e($kegiatan->kuota ?: '∞'); ?></p>
            </div>
            <div class="bg-emerald-600 p-6 rounded-3xl shadow-lg shadow-emerald-100">
                <p class="text-[10px] font-bold text-emerald-100 uppercase tracking-wider mb-1">Status Kegiatan</p>
                <p class="text-2xl font-black text-white uppercase"><?php echo e($kegiatan->status); ?></p>
            </div>
            <div class="bg-white/70 backdrop-blur-md border border-white/50 p-6 rounded-3xl shadow-sm">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Total Pendaftar</p>
                <p class="text-2xl font-black text-slate-800"><?php echo e($pendaftarans->total()); ?></p>
            </div>
            <div class="bg-white/70 backdrop-blur-md border border-white/50 p-6 rounded-3xl shadow-sm">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Disetujui</p>
                <p class="text-2xl font-black text-emerald-600"><?php echo e($pendaftarans->where('status','disetujui')->count()); ?></p>
            </div>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
            <div class="mb-8 flex items-center gap-3 bg-emerald-50 border border-emerald-100 text-emerald-700 px-6 py-4 rounded-2xl font-bold text-sm shadow-sm animate-fade-in">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('error')): ?>
            <div class="mb-8 flex items-center gap-3 bg-rose-50 border border-rose-100 text-rose-700 px-6 py-4 rounded-2xl font-bold text-sm shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div class="bg-white/70 backdrop-blur-md rounded-[2rem] border border-white/50 shadow-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50/50 border-b border-white">
                        <tr>
                            <th class="px-6 py-6 text-[10px] font-bold uppercase tracking-widest text-slate-500 text-center">No</th>
                            <th class="px-6 py-6 text-[10px] font-bold uppercase tracking-widest text-slate-500">Nama Peserta</th>
                            <th class="px-6 py-6 text-[10px] font-bold uppercase tracking-widest text-slate-500">Kontak</th>
                            <th class="px-6 py-6 text-[10px] font-bold uppercase tracking-widest text-slate-500 text-center">Status</th>
                            <th class="px-6 py-6 text-[10px] font-bold uppercase tracking-widest text-slate-500 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/60">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $pendaftarans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="px-6 py-5 text-xs font-bold text-slate-400 text-center">
                                <?php echo e($pendaftarans->firstItem() + $key); ?>

                            </td>
                            <td class="px-6 py-5">
                                <div class="text-sm font-bold text-slate-800 group-hover:text-emerald-600 transition-colors">
                                    <?php echo e($p->display_name); ?>

                                </div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($p->nama_peserta): ?>
                                    <div class="text-[10px] text-slate-400 italic mt-0.5">(Didaftarkan oleh akun)</div>
                                <?php elseif($p->anggota): ?>
                                    <div class="text-[10px] text-slate-400 mt-0.5">Anggota: <?php echo e($p->anggota->nomor_anggota); ?></div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                            <td class="px-6 py-5 text-sm font-medium text-slate-600">
                                <?php echo e($p->display_contact); ?>

                            </td>
                            <td class="px-6 py-5 text-center">
                                <span class="inline-block px-4 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-wider
                                    <?php if($p->status=='pending'): ?> bg-slate-100 text-slate-500
                                    <?php elseif($p->status=='disetujui'): ?> bg-emerald-100 text-emerald-600
                                    <?php elseif($p->status=='ditolak'): ?> bg-rose-100 text-rose-600
                                    <?php else: ?> bg-gray-100 text-gray-500 <?php endif; ?>">
                                    <?php echo e($p->status); ?>

                                </span>
                            </td>
                            <td class="px-6 py-5">
                                <form action="<?php echo e(route('admin.pendaftaran.update', $p->id_daftar)); ?>" method="POST" class="flex items-center gap-2 justify-center">
                                    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                                    <select name="status" class="text-[11px] font-bold bg-white/50 border border-slate-200 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 rounded-xl py-2 px-3 uppercase outline-none transition-all">
                                        <option value="pending" <?php echo e($p->status=='pending' ? 'selected' : ''); ?>>Pending</option>
                                        <option value="disetujui" <?php echo e($p->status=='disetujui' ? 'selected' : ''); ?>>Setujui</option>
                                        <option value="ditolak" <?php echo e($p->status=='ditolak' ? 'selected' : ''); ?>>Tolak</option>
                                        <option value="batal" <?php echo e($p->status=='batal' ? 'selected' : ''); ?>>Batal</option>
                                    </select>
                                    <button type="submit" class="bg-slate-800 text-white p-2.5 rounded-xl hover:bg-emerald-600 transition-all shadow-sm group/btn">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center text-slate-400 italic">
                                Belum ada pendaftar untuk kegiatan ini.
                                <br>
                                <a href="<?php echo e(route('admin.pendaftaran.create', $kegiatan->id_kegiatan)); ?>" class="text-emerald-600 font-bold underline mt-2 inline-block">+ Tambah peserta baru</a>
                            </td>
                        </tr>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-8">
            <?php echo e($pendaftarans->links()); ?>

        </div>
    </div>
</div>

<style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in { animation: fade-in 0.4s ease-out forwards; }
    
    .overflow-x-auto::-webkit-scrollbar { height: 6px; }
    .overflow-x-auto::-webkit-scrollbar-track { background: transparent; }
    .overflow-x-auto::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Sibo\resources\views/admin/pendaftaran/show.blade.php ENDPATH**/ ?>