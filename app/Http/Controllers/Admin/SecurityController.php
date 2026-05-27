<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\User;
use App\Services\AuditService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SecurityController extends Controller
{
    public function index(Request $request)
    {
        $users = User::with('anggota')
            ->when($request->role, fn ($q, $role) => $q->where('role', $role))
            ->when($request->status, fn ($q, $status) => $q->where('account_status', $status))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $auditLogs = AuditLog::with('user')->latest()->limit(20)->get();
        return view('admin.security.index', compact('users', 'auditLogs'));
    }

    public function updateUser(Request $request, User $user, AuditService $audit): RedirectResponse
    {
        $data = $request->validate([
            'account_status' => ['required', Rule::in(['aktif', 'nonaktif', 'blokir'])],
            'two_factor_enabled' => ['nullable', 'boolean'],
        ]);
        $old = $user->only(['account_status', 'two_factor_enabled']);
        $user->update([
            'account_status' => $data['account_status'],
            // Admin sengaja tidak diwajibkan OTP. Checkbox OTP hanya berlaku untuk anggota/PAC.
            'two_factor_enabled' => $user->role === 'admin' ? false : $request->boolean('two_factor_enabled'),
        ]);
        $audit->log('update_user_security', 'security', $user, $old, $user->only(['account_status', 'two_factor_enabled']), $request);
        return back()->with('success', 'Pengaturan keamanan akun berhasil diperbarui.');
    }
}
