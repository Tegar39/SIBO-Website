

<?php $__env->startSection('content'); ?>
<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <div class="flex items-center gap-4 mb-10 border-b-4 border-gray-900 pb-6">
            <div class="bg-green-700 text-white p-3 border-2 border-gray-900 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <h1 class="text-4xl font-black text-gray-900 uppercase italic tracking-tighter">Riwayat <span class="text-green-700">Pendaftaran</span></h1>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
            <div class="bg-green-100 border-4 border-gray-900 p-4 mb-6 font-black uppercase text-xs shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div class="bg-white border-4 border-gray-900 shadow-[10px_10px_0px_0px_rgba(0,0,0,1)] overflow-hidden">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($pendaftarans->count() > 0): ?>
                <div class="overflow-x-auto text-left">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-900 text-white">
                                <th class="px-6 py-4 text-[10px] font-black uppercase tracking-[0.2em]">No</th>
                                <th class="px-6 py-4 text-[10px] font-black uppercase tracking-[0.2em]">Nama Kegiatan</th>
                                <th class="px-6 py-4 text-[10px] font-black uppercase tracking-[0.2em]">Waktu Pelaksanaan</th>
                                <th class="px-6 py-4 text-[10px] font-black uppercase tracking-[0.2em]">Waktu Daftar</th>
                                <th class="px-6 py-4 text-[10px] font-black uppercase tracking-[0.2em]">Status</th>
                                <th class="px-6 py-4 text-[10px] font-black uppercase tracking-[0.2em]">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y-4 divide-gray-900 font-bold">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $pendaftarans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 text-gray-400 font-black italic"><?php echo e($key+1); ?></td>
                                    <td class="px-6 py-4 uppercase tracking-tighter text-lg text-gray-900"><?php echo e($p->kegiatan->judul); ?></td>
                                    <td class="px-6 py-4 text-xs">
                                        <span class="bg-yellow-400 border border-gray-900 px-2 py-1 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                                            <?php echo e(\Carbon\Carbon::parse($p->kegiatan->tanggal)->format('d M Y')); ?>

                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-[10px] text-gray-500 font-black uppercase">
                                        <?php echo e(\Carbon\Carbon::parse($p->tgl_daftar)->format('d/m/y - H:i')); ?>

                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-4 py-1 border-2 border-gray-900 text-[10px] font-black uppercase italic
                                            <?php if($p->status=='pending'): ?> bg-blue-400
                                            <?php elseif($p->status=='disetujui'): ?> bg-green-500
                                            <?php elseif($p->status=='ditolak'): ?> bg-red-500
                                            <?php else: ?> bg-gray-400 <?php endif; ?>">
                                            <?php echo e($p->status); ?>

                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="<?php echo e(route('kegiatan.publik.show', $p->id_kegiatan)); ?>" class="bg-white border-2 border-gray-900 text-gray-900 px-4 py-2 text-[10px] font-black uppercase shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-0.5 hover:translate-y-0.5 transition-all">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="p-4 bg-gray-50 border-t-4 border-gray-900">
                    <?php echo e($pendaftarans->links()); ?>

                </div>
            <?php else: ?>
                <div class="p-20 text-center flex flex-col items-center justify-center">
                    <div class="w-20 h-20 bg-gray-100 border-4 border-dashed border-gray-400 flex items-center justify-center mb-4">
                        <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <p class="font-black uppercase italic text-gray-400 tracking-widest">Belum ada jejak pendaftaran</p>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Sibo\resources\views/anggota/riwayat.blade.php ENDPATH**/ ?>