@extends('layouts.app')
@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">Notifikasi</h1>
    @forelse($notifikasi as $n)
        <div class="border p-4 mb-3 rounded {{ $n->is_read ? 'bg-gray-50' : 'bg-white shadow-md' }}">
            <p class="font-semibold">{{ $n->judul }}</p>
            <p>{{ $n->pesan }}</p>
            <small class="text-gray-500">{{ $n->created_at->diffForHumans() }}</small>
            @if(!$n->is_read)
                <form action="{{ route('anggota.notifikasi.read', $n->id) }}" method="POST" class="inline">
                    @csrf @method('PUT')
                    <button class="text-blue-600 text-sm underline ml-4">Tandai Dibaca</button>
                </form>
            @endif
        </div>
    @empty
        <p>Tidak ada notifikasi.</p>
    @endforelse
    {{ $notifikasi->links() }}
</div>
@endsection