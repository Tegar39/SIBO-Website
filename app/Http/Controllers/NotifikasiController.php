<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class NotifikasiController extends Controller
{
    public function index(): View|RedirectResponse
    {
        $anggota = Auth::user()?->anggota;

        if (! $anggota) {
            return redirect()->route('home')->with('error', 'Data anggota tidak ditemukan.');
        }

        $notifikasi = Notifikasi::where('id_anggota', $anggota->id_anggota)
            ->latest()
            ->paginate(10);

        return view('anggota.notifikasi', compact('notifikasi'));
    }

    public function markAsRead(int $id): RedirectResponse
    {
        $anggota = Auth::user()?->anggota;

        if (! $anggota) {
            return redirect()->route('home')->with('error', 'Data anggota tidak ditemukan.');
        }

        Notifikasi::where('id', $id)
            ->where('id_anggota', $anggota->id_anggota)
            ->update(['is_read' => true]);

        return back()->with('success', 'Notifikasi ditandai sudah dibaca.');
    }
}
