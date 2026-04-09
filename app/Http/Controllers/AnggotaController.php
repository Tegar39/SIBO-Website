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
        $anggota = Anggota::with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.anggota.index', compact('anggota'));
    }

    public function create()
    {
        return view('admin.anggota.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'nomor_anggota' => 'required|string|min:8|unique:anggotas,nomor_anggota',
            'password' => 'required|min:8',
            'kontak' => ['required', 'regex:/^(08|\+62)[0-9]{8,}$/'],
            'pac' => 'required|in:PAC-01,PAC-02,PAC-03,PAC-04,PAC-05',
            'tempat_lahir' => 'nullable|string',
            'tgl_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
        ]);

        $user = User::create([
            'name' => $request->nama_lengkap,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'anggota',
        ]);

        Anggota::create([
            'id_user' => $user->id,
            'nomor_anggota' => $request->nomor_anggota,
            'nama_lengkap' => $request->nama_lengkap,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'alamat' => $request->alamat,
            'kontak' => $request->kontak,
            'pac' => $request->pac,
        ]);

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
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'nomor_anggota' => 'required|string|min:8|unique:anggotas,nomor_anggota,' . $id . ',id_anggota',
            'kontak' => ['required', 'regex:/^(08|\+62)[0-9]{8,}$/'],
            'pac' => 'required|in:PAC-01,PAC-02,PAC-03,PAC-04,PAC-05',
            'tempat_lahir' => 'nullable|string',
            'tgl_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
        ]);

        $anggota->update([
            'nama_lengkap' => $request->nama_lengkap,
            'nomor_anggota' => $request->nomor_anggota,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'alamat' => $request->alamat,
            'kontak' => $request->kontak,
            'pac' => $request->pac,
        ]);

        // Update name di tabel users
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