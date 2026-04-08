@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-2xl font-bold">Absensi: {{ $kegiatan->judul }}</h1>
                    <a href="{{ route('admin.absensi.index') }}" class="bg-gray-500 text-white px-3 py-1 rounded">Kembali</a>
                </div>
                <p class="mb-4">Tanggal: {{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('d M Y') }}</p>

                @if(session('success'))<div class="bg-green-100 border-green-400 text-green-700 px-4 py-2 rounded mb-4">{{ session('success') }}</div>@endif

                <form action="{{ route('admin.absensi.store', $kegiatan->id_kegiatan) }}" method="POST">
                    @csrf
                    <div class="overflow-x-auto">
                        <table class="min-w-full border">
                            <thead class="bg-gray-200">
                                <tr><th class="px-4 py-2 border">No</th><th class="px-4 py-2 border">Nama</th><th class="px-4 py-2 border">Nomor Anggota</th><th class="px-4 py-2 border">Hadir</th></tr>
                            </thead>
                            <tbody>
                                @foreach($pendaftarans as $key => $p)
                                <tr>
                                    <td class="px-4 py-2 border">{{ $key+1 }}</td>
                                    <td class="px-4 py-2 border">{{ $p->anggota->nama_lengkap }}</td>
                                    <td class="px-4 py-2 border">{{ $p->anggota->nomor_anggota }}</td>
                                    <td class="px-4 py-2 border">
                                        <input type="checkbox" name="hadir[{{ $p->id_daftar }}]" value="1" {{ $p->absensi && $p->absensi->hadir ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">Simpan Absensi</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection