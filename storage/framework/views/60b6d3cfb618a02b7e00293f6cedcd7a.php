

<?php $__env->startSection('content'); ?>
<div class="py-8 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Dashboard Admin</h1>
            <span class="text-sm font-medium text-gray-500 bg-white px-4 py-2 rounded-full shadow-sm border border-gray-100">
                <?php echo e(now()->translatedFormat('d F Y')); ?>

            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="relative overflow-hidden bg-white rounded-2xl shadow-sm border border-gray-100 p-6 transition hover:shadow-md">
                <div class="absolute top-0 right-0 p-3 opacity-10">
                    <svg class="w-12 h-12 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path></svg>
                </div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Anggota</p>
                <p class="text-3xl font-bold text-blue-600 mt-1"><?php echo e(array_sum($anggotaData)); ?></p>
                <div class="mt-2 text-xs text-blue-500 font-medium">Data terdaftar aktif</div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 transition hover:shadow-md">
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Kegiatan</p>
                <p class="text-3xl font-bold text-green-600 mt-1"><?php echo e(array_sum($kategoriData)); ?></p>
                <div class="mt-2 text-xs text-green-500 font-medium">Seluruh kategori kegiatan</div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 transition hover:shadow-md">
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Pendaftar Baru</p>
                <p class="text-3xl font-bold text-purple-600 mt-1"><?php echo e($pendaftarBaru); ?></p>
                <div class="mt-2 text-xs text-purple-500 font-medium">Bulan <?php echo e(now()->translatedFormat('F')); ?></div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 transition hover:shadow-md">
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Kategori Aktif</p>
                <p class="text-3xl font-bold text-orange-600 mt-1"><?php echo e(count($kategoriLabels)); ?></p>
                <div class="mt-2 text-xs text-orange-500 font-medium">Tersedia untuk pendaftaran</div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <span class="w-2 h-6 bg-blue-600 rounded-full"></span>
                    Pertumbuhan Anggota (6 Bulan Terakhir)
                </h2>
                <div class="relative h-[300px]">
                    <canvas id="anggotaChart"></canvas>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Kegiatan per Kategori</h2>
                <div class="relative h-[250px] flex items-center justify-center">
                    <canvas id="kegiatanChart"></canvas>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
            <h2 class="text-lg font-bold text-gray-800 mb-4">5 Kegiatan dengan Pendaftar Terbanyak</h2>
            <div class="relative h-[200px]">
                <canvas id="pendaftarChart"></canvas>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-4 border-b border-gray-50 bg-gray-50/50">
                    <h2 class="font-bold text-gray-800">Kegiatan Terdekat</h2>
                </div>
                <ul class="divide-y divide-gray-100">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $kegiatanTerdekat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <li class="p-4 hover:bg-gray-50 transition">
                            <div class="flex justify-between items-start">
                                <span class="font-semibold text-sm text-gray-700 leading-snug"><?php echo e($k->judul); ?></span>
                                <span class="text-[10px] font-bold bg-blue-50 text-blue-600 px-2 py-1 rounded uppercase">
                                    <?php echo e(\Carbon\Carbon::parse($k->tanggal)->translatedFormat('d M')); ?>

                                </span>
                            </div>
                        </li>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <li class="p-4 text-gray-500 text-sm italic text-center">Tidak ada kegiatan terdekat.</li>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </ul>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-4 border-b border-gray-50 bg-gray-50/50">
                    <h2 class="font-bold text-gray-800">Aktivitas Terbaru</h2>
                </div>
                <ul class="divide-y divide-gray-100">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $aktivitasTerbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $akt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <li class="p-4 hover:bg-gray-50 transition">
                            <p class="text-sm text-gray-600 leading-tight">
                                <strong class="text-gray-900"><?php echo e($akt->anggota->nama_lengkap ?? 'Anggota'); ?></strong> 
                                mendaftar kegiatan 
                                <span class="text-blue-600 italic">"<?php echo e($akt->kegiatan->judul ?? '-'); ?>"</span>
                            </p>
                            <span class="text-[10px] text-gray-400 mt-1 block uppercase font-bold"><?php echo e($akt->created_at->diffForHumans()); ?></span>
                        </li>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <li class="p-4 text-gray-500 text-sm italic text-center">Belum ada aktivitas.</li>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </ul>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-4 border-b border-gray-50 bg-red-50/50">
                    <h2 class="font-bold text-red-800">Anggota Bolos</h2>
                </div>
                <ul class="divide-y divide-gray-100">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $anggotaBolos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <li class="p-4 bg-red-50/20">
                            <div class="flex justify-between items-center mb-1">
                                <span class="font-bold text-sm text-gray-900"><?php echo e($ab->anggota->nama_lengkap ?? '?'); ?></span>
                                <span class="text-[10px] font-bold text-red-600 bg-red-100 px-2 py-0.5 rounded uppercase">Alfa</span>
                            </div>
                            <div class="text-[11px] text-gray-500">
                                <?php echo e($ab->kegiatan->judul ?? '-'); ?> (<?php echo e(\Carbon\Carbon::parse($ab->kegiatan->tanggal)->format('d M Y')); ?>)
                            </div>
                        </li>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <li class="p-4 text-gray-500 text-sm italic text-center">Tidak ada yang bolos.</li>
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
        const commonOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom', labels: { boxWidth: 12, font: { size: 11 } } }
            }
        };

        // Grafik garis - pertumbuhan anggota
        new Chart(document.getElementById('anggotaChart').getContext('2d'), {
            type: 'line',
            data: {
                labels: <?php echo json_encode($anggotaLabels, 15, 512) ?>,
                datasets: [{
                    label: 'Anggota Baru',
                    data: <?php echo json_encode($anggotaData, 15, 512) ?>,
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.05)',
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#3b82f6',
                    pointRadius: 4
                }]
            },
            options: commonOptions
        });

        // Grafik lingkaran - Diperkecil dengan pengaturan cutout
        new Chart(document.getElementById('kegiatanChart').getContext('2d'), {
            type: 'doughnut', // Menggunakan Doughnut agar lebih modern
            data: {
                labels: <?php echo json_encode($kategoriLabels, 15, 512) ?>,
                datasets: [{
                    data: <?php echo json_encode($kategoriData, 15, 512) ?>,
                    backgroundColor: ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6'],
                    borderWidth: 0
                }]
            },
            options: {
                ...commonOptions,
                cutout: '70%', // Membuat ring lebih tipis
            }
        });

        // Grafik batang - pendaftar per kegiatan
        new Chart(document.getElementById('pendaftarChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($kegiatanPendaftarLabels, 15, 512) ?>,
                datasets: [{
                    label: 'Jumlah Pendaftar',
                    data: <?php echo json_encode($kegiatanPendaftarData, 15, 512) ?>,
                    backgroundColor: '#f97316',
                    borderRadius: 5,
                    barThickness: 30
                }]
            },
            options: commonOptions
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Sibo\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>