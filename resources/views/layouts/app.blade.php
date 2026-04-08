<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIBO - Sistem Informasi Budaya & Olahraga</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .line-clamp-3 { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
    </style>
    @livewireStyles
    @stack('styles')
</head>
<body class="bg-gray-100">
    @include('layouts.navigation')
    <main class="container mx-auto p-4">
        @yield('content')
    </main>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Livewire Scripts -->
    @livewireScripts

    <!-- Re-inisialisasi Alpine setelah navigasi Livewire -->
    <script>
        document.addEventListener('livewire:navigated', () => {
            if (window.Alpine) {
                // Reinitsialisasi komponen Alpine pada body
                Alpine.initTree(document.body);
            }
        });
    </script>

    <!-- Instant.page untuk preload (opsional) -->
    <script src="//instant.page/5.2.0" type="module" integrity="sha384-jnZyxPjiipYXnSU0ygqeac2q7CVYMbh84q0uHVRRxEtvFPiQYbXWUorga2aqZJ0z"></script>
</body>
</html>