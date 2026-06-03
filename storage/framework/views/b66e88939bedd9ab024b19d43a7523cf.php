<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>SIBO - <?php echo e(config('app.name', 'Laravel')); ?></title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <?php echo $__env->yieldPushContent('styles'); ?>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>


    <style>
        [x-cloak] { display: none !important; }

        .sticky-nav {
            position: sticky;
            top: 0;
            z-index: 50;
        }

        body {
            background:
                radial-gradient(circle at top left, rgba(16, 185, 129, .12), transparent 34%),
                radial-gradient(circle at bottom right, rgba(15, 23, 42, .08), transparent 32%),
                #f8fafc;
        }

        #app-content {
            min-height: calc(100vh - 80px);
            background:
                linear-gradient(135deg, rgba(255,255,255,.84), rgba(236,253,245,.32)),
                radial-gradient(circle at top right, rgba(245,158,11,.10), transparent 28%);
        }

        .sibo-soft-card,
        .bg-white.rounded-3xl,
        .bg-white.rounded-\[2rem\],
        .bg-white.rounded-2xl {
            box-shadow: 0 18px 45px rgba(15, 23, 42, .08) !important;
            border-color: rgba(16, 185, 129, .12) !important;
        }

        .sibo-help-fab {
            position: fixed;
            right: 24px;
            bottom: 24px;
            width: 52px;
            height: 52px;
            border-radius: 999px;
            background: linear-gradient(135deg, #059669, #10b981);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            font-size: 24px;
            box-shadow: 0 18px 40px rgba(16, 185, 129, .34);
            z-index: 80;
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .sibo-help-fab:hover {
            transform: translateY(-3px) scale(1.03);
            box-shadow: 0 24px 50px rgba(16, 185, 129, .42);
        }

        .sibo-guide-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, .58);
            z-index: 90;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .sibo-guide-panel {
            width: min(680px, 100%);
            max-height: 86vh;
            overflow-y: auto;
            border-radius: 28px;
            background: #fff;
            box-shadow: 0 30px 90px rgba(15, 23, 42, .28);
            border: 1px solid rgba(16, 185, 129, .18);
        }

        .sibo-guide-header {
            background: linear-gradient(135deg, #0f172a, #059669);
            color: #fff;
            padding: 24px 28px;
        }

        .sibo-guide-step {
            display: flex;
            gap: 14px;
            padding: 14px 0;
            border-bottom: 1px solid #eef2f7;
        }

        .sibo-guide-number {
            width: 28px;
            height: 28px;
            border-radius: 999px;
            background: #ecfdf5;
            color: #059669;
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 auto;
            font-weight: 900;
            font-size: 12px;
        }


        .sibo-page-shell {
            background:
                linear-gradient(135deg, rgba(255,255,255,.95), rgba(236,253,245,.48)),
                radial-gradient(circle at 12% 20%, rgba(16,185,129,.16), transparent 30%),
                radial-gradient(circle at 88% 5%, rgba(245,158,11,.10), transparent 24%);
        }

        .sibo-section-title {
            color: #0f172a;
            text-shadow: 0 1px 0 rgba(255,255,255,.75);
        }

        .sibo-action-primary {
            background: linear-gradient(135deg, #059669, #10b981) !important;
            box-shadow: 0 16px 34px rgba(16,185,129,.25) !important;
        }

        .sibo-action-primary:hover {
            filter: brightness(.98);
            transform: translateY(-1px);
        }

        .sibo-soft-table {
            background: rgba(255,255,255,.88);
            border: 1px solid rgba(148,163,184,.18);
            box-shadow: 0 22px 55px rgba(15,23,42,.08);
        }
    </style>
</head>

<body class="font-sans antialiased">

    <!-- NAVBAR -->
        <?php echo $__env->make('layouts.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- CONTENT -->
    <main id="app-content" class="<?php echo e(auth()->check() ? 'pt-28' : ''); ?>">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- FOOTER -->
    <footer class="bg-gray-800 text-white py-6 mt-8">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p>&copy; <?php echo e(date('Y')); ?> SIBO - PC DESBOR Kabupaten Kediri</p>
        </div>
    </footer>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
        <?php echo $__env->make('components.page-help', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php echo $__env->yieldPushContent('scripts'); ?>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>


    <!-- ✅ SCRIPT WAJIB UNTUK LIVEWIRE NAVIGATE -->
    <script>
        function scrollToHash() {
            if (window.location.hash) {
                const el = document.querySelector(window.location.hash);
                if (el) {
                    el.scrollIntoView({ behavior: "smooth" });
                }
            }
        }

        // jalan saat pertama load halaman
        document.addEventListener("DOMContentLoaded", scrollToHash);

        // jalan saat pindah halaman pakai Livewire (tanpa reload)
        document.addEventListener("livewire:navigated", scrollToHash);
    </script>

</body>
</html><?php /**PATH D:\laragon\www\Sibo\resources\views/layouts/app.blade.php ENDPATH**/ ?>