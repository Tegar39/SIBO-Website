@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold mb-6">Dashboard Admin</h1>

        <!-- Statistik Ringkas -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="bg-white rounded-lg shadow p-4">
                <p class="text-gray-500 text-sm">Total Anggota</p>
                <p class="text-2xl font-bold text-blue-600">{{ array_sum($anggotaData) }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <p class="text-gray-500 text-sm">Total Kegiatan</p>
                <p class="text-2xl font-bold text-green-600">{{ array_sum($kategoriData) }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <p class="text-gray-500 text-sm">Pendaftar Baru (Bulan Ini)</p>
                <p class="text-2xl font-bold text-purple-600">{{ $pendaftarBaru }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <p class="text-gray-500 text-sm">Kategori Aktif</p>
                <p class="text-2xl font-bold text-orange-600">{{ count($kategoriLabels) }}</p>
            </div>
        </div>

        <!-- Grafik Baris dan Lingkaran -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-4">
                <h2 class="text-lg font-semibold mb-2">Pertumbuhan Anggota (6 Bulan Terakhir)</h2>
                <canvas id="anggotaChart" height="200"></canvas>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <h2 class="text-lg font-semibold mb-2">Total Kegiatan per Kategori</h2>
                <canvas id="kegiatanChart" height="200"></canvas>
            </div>
        </div>

        <!-- Grafik Batang Pendaftar per Kegiatan -->
        <div class="bg-white rounded-lg shadow p-4 mb-8">
            <h2 class="text-lg font-semibold mb-2">5 Kegiatan dengan Pendaftar Terbanyak</h2>
            <canvas id="pendaftarChart" height="150"></canvas>
        </div>

        <!-- Kegiatan Terdekat & Aktivitas Terbaru -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white rounded-lg shadow p-4">
                <h2 class="text-lg font-semibold mb-2">Kegiatan Terdekat</h2>
                <ul class="divide-y">
                    @forelse($kegiatanTerdekat as $k)
                        <li class="py-2 flex justify-between">
                            <span>{{ $k->judul }}</span>
                            <span class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($k->tanggal)->format('d M Y') }}</span>
                        </li>
                    @empty
                        <li class="py-2 text-gray-500">Tidak ada kegiatan terdekat.</li>
                    @endforelse
                </ul>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <h2 class="text-lg font-semibold mb-2">Aktivitas Terbaru</h2>
                <ul class="divide-y">
                    @forelse($aktivitasTerbaru as $akt)
                        <li class="py-2">
                            <span class="block text-sm">{{ $akt->anggota->nama_lengkap ?? 'Anggota' }} mendaftar kegiatan "{{ $akt->kegiatan->judul ?? '-' }}"</span>
                            <span class="text-xs text-gray-400">{{ $akt->created_at->diffForHumans() }}</span>
                        </li>
                    @empty
                        <li class="py-2 text-gray-500">Belum ada aktivitas.</li>
                    @endforelse
                </ul>
            </div>
        </div>
        <!-- Baris baru: Aktivitas Terbaru & Anggota Bolos -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
            <div class="bg-white rounded-lg shadow p-4">
                <h2 class="text-lg font-semibold mb-2">Aktivitas Terbaru</h2>
                <!-- ... list aktivitas ... -->
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <h2 class="text-lg font-semibold mb-2">Anggota Bolos (Tidak Hadir)</h2>
                @if($anggotaBolos->count())
                    <ul class="divide-y">
                        @foreach($anggotaBolos as $ab)
                            <li class="py-2">
                                <div class="flex justify-between">
                                    <span class="font-medium">{{ $ab->anggota->nama_lengkap ?? '?' }}</span>
                                    <span class="text-sm text-red-600">Tidak hadir</span>
                                </div>
                                <div class="text-xs text-gray-500">
                                    Kegiatan: {{ $ab->kegiatan->judul ?? '-' }}<br>
                                    Tanggal: {{ \Carbon\Carbon::parse($ab->kegiatan->tanggal)->format('d M Y') }}
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500">Tidak ada anggota yang bolos.</p>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Grafik garis - pertumbuhan anggota
        const ctx1 = document.getElementById('anggotaChart').getContext('2d');
        new Chart(ctx1, {
            type: 'line',
            data: {
                labels: @json($anggotaLabels),
                datasets: [{
                    label: 'Jumlah Anggota Baru',
                    data: @json($anggotaData),
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    tension: 0.3,
                    fill: true
                }]
            },
            options: { responsive: true, maintainAspectRatio: true }
        });

        // Grafik lingkaran - kegiatan per kategori
        const ctx2 = document.getElementById('kegiatanChart').getContext('2d');
        new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: @json($kategoriLabels),
                datasets: [{
                    data: @json($kategoriData),
                    backgroundColor: ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6']
                }]
            },
            options: { responsive: true, maintainAspectRatio: true }
        });

        // Grafik batang - pendaftar per kegiatan
        const ctx3 = document.getElementById('pendaftarChart').getContext('2d');
        new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: @json($kegiatanPendaftarLabels),
                datasets: [{
                    label: 'Jumlah Pendaftar',
                    data: @json($kegiatanPendaftarData),
                    backgroundColor: '#f97316'
                }]
            },
            options: { responsive: true, maintainAspectRatio: true }
        });
    });
</script>
@endpush
@endsection