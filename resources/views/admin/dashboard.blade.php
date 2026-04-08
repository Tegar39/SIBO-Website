@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold mb-4">Dashboard Admin</h1>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div class="bg-blue-500 text-white p-4 rounded-lg">
                        <h3 class="text-lg">Total Anggota</h3>
                        <p class="text-3xl font-bold">{{ $totalAnggota }}</p>
                    </div>
                    <div class="bg-green-500 text-white p-4 rounded-lg">
                        <h3 class="text-lg">Total Kegiatan</h3>
                        <p class="text-3xl font-bold">{{ $totalKegiatan }}</p>
                    </div>
                    <div class="bg-yellow-500 text-white p-4 rounded-lg">
                        <h3 class="text-lg">Pendaftar Pending</h3>
                        <p class="text-3xl font-bold">{{ $pendingPendaftar }}</p>
                    </div>
                </div>

                <h2 class="text-xl font-semibold mb-2">Anggota Terbaru</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full border">
                        <thead class="bg-gray-200">
                            <tr><th class="px-4 py-2 border">Nama</th><th class="px-4 py-2 border">Nomor Anggota</th><th class="px-4 py-2 border">PAC</th></tr>
                        </thead>
                        <tbody>
                            @foreach($anggotaTerbaru as $a)
                            <tr><td class="px-4 py-2 border">{{ $a->nama_lengkap }}</td><td class="px-4 py-2 border">{{ $a->nomor_anggota }}</td><td class="px-4 py-2 border">{{ $a->pac }}</td></tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection