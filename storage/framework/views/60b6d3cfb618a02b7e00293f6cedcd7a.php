

<?php $__env->startSection('content'); ?>
<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 border-b-4 border-gray-900 pb-8 gap-4">
            <div>
                <h1 class="text-5xl font-black text-gray-900 uppercase italic tracking-tighter">
                    Admin <span class="text-green-700">Dashboard</span>
                </h1>
                <p class="text-gray-500 text-[10px] font-black uppercase tracking-[0.3em] mt-2">Status Sistem & Statistik PC DESBOR - <?php echo e(now()->translatedFormat('d F Y')); ?></p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <div class="bg-blue-50 border-2 border-gray-900 p-6 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] flex flex-col">
                <span class="text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Total Anggota</span>
                <span class="text-4xl font-black text-blue-700 leading-none mb-4"><?php echo e(array_sum($anggotaData)); ?></span>
                <span class="mt-auto text-[10px] font-bold text-blue-500 border-t border-blue-200 pt-2 uppercase italic">Database Terpusat</span>
            </div>

            <div class="bg-green-50 border-2 border-gray-900 p-6 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] flex flex-col">
                <span class="text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Total Kegiatan</span>
                <span class="text-4xl font-black text-green-700 leading-none mb-4"><?php echo e(array_sum($kategoriData)); ?></span>
                <span class="mt-auto text-[10px] font-bold text-green-500 border-t border-green-200 pt-2 uppercase italic">Arsip Budaya & Olahraga</span>
            </div>

            <div class="bg-yellow-50 border-2 border-gray-900 p-6 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] flex flex-col">
                <span class="text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Pendaftar Baru</span>
                <span class="text-4xl font-black text-gray-900 leading-none mb-4"><?php echo e($pendaftarBaru); ?></span>
                <span class="mt-auto text-[10px] font-bold text-gray-500 border-t border-yellow-200 pt-2 uppercase italic">Bulan <?php echo e(now()->translatedFormat('F')); ?></span>
            </div>

            <div class="bg-red-50 border-2 border-gray-900 p-6 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] flex flex-col">
                <span class="text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Kategori Aktif</span>
                <span class="text-4xl font-black text-red-700 leading-none mb-4"><?php echo e(count($kategoriLabels)); ?></span>
                <span class="mt-auto text-[10px] font-bold text-red-500 border-t border-red-200 pt-2 uppercase italic">Ready to use</span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
            <div class="lg:col-span-2 bg-white border-2 border-gray-900 p-6 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] overflow-hidden">
                <h2 class="text-lg font-black uppercase italic border-b-2 border-gray-900 pb-4 mb-6 flex items-center gap-2">
                    Pertumbuhan Anggota
                </h2>
                <div class="relative h-[300px]">
                    <canvas id="anggotaChart"></canvas>
                </div>
            </div>

            <div class="bg-white border-2 border-gray-900 p-6 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                <h2 class="text-lg font-black uppercase italic border-b-2 border-gray-900 pb-4 mb-6 text-center">Proporsi Kategori</h2>
                <div class="relative h-[300px] flex items-center justify-center">
                    <canvas id="kegiatanChart"></canvas>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            <div class="bg-white border-2 border-gray-900 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] overflow-hidden">
                <div class="p-4 bg-gray-900 text-white font-black uppercase text-xs italic tracking-[0.2em]">
                    Kegiatan Terdekat
                </div>
                <ul class="divide-y-2 divide-gray-900 font-bold">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $kegiatanTerdekat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <li class="p-4 hover:bg-yellow-100 transition-colors flex justify-between gap-2">
                            <span class="text-xs uppercase leading-tight"><?php echo e($k->judul); ?></span>
                            <span class="text-[9px] bg-black text-white px-2 py-1 uppercase whitespace-nowrap"><?php echo e(\Carbon\Carbon::parse($k->tanggal)->translatedFormat('d M')); ?></span>
                        </li>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <li class="p-4 text-xs italic text-gray-400">Kosong...</li>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </ul>
            </div>

            <div class="bg-white border-2 border-gray-900 shadow-[6px_6px_0px_0px_rgba(0,100,0,1)] overflow-hidden">
                <div class="p-4 bg-green-800 text-white font-black uppercase text-xs italic tracking-[0.2em]">
                    Aktivitas Terbaru
                </div>
                <ul class="divide-y-2 divide-gray-900 font-bold">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $aktivitasTerbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $akt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <li class="p-4 hover:bg-green-50 transition-colors">
                            <p class="text-[11px] leading-tight uppercase">
                                <span class="text-green-700"><?php echo e($akt->anggota->nama_lengkap ?? 'Anggota'); ?></span> 
                                mendaftar ke <span class="italic">"<?php echo e($akt->kegiatan->judul ?? '-'); ?>"</span>
                            </p>
                            <span class="text-[8px] text-gray-400 mt-2 block uppercase"><?php echo e($akt->created_at->diffForHumans()); ?></span>
                        </li>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <li class="p-4 text-xs italic text-gray-400">Belum ada...</li>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </ul>
            </div>

            <div class="bg-white border-2 border-gray-900 shadow-[6px_6px_0px_0px_rgba(185,28,28,1)] overflow-hidden">
                <div class="p-4 bg-red-700 text-white font-black uppercase text-xs italic tracking-[0.2em]">
                    Daftar Alfa
                </div>
                <ul class="divide-y-2 divide-gray-900 font-bold">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $anggotaBolos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <li class="p-4 bg-red-50/50">
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-xs uppercase text-red-700 font-black"><?php echo e($ab->anggota->nama_lengkap ?? '?'); ?></span>
                                <span class="text-[8px] border border-red-700 px-1 text-red-700 font-black">ALFA</span>
                            </div>
                            <div class="text-[9px] text-gray-500 uppercase tracking-tighter">
                                <?php echo e($ab->kegiatan->judul ?? '-'); ?>

                            </div>
                        </li>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <li class="p-4 text-xs italic text-gray-400">Zero Alfa!</li>
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
        // Kita modifikasi sedikit tampilan chart-nya agar lebih brutalist
        Chart.defaults.font.family = 'Inter, sans-serif';
        Chart.defaults.font.weight = '900';
        Chart.defaults.color = '#000';

        const commonOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom', labels: { boxWidth: 10, font: { size: 10 } } }
            },
            scales: {
                y: { grid: { color: '#e5e7eb' }, border: { width: 2, color: '#000' } },
                x: { grid: { display: false }, border: { width: 2, color: '#000' } }
            }
        };

        // Anggota Chart
        new Chart(document.getElementById('anggotaChart').getContext('2d'), {
            type: 'line',
            data: {
                labels: <?php echo json_encode($anggotaLabels, 15, 512) ?>,
                datasets: [{
                    label: 'ANGGOTA BARU',
                    data: <?php echo json_encode($anggotaData, 15, 512) ?>,
                    borderColor: '#1d4ed8', // Biru Tua
                    backgroundColor: '#1d4ed8',
                    borderWidth: 4,
                    tension: 0, // Garis kaku (Sesuai style Brutalist)
                    pointStyle: 'rect',
                    pointRadius: 6,
                    pointBackgroundColor: '#fff'
                }]
            },
            options: commonOptions
        });

        // Kegiatan Chart
        new Chart(document.getElementById('kegiatanChart').getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: <?php echo json_encode($kategoriLabels, 15, 512) ?>,
                datasets: [{
                    data: <?php echo json_encode($kategoriData, 15, 512) ?>,
                    backgroundColor: ['#15803d', '#facc15', '#b91c1c', '#1d4ed8', '#7e22ce'],
                    borderWidth: 3,
                    borderColor: '#000'
                }]
            },
            options: {
                ...commonOptions,
                cutout: '65%',
                scales: { x: { display: false }, y: { display: false } }
            }
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Sibo\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>