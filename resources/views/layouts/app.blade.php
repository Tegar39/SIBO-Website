<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SIBO - {{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @stack('styles')
    @livewireStyles

    <style>
        .sticky-nav {
            position: sticky;
            top: 0;
            z-index: 50;
        }
    </style>
</head>

<body class="font-sans antialiased">

    <!-- NAVBAR -->
        @include('layouts.navigation')

    <!-- CONTENT -->
    <main id="app-content">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-gray-800 text-white py-6 mt-8">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} SIBO - PC DESBOR Kabupaten Kediri</p>
        </div>
    </footer>

    @stack('scripts')
    @livewireScripts

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
</html>