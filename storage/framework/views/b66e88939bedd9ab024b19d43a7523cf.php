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
    <style>
        /* Sticky navigation */
        .sticky-nav {
            position: sticky;
            top: 0;
            z-index: 50;
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="sticky-nav">
        <?php echo $__env->make('layouts.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>

    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- Footer di setiap halaman -->
    <footer class="bg-gray-800 text-white py-6 mt-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p>&copy; <?php echo e(date('Y')); ?> SIBO - PC DESBOR Kabupaten Kediri. All rights reserved.</p>
            <p class="text-sm text-gray-400 mt-1">Jl. Imam Bonjol, Ds. Ngadirejo, Kec. Kota, Kota Kediri</p>
        </div>
    </footer>
</body>
</html><?php /**PATH D:\laragon\www\Sibo\resources\views/layouts/app.blade.php ENDPATH**/ ?>