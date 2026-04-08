@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold mb-4">Riwayat Pendaftaran</h1>

                @if(session('success'))
                    <div class="bg-green-100 border-green-400 text-green-700 px-4 py-2 rounded mb-4">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="bg-red-100 border-red-400 text-red-700 px-4 py-2 rounded mb-4">{{ session('error') }}</div>
                @endif

                @if($pendaftarans->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full border">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="px-4 py-2 border">No</th>
                                    <th class="px-4 py-2 border">Kegiatan</th>
                                    <th class="px-4 py-2 border">Tanggal Kegiatan</th>
                                    <th class="px-4 py-2 border">Tanggal Daftar</th>
                                    <th class="px-4 py-2 border">Status</th>
                                    <th class="px-4 py-2 border">Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendaftarans as $key => $p)
                                    <tr>
                                        <td class="px-4 py-2 border">{{ $key+1 }}</td>
                                        <td class="px-4 py-2 border">{{ $p->kegiatan->judul }}</td>
                                        <td class="px-4 py-2 border">{{ \Carbon\Carbon::parse($p->kegiatan->tanggal)->format('d M Y') }}</td>
                                        <td class="px-4 py-2 border">{{ \Carbon\Carbon::parse($p->tgl_daftar)->format('d M Y H:i') }}</td>
                                        <td class="px-4 py-2 border">
                                            <span class="px-2 py-1 rounded text-white text-xs
                                                @if($p->status=='pending') bg-yellow-500
                                                @elseif($p->status=='disetujui') bg-green-500
                                                @elseif($p->status=='ditolak') bg-red-500
                                                @else bg-gray-500 @endif">
                                                {{ ucfirst($p->status) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-2 border">
                                            <a href="{{ route('kegiatan.publik.show', $p->id_kegiatan) }}" wire:navigate class="text-blue-600 hover:underline">Lihat</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $pendaftarans->links() }}
                @else
                    <p class="text-gray-500">Anda belum pernah mendaftar kegiatan apapun.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection