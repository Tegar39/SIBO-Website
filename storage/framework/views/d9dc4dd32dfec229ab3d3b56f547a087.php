

<?php $__env->startSection('content'); ?>
<div class="bg-white">
    <!-- Hero Section -->
    <div class="relative overflow-hidden h-screen min-h-[600px]" 
        onmouseenter="document.getElementById('hero-overlay').classList.add('hovered')"
        onmouseleave="document.getElementById('hero-overlay').classList.remove('hovered')">
        <?php
            $heroImage = null;
            $unggulan = $galeri->where('is_unggulan', 1)->first();
            if ($unggulan && $unggulan->path_file) {
                $heroImage = Storage::url($unggulan->path_file);
            } elseif ($kegiatanTerbaru->isNotEmpty() && $kegiatanTerbaru->first()->pamflet) {
                $heroImage = Storage::url($kegiatanTerbaru->first()->pamflet->path_file);
            }
        ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($heroImage): ?>
            <div class="absolute inset-0">
                <img src="<?php echo e($heroImage); ?>" alt="Hero Background" class="w-full h-full object-cover">
                <div id="hero-overlay" class="absolute inset-0 bg-black/80 transition-all duration-500"></div>
            </div>
        <?php else: ?>
            <div class="absolute inset-0 bg-gradient-to-br from-blue-900 via-indigo-800 to-purple-900"></div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div class="relative z-10 flex flex-col items-center justify-center h-full text-center text-white px-4">
            <div class="animate-fade-in-up">
                <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight drop-shadow-lg">SIBO</h1>
                <p class="mt-4 text-xl md:text-2xl max-w-2xl drop-shadow-md">Sistem Informasi Budaya & Olahraga<br>PC DESBOR Kabupaten Kediri</p>
                <div class="mt-8 flex flex-col sm:flex-row justify-center gap-4">
                    <!-- Tombol Lihat Kegiatan (efek slide hanya pada tombol) -->
                    <a href="<?php echo e(route('kegiatan.publik.index')); ?>" wire:navigate 
                    class="relative px-8 py-3 font-semibold rounded-full shadow-lg overflow-hidden inline-block bg-white text-green-600 hover:text-white transition-colors duration-300 group">
                        <span class="relative z-10">Lihat Kegiatan</span>
                        <span class="absolute inset-0 bg-green-600 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-500 ease-out"></span>
                    </a>
                </div>
            </div>
        </div>

        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 cursor-pointer z-30" onclick="window.scrollTo({top: window.innerHeight, behavior: 'smooth'})">
            <div class="animate-bounce bg-white/20 rounded-full p-2 hover:bg-white/40 transition">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
            </div>
        </div>
    </div>

    <style>
        #hero-overlay {
            transition-property: background-color;
            transition-duration: 0.5s;
            transition-timing-function: ease;
        }
        #hero-overlay.hovered {
            background-color: rgba(0, 0, 0, 0.6) !important;
        }
        .animate-infinite-scroll:hover {
            animation-play-state: paused;
        }
        .animate-infinite-scroll {
            animation: infinite-scroll 30s linear infinite;
        }
    </style>

    <!-- Tentang SIBO (Profil) -->
    <div id="tentang" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Tentang SIBO</h2>
                <p class="text-gray-600 mb-4 leading-relaxed">
                    SIBO (Sistem Informasi Budaya & Olahraga) adalah platform digital yang dikembangkan untuk PC DESBOR Kabupaten Kediri dalam rangka mendigitalisasi manajemen organisasi. Sistem ini memudahkan pendataan anggota, pengelolaan kegiatan, pendaftaran online, absensi, serta dokumentasi galeri.
                </p>
                <p class="text-gray-600 mb-4 leading-relaxed">
                    Dengan SIBO, diharapkan seluruh anggota dapat mengakses informasi kegiatan secara real-time, mendaftar kegiatan dengan mudah, dan melihat riwayat keikutsertaan. Admin juga dimudahkan dalam mengelola data dan laporan.
                </p>
                <p class="text-gray-600 leading-relaxed">
                    PC DESBOR Kabupaten Kediri berkomitmen untuk terus mengembangkan kegiatan di bidang budaya dan olahraga, serta memanfaatkan teknologi untuk meningkatkan pelayanan kepada anggota.
                </p>
            </div>
            <div class="flex justify-center">
                <img src="<?php echo e(asset('images/logo-desbor.png')); ?>" alt="PC DESBOR" class="rounded-lg shadow-lg w-full max-w-md object-cover">
            </div>
        </div>
    </div>

    <!-- Statistik -->
    <div id="statistik" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <!-- Header Statistik -->
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Data Jumlah</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Rekapitulasi data anggota, kegiatan, dan keaktifan PAC di lingkungan PC DESBOR Kabupaten Kediri.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-2xl shadow-lg p-6 text-center transform transition duration-300 hover:-translate-y-2 hover:shadow-2xl">
                <div class="text-5xl font-bold text-blue-600"><?php echo e($totalAnggota); ?></div>
                <div class="text-gray-600 mt-2">Total Anggota</div>
                <div class="text-sm text-gray-400 mt-1">Terdaftar aktif</div>
            </div>
            <div class="bg-white rounded-2xl shadow-lg p-6 text-center transform transition duration-300 hover:-translate-y-2 hover:shadow-2xl">
                <div class="text-5xl font-bold text-green-600"><?php echo e($totalKegiatan); ?></div>
                <div class="text-gray-600 mt-2">Total Kegiatan</div>
                <div class="text-sm text-gray-400 mt-1">Sepanjang waktu</div>
            </div>
            <div class="bg-white rounded-2xl shadow-lg p-6 text-center transform transition duration-300 hover:-translate-y-2 hover:shadow-2xl">
                <div class="text-5xl font-bold text-purple-600"><?php echo e($totalPac ?? '0'); ?></div>
                <div class="text-gray-600 mt-2">PAC Aktif</div>
                <div class="text-sm text-gray-400 mt-1">Tersebar di Kabupaten Kediri</div>
            </div>
        </div>

        <!-- Informasi Tambahan (opsional) -->
        <div class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-6 bg-gray-50 rounded-xl p-6">
            <div class="flex items-start gap-3">
                <svg class="w-6 h-6 text-blue-600 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <h3 class="font-semibold text-gray-800">Informasi Keanggotaan</h3>
                    <p class="text-sm text-gray-600">Anggota terdiri dari Kader Desa Bersama (KDB) dan Kader Nuansa Baru (KNB) yang tersebar di berbagai PAC.</p>
                </div>
            </div>
            <div class="flex items-start gap-3">
                <svg class="w-6 h-6 text-green-600 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <h3 class="font-semibold text-gray-800">Kegiatan Rutin</h3>
                    <p class="text-sm text-gray-600">Kegiatan bidang budaya (KDB) dan olahraga (KNB) dilaksanakan secara berkala.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Kegiatan Terbaru dengan efek hover zoom + darken -->
    <div id="kegiatan-terbaru" class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 text-center mb-4">Kegiatan Terbaru</h2>
            <p class="text-gray-600 text-center mb-12 max-w-2xl mx-auto">Ikuti berbagai kegiatan seru dan bermanfaat dari PC DESBOR.</p>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $kegiatanTerbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kegiatan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden transition duration-300 hover:shadow-2xl group">
                        <div class="relative overflow-hidden">
                            <?php
                                $imgPath = null;
                                if ($kegiatan->pamflet && $kegiatan->pamflet->path_file) {
                                    $imgPath = Storage::url($kegiatan->pamflet->path_file);
                                }
                            ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($imgPath): ?>
                                <img src="<?php echo e($imgPath); ?>" class="w-full h-56 object-cover transition-all duration-500 group-hover:scale-110 group-hover:rotate-1">
                                <!-- Overlay darken saat hover -->
                                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <?php else: ?>
                                <div class="w-full h-56 bg-gray-200 flex items-center justify-center text-gray-500">Tidak ada gambar</div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <div class="p-5">
                            <span class="inline-block px-3 py-1 text-xs font-semibold text-blue-800 bg-blue-100 rounded-full"><?php echo e($kegiatan->kategori->nama ?? 'Umum'); ?></span>
                            <h3 class="text-xl font-bold text-gray-900 mt-2"><?php echo e($kegiatan->judul); ?></h3>
                            <p class="text-gray-600 mt-2 line-clamp-2"><?php echo e(Str::limit($kegiatan->deskripsi, 100)); ?></p>
                            <div class="mt-4 flex justify-between items-center">
                                <span class="text-sm text-gray-500"><?php echo e(\Carbon\Carbon::parse($kegiatan->tanggal)->format('d M Y')); ?></span>
                                <a href="<?php echo e(route('kegiatan.publik.show', $kegiatan->id_kegiatan)); ?>" wire:navigate class="text-blue-600 font-medium hover:underline">Detail →</a>
                            </div>
                        </div>
                    </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <div class="col-span-full text-center text-gray-500 py-8">Belum ada kegiatan terbaru.</div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Galeri Foto dengan Carousel Horizontal Loop (dengan efek darken saat hover) -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($galeri->count() > 0): ?>
    <div  id="galeri" class="py-16 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <div class="inline-block bg-gradient-to-r from-blue-100 to-indigo-100 rounded-full px-8 py-3 shadow-md">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Galeri Kegiatan</h2>
                </div>
                <p class="text-gray-600 mt-3 max-w-2xl mx-auto">Dokumentasi momen berharga dari berbagai kegiatan.</p>
            </div>

            <div class="relative w-full overflow-hidden">
                <div class="flex gap-4 animate-infinite-scroll">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $galeri; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $foto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <?php
                            $fotoPath = $foto->path_file ? Storage::url($foto->path_file) : null;
                        ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($fotoPath): ?>
                            <div class="flex-none w-72 h-72 group relative overflow-hidden shadow-md cursor-pointer"
                                onclick="openLightbox('<?php echo e($fotoPath); ?>', '<?php echo e(addslashes($foto->judul_foto ?? '')); ?>')">
                                <div class="w-full h-full overflow-hidden">
                                    <img src="<?php echo e($fotoPath); ?>" alt="<?php echo e($foto->judul_foto ?? 'Galeri'); ?>" 
                                        class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110 group-hover:rotate-1">
                                </div>
                                <!-- Overlay darken saat hover -->
                                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($foto->judul_foto): ?>
                                    <div class="absolute inset-x-0 bottom-0 bg-black/60 text-white text-xs p-2 text-center opacity-0 group-hover:opacity-100 transition"><?php echo e($foto->judul_foto); ?></div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <!-- Duplikasi untuk loop -->
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $galeri; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $foto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <?php
                            $fotoPath = $foto->path_file ? Storage::url($foto->path_file) : null;
                        ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($fotoPath): ?>
                            <div class="flex-none w-72 h-72 group relative overflow-hidden shadow-md cursor-pointer"
                                onclick="openLightbox('<?php echo e($fotoPath); ?>', '<?php echo e(addslashes($foto->judul_foto ?? '')); ?>')">
                                <div class="w-full h-full overflow-hidden">
                                    <img src="<?php echo e($fotoPath); ?>" alt="<?php echo e($foto->judul_foto ?? 'Galeri'); ?>" 
                                        class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110 group-hover:rotate-1">
                                </div>
                                <!-- Overlay darken saat hover -->
                                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($foto->judul_foto): ?>
                                    <div class="absolute inset-x-0 bottom-0 bg-black/60 text-white text-xs p-2 text-center opacity-0 group-hover:opacity-100 transition"><?php echo e($foto->judul_foto); ?></div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>

