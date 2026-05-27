<?php $__env->startSection('content'); ?>
<div class="bg-slate-50 font-sans text-slate-800 selection:bg-green-200 selection:text-green-900">
    <!-- Hero Section -->
    <section id="home" 
        class="relative overflow-hidden h-screen min-h-[600px] scroll-mt-20 group"
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
            <div class="absolute inset-0 transition-transform duration-1000 group-hover:scale-105">
                <img src="<?php echo e($heroImage); ?>" alt="Hero Background" class="w-full h-full object-cover object-center">
                <div id="hero-overlay" class="absolute inset-0 bg-slate-900/60 backdrop-blur-[2px] transition-all duration-700"></div>
            </div>
        <?php else: ?>
            <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-slate-800 to-green-950"></div>
            <div class="absolute top-0 -left-40 w-96 h-96 bg-green-500 rounded-full mix-blend-multiply filter blur-[128px] opacity-20 animate-pulse"></div>
            <div class="absolute bottom-0 -right-40 w-96 h-96 bg-green-400 rounded-full mix-blend-multiply filter blur-[128px] opacity-20 animate-pulse" style="animation-delay: 2s;"></div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div class="relative z-10 flex flex-col items-center justify-center h-full text-center text-white px-4 sm:px-6 lg:px-8">
            <div class="animate-fade-in-up max-w-4xl mx-auto flex flex-col items-center">
                <span class="px-5 py-2 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-green-300 text-xs sm:text-sm font-semibold tracking-widest mb-8 inline-block shadow-lg">
                    SISTEM INFORMASI BUDAYA & OLAHRAGA
                </span>
                <h1 class="text-5xl sm:text-6xl md:text-8xl font-black tracking-tight drop-shadow-xl leading-[1.1]">
                    Aktivitas & <br class="md:hidden" />
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-green-300">Inspirasi</span>
                </h1>
                <p class="mt-6 md:mt-8 text-base md:text-xl text-slate-200 drop-shadow max-w-2xl font-light leading-relaxed">
                    PC IPNU IPPNU Departemen Seni Budaya & Olahraga<br>
                    <span class="font-medium text-white">Kabupaten Kediri</span>
                </p>
                <div class="mt-10 flex flex-col sm:flex-row justify-center gap-4 w-full sm:w-auto">
                    <a href="#kegiatan-terbaru"
                    class="relative px-8 py-4 font-semibold rounded-full shadow-[0_0_40px_rgba(34,197,94,0.3)] overflow-hidden inline-flex items-center justify-center bg-green-500 text-white hover:bg-green-400 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-[0_0_60px_rgba(34,197,94,0.5)] ring-1 ring-green-400/50">
                        <span>Lihat Kegiatan</span>
                        <svg class="w-5 h-5 ml-2 -mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            </div>
        </div>

        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 cursor-pointer z-30" onclick="window.scrollTo({top: window.innerHeight, behavior: 'smooth'})">
            <div class="animate-bounce bg-white/5 backdrop-blur-sm border border-white/10 rounded-full p-3 hover:bg-white/20 transition-all group">
                <svg class="w-6 h-6 text-white/70 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
            </div>
        </div>
    </section>



    <!-- Direktori PAC Aktif -->
    <section id="pac" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-8">
            <div>
                <span class="text-emerald-600 font-black uppercase tracking-[0.25em] text-xs">PAC Aktif</span>
                <h2 class="mt-2 text-3xl md:text-4xl font-black text-slate-900">Informasi PAC</h2>
                <p class="mt-3 text-slate-500 max-w-2xl">Klik kartu PAC untuk membuka halaman informasi PAC yang aktif beserta nama, jumlah anggota, dan riwayat kegiatannya.</p>
            </div>
            <a href="<?php echo e(route('pac.public.index')); ?>" class="inline-flex justify-center bg-slate-900 hover:bg-emerald-600 text-white px-6 py-3 rounded-2xl text-xs font-black uppercase tracking-widest transition">Lihat Semua PAC</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $pacList ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pac): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <a href="<?php echo e(route('pac.public.show', urlencode($pac->pac))); ?>" class="group bg-white rounded-3xl p-6 border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all">
                    <div class="flex items-center justify-between">
                        <div class="w-11 h-11 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-black">PAC</div>
                        <span class="text-[10px] font-black uppercase tracking-widest text-emerald-600">Aktif</span>
                    </div>
                    <h3 class="mt-5 text-xl font-black text-slate-900 group-hover:text-emerald-600 transition"><?php echo e($pac->pac); ?></h3>
                    <p class="mt-2 text-sm text-slate-500"><?php echo e($pac->total_anggota); ?> anggota terdaftar</p>
                </a>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <div class="col-span-full bg-white rounded-3xl p-8 text-center text-slate-400 font-bold border border-slate-100">Belum ada data PAC aktif.</div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </section>

    <!-- Tentang SIBO (Profil) -->
    <div id="tentang" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
            <div class="relative order-2 lg:order-1">
                <div class="mb-10 relative">
                    <span class="flex items-center text-green-600 font-bold text-sm uppercase tracking-[0.2em] mb-4">
                        <span class="w-8 h-px bg-green-600 mr-4"></span> Profil Organisasi
                    </span>
                    <h2 class="text-4xl md:text-5xl font-black text-slate-900 tracking-tight leading-tight">
                        Tentang <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-green-500">Organisasi</span>
                    </h2>
                </div>
                <div class="space-y-8">
                    <p class="text-slate-600 text-lg leading-relaxed text-justify">
                        IPNU (Ikatan Pelajar Nahdlatul Ulama) dan IPPNU (Ikatan Pelajar Putri Nahdlatul Ulama) adalah badan otonom NU yang menjadi wadah kaderisasi pelajar dan mahasiswa, bertujuan membentuk pelajar religius, berilmu, berakhlak mulia, serta cinta tanah air berdasarkan Pancasila dan Aswaja. IPNU khusus untuk pelajar putra (berdiri 1954) dan IPPNU untuk pelajar putri (berdiri 1955), keduanya merupakan organisasi kepelajaran, kekeluargaan, kemasyarakatan, dan keagamaan yang berfokus pada pendidikan, pengkaderan, dan pengabdian masyarakat.
                    </p>
                    <div class="grid grid-cols-1 gap-4">
                        <div class="group bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-all duration-300">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-10 h-10 bg-green-600 rounded-lg flex items-center justify-center shadow-lg shadow-green-200">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </div>
                                <h3 class="text-xl font-bold text-slate-800 uppercase tracking-wide">Visi</h3>
                            </div>
                            <p class="text-slate-600 leading-relaxed italic">
                                "Mewujudkan pelajar bangsa yang bertaqwa, berilmu, berakhlakul karimah, dan berwawasan kebangsaan, yang bertanggung jawab menegakkan syariat Islam Ahlussunnah Wal Jama'ah berdasarkan Pancasila dan UUD 1945, serta menjadi wadah pengembangan potensi pelajar Nahdlatul Ulama untuk membangun peradaban bangsa yang berkeadilan"
                            </p>
                        </div>
                        <div class="group bg-green-50/50 p-6 rounded-2xl border border-green-100/50 hover:bg-green-50 transition-all duration-300">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-10 h-10 bg-slate-800 rounded-lg flex items-center justify-center shadow-lg shadow-slate-200">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                </div>
                                <h3 class="text-xl font-bold text-slate-800 uppercase tracking-wide">Misi</h3>
                            </div>
                            <p class="text-slate-600 leading-relaxed">
                                Membangun kader NU berkualitas yang religius (bertaqwa, berakhlak mulia), intelektual (berilmu, menguasai IPTEK), berwawasan kebangsaan (demokratis, cinta NKRI, berwawasan kebhinekaan), serta mengembangkan potensi kader menjadi pribadi yang dinamis, kreatif, inovatif, dan mandiri, dengan landasan Islam Ahlussunnah Wal Jama'ah, untuk menciptakan pelajar berdaya guna bagi agama, bangsa, dan negara.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-center relative order-1 lg:order-2">
                <div class="absolute inset-0 bg-gradient-to-tr from-green-200 to-green-50 rounded-[3rem] transform rotate-3 scale-105 -z-10 opacity-60"></div>
                <div class="absolute inset-0 bg-white/40 backdrop-blur-3xl rounded-[3rem] -z-10"></div>
                <div class="relative rounded-[2.5rem] bg-white p-8 md:p-12 shadow-[0_30px_60px_rgba(0,0,0,0.08)] border border-slate-100 w-full max-w-md group overflow-hidden">
                    <img src="<?php echo e(asset('images/logo-desbor.png')); ?>" alt="PC DESBOR" class="w-full h-auto object-contain transform group-hover:scale-110 transition-transform duration-700 drop-shadow-2xl">
                    <div class="absolute top-0 right-0 p-4 opacity-10">
                        <svg class="w-20 h-20 text-green-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"/></svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik -->
    <div id="statistik" class="relative py-32 overflow-hidden bg-white transition-colors duration-700">
        <div class="absolute inset-0 z-0 opacity-0 transition-all duration-[1200ms] ease-out scale-110" id="stat-bg">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($heroImage): ?>
                <img src="<?php echo e($heroImage); ?>" class="w-full h-full object-cover grayscale opacity-10 mix-blend-luminosity">
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <div class="absolute inset-0 bg-slate-900/95 backdrop-blur-sm"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 relative z-10">
            <div class="text-center mb-20 transition-all duration-700" id="stat-content">
                <div class="inline-block relative">
                    <h2 class="text-4xl md:text-6xl font-black text-slate-900 tracking-tight leading-none transition-colors duration-500" id="stat-title">
                        JUMLAH <span class="text-green-600 transition-colors duration-500" id="stat-highlight">DATA</span>
                    </h2>
                </div>
                <p class="text-slate-500 font-bold mt-6 text-sm md:text-base uppercase tracking-[0.3em] max-w-lg mx-auto" id="stat-subtitle">
                    Real-time Rekapitulasi Anggota
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12 relative z-20">
                <?php
                    $stats = [
                        ['label' => 'Total Anggota', 'val' => $totalAnggota ?? 0, 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'],
                        ['label' => 'Total Kegiatan', 'val' => $totalKegiatan ?? 0, 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                        ['label' => 'PAC Aktif', 'val' => $totalPac ?? 0, 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
                    ];
                ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <div class="group text-center bg-white rounded-[2rem] py-12 px-6 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100 transition-all duration-500 hover:shadow-[0_20px_40px_rgb(0,0,0,0.08)] hover:-translate-y-2 stat-card relative overflow-hidden">
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-green-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-700 ease-out z-0"></div>
                    <div class="relative z-10 flex flex-col items-center">
                        <div class="w-16 h-16 mb-6 rounded-2xl bg-green-50 text-green-600 flex items-center justify-center transition-colors duration-500 stat-icon-container">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="<?php echo e($s['icon']); ?>"></path></svg>
                        </div>
                        <div class="text-6xl md:text-7xl font-black text-slate-900 tracking-tight mb-2 transition-colors duration-500 stat-number"><?php echo e($s['val']); ?></div>
                        <div class="text-green-600 font-bold uppercase tracking-widest text-xs transition-colors duration-500 stat-label"><?php echo e($s['label']); ?></div>
                    </div>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full text-center pointer-events-none select-none z-0 overflow-hidden">
                <span class="stat-outline-dynamic text-[8rem] md:text-[18rem] font-black uppercase tracking-tighter block leading-none opacity-5 transition-all duration-700 whitespace-nowrap">
                    STATISTIK
                </span>
            </div>
        </div>
    </div>

    <!-- ========== INFORMASI & KEGIATAN (Horizontal Scroll FIXED) ========== -->
    <div id="kegiatan-terbaru" class="bg-slate-50/50 py-24 relative">
        <div class="absolute inset-0 bg-top bg-no-repeat bg-[url('data:image/svg+xml,%3Csvg width=\"100%25\" height=\"100%25\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cdefs%3E%3Cpattern id=\"grid\" width=\"40\" height=\"40\" patternUnits=\"userSpaceOnUse\"%3E%3Cpath d=\"M0 40L40 0H20L0 20M40 40V20L20 40\" fill=\"none\" stroke=\"%23e2e8f0\" stroke-opacity=\"0.4\"/%3E%3C/pattern%3E%3C/defs%3E%3Crect width=\"100%25\" height=\"100%25\" fill=\"url(%23grid)\"/%3E%3C/svg%3E')]"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
                <div>
                    <span class="flex items-center text-green-600 font-bold text-sm uppercase tracking-[0.2em] mb-3">
                        <span class="w-8 h-px bg-green-600 mr-3"></span> Update
                    </span>
                    <h2 class="text-4xl md:text-5xl font-black text-slate-900 tracking-tight leading-none">
                        Informasi <span class="text-green-600">Kegiatan</span>
                    </h2>
                </div>
                <div>
                    <a href="<?php echo e(route('kegiatan.publik.index')); ?>" class="inline-flex items-center text-sm font-bold text-slate-700 bg-white border border-slate-200 px-6 py-3 rounded-full hover:border-green-500 hover:text-green-600 shadow-sm transition-all group">
                        Lihat Semua Kegiatan 
                        <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>

            <!-- SCROLL HORIZONTAL: overflow-x-auto pada parent, w-max pada flex container -->
            <div class="w-full overflow-x-auto pb-6 scrollbar-hide" style="-webkit-overflow-scrolling: touch;">
                <div class="flex gap-6 w-max px-2">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $kegiatanTerbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kegiatan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <div class="w-[85vw] sm:w-[340px] flex-none">
                            <div class="bg-white rounded-[2rem] border border-slate-100/80 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_20px_40px_rgb(0,0,0,0.08)] transition-all duration-500 flex flex-col h-full group/card relative overflow-hidden">
                                <div class="relative aspect-[4/3] overflow-hidden bg-slate-100 m-2 rounded-[1.5rem]">
                                    <?php
                                        $imgPath = ($kegiatan->pamflet && $kegiatan->pamflet->path_file) ? Storage::url($kegiatan->pamflet->path_file) : null;
                                    ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($imgPath): ?>
                                        <img src="<?php echo e($imgPath); ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover/card:scale-110">
                                    <?php else: ?>
                                        <div class="w-full h-full flex flex-col items-center justify-center text-slate-400 bg-slate-100">
                                            <svg class="w-12 h-12 mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            <span class="text-sm font-medium">Tidak Ada Poster</span>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <div class="absolute top-4 left-4 z-10">
                                        <span class="bg-white/90 backdrop-blur-md text-slate-800 text-xs font-bold px-4 py-2 rounded-full shadow-sm border border-white/50">
                                            <?php echo e($kegiatan->kategori->nama ?? 'EVENT'); ?>

                                        </span>
                                    </div>
                                </div>
                                <div class="p-6 flex-grow flex flex-col relative z-10">
                                    <div class="flex items-center gap-2 text-xs font-bold text-green-600 mb-4 bg-green-50 w-fit px-3 py-1.5 rounded-lg">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        <?php echo e(\Carbon\Carbon::parse($kegiatan->tanggal)->translatedFormat('d M Y')); ?>

                                    </div>
                                    <h3 class="text-xl font-bold text-slate-900 leading-tight mb-3 transition-colors group-hover/card:text-green-600 line-clamp-2">
                                        <?php echo e($kegiatan->judul); ?>

                                    </h3>
                                    <p class="text-sm text-slate-500 leading-relaxed line-clamp-3 mb-6">
                                        <?php echo e($kegiatan->deskripsi); ?>

                                    </p>
                                    <div class="mt-auto pt-5 border-t border-slate-100">
                                        <a href="<?php echo e(route('kegiatan.publik.show', $kegiatan->id_kegiatan)); ?>" class="w-full inline-flex items-center justify-center text-sm font-bold text-white bg-slate-900 hover:bg-green-600 py-3 rounded-xl transition-colors duration-300">
                                            Detail Kegiatan 
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <div class="w-full flex flex-col items-center justify-center py-24 bg-white rounded-[2rem] border border-slate-100 shadow-sm">
                            <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                                <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                            </div>
                            <p class="text-slate-500 font-medium text-lg">Belum ada pengumuman kegiatan terbaru.</p>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
            <div class="md:hidden flex justify-center items-center gap-2 mt-6 text-slate-400 text-xs font-bold uppercase tracking-wider animate-pulse">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path></svg>
                Geser untuk melihat kegiatan lainnya
            </div>
        </div>
    </div>

    <!-- Galeri -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($galeri->count() > 0): ?>
    <div id="galeri" class="py-24 md:py-32 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 md:mb-20">
                <span class="text-green-600 font-bold text-sm uppercase tracking-[0.2em] mb-4 block">
                    Visual Archive
                </span>
                <h2 class="text-4xl md:text-5xl lg:text-6xl font-black text-slate-900 tracking-tight">
                    Galeri <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-green-400">Kegiatan</span>
                </h2>
            </div>
            <div class="relative w-full overflow-hidden [mask-image:_linear-gradient(to_right,transparent_0,_black_128px,_black_calc(100%-128px),transparent_100%)]">
                <div class="flex gap-6 animate-infinite-scroll py-4 hover:animate-pause">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $galeri->merge($galeri); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $foto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <?php $fotoPath = $foto->path_file ? Storage::url($foto->path_file) : null; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($fotoPath): ?>
                            <div class="flex-none w-64 h-64 md:w-80 md:h-80 group relative overflow-hidden rounded-[2rem] shadow-sm hover:shadow-[0_20px_40px_rgb(0,0,0,0.12)] cursor-pointer transition-all duration-500"
                                onclick="openLightbox('<?php echo e($fotoPath); ?>', '<?php echo e(addslashes($foto->judul_foto ?? '')); ?>')">
                                <div class="w-full h-full overflow-hidden bg-slate-100">
                                    <img src="<?php echo e($fotoPath); ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                </div>
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/40 to-transparent flex flex-col justify-end p-6 md:p-8 opacity-0 group-hover:opacity-100 transition-all duration-300 translate-y-4 group-hover:translate-y-0">
                                    <h4 class="text-white font-bold text-lg md:text-xl leading-tight mb-3">
                                        <?php echo e($foto->judul_foto ?? 'Dokumentasi'); ?>

                                    </h4>
                                    <div class="text-xs md:text-sm text-slate-300 space-y-2 font-medium">
                                        <p class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                            <span class="truncate"><?php echo e($foto->kegiatan?->lokasi ?? 'Lokasi tidak tersedia'); ?></span>
                                        </p>
                                        <p class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            <?php echo e($foto->kegiatan ? \Carbon\Carbon::parse($foto->kegiatan->tanggal)->translatedFormat('d M Y') : '-'); ?>

                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
            </div>
            <div class="text-center mt-16">
                <a href="<?php echo e(route('galeri.publik.index')); ?>" class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-bold py-4 px-8 rounded-full shadow-lg transition-all transform hover:-translate-y-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    Lihat Galeri Lengkap
                </a>
            </div>
        </div>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>

<!-- Lightbox Modal -->
<div id="lightbox" class="fixed inset-0 bg-slate-950/90 backdrop-blur-md z-[100] hidden items-center justify-center transition-opacity" onclick="closeLightbox()">
    <div class="relative max-w-6xl mx-auto p-4 w-full flex flex-col items-center justify-center h-full" onclick="event.stopPropagation()">
        <button class="absolute top-6 right-6 md:top-10 md:right-10 w-12 h-12 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center text-white backdrop-blur-sm transition-all" onclick="closeLightbox()">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        <img id="lightbox-img" src="" class="max-w-full max-h-[80vh] rounded-2xl shadow-2xl object-contain ring-1 ring-white/10">
        <div class="mt-6 px-6 py-3 bg-white/10 backdrop-blur-md rounded-full ring-1 ring-white/20">
            <p id="lightbox-caption" class="text-white font-semibold text-lg text-center"></p>
        </div>
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
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('statistik');
        if(container) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) container.classList.add('stat-active');
                    else container.classList.remove('stat-active');
                });
            }, { threshold: 0.4 });
            observer.observe(container);
        }
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
        animation: fade-in-up 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
    .scrollbar-hide::-webkit-scrollbar { display: none; }
    .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
    .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    .line-clamp-3 { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
    .stat-outline-dynamic { color: transparent; -webkit-text-stroke: 1px #e2e8f0; }
    .stat-active #stat-bg { opacity: 1 !important; transform: scale(1) !important; }
    .stat-active { background-color: #020617 !important; }
    .stat-active #stat-title { color: white !important; }
    .stat-active #stat-highlight { color: #22c55e !important; }
    .stat-active .stat-card { background-color: rgba(30, 41, 59, 0.4) !important; border-color: rgba(255, 255, 255, 0.05) !important; backdrop-filter: blur(12px); }
    .stat-active .stat-number { color: white !important; }
    .stat-active .stat-label { color: #4ade80 !important; }
    .stat-active .stat-icon-container { background-color: rgba(34, 197, 94, 0.1) !important; color: #4ade80 !important; }
    .stat-active .stat-outline-dynamic { -webkit-text-stroke: 1px rgba(255, 255, 255, 0.03); }
    #hero-overlay { transition: background-color 0.8s ease, backdrop-filter 0.8s ease; }
    #hero-overlay.hovered { background-color: rgba(2, 6, 23, 0.85) !important; backdrop-filter: blur(8px); }
    @keyframes infinite-scroll { 0% { transform: translateX(0); } 100% { transform: translateX(calc(-50% - 12px)); } }
    .animate-infinite-scroll { animation: infinite-scroll 40s linear infinite; width: max-content; }
    .hover\:animate-pause:hover { animation-play-state: paused; }
</style>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Sibo\resources\views/home.blade.php ENDPATH**/ ?>