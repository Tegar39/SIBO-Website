<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AnggotaController extends Controller
{
    public function index(Request $request)
    {
        // Query dengan fitur Search dan Filter PAC
        $anggota = Anggota::with('user')
            ->when($request->search, function ($query, $search) {
                $query->where('nama_lengkap', 'like', "%{$search}%")
                      ->orWhere('nomor_anggota', 'like', "%{$search}%");
            })
            ->when($request->pac, function ($query, $pac) {
                $query->where('pac', $pac);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(3) // Kembali ke 3 data per halaman sesuai request
            ->withQueryString(); // Menjaga filter tetap aktif saat navigasi halaman

        return view('admin.anggota.index', compact('anggota'));
    }

    public function create()
    {
        return view('admin.anggota.create');
    }

    public function store(Request $request)
    {
        // Auto-generate nomor anggota 5 digit
        $lastAnggota = Anggota::orderBy('id_anggota', 'desc')->first();
        if ($lastAnggota) {
            $lastNumber = (int) $lastAnggota->nomor_anggota;
            $newNumber = str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '00001';
        }

        $request->merge(['nomor_anggota' => $newNumber]);

        $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'nomor_anggota' => 'required|string|size:5|unique:anggotas,nomor_anggota',
            'password' => 'required|min:8',
            'kontak' => ['required', 'regex:/^(08|\+62)[0-9]{8,}$/'],
            'pac' => 'required|in:PAC-01,PAC-02,PAC-03,PAC-04,PAC-05',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Create User Account
        $user = User::create([
            'name' => $request->nama_lengkap,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'anggota',
        ]);

        $dataAnggota = [
            'id_user' => $user->id,
            'nomor_anggota' => $request->nomor_anggota,
            'nama_lengkap' => $request->nama_lengkap,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'alamat' => $request->alamat,
            'kontak' => $request->kontak,
            'pac' => $request->pac,
        ];

        if ($request->hasFile('foto_profil')) {
            $path = $request->file('foto_profil')->store('foto_profil', 'public');
            $dataAnggota['foto_profil'] = $path;
        }

        Anggota::create($dataAnggota);

        return redirect()->route('admin.anggota.index')
            ->with('success', "Anggota berhasil ditambahkan (ID: {$newNumber})");
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
            'kontak' => ['required', 'regex:/^(08|\+62)[0-9]{8,}$/'],
            'pac' => 'required|in:PAC-01,PAC-02,PAC-03,PAC-04,PAC-05',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $dataAnggota = $request->only(['nama_lengkap', 'tempat_lahir', 'tgl_lahir', 'alamat', 'kontak', 'pac']);

        if ($request->hasFile('foto_profil')) {
            if ($anggota->foto_profil && Storage::disk('public')->exists($anggota->foto_profil)) {
                Storage::disk('public')->delete($anggota->foto_profil);
            }
            $dataAnggota['foto_profil'] = $request->file('foto_profil')->store('foto_profil', 'public');
        }

        $anggota->update($dataAnggota);
        $anggota->user->update(['name' => $request->nama_lengkap]);

        return redirect()->route('admin.anggota.index')->with('success', 'Data anggota berhasil diperbarui');
    }

    public function destroy($id)
    {
        $anggota = Anggota::findOrFail($id);
        
        if ($anggota->foto_profil) {
            Storage::disk('public')->delete($anggota->foto_profil);
        }

        $user = $anggota->user;
        $anggota->delete();
        
        if ($user) {
            $user->delete();
        }

        return redirect()->route('admin.anggota.index')->with('success', 'Anggota dan akun user berhasil dihapus');
    }
}