<!-- Lightbox Modal -->
<div id="lightbox" class="fixed inset-0 bg-black/80 z-50 hidden items-center justify-center" onclick="closeLightbox()">
    <div class="relative max-w-4xl mx-auto p-4">
        <img id="lightbox-img" src="" class="max-w-full max-h-screen rounded-lg shadow-2xl">
        <p id="lightbox-caption" class="text-white text-center mt-2"></p>
        <button class="absolute top-4 right-4 text-white text-3xl" onclick="closeLightbox()">&times;</button>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    function openLightbox(src, caption) {
        document.getElementById('lightbox-img').src = src;
        document.getElementById('lightbox-caption').innerText = caption;
        document.getElementById('lightbox').classList.remove('hidden');
        document.getElementById('lightbox').classList.add('flex');
        document.body.style.overflow = 'hidden';
    }
    function closeLightbox() {
        document.getElementById('lightbox').classList.add('hidden');
        document.getElementById('lightbox').classList.remove('flex');
        document.body.style.overflow = '';
    }
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeLightbox();
    });
</script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    @keyframes fade-in-up {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-up {
        animation: fade-in-up 1s ease-out;
    }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .group:hover .group-hover\:rotate-1 {
        transform: scale(1.1) rotate(1deg);
    }
</style>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Sibo\resources\views/home.blade.php ENDPATH**/ ?>