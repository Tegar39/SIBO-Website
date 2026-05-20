<?php $__env->startSection('content'); ?>
<div class="pt-28 pb-12 bg-slate-50 min-h-screen font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 pb-6 gap-6 border-b border-slate-200">
            <div>
                <h1 class="text-4xl font-extrabold text-slate-800 tracking-tight leading-none uppercase">
                    Halo, <span class="text-emerald-600"><?php echo e(Auth::user()->name); ?>!</span>
                </h1>
                <p class="text-slate-400 text-[11px] font-bold uppercase tracking-[0.3em] mt-3 flex items-center gap-2">
                    <span class="w-8 h-[2px] bg-emerald-500"></span>
                    Portal Anggota SIBO
                </p>
            </div>
            <a href="<?php echo e(route('anggota.profil')); ?>" class="group bg-white hover:bg-emerald-600 border border-slate-100 text-slate-700 hover:text-white px-8 py-4 rounded-2xl text-[11px] font-black uppercase tracking-[0.2em] transition-all hover:shadow-xl hover:shadow-emerald-100 flex items-center gap-3">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                Edit Profil Saya
            </a>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(Auth::user()->anggota): ?>
            <div class="bg-white/70 backdrop-blur-md rounded-[2.5rem] border border-white/50 shadow-xl overflow-hidden mb-12 flex flex-col md:flex-row">
                <div class="bg-emerald-600 md:w-1/3 p-10 flex flex-col items-center justify-center text-center relative overflow-hidden">
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
                    
                    <div class="w-36 h-36 bg-white/20 p-2 rounded-[2rem] mb-6 backdrop-blur-sm relative z-10">
                        <div class="w-full h-full bg-emerald-100 rounded-[1.8rem] overflow-hidden flex items-center justify-center border-2 border-white shadow-inner">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(Auth::user()->anggota->foto_profil && Storage::disk('public')->exists(Auth::user()->anggota->foto_profil)): ?>
                                <img src="<?php echo e(Storage::url(Auth::user()->anggota->foto_profil)); ?>" class="w-full h-full object-cover">
                            <?php else: ?>
                                <svg class="w-16 h-16 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                    <h2 class="text-white font-extrabold uppercase tracking-tight text-2xl relative z-10"><?php echo e(Auth::user()->anggota->nama_lengkap); ?></h2>
                    <span class="bg-white/20 backdrop-blur-md text-white text-[10px] font-black px-4 py-1.5 mt-4 rounded-full uppercase tracking-widest relative z-10 border border-white/30">Anggota Aktif</span>
                </div>
                
                <div class="flex-1 p-10 grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8 bg-white/30">
                    <?php $fields = [
                        ['label' => 'Nomor Anggota', 'val' => Auth::user()->anggota->nomor_anggota],
                        ['label' => 'Wilayah (PAC)', 'val' => Auth::user()->anggota->pac ?? '-'],
                        ['label' => 'WhatsApp', 'val' => Auth::user()->anggota->kontak ?? '-'],
                        ['label' => 'Email Terdaftar', 'val' => Auth::user()->email]
                    ]; ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <div class="relative group">
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1 group-hover:text-emerald-500 transition-colors"><?php echo e($field['label']); ?></p>
                        <p class="text-lg font-bold text-slate-800"><?php echo e($field['val']); ?></p>
                        <div class="w-full h-[1px] bg-slate-100 mt-2"></div>
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
            </div>
        <?php else: ?>
            <div class="bg-rose-50 border border-rose-100 p-8 rounded-[2rem] mb-12 flex items-center gap-6 shadow-sm">
                <div class="w-12 h-12 bg-rose-500 rounded-2xl flex items-center justify-center text-white shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <div>
                    <p class="font-black uppercase text-rose-700 tracking-wider">Lengkapi Data Anda</p>
                    <p class="text-rose-500 text-sm font-medium mt-1 uppercase italic">Segera hubungi admin untuk validasi data agar dapat mengikuti kegiatan.</p>
                </div>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($unreadCount) && $unreadCount > 0): ?>
        <div class="mb-6 bg-rose-50 border-l-4 border-rose-500 p-4 rounded-xl shadow-sm">
            <div class="flex justify-between items-center">
                <p class="font-bold text-rose-700">
                    ⚠️ Anda memiliki <?php echo e($unreadCount); ?> notifikasi alfa (tidak hadir tanpa keterangan).
                </p>
                <a href="<?php echo e(route('anggota.notifikasi')); ?>" class="text-sm text-rose-600 underline hover:text-rose-800">
                    Lihat Semua
                </a>
            </div>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($notifikasi) && $notifikasi->count() > 0): ?>
        <div class="mb-6 bg-white p-4 rounded-xl shadow-sm border">
            <h3 class="font-bold text-slate-800 mb-2 flex items-center gap-2">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                Notifikasi Terbaru
            </h3>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $notifikasi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notif): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <div class="border-b py-2 <?php echo e($notif->is_read ? 'opacity-60' : ''); ?>">
                    <p class="font-semibold text-sm"><?php echo e($notif->judul); ?></p>
                    <p class="text-xs text-slate-500"><?php echo e($notif->pesan); ?></p>
                    <small class="text-[10px] text-slate-400"><?php echo e($notif->created_at->diffForHumans()); ?></small>
                </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($notifikasi->count() > 0): ?>
                <div class="mt-3 text-right">
                    <a href="<?php echo e(route('anggota.notifikasi')); ?>" class="text-xs text-emerald-600 hover:underline">Lihat semua →</a>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="md:col-span-2 bg-white/70 backdrop-blur-md rounded-[2.5rem] border border-white/50 shadow-xl overflow-hidden flex flex-col">
                <div class="p-6 bg-slate-800 text-white font-black uppercase text-[10px] tracking-[0.3em] px-10">
                    Statistik Aktivitas
                </div>
                <div class="p-10 grid grid-cols-1 sm:grid-cols-3 gap-8">
                    <?php $stats = [
                        ['label' => 'Pendaftaran', 'val' => $jumlahPendaftaran, 'bg' => 'bg-slate-50', 'text' => 'text-slate-800'],
                        ['label' => 'Diikuti', 'val' => $jumlahDiikuti, 'bg' => 'bg-emerald-50', 'text' => 'text-emerald-600'],
                        ['label' => 'Selesai', 'val' => $jumlahSelesai, 'bg' => 'bg-slate-800', 'text' => 'text-white']
                    ]; ?>
                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <div class="<?php echo e($s['bg']); ?> p-6 rounded-[2rem] flex flex-col items-center justify-center shadow-sm">
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2"><?php echo e($s['label']); ?></p>
                        <p class="text-4xl font-black <?php echo e($s['text']); ?>"><?php echo e($s['val']); ?></p>
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
            </div>

            <div class="flex flex-col gap-6">
                <a href="<?php echo e(route('kegiatan.publik.index')); ?>" class="group flex-1 bg-emerald-600 p-8 rounded-[2.5rem] text-white shadow-lg shadow-emerald-100 hover:shadow-emerald-200 transition-all flex flex-col justify-center items-center text-center">
                    <span class="text-2xl font-extrabold uppercase tracking-tight group-hover:scale-105 transition-transform">Cari Kegiatan</span>
                    <span class="text-[10px] font-bold uppercase opacity-60 tracking-[0.2em] mt-2 italic">— Lihat agenda terbaru</span>
                </a>
                <a href="<?php echo e(route('anggota.riwayat')); ?>" class="group flex-1 bg-white p-8 rounded-[2.5rem] text-slate-800 border border-slate-100 shadow-xl hover:shadow-emerald-100 transition-all flex flex-col justify-center items-center text-center">
                    <span class="text-2xl font-extrabold uppercase tracking-tight group-hover:scale-105 transition-transform">Riwayat Saya</span>
                    <span class="text-[10px] font-bold uppercase text-slate-400 tracking-[0.2em] mt-2 italic">— Cek status pendaftaran</span>
                </a>
            </div>
        </div>

        <div class="mt-12 bg-white/70 backdrop-blur-md rounded-[2.5rem] border border-white/50 shadow-xl overflow-hidden">
            <div class="p-6 border-b border-white bg-white/30 flex items-center justify-between px-10">
                <span class="font-black uppercase text-[10px] tracking-[0.3em] text-slate-800">Agenda Mendatang</span>
                <span class="w-3 h-3 bg-emerald-500 rounded-full animate-pulse"></span>
            </div>
            
            <div class="p-4">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $agendaMendatang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <div class="p-6 m-2 bg-white border border-slate-50 rounded-3xl flex flex-col md:flex-row justify-between items-center hover:shadow-md transition-all group">
                        <div class="text-center md:text-left mb-4 md:mb-0">
                            <h4 class="font-extrabold text-lg text-slate-800 uppercase tracking-tight group-hover:text-emerald-600 transition-colors"><?php echo e($item->kegiatan->judul); ?></h4>
                            <p class="text-[10px] font-black text-emerald-500 uppercase tracking-widest mt-1"><?php echo e(\Carbon\Carbon::parse($item->kegiatan->tanggal)->translatedFormat('d F Y')); ?></p>
                        </div>
                        <div class="px-6 py-2.5 bg-slate-50 rounded-full border border-slate-100 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">
                            <?php echo e($item->status_pendaftaran); ?>

                        </div>
                    </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <div class="py-20 text-center">
                        <div class="inline-flex p-6 bg-slate-50 rounded-full mb-6">
                            <svg class="w-12 h-12 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <p class="text-slate-300 font-bold uppercase italic tracking-widest text-xs">Belum ada kegiatan yang kamu ikuti</p>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>

    </div>
</div>

<style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in { animation: fade-in 0.4s ease-out forwards; }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\sibo\resources\views/anggota/dashboard.blade.php ENDPATH**/ ?>