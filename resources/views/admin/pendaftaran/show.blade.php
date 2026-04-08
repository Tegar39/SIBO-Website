@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-2xl font-bold">Pendaftar: {{ $kegiatan->judul }}</h1>
                    <a href="{{ route('admin.pendaftaran.index') }}" class="bg-gray-500 text-white px-3 py-1 rounded">Kembali</a>
                </div>
                <p>Tanggal: {{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('d M Y') }} | Kuota: {{ $kegiatan->kuota == 0 ? 'Tak terbatas' : $kegiatan->kuota }}</p>
                <p class="mb-4">Status kegiatan: {{ ucfirst($kegiatan->status) }}</p>
                @if(session('success'))<div class="bg-green-100 border-green-400 text-green-700 px-4 py-2 rounded mb-4">{{ session('success') }}</div>@endif
                @if(session('error'))<div class="bg-red-100 border-red-400 text-red-700 px-4 py-2 rounded mb-4">{{ session('error') }}</div>@endif
                <div class="overflow-x-auto">
                    <table class="min-w-full border">
                        <thead class="bg-gray-200">
                            <tr><th class="px-4 py-2 border">No</th><th class="px-4 py-2 border">Nama</th><th class="px-4 py-2 border">Nomor Anggota</th><th class="px-4 py-2 border">PAC</th><th class="px-4 py-2 border">Tgl Daftar</th><th class="px-4 py-2 border">Status</th><th class="px-4 py-2 border">Aksi</th></tr>
                        </thead>
                        <tbody>
                            @foreach($pendaftarans as $key => $p)
                            <tr>
                                <td class="px-4 py-2 border">{{ $key+1 }}</td>
                                <td class="px-4 py-2 border">{{ $p->anggota->nama_lengkap }}</td>
                                <td class="px-4 py-2 border">{{ $p->anggota->nomor_anggota }}</td>
                                <td class="px-4 py-2 border">{{ $p->anggota->pac ?? '-' }}</td>
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
                                    <form action="{{ route('admin.pendaftaran.update', $p->id_daftar) }}" method="POST" class="flex gap-1">
                                        @csrf @method('PUT')
                                        <select name="status" class="border rounded px-1 py-1 text-sm">
                                            <option value="pending" {{ $p->status=='pending'?'selected':'' }}>Pending</option>
                                            <option value="disetujui" {{ $p->status=='disetujui'?'selected':'' }}>Disetujui</option>
                                            <option value="ditolak" {{ $p->status=='ditolak'?'selected':'' }}>Ditolak</option>
                                            <option value="batal" {{ $p->status=='batal'?'selected':'' }}>Batal</option>
                                        </select>
                                        <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded text-sm">Update</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $pendaftarans->links() }}
            </div>
        </div>
    </div>
</div>
@endsection