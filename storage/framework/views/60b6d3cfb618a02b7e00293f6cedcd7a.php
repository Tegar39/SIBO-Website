<?php $__env->startSection('content'); ?>
<div class="pt-28 pb-12 bg-slate-50 min-h-screen font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8 flex flex-col lg:flex-row lg:items-end justify-between gap-5">
            <div>
                <p class="inline-flex items-center gap-2 text-xs font-black uppercase tracking-[0.25em] text-emerald-700 bg-emerald-50 px-4 py-2 rounded-full border border-emerald-100 mb-3">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    Analisis Data Bulan Berjalan
                </p>
                <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">
                    Dashboard <span class="text-emerald-600">Admin</span>
                </h1>
                <p class="text-slate-500 text-sm mt-1 font-medium">
                    Ringkasan otomatis untuk <?php echo e($periodeBulanIni); ?>. Filter detail tersedia di menu Laporan.
                </p>
            </div>
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm px-5 py-4">
                <p class="text-[10px] font-black uppercase tracking-[0.22em] text-slate-400">Periode Dashboard</p>
                <p class="text-lg font-black text-slate-800 mt-1"><?php echo e($periodeBulanIni); ?></p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100">
                <span class="text-xs font-black text-slate-400 uppercase tracking-widest">Anggota Baru Bulan Ini</span>
                <div class="flex items-end justify-between mt-2">
                    <span class="text-4xl font-black text-slate-800"><?php echo e($anggotaBaruBulanIni); ?></span>
                    <span class="text-[10px] font-black text-emerald-700 bg-emerald-50 px-3 py-1 rounded-full uppercase">baru</span>
                </div>
                <p class="text-xs text-slate-500 mt-4">Total anggota keseluruhan: <b><?php echo e($totalAnggota); ?></b></p>
            </div>

            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100">
                <span class="text-xs font-black text-slate-400 uppercase tracking-widest">Kegiatan Tahunan</span>
                <div class="flex items-end justify-between mt-2">
                    <span class="text-4xl font-black text-slate-800"><?php echo e($totalKegiatanTahunan); ?></span>
                    <span class="text-[10px] font-black text-blue-700 bg-blue-50 px-3 py-1 rounded-full uppercase"><?php echo e($periodeTahunIni); ?></span>
                </div>
                <p class="text-xs text-slate-500 mt-4">Total agenda sepanjang tahun berjalan.</p>
            </div>

            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100">
                <span class="text-xs font-black text-slate-400 uppercase tracking-widest">Kegiatan Bulan Ini</span>
                <div class="flex items-end justify-between mt-2">
                    <span class="text-4xl font-black text-slate-800"><?php echo e($totalKegiatanBulanIni); ?></span>
                    <span class="text-[10px] font-black text-amber-700 bg-amber-50 px-3 py-1 rounded-full uppercase">bulan ini</span>
                </div>
                <p class="text-xs text-slate-500 mt-4">Terlaksana: <b><?php echo e($kegiatanTerlaksanaBulanIni); ?></b> &bull; Terjadwal: <b><?php echo e($kegiatanTerjadwalBulanIni); ?></b></p>
            </div>

            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100">
                <span class="text-xs font-black text-slate-400 uppercase tracking-widest">Pendaftar Bulan Ini</span>
                <div class="flex items-end justify-between mt-2">
                    <span class="text-4xl font-black text-slate-800"><?php echo e($pendaftarBulanIni); ?></span>
                    <span class="text-[10px] font-black text-purple-700 bg-purple-50 px-3 py-1 rounded-full uppercase">peserta</span>
                </div>
                <p class="text-xs text-slate-500 mt-4">Disetujui: <b><?php echo e($pesertaDisetujuiBulanIni); ?></b> &bull; Hadir: <b><?php echo e($hadirBulanIni); ?></b> &bull; Tidak hadir: <b><?php echo e($tidakHadirBulanIni); ?></b></p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <div class="lg:col-span-2 bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/60 flex items-center justify-between gap-4">
                    <div>
                        <h3 class="font-black text-slate-800 text-sm uppercase tracking-wider">Kegiatan Belum Terlaksana Bulan Ini</h3>
                        <p class="text-xs text-slate-500 mt-1">Admin dapat langsung melihat agenda yang masih harus dijalankan tanpa mencari/filter.</p>
                    </div>
                    <span class="text-xs font-black text-emerald-700 bg-emerald-50 px-3 py-1.5 rounded-full"><?php echo e($kegiatanBelumTerlaksanaBulanIni->count()); ?> agenda</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-white border-b border-slate-100">
                            <tr class="text-[11px] font-black uppercase tracking-widest text-slate-500">
                                <th class="px-6 py-4">Kegiatan</th>
                                <th class="px-6 py-4">Jadwal</th>
                                <th class="px-6 py-4 text-center">Peserta</th>
                                <th class="px-6 py-4 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $kegiatanBelumTerlaksanaBulanIni; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kegiatan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <tr class="hover:bg-slate-50/70 transition">
                                    <td class="px-6 py-4">
                                        <p class="font-bold text-slate-800 text-sm"><?php echo e($kegiatan->judul); ?></p>
                                        <p class="text-xs text-slate-500 mt-1"><?php echo e($kegiatan->kategori->nama ?? 'Umum'); ?> &bull; <?php echo e($kegiatan->lokasi ?: 'Lokasi belum diisi'); ?></p>
                                    </td>
                                    <td class="px-6 py-4 text-xs font-bold text-slate-600 whitespace-nowrap">
                                        <?php echo e(\Carbon\Carbon::parse($kegiatan->tanggal)->locale('id')->translatedFormat('d M Y')); ?>

                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($kegiatan->waktu): ?>
                                            <span class="block text-[10px] text-slate-400 mt-1"><?php echo e(\Carbon\Carbon::parse($kegiatan->waktu)->format('H:i')); ?></span>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-flex bg-emerald-50 text-emerald-700 text-xs font-black px-3 py-1.5 rounded-xl border border-emerald-100">
                                            <?php echo e($kegiatan->total_disetujui); ?> / <?php echo e($kegiatan->total_pendaftar); ?>

                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="text-[10px] font-black uppercase tracking-wider px-3 py-1 rounded-full <?php echo e($kegiatan->status === 'tutup' ? 'bg-amber-100 text-amber-700' : 'bg-emerald-100 text-emerald-700'); ?>"><?php echo e($kegiatan->status); ?></span>
                                    </td>
                                </tr>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                <tr><td colspan="4" class="px-6 py-14 text-center text-sm text-slate-400">Tidak ada kegiatan terjadwal yang belum terlaksana pada bulan ini.</td></tr>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="bg-white rounded-3xl border border-amber-100 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-amber-100 bg-amber-50/60">
                    <h3 class="font-black text-amber-700 text-sm uppercase tracking-wider">Notifikasi H-1</h3>
                    <p class="text-xs text-amber-600 mt-1">Pengingat otomatis untuk kegiatan besok.</p>
                </div>
                <ul class="divide-y divide-amber-50">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $kegiatanH1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kegiatan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <li class="p-5 hover:bg-amber-50/50 transition-colors">
                            <div class="flex justify-between items-start gap-3">
                                <div>
                                    <p class="text-sm font-black text-slate-800"><?php echo e($kegiatan->judul); ?></p>
                                    <p class="text-xs text-slate-500 mt-1"><?php echo e($kegiatan->lokasi ?: 'Lokasi belum diisi'); ?></p>
                                </div>
                                <span class="text-[10px] bg-amber-100 text-amber-700 px-2 py-1 rounded-md font-black uppercase tracking-wide">H-1</span>
                            </div>
                            <p class="text-[11px] text-slate-500 mt-3">Peserta disetujui: <b><?php echo e($kegiatan->total_disetujui); ?></b>. Notifikasi dikirim otomatis ke peserta.</p>
                        </li>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <li class="p-10 text-center text-sm text-slate-400">Tidak ada kegiatan H-1 hari ini.</li>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </ul>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <div class="lg:col-span-2 bg-white rounded-3xl border border-slate-100 shadow-sm p-6">
                <div class="mb-5">
                    <h3 class="font-black text-slate-800 text-sm uppercase tracking-wider">Tren 6 Bulan Terakhir</h3>
                    <p class="text-xs text-slate-500 mt-1">Ringkasan perkembangan anggota, kegiatan, dan pendaftar.</p>
                </div>
                <div class="h-72">
                    <canvas id="trenBulananChart"></canvas>
                </div>
            </div>

            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6">
                <div class="mb-5">
                    <h3 class="font-black text-slate-800 text-sm uppercase tracking-wider">Kegiatan per Kategori</h3>
                    <p class="text-xs text-slate-500 mt-1">Bulan berjalan.</p>
                </div>
                <div class="h-72">
                    <canvas id="kategoriChart"></canvas>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/60">
                <h3 class="font-black text-slate-800 text-sm uppercase tracking-wider">Pendaftar Terbaru Bulan Ini</h3>
                <p class="text-xs text-slate-500 mt-1">Cuplikan aktivitas terbaru, bukan laporan detail. Data lengkap tersedia di menu Laporan.</p>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-white border-b border-slate-100">
                        <tr class="text-[11px] font-black uppercase tracking-widest text-slate-500">
                            <th class="px-6 py-4">Pendaftar</th>
                            <th class="px-6 py-4">Kegiatan</th>
                            <th class="px-6 py-4">Jenis</th>
                            <th class="px-6 py-4 text-center">Status</th>
                            <th class="px-6 py-4 text-right">Waktu</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $pendaftarTerbaruBulanIni; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pendaftaran): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <tr class="hover:bg-slate-50/60">
                                <td class="px-6 py-4 text-sm font-bold text-slate-800"><?php echo e($pendaftaran->display_name); ?></td>
                                <td class="px-6 py-4">
                                    <p class="text-sm font-bold text-slate-700"><?php echo e($pendaftaran->kegiatan->judul ?? '-'); ?></p>
                                    <p class="text-xs text-slate-500 mt-1"><?php echo e($pendaftaran->kegiatan->kategori->nama ?? 'Umum'); ?></p>
                                </td>
                                <td class="px-6 py-4 text-xs font-black text-slate-500 uppercase tracking-wider">
                                    <?php echo e($pendaftaran->jenis_daftar === 'other' ? 'Orang lain' : ($pendaftaran->jenis_daftar === 'admin' ? 'Admin' : 'Sendiri')); ?>

                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="text-[10px] font-black uppercase px-3 py-1 rounded-full <?php echo e($pendaftaran->status === 'disetujui' ? 'bg-emerald-100 text-emerald-700' : ($pendaftaran->status === 'pending' ? 'bg-amber-100 text-amber-700' : 'bg-rose-100 text-rose-700')); ?>"><?php echo e($pendaftaran->status); ?></span>
                                </td>
                                <td class="px-6 py-4 text-right text-xs font-bold text-slate-500 whitespace-nowrap"><?php echo e($pendaftaran->created_at->locale('id')->translatedFormat('d M Y H:i')); ?></td>
                            </tr>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            <tr><td colspan="5" class="px-6 py-12 text-center text-sm text-slate-400">Belum ada pendaftar bulan ini.</td></tr>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Chart.defaults.font.family = "'Inter', 'Segoe UI', Roboto, Helvetica, Arial, sans-serif";
        Chart.defaults.color = '#64748b';

        const commonOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom', labels: { usePointStyle: true, padding: 18, font: { size: 12, weight: '700' } } },
                tooltip: { backgroundColor: '#0f172a', padding: 12, cornerRadius: 12 }
            },
            scales: {
                y: { beginAtZero: true, ticks: { precision: 0 }, grid: { color: '#e2e8f0' } },
                x: { grid: { display: false } }
            }
        };

        const trenCtx = document.getElementById('trenBulananChart');
        if (trenCtx) {
            new Chart(trenCtx, {
                type: 'line',
                data: {
                    labels: <?php echo json_encode($trenLabels, 15, 512) ?>,
                    datasets: [
                        { label: 'Anggota Baru', data: <?php echo json_encode($trenAnggotaData, 15, 512) ?>, borderColor: '#059669', backgroundColor: 'rgba(5,150,105,.12)', tension: .35, fill: true },
                        { label: 'Kegiatan', data: <?php echo json_encode($trenKegiatanData, 15, 512) ?>, borderColor: '#2563eb', backgroundColor: 'rgba(37,99,235,.08)', tension: .35 },
                        { label: 'Pendaftar', data: <?php echo json_encode($trenPendaftarData, 15, 512) ?>, borderColor: '#f59e0b', backgroundColor: 'rgba(245,158,11,.08)', tension: .35 }
                    ]
                },
                options: commonOptions
            });
        }

        const kategoriCtx = document.getElementById('kategoriChart');
        if (kategoriCtx) {
            new Chart(kategoriCtx, {
                type: 'doughnut',
                data: {
                    labels: <?php echo json_encode($kategoriLabels, 15, 512) ?>,
                    datasets: [{ data: <?php echo json_encode($kategoriData, 15, 512) ?>, backgroundColor: ['#059669', '#f59e0b', '#2563eb', '#dc2626', '#7c3aed', '#0f766e'], borderWidth: 0 }]
                },
                options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, font: { size: 11, weight: '700' } } } }, cutout: '62%' }
            });
        }
    });
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Sibo\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>