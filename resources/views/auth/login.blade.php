<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SIBO - Login</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    @php
        // Ambil gambar background dari galeri unggulan atau kegiatan terbaru
        $backgroundImage = null;
        $unggulan = \App\Models\Galeri::where('is_unggulan', 1)->first();
        if ($unggulan && $unggulan->path_file) {
            $backgroundImage = Storage::url($unggulan->path_file);
        } else {
            $kegiatan = \App\Models\Kegiatan::with('pamflet')->where('status', 'aktif')->latest()->first();
            if ($kegiatan && $kegiatan->pamflet) {
                $backgroundImage = Storage::url($kegiatan->pamflet->path_file);
            }
        }
    @endphp
    <div class="relative min-h-screen flex items-center justify-center bg-cover bg-center bg-no-repeat"
         style="background-image: url('{{ $backgroundImage ?: asset('images/default-bg.jpg') }}');">
        <!-- Overlay gelap -->
        <div class="absolute inset-0 bg-black/60"></div>

        <div class="relative z-10 w-full max-w-md px-6 py-8 bg-white/10 backdrop-blur-md rounded-2xl shadow-2xl border border-white/20">
            <div class="text-center mb-6">
                <h1 class="text-3xl font-bold text-white">SIBO</h1>
                <p class="text-white/80 text-sm mt-1">Sistem Informasi Budaya & Olahraga</p>
                <p class="text-white/60 text-xs mt-2">Silakan login menggunakan akun Anda</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-white mb-1">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full px-4 py-2 bg-white/20 border border-white/30 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-white/50">
                    @error('email')
                        <p class="text-red-300 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-white mb-1">Password</label>
                    <input id="password" type="password" name="password" required
                           class="w-full px-4 py-2 bg-white/20 border border-white/30 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-white/50">
                    @error('password')
                        <p class="text-red-300 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between mb-4">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="rounded border-white/30 bg-white/20 text-blue-600 shadow-sm focus:ring-white/50">
                        <span class="ml-2 text-sm text-white">Ingat saya</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-white/80 hover:text-white">Lupa password?</a>
                    @endif
                </div>

                <button type="submit"
                        class="w-full py-2 px-4 bg-white text-gray-800 font-semibold rounded-lg shadow-md hover:bg-gray-100 transition">
                    Masuk
                </button>
            </form>

            <div class="text-center mt-6">
                <a href="{{ route('home') }}" class="text-sm text-white/80 hover:text-white">&larr; Kembali ke Beranda</a>
            </div>
        </div>
    </div>
</body>
</html>