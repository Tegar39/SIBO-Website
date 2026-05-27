@extends('layouts.app')

@section('content')
<div class="pt-28 pb-16 bg-slate-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-[2rem] p-8 border border-slate-100 shadow-sm">
            <p class="text-emerald-600 text-xs font-black uppercase tracking-[0.25em]">Keamanan Sistem</p>
            <h1 class="mt-2 text-3xl font-black text-slate-900">Status Akun, OTP Aksi Sensitif, dan Audit Log</h1>
            <p class="mt-3 text-slate-500">Fitur tambahan untuk mendukung keamanan proyek UAS: OTP hanya untuk aksi sensitif anggota/PAC seperti ganti password, semua role langsung masuk setelah password valid, blokir akun, dan pencatatan aktivitas penting.</p>
        </div>
        @if(session('success'))<div class="mt-6 rounded-2xl bg-emerald-50 text-emerald-700 px-5 py-4 font-bold">{{ session('success') }}</div>@endif
        <div class="mt-8 bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <h2 class="font-black text-slate-800">Pengaturan Akun</h2>
                <form class="flex gap-2" method="GET">
                    <select name="role" class="rounded-xl border-slate-200 text-sm"><option value="">Semua Role</option>@foreach(['admin','anggota','pac'] as $role)<option value="{{ $role }}" @selected(request('role')===$role)>{{ strtoupper($role) }}</option>@endforeach</select>
                    <select name="status" class="rounded-xl border-slate-200 text-sm"><option value="">Semua Status</option>@foreach(['aktif','nonaktif','blokir'] as $status)<option value="{{ $status }}" @selected(request('status')===$status)>{{ strtoupper($status) }}</option>@endforeach</select>
                    <button class="rounded-xl bg-slate-900 px-4 py-2 text-xs font-black uppercase text-white">Filter</button>
                </form>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm"><thead class="bg-slate-50 text-left text-[10px] uppercase tracking-widest text-slate-500 font-black"><tr><th class="px-6 py-4">User</th><th class="px-6 py-4">Role</th><th class="px-6 py-4">PAC</th><th class="px-6 py-4">Login Terakhir</th><th class="px-6 py-4">Pengaturan</th></tr></thead>
                <tbody class="divide-y divide-slate-100">@foreach($users as $user)<tr><td class="px-6 py-4"><div class="font-black text-slate-800">{{ $user->name }}</div><div class="text-xs text-slate-400">{{ $user->email }}</div></td><td class="px-6 py-4 font-bold uppercase">{{ $user->role }}</td><td class="px-6 py-4">{{ $user->anggota->pac ?? '-' }}</td><td class="px-6 py-4 text-slate-500">{{ $user->last_login_at ? $user->last_login_at->format('d/m/Y H:i') : '-' }}<br><span class="text-xs">{{ $user->last_login_ip ?? '-' }}</span></td><td class="px-6 py-4"><form method="POST" action="{{ route('admin.security.user.update', $user) }}" class="flex flex-wrap items-center gap-3">@csrf @method('PUT')<select name="account_status" class="rounded-xl border-slate-200 text-xs">@foreach(['aktif','nonaktif','blokir'] as $status)<option value="{{ $status }}" @selected($user->account_status === $status)>{{ strtoupper($status) }}</option>@endforeach</select>@if($user->role === 'admin')<span class="rounded-xl bg-slate-100 px-3 py-2 text-[10px] font-black uppercase text-slate-500">Admin tanpa OTP</span>@else<label class="flex items-center gap-2 text-xs font-bold text-slate-600"><input type="checkbox" name="two_factor_enabled" value="1" @checked($user->two_factor_enabled) class="rounded border-slate-300 text-emerald-600">OTP aksi sensitif</label>@endif<button class="rounded-xl bg-emerald-600 px-4 py-2 text-[10px] font-black uppercase text-white">Simpan</button></form></td></tr>@endforeach</tbody></table>
            </div>
            <div class="px-6 py-4">{{ $users->links() }}</div>
        </div>
        <div class="mt-8 bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden"><div class="px-6 py-5 border-b border-slate-100"><h2 class="font-black text-slate-800">Audit Log Terbaru</h2></div><div class="overflow-x-auto"><table class="w-full text-sm"><thead class="bg-slate-50 text-left text-[10px] uppercase tracking-widest text-slate-500 font-black"><tr><th class="px-6 py-4">Waktu</th><th class="px-6 py-4">User</th><th class="px-6 py-4">Modul</th><th class="px-6 py-4">Aksi</th><th class="px-6 py-4">IP</th></tr></thead><tbody class="divide-y divide-slate-100">@forelse($auditLogs as $log)<tr><td class="px-6 py-4">{{ $log->created_at->format('d/m/Y H:i') }}</td><td class="px-6 py-4">{{ $log->user->name ?? 'System' }}</td><td class="px-6 py-4">{{ $log->module ?? '-' }}</td><td class="px-6 py-4 font-bold">{{ $log->action }}</td><td class="px-6 py-4 text-slate-500">{{ $log->ip_address ?? '-' }}</td></tr>@empty<tr><td colspan="5" class="px-6 py-12 text-center text-slate-400 font-bold">Belum ada audit log.</td></tr>@endforelse</tbody></table></div></div>
    </div>
</div>
@endsection
