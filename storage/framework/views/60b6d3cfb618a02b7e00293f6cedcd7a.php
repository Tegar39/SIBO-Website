<?php $__env->startSection('content'); ?>
<div class="pt-28 pb-12 bg-slate-50 min-h-screen font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-slate-800 tracking-tight">
                    Admin <span class="text-emerald-600">Dashboard</span>
                </h1>
                <p class="text-slate-500 text-sm mt-1 font-medium">Status Sistem & Statistik PC DESBOR &bull; <?php echo e(now()->translatedFormat('d F Y')); ?></p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <a href="<?php echo e(route('admin.anggota.index')); ?>" class="block bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex flex-col transition-all hover:shadow-md hover:border-emerald-200 cursor-pointer">
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Total Anggota</span>
                <span class="text-4xl font-bold text-slate-800 mb-4"><?php echo e(array_sum($anggotaData)); ?></span>
                <span class="mt-auto text-xs font-medium text-emerald-700 bg-emerald-50 w-fit px-2.5 py-1 rounded-md">Database Terpusat</span>
            </a>

            <a href="<?php echo e(route('admin.kegiatan.index')); ?>" class="block bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex flex-col transition-all hover:shadow-md hover:border-blue-200 cursor-pointer">
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Total Kegiatan</span>
                <span class="text-4xl font-bold text-slate-800 mb-4"><?php echo e(array_sum($kategoriData)); ?></span>
                <span class="mt-auto text-xs font-medium text-blue-700 bg-blue-50 w-fit px-2.5 py-1 rounded-md">Budaya & Olahraga</span>
            </a>

            <a href="<?php echo e(route('admin.pendaftaran.index')); ?>" class="block bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex flex-col transition-all hover:shadow-md hover:border-emerald-200 cursor-pointer">
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Pendaftar Baru</span>
                <span class="text-4xl font-bold text-slate-800 mb-4"><?php echo e($pendaftarBaru); ?></span>
                <span class="mt-auto text-xs font-medium text-emerald-700 bg-emerald-50 w-fit px-2.5 py-1 rounded-md">Bulan <?php echo e(now()->translatedFormat('F')); ?></span>
            </a>

            <a href="<?php echo e(route('admin.kategori.index')); ?>" class="block bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex flex-col transition-all hover:shadow-md hover:border-blue-200 cursor-pointer">
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Kategori Aktif</span>
                <span class="text-4xl font-bold text-slate-800 mb-4"><?php echo e(count($kategoriLabels)); ?></span>
                <span class="mt-auto text-xs font-medium text-blue-700 bg-blue-50 w-fit px-2.5 py-1 rounded-md">Ready to use</span>
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-10">
            <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-100 p-6 shadow-sm">
                <h2 class="text-base font-bold text-slate-800 mb-6">Pertumbuhan Anggota</h2>
                <div class="relative h-[300px] w-full">
                    <canvas id="anggotaChart"></canvas>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-100 p-6 shadow-sm">
                <h2 class="text-base font-bold text-slate-800 mb-6">Proporsi Kategori</h2>
                <div class="relative h-[300px] flex items-center justify-center">
                    <canvas id="kegiatanChart"></canvas>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden flex flex-col h-full">
                <div class="px-5 py-4 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="font-bold text-slate-800 text-sm">Kegiatan Terdekat</h3>
                </div>
                <ul class="divide-y divide-slate-100 flex-1">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $kegiatanTerdekat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <li class="p-5 hover:bg-slate-50 transition-colors flex justify-between items-center gap-4">
                            <span class="text-sm font-medium text-slate-700 truncate"><?php echo e($k->judul); ?></span>
                            <span class="text-[10px] font-bold bg-emerald-100 text-emerald-700 px-2.5 py-1.5 rounded-full whitespace-nowrap">
                                <?php echo e(\Carbon\Carbon::parse($k->tanggal)->translatedFormat('d M')); ?>

                            </span>
                        </li>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <li class="p-5 text-sm text-slate-400 text-center">Belum ada kegiatan terdekat.</li>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </ul>
            </div>

            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden flex flex-col h-full">
                <div class="px-5 py-4 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="font-bold text-slate-800 text-sm">Aktivitas Terbaru</h3>
                </div>
                <ul class="divide-y divide-slate-100 flex-1">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $aktivitasTerbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $akt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <li class="p-5 hover:bg-slate-50 transition-colors">
                            <p class="text-sm text-slate-600 leading-snug">
                                <span class="font-semibold text-slate-800"><?php echo e($akt->anggota->nama_lengkap ?? 'Anggota'); ?></span> 
                                mendaftar ke <span class="text-emerald-600 font-medium"><?php echo e($akt->kegiatan->judul ?? '-'); ?></span>
                            </p>
                            <span class="text-[10px] font-medium text-slate-400 mt-1.5 block">
                                <?php echo e($akt->created_at->diffForHumans()); ?>

                            </span>
                        </li>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <li class="p-5 text-sm text-slate-400 text-center">Belum ada aktivitas.</li>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </ul>
            </div>

            <div class="bg-white rounded-2xl border border-rose-100 shadow-sm overflow-hidden flex flex-col h-full">
                <div class="px-5 py-4 border-b border-rose-100 bg-rose-50/50">
                    <h3 class="font-bold text-rose-700 text-sm flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        Daftar Alfa
                    </h3>
                </div>
                <ul class="divide-y divide-rose-50 flex-1">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $anggotaBolos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <li class="p-5 hover:bg-rose-50/50 transition-colors">
                            <div class="flex justify-between items-start mb-1">
                                <span class="text-sm font-semibold text-slate-800"><?php echo e($ab->anggota->nama_lengkap ?? 'Tanpa Nama'); ?></span>
                                <span class="text-[10px] bg-rose-100 text-rose-700 px-2 py-1 rounded-md font-bold uppercase tracking-wide">Alfa</span>
                            </div>
                            <div class="text-xs text-slate-500">
                                <?php echo e($ab->kegiatan->judul ?? '-'); ?>

                            </div>
                        </li>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <li class="p-5 text-sm text-emerald-600 font-medium text-center bg-emerald-50/30 h-full flex items-center justify-center">
                            Luar biasa! Tidak ada yang alfa.
                        </li>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Konfigurasi Modern Chart.js
        Chart.defaults.font.family = "'Inter', 'Segoe UI', Roboto, Helvetica, Arial, sans-serif";
        Chart.defaults.color = '#64748b'; // text-slate-500

        const commonOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { 
                    position: 'bottom', 
                    labels: { 
                        usePointStyle: true, 
                        padding: 20, 
                        font: { size: 12, weight: '500' } 
                    } 
                },
                tooltip: {
                    backgroundColor: '#1e293b', // slate-800
                    padding: 12,
                    cornerRadius: 8,
                    titleFont: { size: 13 },
                    bodyFont: { size: 13 }
                }
            }
        };

        // Anggota Chart (Garis yang halus / Smooth Curve)
        new Chart(document.getElementById('anggotaChart').getContext('2d'), {
            type: 'line',
            data: {
                labels: <?php echo json_encode($anggotaLabels, 15, 512) ?>,
                datasets: [{
                    label: 'Anggota Baru',
                    data: <?php echo json_encode($anggotaData, 15, 512) ?>,
                    borderColor: '#10b981', // emerald-500
                    backgroundColor: 'rgba(16, 185, 129, 0.1)', // Light emerald
                    borderWidth: 3,
                    tension: 0.4, // Membuat garis menjadi melengkung modern
                    fill: true,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#10b981',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                ...commonOptions,
                scales: {
                    y: { 
                        beginAtZero: true,
                        grid: { color: '#f1f5f9', drawBorder: false }, // slate-100
                        border: { display: false }
                    },
                    x: { 
                        grid: { display: false },
                        border: { display: false }
                    }
                }
            }
        });

        // Kegiatan Chart (Doughnut Modern)
        new Chart(document.getElementById('kegiatanChart').getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: <?php echo json_encode($kategoriLabels, 15, 512) ?>,
                datasets: [{
                    data: <?php echo json_encode($kategoriData, 15, 512) ?>,
                    // Hanya menggunakan 3 tone warna utama + abu-abu elegan
                    backgroundColor: [
                        '#10b981', // Emerald
                        '#3b82f6', // Blue
                        '#f43f5e', // Rose
                        '#cbd5e1', // Slate 300
                        '#64748b'  // Slate 500
                    ],
                    borderWidth: 0, // Tanpa border untuk kesan seamless
                    hoverOffset: 4
                }]
            },
            options: {
                ...commonOptions,
                cutout: '75%', // Lubang tengah yang lebih besar
                layout: { padding: 10 }
            }
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Sibo\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>