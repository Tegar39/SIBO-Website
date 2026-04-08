@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold">Selamat Datang, {{ Auth::user()->name }}</h1>
                <p class="mt-2">Anda login sebagai anggota.</p>

                @if(Auth::user()->anggota)
                    <div class="mt-4 p-4 bg-gray-100 rounded">
                        <p><strong>Nomor Anggota:</strong> {{ Auth::user()->anggota->nomor_anggota }}</p>
                        <p><strong>PAC:</strong> {{ Auth::user()->anggota->pac ?? 'Belum diatur' }}</p>
                        <p><strong>Jumlah pendaftaran:</strong> {{ Auth::user()->anggota->pendaftarans->count() }} kegiatan</p>
                    </div>
                @else
                    <p class="text-red-500 mt-2">Data anggota belum lengkap. Silakan hubungi admin.</p>
                @endif

                <div class="mt-6 flex gap-2">
                    <a href="{{ route('kegiatan.publik.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Lihat Kegiatan</a>
                    <a href="{{ route('anggota.riwayat') }}" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">Riwayat Pendaftaran</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection