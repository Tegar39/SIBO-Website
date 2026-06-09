@extends('layouts.app')

@section('content')
@php
    use Carbon\Carbon;
    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;

    $user = auth()->user();
    $anggota = $anggota ?? ($user->anggota ?? null);

    $namaAnggota = $anggota->nama_lengkap
        ?? $anggota->nama
        ?? $user->name
        ?? 'Anggota';

    $inisialAnggota = collect(explode(' ', trim($namaAnggota)))
        ->filter()
        ->take(2)
        ->map(fn ($nama) => Str::upper(Str::substr($nama, 0, 1)))
        ->implode('');

    $fotoProfil = $anggota->foto
        ?? $anggota->foto_profil
        ?? $anggota->avatar
        ?? $user->foto
        ?? $user->avatar
        ?? null;

    $fotoProfilUrl = null;

    if ($fotoProfil) {
        if (Str::startsWith($fotoProfil, ['http://', 'https://'])) {
            $fotoProfilUrl = $fotoProfil;
        } elseif (Storage::disk('public')->exists($fotoProfil)) {
            $fotoProfilUrl = Storage::url($fotoProfil);
        } elseif (file_exists(public_path($fotoProfil))) {
            $fotoProfilUrl = asset($fotoProfil);
        } elseif (file_exists(public_path('storage/' . $fotoProfil))) {
            $fotoProfilUrl = asset('storage/' . $fotoProfil);
        }
    }

    $pacAnggota = $anggota->pac
        ?? $anggota->nama_pac
        ?? $user->pac
        ?? '-';

    $jumlahPendaftaran = $jumlahPendaftaran ?? 0;
    $jumlahDiikuti = $jumlahDiikuti ?? 0;
    $jumlahSelesai = $jumlahSelesai ?? 0;
    $jumlahSertifikat = $jumlahSertifikat ?? 0;

    $agendaMendatang = collect($agendaMendatang ?? $kegiatanMendatang ?? $kegiatanTerbaru ?? []);
    $riwayatTerbaru = collect($riwayatTerbaru ?? $riwayat ?? []);
    $notifikasiTerbaru = collect($notifikasiTerbaru ?? $notifikasi ?? []);
    $sertifikatTerbaru = collect($sertifikatTerbaru ?? $sertifikat ?? []);
    $pacInfo = $pacInfo ?? $pac ?? null;

    $urlProfil = Route::has('anggota.profil') ? route('anggota.profil') : url('/anggota/profil');
    $urlKegiatan = Route::has('kegiatan.publik.index') ? route('kegiatan.publik.index') : url('/kegiatan');
    $urlRiwayat = Route::has('anggota.riwayat') ? route('anggota.riwayat') : url('/anggota/riwayat');
    $urlNotifikasi = Route::has('anggota.notifikasi') ? route('anggota.notifikasi') : url('/anggota/notifikasi');

    $urlPac = Route::has('anggota.pac.index')
        ? route('anggota.pac.index')
        : (Route::has('pac.public.index') ? route('pac.public.index') : url('/pac'));

    $urlSertifikat = Route::has('anggota.sertifikat.index') ? route('anggota.sertifikat.index') : url('/certificate');
@endphp

