<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggota = Anggota::with('user')->orderBy('created_at', 'desc')->paginate(3);
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

        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'nomor_anggota' => 'required|string|size:5|unique:anggotas,nomor_anggota',
            'password' => 'required|min:8',
            'kontak' => ['required', 'regex:/^(08|\+62)[0-9]{8,}$/'],
            'pac' => 'required|in:PAC-01,PAC-02,PAC-03,PAC-04,PAC-05',
            'tempat_lahir' => 'nullable|string',
            'tgl_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'nomor_anggota.required' => 'Nomor anggota wajib diisi.',
            'nomor_anggota.size' => 'Nomor anggota harus tepat 5 digit angka.',
            'nomor_anggota.unique' => 'Nomor anggota sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'kontak.required' => 'Kontak wajib diisi.',
            'kontak.regex' => 'Format kontak harus diawali 08 atau +62 dan minimal 10 digit.',
            'pac.required' => 'PAC wajib dipilih.',
            'foto_profil.image' => 'File harus berupa gambar.',
            'foto_profil.mimes' => 'Format gambar harus JPEG, PNG, atau JPG.',
            'foto_profil.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        // Buat user
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

        // Upload foto profil jika ada
        if ($request->hasFile('foto_profil')) {
            $path = $request->file('foto_profil')->store('foto_profil', 'public');
            $dataAnggota['foto_profil'] = $path;
        }

        Anggota::create($dataAnggota);

        return redirect()->route('admin.anggota.index')
            ->with('success', "Anggota berhasil ditambahkan dengan nomor anggota {$newNumber}");
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
            'kontak' => ['required', 'regex:/^(08|\+62)[0-9]{8,}$/'],
            'pac' => 'required|in:PAC-01,PAC-02,PAC-03,PAC-04,PAC-05',
            'tempat_lahir' => 'nullable|string',
            'tgl_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'kontak.required' => 'Kontak wajib diisi.',
            'kontak.regex' => 'Format kontak harus diawali 08 atau +62 dan minimal 10 digit.',
            'pac.required' => 'PAC wajib dipilih.',
            'foto_profil.image' => 'File harus berupa gambar.',
            'foto_profil.mimes' => 'Format gambar harus JPEG, PNG, atau JPG.',
            'foto_profil.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        $dataAnggota = [
            'nama_lengkap' => $request->nama_lengkap,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'alamat' => $request->alamat,
            'kontak' => $request->kontak,
            'pac' => $request->pac,
        ];

        // Upload foto profil baru jika ada
        if ($request->hasFile('foto_profil')) {
            // Hapus foto lama
            if ($anggota->foto_profil && Storage::disk('public')->exists($anggota->foto_profil)) {
                Storage::disk('public')->delete($anggota->foto_profil);
            }
            $path = $request->file('foto_profil')->store('foto_profil', 'public');
            $dataAnggota['foto_profil'] = $path;
        }

        $anggota->update($dataAnggota);

        // Update nama di tabel users
        $anggota->user->update(['name' => $request->nama_lengkap]);

        return redirect()->route('admin.anggota.index')
            ->with('success', 'Anggota berhasil diperbarui');
    }

    public function destroy($id)
    {
        $anggota = Anggota::findOrFail($id);
        // Hapus foto profil jika ada
        if ($anggota->foto_profil && Storage::disk('public')->exists($anggota->foto_profil)) {
            Storage::disk('public')->delete($anggota->foto_profil);
        }
        $user = $anggota->user;
        $anggota->delete();
        $user->delete();

        return redirect()->route('admin.anggota.index')
            ->with('success', 'Anggota berhasil dihapus');
    }
}