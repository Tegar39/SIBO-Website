@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">

                {{-- Pamflet --}}
                @if($kegiatan->pamflet)
                    <img src="{{ Storage::url($kegiatan->pamflet->path_file) }}" class="w-full max-h-96 object-cover rounded mb-6">
                @else
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center rounded mb-6">Tidak ada pamflet</div>
                @endif

                {{-- Judul --}}
                <h1 class="text-3xl font-bold mb-2">{{ $kegiatan->judul }}</h1>

                {{-- Kategori --}}
                <p class="text-gray-600 mb-1">
                    <span class="font-semibold">Kategori:</span> {{ $kegiatan->kategori->nama }}
                </p>

                {{-- Tanggal & Waktu --}}
                <p class="text-gray-600 mb-1">
                    <span class="font-semibold">Tanggal:</span> {{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('d M Y') }}
                    @if($kegiatan->waktu)
                        , {{ \Carbon\Carbon::parse($kegiatan->waktu)->format('H:i') }} WIB
                    @endif
                </p>

                {{-- Lokasi --}}
                @if($kegiatan->lokasi)
                    <p class="text-gray-600 mb-1">
                        <span class="font-semibold">Lokasi:</span> {{ $kegiatan->lokasi }}
                    </p>
                @endif

                {{-- Kuota & Peserta --}}
                <p class="text-gray-600 mb-4">
                    <span class="font-semibold">Peserta:</span> 
                    {{ $kegiatan->jumlah_peserta }} / 
                    {{ $kegiatan->kuota == 0 ? 'Tak terbatas' : $kegiatan->kuota }}
                </p>

                {{-- Deskripsi --}}
                @if($kegiatan->deskripsi)
                    <div class="mt-4 border-t pt-4">
                        <h2 class="text-xl font-semibold mb-2">Deskripsi</h2>
                        <p class="text-gray-700">{{ nl2br(e($kegiatan->deskripsi)) }}</p>
                    </div>
                @endif

                {{-- Tombol Daftar (hanya untuk anggota yang sudah login) --}}
                @auth
                    @if(auth()->user()->role == 'anggota')
                        @php
                            $sudahDaftar = \App\Models\Pendaftaran::where('id_anggota', auth()->user()->anggota->id_anggota)
                                ->where('id_kegiatan', $kegiatan->id_kegiatan)
                                ->exists();
                        @endphp

                        @if($sudahDaftar)
                            <div class="mt-6 p-3 bg-green-100 text-green-700 rounded">
                                Anda sudah mendaftar kegiatan ini. Status: 
                                {{ \App\Models\Pendaftaran::where('id_anggota', auth()->user()->anggota->id_anggota)
                                    ->where('id_kegiatan', $kegiatan->id_kegiatan)
                                    ->first()->status ?? 'pending' }}
                            </div>
                        @elseif($kegiatan->status != 'aktif')
                            <div class="mt-6 p-3 bg-gray-100 text-gray-700 rounded">
                                Kegiatan ini sudah {{ $kegiatan->status }}.
                            </div>
                        @elseif($kegiatan->kuota > 0 && $kegiatan->jumlah_peserta >= $kegiatan->kuota)
                            <div class="mt-6 p-3 bg-red-100 text-red-700 rounded">
                                Maaf, kuota peserta sudah penuh.
                            </div>
                        @else
                            <form action="{{ route('anggota.daftar', $kegiatan->id_kegiatan) }}" method="POST" class="mt-6">
                                @csrf
                                <button type="submit" 
                                        class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-lg transition">
                                    Daftar Sekarang
                                </button>
                            </form>
                        @endif
                    @else
                        <div class="mt-6 p-3 bg-blue-100 text-blue-700 rounded">
                            Anda login sebagai admin. Untuk mendaftar, gunakan akun anggota.
                        </div>
                    @endif
                @else
                    <div class="mt-6 p-3 bg-yellow-100 text-yellow-700 rounded">
                        <a href="{{ route('login') }}" class="underline">Login</a> sebagai anggota untuk mendaftar kegiatan ini.
                    </div>
                @endauth

                <div class="mt-6">
                    <a href="{{ route('kegiatan.publik.index') }}" class="text-blue-600 hover:underline">
                        &larr; Kembali ke daftar kegiatan
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection