

<?php $__env->startSection('content'); ?>
<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 border-b-4 border-gray-900 pb-6 gap-4">
            <div>
                <h1 class="text-4xl font-black text-gray-900 uppercase italic tracking-tighter">
                    Database <span class="text-green-700">Anggota</span>
                </h1>
                <p class="text-gray-500 text-[10px] font-black uppercase tracking-[0.3em] mt-1">Sistem Informasi Manajemen PC DESBOR</p>
            </div>
            <a href="<?php echo e(route('admin.anggota.create')); ?>" 
               class="group relative inline-flex items-center gap-3 bg-gray-900 text-white text-[11px] font-black py-4 px-8 uppercase tracking-widest transition-all hover:bg-green-700 shadow-[6px_6px_0px_0px_rgba(234,179,8,1)]">
                <svg class="w-4 h-4 transition-transform group-hover:rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path>
                </svg>
                Registrasi Anggota
            </a>
        </div>

        <div class="mb-10 bg-white border-4 border-gray-900 p-6 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
            <form action="<?php echo e(route('admin.anggota.index')); ?>" method="GET" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1 relative">
                    <input type="text" name="search" value="<?php echo e(request('search')); ?>" 
                        placeholder="CARI NAMA ATAU ID ANGGOTA..." 
                        class="w-full bg-gray-50 border-2 border-gray-900 px-4 py-3 font-black uppercase italic text-xs tracking-widest focus:ring-0 focus:border-green-700 transition-all">
                </div>

                <div class="md:w-64">
                    <select name="pac" onchange="this.form.submit()" 
                        class="w-full bg-white border-2 border-gray-900 px-4 py-3 font-black uppercase italic text-xs tracking-widest focus:ring-0 focus:border-green-700 appearance-none cursor-pointer">
                        <option value="">SEMUA PAC</option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = ['PAC-01', 'PAC-02', 'PAC-03', 'PAC-04', 'PAC-05']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pac): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <option value="<?php echo e($pac); ?>" <?php echo e(request('pac') == $pac ? 'selected' : ''); ?>>WILAYAH <?php echo e($pac); ?></option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </select>
                </div>

                <button type="submit" class="bg-gray-900 text-white px-8 py-3 font-black uppercase italic text-[10px] hover:bg-green-700 transition-all shadow-[4px_4px_0px_0px_rgba(234,179,8,1)]">
                    CARI
                </button>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(request('search') || request('pac')): ?>
                    <a href="<?php echo e(route('admin.anggota.index')); ?>" 
                    class="bg-red-500 text-white border-2 border-gray-900 px-6 py-3 font-black uppercase italic text-[10px] flex items-center justify-center hover:bg-red-600 transition-all shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] active:shadow-none active:translate-x-[4px] active:translate-y-[4px]">
                        RESET
                    </a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </form>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($anggota->count() > 0): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $anggota; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <div class="relative bg-gray-900 rounded-xl"> <div class="relative z-10 bg-white rounded-xl border-2 border-gray-900 overflow-hidden flex flex-col transform transition-all duration-200 hover:-translate-y-[-8px] hover:-translate-x-[-8px]">
                            
                            <div class="bg-gradient-to-r from-green-700 to-green-800 px-4 py-4 flex items-center gap-3 border-b-2 border-gray-900">
                                <div class="w-14 h-14 rounded-full bg-white flex items-center justify-center overflow-hidden border-2 border-yellow-400">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($a->foto_profil && Storage::disk('public')->exists($a->foto_profil)): ?>
                                        <img src="<?php echo e(Storage::url($a->foto_profil)); ?>" alt="Foto" class="w-full h-full object-cover">
                                    <?php else: ?>
                                        <svg class="w-8 h-8 text-green-700" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-sm font-black text-white uppercase italic tracking-tighter truncate"><?php echo e($a->nama_lengkap); ?></h3>
                                    <p class="text-yellow-200 text-[10px] font-mono">ID: <?php echo e($a->nomor_anggota); ?></p>
                                </div>
                                <span class="bg-yellow-500 text-green-900 text-[9px] font-black px-2 py-0.5 rounded-full border border-gray-900">
                                    <?php echo e($a->pac); ?>

                                </span>
                            </div>

                            <div class="p-5 flex-1 space-y-3 text-[11px] font-bold uppercase tracking-wider text-gray-700">
                                <div class="flex items-center gap-3">
                                    <svg class="w-4 h-4 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    <span class="truncate"><?php echo e($a->user->email); ?></span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <svg class="w-4 h-4 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                    <span><?php echo e($a->kontak ?? '-'); ?></span>
                                </div>
                            </div>

                            <div class="border-t-2 border-gray-900 flex divide-x-2 divide-gray-900 bg-gray-50">
                                <a href="<?php echo e(route('admin.anggota.edit', $a->id_anggota)); ?>" class="flex-1 py-3 text-center text-blue-600 hover:bg-blue-100 font-black text-[10px] uppercase tracking-widest transition-colors">
                                    EDIT
                                </a>
                                <form action="<?php echo e(route('admin.anggota.destroy', $a->id_anggota)); ?>" method="POST" class="flex-1 flex" onsubmit="return confirm('Hapus?')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="w-full py-3 text-red-600 hover:bg-red-100 font-black text-[10px] uppercase tracking-widest transition-colors">
                                        HAPUS
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>

            <div class="mt-16">
                <?php echo e($anggota->links()); ?>

            </div>
        <?php else: ?>
            <div class="text-center py-20 bg-white border-4 border-dashed border-gray-300">
                <h3 class="text-xl font-black text-gray-400 uppercase italic">Data Kosong</h3>
                <a href="<?php echo e(route('admin.anggota.index')); ?>" class="text-green-700 underline font-black text-xs">RESET FILTER</a>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Sibo\resources\views/admin/anggota/index.blade.php ENDPATH**/ ?>