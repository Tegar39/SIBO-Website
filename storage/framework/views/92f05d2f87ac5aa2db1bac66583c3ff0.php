

<?php $__env->startSection('content'); ?>
<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 border-b-4 border-gray-900 pb-6 gap-4">
            <div>
                <h1 class="text-4xl font-black text-gray-900 uppercase italic tracking-tighter">
                    Halo, <span class="text-green-700"><?php echo e(Auth::user()->name); ?>!</span>
                </h1>
                <p class="text-gray-500 text-[10px] font-black uppercase tracking-[0.3em] mt-1">Selamat Datang di Portal Anggota SIBO</p>
            </div>
            <a href="<?php echo e(route('anggota.profil')); ?>" class="bg-yellow-400 border-2 border-gray-900 text-gray-900 px-6 py-3 text-[11px] font-black uppercase tracking-widest hover:bg-black hover:text-white transition-all shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                Profil Saya
            </a>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(Auth::user()->anggota): ?>
            <div class="bg-white border-4 border-gray-900 shadow-[10px_10px_0px_0px_rgba(21,128,61,1)] mb-12 flex flex-col md:flex-row">
                <div class="bg-green-700 md:w-1/3 p-8 flex flex-col items-center justify-center text-center border-b-4 md:border-b-0 md:border-r-4 border-gray-900">
                    <div class="w-32 h-32 bg-yellow-400 border-4 border-gray-900 rounded-none mb-4 overflow-hidden shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] flex items-center justify-center">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(Auth::user()->anggota->foto_profil && Storage::disk('public')->exists(Auth::user()->anggota->foto_profil)): ?>
                            
                            <img src="<?php echo e(Storage::url(Auth::user()->anggota->foto_profil)); ?>" 
                                alt="Foto <?php echo e(Auth::user()->name); ?>" 
                                class="w-full h-full object-cover">
                        <?php else: ?>
                            
                            <svg class="w-16 h-16 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    <h2 class="text-white font-black uppercase tracking-tighter text-xl"><?php echo e(Auth::user()->anggota->nama_lengkap); ?></h2>
                    <span class="bg-black text-yellow-400 text-[10px] font-black px-3 py-1 mt-2 uppercase tracking-[0.2em]">Anggota Aktif</span>
                </div>
                
                <div class="flex-1 p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="border-b-2 border-gray-100 pb-2">
                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Nomor Anggota</p>
                        <p class="text-lg font-black text-gray-900"><?php echo e(Auth::user()->anggota->nomor_anggota); ?></p>
                    </div>
                    <div class="border-b-2 border-gray-100 pb-2">
                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Wilayah (PAC)</p>
                        <p class="text-lg font-black text-gray-900 uppercase italic"><?php echo e(Auth::user()->anggota->pac ?? '-'); ?></p>
                    </div>
                    <div class="border-b-2 border-gray-100 pb-2">
                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">WhatsApp</p>
                        <p class="text-lg font-black text-gray-900"><?php echo e(Auth::user()->anggota->kontak ?? '-'); ?></p>
                    </div>
                    <div class="border-b-2 border-gray-100 pb-2">
                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Email Terdaftar</p>
                        <p class="text-lg font-black text-gray-900"><?php echo e(Auth::user()->email); ?></p>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="bg-red-50 border-4 border-gray-900 p-6 mb-12 shadow-[8px_8px_0px_0px_rgba(185,28,28,1)]">
                <p class="font-black uppercase text-red-700 italic">⚠️ Data Anggota Belum Lengkap. Segera hubungi admin untuk validasi data!</p>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="md:col-span-2 bg-white border-2 border-gray-900 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col">
                <div class="p-4 bg-gray-900 text-white font-black uppercase text-xs italic tracking-widest">
                    Ringkasan Aktivitas
                </div>
                <div class="p-8 grid grid-cols-1 sm:grid-cols-3 gap-4 text-center">
                    <div class="p-4 border-2 border-gray-900 bg-gray-50">
                        <p class="text-[9px] font-black text-gray-400 uppercase">Pendaftaran</p>
                        <p class="text-3xl font-black text-gray-900">0</p>
                    </div>
                    <div class="p-4 border-2 border-gray-900 bg-green-50">
                        <p class="text-[9px] font-black text-gray-400 uppercase">Diikuti</p>
                        <p class="text-3xl font-black text-green-700">0</p>
                    </div>
                    <div class="p-4 border-2 border-gray-900 bg-yellow-50">
                        <p class="text-[9px] font-black text-gray-400 uppercase">Selesai</p>
                        <p class="text-3xl font-black text-yellow-600">0</p>
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-4">
                <a href="<?php echo e(route('kegiatan.publik.index')); ?>" class="flex-1 bg-green-700 border-2 border-gray-900 text-white p-6 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-1 hover:translate-y-1 transition-all flex flex-col justify-center items-center group">
                    <span class="text-xl font-black uppercase italic tracking-tighter group-hover:underline">Cari Kegiatan</span>
                    <span class="text-[10px] font-bold uppercase opacity-70">Lihat agenda terbaru</span>
                </a>
                <a href="<?php echo e(route('anggota.riwayat')); ?>" class="flex-1 bg-white border-2 border-gray-900 text-gray-900 p-6 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-1 hover:translate-y-1 transition-all flex flex-col justify-center items-center group">
                    <span class="text-xl font-black uppercase italic tracking-tighter group-hover:underline text-gray-700">Riwayat Saya</span>
                    <span class="text-[10px] font-bold uppercase opacity-50 text-gray-500">Cek status pendaftaran</span>
                </a>
            </div>
        </div>

        <div class="mt-12 bg-white border-2 border-gray-900 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
            <div class="p-4 border-b-2 border-gray-900 bg-yellow-400 font-black uppercase text-xs italic tracking-widest">
                Agenda Mendatang
            </div>
            <div class="p-12 text-center">
                <div class="inline-block p-4 bg-gray-100 border-2 border-dashed border-gray-400 mb-4">
                    <svg class="w-12 h-12 text-gray-300 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <p class="text-gray-400 font-black uppercase italic tracking-widest">Belum ada kegiatan yang kamu ikuti</p>
                <p class="text-[10px] text-gray-400 uppercase mt-1">Ayo daftar kegiatan budaya & olahraga sekarang!</p>
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Sibo\resources\views/anggota/dashboard.blade.php ENDPATH**/ ?>