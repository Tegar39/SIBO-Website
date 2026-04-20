

<?php $__env->startSection('content'); ?>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($kegiatan->pamflet): ?>
                    <img src="<?php echo e(Storage::url($kegiatan->pamflet->path_file)); ?>" class="w-full max-h-96 object-cover rounded mb-6">
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <h1 class="text-3xl font-bold mb-2"><?php echo e($kegiatan->judul); ?></h1>
                <p class="text-gray-600 mb-1"><span class="font-semibold">Kategori:</span> <?php echo e($kegiatan->kategori->nama); ?></p>
                <p class="text-gray-600 mb-1"><span class="font-semibold">Tanggal:</span> <?php echo e(\Carbon\Carbon::parse($kegiatan->tanggal)->format('d M Y')); ?> <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($kegiatan->waktu): ?> , <?php echo e(\Carbon\Carbon::parse($kegiatan->waktu)->format('H:i')); ?> WIB <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></p>
                <p class="text-gray-600 mb-1"><span class="font-semibold">Lokasi:</span> <?php echo e($kegiatan->lokasi ?: '-'); ?></p>
                <p class="text-gray-600 mb-4"><span class="font-semibold">Kuota:</span> <?php echo e($jumlahPeserta); ?> / <?php echo e($kegiatan->kuota == 0 ? 'Tak terbatas' : $kegiatan->kuota); ?></p>

                <div class="mt-4 border-t pt-4">
                    <h2 class="text-xl font-semibold mb-2">Deskripsi</h2>
                    <p class="text-gray-700"><?php echo e(nl2br(e($kegiatan->deskripsi))); ?></p>
                </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->role == 'anggota'): ?>
                        <?php
                            $sudahDaftar = \App\Models\Pendaftaran::where('id_anggota', auth()->user()->anggota->id_anggota)
                                ->where('id_kegiatan', $kegiatan->id_kegiatan)
                                ->exists();
                            $statusPendaftaran = $sudahDaftar ? \App\Models\Pendaftaran::where('id_anggota', auth()->user()->anggota->id_anggota)
                                ->where('id_kegiatan', $kegiatan->id_kegiatan)
                                ->first()->status : null;
                        ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($sudahDaftar): ?>
                            <div class="mt-6 p-3 rounded <?php if($statusPendaftaran == 'disetujui'): ?> bg-green-100 text-green-700 <?php elseif($statusPendaftaran == 'ditolak'): ?> bg-red-100 text-red-700 <?php else: ?> bg-yellow-100 text-yellow-700 <?php endif; ?>">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($statusPendaftaran == 'pending'): ?>
                                    Anda sudah mendaftar. Menunggu konfirmasi admin.
                                <?php elseif($statusPendaftaran == 'disetujui'): ?>
                                    Pendaftaran Anda telah disetujui. Silakan datang tepat waktu.
                                <?php elseif($statusPendaftaran == 'ditolak'): ?>
                                    Maaf, pendaftaran Anda ditolak.
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        <?php elseif($kegiatan->status != 'aktif'): ?>
                            <div class="mt-6 p-3 bg-gray-100 text-gray-700 rounded">Kegiatan ini sudah <?php echo e($kegiatan->status); ?>.</div>
                        <?php elseif($kegiatan->kuota > 0 && $jumlahPeserta >= $kegiatan->kuota): ?>
                            <div class="mt-6 p-3 bg-red-100 text-red-700 rounded">Maaf, kuota sudah penuh.</div>
                        <?php else: ?>
                            <form action="<?php echo e(route('anggota.daftar', $kegiatan->id_kegiatan)); ?>" method="POST" class="mt-6">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-lg transition">Daftar Sekarang</button>
                            </form>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php else: ?>
                        <div class="mt-6 p-3 bg-blue-100 text-blue-700 rounded">Anda login sebagai admin. Untuk mendaftar, gunakan akun anggota.</div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php else: ?>
                    <div class="mt-6 p-3 bg-yellow-100 text-yellow-700 rounded">
                        <a href="<?php echo e(route('login')); ?>" class="underline">Login</a> sebagai anggota untuk mendaftar kegiatan ini.
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <div class="mt-6">
                    <a href="<?php echo e(route('kegiatan.publik.index')); ?>" wire:navigate class="text-blue-600 hover:underline">&larr; Kembali ke daftar kegiatan</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($kegiatan->latitude && $kegiatan->longitude): ?>
<div class="mt-4">
    <h3 class="font-semibold">Lokasi di Peta</h3>
    <div id="map" style="height: 300px;" class="rounded border mt-2"></div>
</div>

<?php $__env->startPush('scripts'); ?>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script>
    var map = L.map('map').setView([<?php echo e($kegiatan->latitude); ?>, <?php echo e($kegiatan->longitude); ?>], 15);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap'
    }).addTo(map);
    L.marker([<?php echo e($kegiatan->latitude); ?>, <?php echo e($kegiatan->longitude); ?>]).addTo(map)
        .bindPopup('<?php echo e($kegiatan->lokasi); ?>')
        .openPopup();
</script>
<?php $__env->stopPush(); ?>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Sibo\resources\views/kegiatan/show.blade.php ENDPATH**/ ?>