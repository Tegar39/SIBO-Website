@extends('layouts.app')

@section('content')
<div class="pt-28 pb-12 bg-slate-50 min-h-screen font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-extrabold text-slate-800">Riwayat <span class="text-emerald-600">Kegiatan & Absensi</span></h1>
            <p class="text-slate-500 text-sm mt-1">Pantau status pendaftaran, kehadiran, dan sertifikat digital kamu.</p>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-emerald-50 border border-emerald-100 text-emerald-700 px-5 py-4 rounded-2xl text-sm font-semibold">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="mb-6 bg-rose-50 border border-rose-100 text-rose-700 px-5 py-4 rounded-2xl text-sm font-semibold">{{ session('error') }}</div>
        @endif

        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-slate-50 text-[10px] uppercase tracking-widest text-slate-500 font-black">
                        <tr>
                            <th class="px-6 py-4">Kegiatan</th>
                            <th class="px-6 py-4">Tanggal</th>
                            <th class="px-6 py-4">Pendaftaran</th>
                            <th class="px-6 py-4">Absensi</th>
                            <th class="px-6 py-4">Sertifikat</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse($pendaftarans as $pendaftaran)
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-slate-800">{{ $pendaftaran->kegiatan->judul ?? '-' }}</div>
                                    <div class="text-xs text-slate-400">Peserta: {{ $pendaftaran->display_name }}</div>
                                </td>
                                <td class="px-6 py-4 text-slate-500">{{ $pendaftaran->kegiatan?->tanggal ? \Carbon\Carbon::parse($pendaftaran->kegiatan->tanggal)->translatedFormat('d F Y') : '-' }}</td>
                                <td class="px-6 py-4">
                                    @php $status = $pendaftaran->status; @endphp
                                    <span class="px-3 py-1 rounded-full text-xs font-black {{ $status === 'disetujui' ? 'bg-emerald-100 text-emerald-700' : ($status === 'pending' ? 'bg-amber-100 text-amber-700' : 'bg-rose-100 text-rose-700') }}">{{ strtoupper($status) }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    @if($pendaftaran->absensi)
                                        @if($pendaftaran->absensi->hadir)
                                            <span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-xs font-black">HADIR</span>
                                            <div class="text-xs text-slate-400 mt-1">{{ \Carbon\Carbon::parse($pendaftaran->absensi->waktu_hadir)->format('d/m/Y H:i') }}</div>
                                        @else
                                            <span class="bg-rose-100 text-rose-700 px-3 py-1 rounded-full text-xs font-black">TIDAK HADIR</span>
                                            <div class="text-xs text-slate-400 mt-1">{{ $pendaftaran->absensi->keterangan ?? 'Tanpa keterangan' }}</div>
                                        @endif
                                    @else
                                        <span class="bg-slate-100 text-slate-500 px-3 py-1 rounded-full text-xs font-black">BELUM DIABSEN</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($pendaftaran->certificate)
                                        <a href="{{ route('certificate.download', $pendaftaran->certificate->id) }}" class="inline-flex bg-slate-800 hover:bg-emerald-600 text-white px-4 py-2 rounded-xl text-xs font-bold transition">Download</a>
                                    @elseif($pendaftaran->absensi && $pendaftaran->absensi->hadir)
                                        <span class="text-xs text-slate-400 font-bold">Sedang diproses</span>
                                    @else
                                        <span class="text-xs text-slate-400 font-bold">Belum tersedia</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="px-6 py-16 text-center text-slate-400 font-bold">Belum ada riwayat kegiatan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-6">{{ $pendaftarans->links() }}</div>
        </div>
    </div>
</div>
@endsection
