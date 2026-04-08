<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggota = Anggota::with('user')->paginate(10);
        return view('admin.anggota.index', compact('anggota'));
    }

    public function create()
    {
        return view('admin.anggota.create');
    }

    public function store(Request $request)
    {
        // Simpan user dulu
        $user = new \App\Models\User();
        $user->name = $request->nama_lengkap;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = 'anggota';
        $user->save();

        // Simpan anggota
        $anggota = new \App\Models\Anggota();
        $anggota->id_user = $user->id;
        $anggota->nomor_anggota = $request->nomor_anggota;
        $anggota->nama_lengkap = $request->nama_lengkap;
        $anggota->tempat_lahir = $request->tempat_lahir;
        $anggota->tgl_lahir = $request->tgl_lahir;
        $anggota->alamat = $request->alamat;
        $anggota->kontak = $request->kontak;
        $anggota->pac = $request->pac;
        $anggota->save();

        return redirect()->route('admin.anggota.index')->with('success', 'Anggota berhasil ditambahkan');
    }

    public function edit($id)
    {
        $anggota = Anggota::findOrFail($id);
        return view('admin.anggota.edit', compact('anggota'));
    }

    public function update(Request $request, $id)
    {
        $anggota = Anggota::findOrFail($id);
        $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'nomor_anggota' => 'required|string|unique:anggotas,nomor_anggota,' . $id . ',id_anggota',
        ]);

        $anggota->update($request->only(['nama_lengkap', 'tempat_lahir', 'tgl_lahir', 'alamat', 'kontak', 'pac']));
        $anggota->user->update(['name' => $request->nama_lengkap]);

        return redirect()->route('admin.anggota.index')->with('success', 'Anggota berhasil diupdate');
    }

    public function destroy($id)
    {
        $anggota = Anggota::findOrFail($id);
        $user = $anggota->user;
        $anggota->delete();
        $user->delete();

        return redirect()->route('admin.anggota.index')->with('success', 'Anggota berhasil dihapus');
    }
}