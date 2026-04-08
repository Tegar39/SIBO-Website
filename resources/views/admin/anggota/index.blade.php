@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-2xl font-bold">Daftar Anggota</h1>
                    <a href="{{ route('admin.anggota.create') }}" wire:navigate class="bg-blue-500 text-white px-4 py-2 rounded">Tambah Anggota</a>
                </div>

                @if(session('success'))
                    <div class="bg-green-100 border-green-400 text-green-700 px-4 py-2 rounded mb-4">{{ session('success') }}</div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full border">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="px-4 py-2 border">No</th>
                                <th class="px-4 py-2 border">Nomor Anggota</th>
                                <th class="px-4 py-2 border">Nama</th>
                                <th class="px-4 py-2 border">PAC</th>
                                <th class="px-4 py-2 border">Email</th>
                                <th class="px-4 py-2 border">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($anggota as $key => $a)
                            <tr>
                                <td class="px-4 py-2 border">{{ $key+1 }}</td>
                                <td class="px-4 py-2 border">{{ $a->nomor_anggota }}</td>
                                <td class="px-4 py-2 border">{{ $a->nama_lengkap }}</td>
                                <td class="px-4 py-2 border">{{ $a->pac }}</td>
                                <td class="px-4 py-2 border">{{ $a->user->email }}</td>
                                <td class="px-4 py-2 border">
                                    <a href="{{ route('admin.anggota.edit', $a->id_anggota) }}" wire:navigate class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</a>
                                    <form action="{{ route('admin.anggota.destroy', $a->id_anggota) }}" method="POST" class="inline-block">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded" onclick="return confirm('Yakin?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $anggota->links() }}
            </div>
        </div>
    </div>
</div>
@endsection