<div class="min-h-screen bg-slate-50 pt-24 pb-16 font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <section class="relative overflow-hidden rounded-[2rem] bg-gradient-to-br from-emerald-700 via-emerald-600 to-green-500 text-white shadow-xl mb-10">
            <div class="absolute -right-20 -top-20 w-72 h-72 rounded-full bg-white/10"></div>
            <div class="absolute -left-16 -bottom-20 w-60 h-60 rounded-full bg-yellow-300/10"></div>

            <div class="relative z-10 px-8 py-10 md:px-12 md:py-12">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                    <div>
                        <p class="text-sm uppercase tracking-[0.35em] font-black text-emerald-100 mb-3">
                            Dashboard Anggota
                        </p>

                        <h1 class="text-4xl md:text-5xl font-black leading-tight">
                            Halo, {{ $namaAnggota }}
                        </h1>

                        <p class="mt-4 text-emerald-50 text-lg max-w-2xl">
                            Pantau kegiatan, riwayat pendaftaran, notifikasi, sertifikat, dan informasi PAC yang kamu ikuti.
                        </p>
                    </div>

                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 rounded-full bg-white overflow-hidden border-4 border-white shadow-lg flex items-center justify-center shrink-0">
                            @if($fotoProfilUrl)
                                <img src="{{ $fotoProfilUrl }}"
                                     alt="Foto Profil {{ $namaAnggota }}"
                                     class="w-full h-full object-cover">
                            @endif

                            @if(!$fotoProfilUrl)
                                <div class="w-full h-full bg-emerald-50 text-emerald-700 flex items-center justify-center text-xl font-black">
                                    {{ $inisialAnggota ?: 'A' }}
                                </div>
                            @endif
                        </div>

                        <a href="{{ $urlProfil }}"
                           class="inline-flex items-center justify-center rounded-2xl bg-white text-emerald-700 px-6 py-4 font-black shadow-lg hover:bg-emerald-50 transition">
                            Edit Profil
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <div class="rounded-[1.7rem] bg-white p-6 shadow-sm border border-slate-100">
                <p class="text-sm text-slate-500 font-bold mb-2">Total Pendaftaran</p>
                <p class="text-4xl font-black text-slate-900">{{ $jumlahPendaftaran }}</p>
            </div>

            <div class="rounded-[1.7rem] bg-white p-6 shadow-sm border border-slate-100">
                <p class="text-sm text-slate-500 font-bold mb-2">Kegiatan Diikuti</p>
                <p class="text-4xl font-black text-emerald-600">{{ $jumlahDiikuti }}</p>
            </div>

            <div class="rounded-[1.7rem] bg-white p-6 shadow-sm border border-slate-100">
                <p class="text-sm text-slate-500 font-bold mb-2">Kegiatan Selesai</p>
                <p class="text-4xl font-black text-slate-900">{{ $jumlahSelesai }}</p>
            </div>

            <div class="rounded-[1.7rem] bg-white p-6 shadow-sm border border-slate-100">
                <p class="text-sm text-slate-500 font-bold mb-2">Sertifikat</p>
                <p class="text-4xl font-black text-amber-500">{{ $jumlahSertifikat }}</p>
            </div>
        </section>

        <section class="rounded-[2rem] bg-white p-8 shadow-sm border border-slate-100 mb-10">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">
                <div>
                    <p class="text-sm uppercase tracking-[0.25em] font-black text-emerald-600 mb-2">
                        Informasi PAC Saya
                    </p>

                    <h2 class="text-2xl font-black text-slate-900">
                        {{ $pacInfo->nama ?? $pacInfo->nama_pac ?? ($pacAnggota !== '-' ? 'PAC '.$pacAnggota : 'PAC belum tercatat') }}
                    </h2>

                    <p class="mt-2 text-slate-600">
                        {{ $pacInfo->deskripsi ?? $pacInfo->keterangan ?? 'Informasi PAC mengikuti data profil anggota dan data yang dikelola admin.' }}
                    </p>
                </div>

                <a href="{{ $urlPac }}"
                   class="inline-flex items-center justify-center rounded-2xl bg-emerald-600 px-6 py-3 text-white font-black shadow-lg shadow-emerald-100 hover:bg-emerald-700 transition">
                    Lihat PAC
                </a>
            </div>
        </section>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
            <section class="xl:col-span-2 rounded-[2rem] bg-white shadow-sm border border-slate-100 overflow-hidden">
                <div class="px-8 py-6 border-b border-slate-100 flex items-center justify-between gap-4">
                    <div>
                        <h2 class="text-2xl font-black text-slate-900">Kegiatan Terbaru</h2>
                        <p class="text-slate-500 mt-1">Kegiatan aktif yang masih bisa dilihat atau diikuti.</p>
                    </div>

                    <a href="{{ $urlKegiatan }}" class="text-emerald-600 font-black hover:text-emerald-700">
                        Lihat Semua
                    </a>
                </div>

                <div class="p-8 space-y-5">
                    @if($agendaMendatang->count() > 0)
                        @foreach($agendaMendatang as $kegiatan)
                            @php
                                $idKegiatan = $kegiatan->id_kegiatan ?? $kegiatan->id ?? null;
                                $judul = $kegiatan->judul ?? $kegiatan->nama_kegiatan ?? 'Kegiatan';
                                $tanggal = $kegiatan->tanggal ?? $kegiatan->tanggal_mulai ?? null;
                                $tanggalText = $tanggal ? Carbon::parse($tanggal)->translatedFormat('d M Y') : '-';
                                $lokasi = $kegiatan->lokasi ?? '-';

                                $kategori = $kegiatan->kategori->nama_kategori
                                    ?? $kegiatan->kategori->nama
                                    ?? $kegiatan->kategori
                                    ?? '-';

                                $urlDetail = $idKegiatan && Route::has('kegiatan.publik.show')
                                    ? route('kegiatan.publik.show', $idKegiatan)
                                    : $urlKegiatan;
                            @endphp

                            <article class="rounded-3xl border border-slate-100 bg-slate-50 p-5 flex flex-col md:flex-row md:items-center md:justify-between gap-5">
                                <div>
                                    <p class="text-xs uppercase tracking-[0.18em] font-black text-emerald-600 mb-2">
                                        {{ $kategori }}
                                    </p>

                                    <h3 class="text-xl font-black text-slate-900">
                                        {{ $judul }}
                                    </h3>

                                    <p class="mt-2 text-slate-600 text-sm">
                                        {{ $tanggalText }} · {{ $lokasi }}
                                    </p>
                                </div>

                                <a href="{{ $urlDetail }}"
                                   class="inline-flex items-center justify-center rounded-2xl bg-slate-900 px-5 py-3 text-white font-black hover:bg-slate-800 transition">
                                    Detail
                                </a>
                            </article>
                        @endforeach
                    @endif

                    @if($agendaMendatang->count() === 0)
                        <div class="rounded-3xl border border-dashed border-slate-200 p-8 text-center">
                            <h3 class="text-xl font-black text-slate-900">Belum ada kegiatan aktif</h3>
                            <p class="text-slate-500 mt-2">Kegiatan terbaru akan muncul setelah admin menambahkan data.</p>
                        </div>
                    @endif
                </div>
            </section>

            <section class="rounded-[2rem] bg-white shadow-sm border border-slate-100 overflow-hidden">
                <div class="px-8 py-6 border-b border-slate-100">
                    <h2 class="text-2xl font-black text-slate-900">Notifikasi</h2>
                    <p class="text-slate-500 mt-1">Informasi terbaru untuk akunmu.</p>
                </div>

                <div class="p-8 space-y-4">
                    @if($notifikasiTerbaru->count() > 0)
                        @foreach($notifikasiTerbaru->take(4) as $item)
                            @php
                                $judulNotif = $item->judul ?? $item->title ?? 'Notifikasi';
                                $pesanNotif = $item->pesan ?? $item->message ?? $item->keterangan ?? '-';
                                $tanggalNotif = $item->created_at
                                    ? Carbon::parse($item->created_at)->translatedFormat('d M Y H:i')
                                    : '-';
                            @endphp

                            <article class="rounded-3xl bg-slate-50 border border-slate-100 p-5">
                                <h3 class="font-black text-slate-900">{{ $judulNotif }}</h3>
                                <p class="text-slate-600 text-sm mt-2">{{ $pesanNotif }}</p>
                                <p class="text-xs text-slate-400 mt-3">
                                    Pada tanggal: {{ $tanggalNotif }}
                                </p>
                            </article>
                        @endforeach
                    @endif

                    @if($notifikasiTerbaru->count() === 0)
                        <div class="rounded-3xl bg-slate-50 border border-slate-100 p-6 text-center">
                            <p class="font-bold text-slate-700">Belum ada notifikasi.</p>
                        </div>
                    @endif

                    <a href="{{ $urlNotifikasi }}"
                       class="block text-center rounded-2xl bg-emerald-600 text-white font-black px-5 py-3 hover:bg-emerald-700 transition">
                        Lihat Notifikasi
                    </a>
                </div>
            </section>
        </div>

        <section class="rounded-[2rem] bg-white shadow-sm border border-slate-100 overflow-hidden mt-8">
            <div class="px-8 py-6 border-b border-slate-100 flex items-center justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-black text-slate-900">Riwayat Kegiatan</h2>
                    <p class="text-slate-500 mt-1">Kegiatan yang sudah kamu daftar atau ikuti.</p>
                </div>

                <a href="{{ $urlRiwayat }}" class="text-emerald-600 font-black hover:text-emerald-700">
                    Lihat Riwayat
                </a>
            </div>

            <div class="p-8 space-y-4">
                @if($riwayatTerbaru->count() > 0)
                    @foreach($riwayatTerbaru->take(4) as $row)
                        @php
                            $keg = $row->kegiatan ?? $row;
                            $judulRiwayat = $keg->judul ?? $keg->nama_kegiatan ?? 'Kegiatan';
                            $statusDaftar = $row->status ?? $row->status_pendaftaran ?? '-';
                            $statusAbsensi = $row->status_absensi ?? $row->absensi_status ?? null;
                            $kegId = $keg->id_kegiatan ?? $keg->id ?? null;

                            $urlDetailRiwayat = $kegId && Route::has('kegiatan.publik.show')
                                ? route('kegiatan.publik.show', $kegId)
                                : $urlKegiatan;
                        @endphp

                        <article class="rounded-3xl bg-slate-50 border border-slate-100 p-5">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                                <div>
                                    <h3 class="font-black text-slate-900">{{ $judulRiwayat }}</h3>

                                    <p class="text-sm text-slate-500 mt-1">
                                        Status pendaftaran: {{ $statusDaftar }}
                                        @if($statusAbsensi)
                                            · Absensi: {{ $statusAbsensi }}
                                        @endif
                                    </p>
                                </div>

                                <a href="{{ $urlDetailRiwayat }}"
                                   class="inline-flex items-center justify-center rounded-2xl bg-slate-900 text-white px-4 py-2 text-sm font-black hover:bg-slate-800 transition">
                                    Info
                                </a>
                            </div>
                        </article>
                    @endforeach
                @endif

                @if($riwayatTerbaru->count() === 0)
                    <div class="rounded-3xl border border-dashed border-slate-200 p-8 text-center">
                        <h3 class="text-lg font-black text-slate-900">Belum ada riwayat</h3>
                        <p class="text-slate-500 mt-2">Riwayat akan muncul setelah kamu mendaftar kegiatan.</p>
                    </div>
                @endif
            </div>
        </section>

        <section class="rounded-[2rem] bg-white shadow-sm border border-slate-100 overflow-hidden mt-8">
            <div class="px-8 py-6 border-b border-slate-100 flex items-center justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-black text-slate-900">Sertifikat Digital</h2>
                    <p class="text-slate-500 mt-1">Sertifikat kegiatan yang sudah tersedia.</p>
                </div>

                <a href="{{ $urlSertifikat }}" class="text-emerald-600 font-black hover:text-emerald-700">
                    Lihat Sertifikat
                </a>
            </div>

            <div class="p-8 space-y-4">
                @if($sertifikatTerbaru->count() > 0)
                    @foreach($sertifikatTerbaru->take(4) as $cert)
                        @php
                            $nomor = $cert->nomor_sertifikat ?? $cert->nomor ?? '-';

                            $judulCert = $cert->kegiatan->judul
                                ?? $cert->pendaftaran->kegiatan->judul
                                ?? 'Sertifikat Kegiatan';

                            $idCert = $cert->id_sertifikat ?? $cert->id ?? null;
                            $urlDownloadCert = $idCert ? url('/certificate/' . $idCert . '/download') : $urlSertifikat;
                        @endphp

                        <article class="rounded-3xl bg-slate-50 border border-slate-100 p-5">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                                <div>
                                    <h3 class="font-black text-slate-900">{{ $judulCert }}</h3>
                                    <p class="text-sm text-slate-500 mt-1">
                                        Nomor: {{ $nomor }}
                                    </p>
                                </div>

                                <a href="{{ $urlDownloadCert }}"
                                   class="inline-flex items-center justify-center rounded-2xl bg-emerald-600 text-white px-4 py-2 text-sm font-black hover:bg-emerald-700 transition">
                                    Download
                                </a>
                            </div>
                        </article>
                    @endforeach
                @endif

                @if($sertifikatTerbaru->count() === 0)
                    <div class="rounded-3xl border border-dashed border-slate-200 p-8 text-center">
                        <h3 class="text-lg font-black text-slate-900">Belum ada sertifikat</h3>
                        <p class="text-slate-500 mt-2">
                            Sertifikat akan muncul setelah kamu mengikuti kegiatan dan absensi dinyatakan hadir.
                        </p>
                    </div>
                @endif
            </div>
        </section>

    </div>
</div>
@endsection