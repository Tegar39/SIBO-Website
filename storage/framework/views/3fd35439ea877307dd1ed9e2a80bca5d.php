

<?php $__env->startSection('content'); ?>
<div class="py-12 bg-[#f4f4f4] min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8">
            <a href="<?php echo e(route('kegiatan.publik.index')); ?>" wire:navigate class="group inline-flex items-center text-[11px] font-black uppercase tracking-widest text-gray-400 hover:text-green-600 transition-colors">
                <span class="mr-2 transition-transform group-hover:-translate-x-1">←</span> Back to Bulletin
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            <div class="lg:col-span-8">
                <div class="bg-white p-3 shadow-xl transform -rotate-1 mb-10 border border-gray-200">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($kegiatan->pamflet): ?>
                        <img src="<?php echo e(Storage::url($kegiatan->pamflet->path_file)); ?>" class="w-full h-auto object-cover">
                    <?php else: ?>
                        <div class="w-full h-80 bg-gray-100 flex items-center justify-center text-gray-400 uppercase font-black tracking-widest italic">
                            No Poster Provided
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <div class="mb-8">
                    <span class="bg-green-600 text-white text-[10px] font-black px-4 py-1.5 uppercase tracking-[0.2em] mb-4 inline-block">
                        <?php echo e($kegiatan->kategori->nama); ?>

                    </span>
                    <h1 class="text-4xl md:text-5xl font-black text-gray-900 leading-[0.9] tracking-tighter uppercase italic">
                        <?php echo e($kegiatan->judul); ?>

                    </h1>
                </div>

                <div class="prose prose-lg max-w-none">
                    <h2 class="text-xs font-black text-gray-400 uppercase tracking-widest border-b border-gray-200 pb-2 mb-4">Event Description</h2>
                    <p class="text-gray-700 leading-relaxed text-lg whitespace-pre-line font-medium">
                        <?php echo e(e($kegiatan->deskripsi)); ?>

                    </p>
                </div>
            </div>

            <div class="lg:col-span-4">
                <div class="sticky top-8">
                    <div class="bg-white border-2 border-gray-900 p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                        <h3 class="text-xl font-black text-gray-900 uppercase tracking-tighter mb-6 border-b-2 border-gray-900 pb-2">Detail Logistik</h3>
                        
                        <div class="space-y-6">
                            <div class="flex items-start gap-4">
                                <div class="bg-gray-100 p-2 text-gray-900 font-black text-center min-w-[50px]">
                                    <span class="block text-lg leading-none"><?php echo e(\Carbon\Carbon::parse($kegiatan->tanggal)->format('d')); ?></span>
                                    <span class="text-[10px] uppercase"><?php echo e(\Carbon\Carbon::parse($kegiatan->tanggal)->format('M')); ?></span>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Waktu</p>
                                    <p class="text-sm font-bold text-gray-900">
                                        <?php echo e(\Carbon\Carbon::parse($kegiatan->waktu)->format('H:i')); ?> WIB - Selesai
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="bg-gray-100 p-2 text-gray-400 flex items-center justify-center min-w-[50px]">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Lokasi</p>
                                    <p class="text-sm font-bold text-gray-900 leading-tight"><?php echo e($kegiatan->lokasi ?: 'Lokasi belum ditentukan'); ?></p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4 pb-4 border-b border-gray-100">
                                <div class="bg-gray-100 p-2 text-gray-400 flex items-center justify-center min-w-[50px]">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Ketersediaan</p>
                                    <p class="text-sm font-bold text-gray-900">
                                        <?php echo e($jumlahPeserta); ?> / <?php echo e($kegiatan->kuota == 0 ? '∞' : $kegiatan->kuota); ?> Peserta
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->role == 'anggota'): ?>
                                    <?php
                                        $pendaftaran = \App\Models\Pendaftaran::where('id_anggota', auth()->user()->anggota->id_anggota)
                                            ->where('id_kegiatan', $kegiatan->id_kegiatan)
                                            ->first();
                                    ?>

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($pendaftaran): ?>
                                        <div class="text-center p-4 rounded-sm border-2 font-black uppercase text-xs tracking-tighter
                                            <?php if($pendaftaran->status == 'disetujui'): ?> border-green-600 text-green-600 bg-green-50 
                                            <?php elseif($pendaftaran->status == 'ditolak'): ?> border-red-600 text-red-600 bg-red-50 
                                            <?php else: ?> border-yellow-500 text-yellow-600 bg-yellow-50 <?php endif; ?>">
                                            Status: <?php echo e($pendaftaran->status); ?>

                                            <p class="font-bold normal-case mt-1 tracking-normal italic text-[10px]">
                                                <?php echo e($pendaftaran->status == 'pending' ? 'Tunggu konfirmasi admin' : 'Silakan cek email berkala'); ?>

                                            </p>
                                        </div>
                                    <?php elseif($kegiatan->status != 'aktif'): ?>
                                        <div class="w-full bg-gray-200 text-gray-500 text-center py-3 font-black uppercase text-xs">
                                            Event <?php echo e($kegiatan->status); ?>

                                        </div>
                                    <?php elseif($kegiatan->kuota > 0 && $jumlahPeserta >= $kegiatan->kuota): ?>
                                        <div class="w-full bg-red-100 text-red-600 text-center py-3 font-black uppercase text-xs border border-red-200">
                                            Kuota Penuh
                                        </div>
                                    <?php else: ?>
                                        <form action="<?php echo e(route('anggota.daftar', $kegiatan->id_kegiatan)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="w-full bg-green-600 hover:bg-black text-white font-black py-4 uppercase tracking-[0.2em] transition-all transform hover:-translate-y-1 shadow-[4px_4px_0px_0px_rgba(0,0,0,0.2)]">
                                                Daftar Sekarang
                                            </button>
                                        </form>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php else: ?>
                                    <div class="p-4 bg-blue-50 border-l-4 border-blue-600 text-blue-700 text-[10px] font-bold uppercase leading-tight">
                                        Anda login sebagai Admin.
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php else: ?>
                                <a href="<?php echo e(route('login')); ?>" class="block w-full bg-gray-900 text-white text-center font-black py-4 uppercase tracking-[0.2em] hover:bg-green-600 transition-colors">
                                    Login to Register
                                </a>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Sibo\resources\views/kegiatan/show.blade.php ENDPATH**/ ?>