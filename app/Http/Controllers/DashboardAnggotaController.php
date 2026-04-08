<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardAnggotaController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $anggota = $user->anggota;
        return view('anggota.dashboard', compact('user', 'anggota'));
    }
}