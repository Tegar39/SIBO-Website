<?php $__env->startSection('content'); ?>
<div class="pt-28 pb-12 bg-slate-50 min-h-screen font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">
                    Kelola <span class="text-emerald-600">Kegiatan</span>
                </h1>
                <p class="text-slate-500 text-sm mt-1 font-medium flex items-center gap-2">
                    <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                    Sistem Informasi Budaya & Olahraga - Admin Panel
                </p>
            </div>
            <a href="<?php echo e(route('admin.kegiatan.create')); ?>" 
               class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold py-3 px-6 rounded-2xl transition-all shadow-lg shadow-emerald-200 hover:-translate-y-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Tambah Kegiatan
            </a>
        </div>

        <div class="mb-10 bg-white/70 backdrop-blur-md border border-white/50 p-4 rounded-3xl shadow-sm">
            <form action="<?php echo e(route('admin.kegiatan.index')); ?>" method="GET" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" name="search" value="<?php echo e(request('search')); ?>" 
                        placeholder="Cari judul atau lokasi..." 
                        class="w-full bg-slate-100/50 border-none pl-11 pr-4 py-3 rounded-2xl text-sm font-semibold text-slate-700 focus:ring-2 focus:ring-emerald-500 transition-all">
                </div>

                <div class="md:w-64">
                    <select name="kategori" onchange="this.form.submit()" 
                        class="w-full bg-slate-100/50 border-none px-4 py-3 rounded-2xl text-sm font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500 appearance-none cursor-pointer">
                        <option value="">SEMUA KATEGORI</option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <option value="<?php echo e($kat->id_kategori); ?>" <?php echo e(request('kategori') == $kat->id_kategori ? 'selected' : ''); ?>>
                                <?php echo e(strtoupper($kat->nama)); ?>

                            </option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </select>
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="bg-slate-800 text-white px-8 py-3 rounded-2xl font-bold text-sm hover:bg-slate-900 transition-all">
                        FILTER
                    </button>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(request('search') || request('kategori')): ?>
                        <a href="<?php echo e(route('admin.kegiatan.index')); ?>" class="bg-rose-50 text-rose-600 px-6 py-3 rounded-2xl font-bold text-sm flex items-center justify-center hover:bg-rose-100 transition-all">
                            RESET
                        </a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </form>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
            <div class="bg-emerald-50 border border-emerald-100 text-emerald-700 px-6 py-4 rounded-2xl mb-8 flex items-center gap-3">
                <div class="w-8 h-8 bg-emerald-500 text-white rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <span class="text-sm font-bold"><?php echo e(session('success')); ?></span>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($kegiatans->count() > 0): ?>
            <div class="bg-white/70 backdrop-blur-md rounded-3xl border border-white/50 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-800/5 text-slate-600 border-b border-slate-100 text-xs font-black uppercase tracking-wider">
                                <th class="px-6 py-4">Kegiatan</th>
                                <th class="px-6 py-4">Jadwal & Lokasi</th>
                                <th class="px-6 py-4 text-center">Kuota</th>
                                <th class="px-6 py-4 text-center">Status</th>
                                <th class="px-6 py-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $kegiatans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <tr class="hover:bg-white/50 transition-colors group">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-4">
                                            <div class="w-12 h-12 rounded-xl bg-slate-100 flex-shrink-0 overflow-hidden border border-slate-200">
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($k->pamflet && Storage::disk('public')->exists($k->pamflet->path_file)): ?>
                                                    <img src="<?php echo e(Storage::url($k->pamflet->path_file)); ?>" class="w-full h-full object-cover">
                                                <?php else: ?>
                                                    <div class="w-full h-full flex items-center justify-center text-slate-300">
                                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                    </div>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </div>
                                            <div class="min-w-0">
                                                <p class="text-sm font-bold text-slate-800 line-clamp-1"><?php echo e($k->judul); ?></p>
                                                <span class="inline-block mt-1 px-2 py-0.5 text-[9px] font-black bg-emerald-50 text-emerald-700 rounded border border-emerald-100 uppercase">
                                                    <?php echo e($k->kategori->nama ?? 'Umum'); ?>

                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col gap-1">
                                            <div class="flex items-center gap-2 text-xs font-bold text-slate-700">
                                                <svg class="w-3.5 h-3.5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                <?php echo e(\Carbon\Carbon::parse($k->tanggal)->format('d M Y')); ?>

                                            </div>
                                            <div class="flex items-center gap-2 text-[11px] font-semibold text-slate-500">
                                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                                <?php echo e($k->lokasi ?: 'Internal'); ?>

                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center text-xs font-bold text-slate-700">
                                        <?php echo e($k->kuota ?: '∞'); ?>

                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <?php
                                            $statusBadge = [
                                                'aktif' => 'bg-emerald-100 text-emerald-700',
                                                'tutup' => 'bg-orange-100 text-orange-700',
                                                'selesai' => 'bg-slate-100 text-slate-500',
                                                'batal' => 'bg-rose-100 text-rose-600'
                                            ];
                                            $statusLabel = [
                                                'aktif' => 'Aktif',
                                                'tutup' => 'Ditutup',
                                                'selesai' => 'Selesai',
                                                'batal' => 'Batal'
                                            ];
                                        ?>
                                        <span class="inline-block px-2.5 py-1 text-[9px] font-black rounded-lg uppercase tracking-tight <?php echo e($statusBadge[$k->status] ?? 'bg-slate-100 text-slate-500'); ?>">
                                            <?php echo e($statusLabel[$k->status] ?? $k->status); ?>

                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end gap-2">
                                            <a href="<?php echo e(route('admin.kegiatan.edit', $k->id_kegiatan)); ?>" 
                                               class="p-2 bg-white border border-slate-200 rounded-lg text-blue-600 hover:bg-blue-50 transition-all shadow-sm"
                                               title="Edit Data">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </a>
                                            <form action="<?php echo e(route('admin.kegiatan.destroy', $k->id_kegiatan)); ?>" method="POST" onsubmit="return confirm('Hapus kegiatan ini?')">
                                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="p-2 bg-white border border-slate-200 rounded-lg text-rose-600 hover:bg-rose-50 transition-all shadow-sm" title="Hapus">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-8">
                <?php echo e($kegiatans->links()); ?>

            </div>
        <?php else: ?>
            <div class="text-center py-24 bg-white/70 backdrop-blur-md rounded-3xl border-2 border-dashed border-slate-200">
                <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-300">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-400 uppercase tracking-widest">Kegiatan Tidak Ditemukan</h3>
                <a href="<?php echo e(route('admin.kegiatan.index')); ?>" class="text-emerald-600 font-bold text-sm hover:underline mt-4 block">TAMPILKAN SEMUA</a>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Sibo\resources\views/admin/kegiatan/index.blade.php ENDPATH**/ ?>