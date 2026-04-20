@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Kartu Selamat Datang & Profil -->
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border-2 border-green-700 mb-8">
            <div class="bg-gradient-to-r from-green-800 to-emerald-800 px-6 py-5 flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-4">
                    <div class="bg-yellow-500 rounded-full p-3 shadow-md">
                        <svg class="w-8 h-8 text-green-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-white">Selamat Datang, {{ Auth::user()->name }}!</h1>
                        <p class="text-yellow-200 mt-1">Anda login sebagai Anggota SIBO</p>
                    </div>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('anggota.profil') }}" class="bg-yellow-500 hover:bg-yellow-600 text-green-900 font-bold py-2 px-4 rounded-lg shadow transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        Profil Saya
                    </a>
                </div>
            </div>

            @if(Auth::user()->anggota)
                <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-green-50 rounded-xl p-4 border border-green-200 flex items-center gap-3">
                        <div class="bg-green-700 rounded-full p-2">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase">Nomor Anggota</p>
                            <p class="text-lg font-bold text-gray-800">{{ Auth::user()->anggota->nomor_anggota }}</p>
                        </div>
                    </div>
                    <div class="bg-green-50 rounded-xl p-4 border border-green-200 flex items-center gap-3">
                        <div class="bg-green-700 rounded-full p-2">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase">PAC</p>
                            <p class="text-lg font-bold text-gray-800">{{ Auth::user()->anggota->pac ?? 'Belum diatur' }}</p>
                        </div>
                    </div>
                    <div class="bg-green-50 rounded-xl p-4 border border-green-200 flex items-center gap-3">
                        <div class="bg-green-700 rounded-full p-2">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase">Kontak</p>
                            <p class="text-lg font-bold text-gray-800">{{ Auth::user()->anggota->kontak ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="p-6 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-b-2xl">
                    <p>Data anggota belum lengkap. Silakan hubungi admin.</p>
                </div>
            @endif
        </div>

        <!-- Statistik & Tombol Aksi -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
                <div class="bg-green-700 px-4 py-3">
                    <h3 class="text-white font-semibold flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Ringkasan Kegiatan
                    </h3>
                </div>
                <div class="p-4 space-y-3">
                    <div class="flex justify-between items-center border-b pb-2">
                        <span class="text-gray-600">Total Pendaftaran</span>
                        <span class="font-bold text-green-700 text-xl">0</span>
                    </div>
                    <div class="flex justify-between items-center border-b pb-2">
                        <span class="text-gray-600">Kegiatan Aktif Diikuti</span>
                        <span class="font-bold text-green-700 text-xl">0</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Kegiatan Selesai</span>
                        <span class="font-bold text-green-700 text-xl">0</span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
                <div class="bg-yellow-500 px-4 py-3">
                    <h3 class="text-green-900 font-semibold flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        Aksi Cepat
                    </h3>
                </div>
                <div class="p-4 space-y-3">
                    <a href="{{ route('kegiatan.publik.index') }}" class="block w-full text-center bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition">
                        Lihat Semua Kegiatan
                    </a>
                    <a href="{{ route('anggota.riwayat') }}" class="block w-full text-center bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg transition">
                        Riwayat Pendaftaran Saya
                    </a>
                </div>
            </div>
        </div>

        <!-- Kegiatan Terbaru yang Akan Datang (contoh) -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
            <div class="bg-green-800 px-4 py-3">
                <h3 class="text-yellow-400 font-semibold flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    Kegiatan Mendatang
                </h3>
            </div>
            <div class="p-6 text-center text-gray-500">
                <svg class="w-12 h-12 mx-auto text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                <p>Belum ada kegiatan yang Anda ikuti.</p>
                <p class="text-sm mt-1">Silakan daftar kegiatan terlebih dahulu.</p>
            </div>
        </div>
    </div>
</div>
@endsection