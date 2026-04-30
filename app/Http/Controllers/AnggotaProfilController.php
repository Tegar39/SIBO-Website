<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Anggota;
use App\Models\User;

class AnggotaProfilController extends Controller
{
    // Halaman Profil (Edit Data Personal)
    public function index()
    {
        $user = Auth::user();
        $anggota = $user->anggota; // relasi di model User
        return view('anggota.profil.index', compact('user', 'anggota'));
    }

    // Halaman Keamanan (Ganti Password)
    public function keamanan()
    {
        return view('anggota.profil.keamanan');
    }

    // Update Profil
    public function update(Request $request)
    {
        $user = Auth::user();
        $anggota = $user->anggota;

        $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'tempat_lahir' => 'nullable|string|max:50',
            'tgl_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'kontak' => ['required', 'regex:/^(08|\+62)[0-9]{8,}$/'],
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'kontak.required' => 'Kontak wajib diisi.',
            'kontak.regex' => 'Format kontak harus diawali 08 atau +62 dan minimal 10 digit.',
            'foto_profil.image' => 'File harus berupa gambar.',
            'foto_profil.mimes' => 'Format gambar harus JPEG, PNG, atau JPG.',
            'foto_profil.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        // Update data user (nama)
        $user->update(['name' => $request->nama_lengkap]);

        // Siapkan data anggota
        $dataAnggota = [
            'nama_lengkap' => $request->nama_lengkap,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'alamat' => $request->alamat,
            'kontak' => $request->kontak,
        ];

        // Proses upload foto profil
        if ($request->hasFile('foto_profil')) {
            // Hapus foto lama jika ada
            if ($anggota->foto_profil && Storage::disk('public')->exists($anggota->foto_profil)) {
                Storage::disk('public')->delete($anggota->foto_profil);
            }
            $path = $request->file('foto_profil')->store('foto_profil', 'public');
            $dataAnggota['foto_profil'] = $path;
        }

        $anggota->update($dataAnggota);

        return redirect()->route('anggota.profil')->with('success', 'Profil berhasil diperbarui.');
    }

    // Update Password (dari halaman keamanan)
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ], [
            'current_password.required' => 'Password lama wajib diisi.',
            'new_password.required' => 'Password baru wajib diisi.',
            'new_password.min' => 'Password baru minimal 6 karakter.',
            'new_password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
        }

        $user->update(['password' => Hash::make($request->new_password)]);

        // Redirect ke halaman keamanan (bukan profil)
        return redirect()->route('anggota.keamanan')->with('success', 'Password berhasil diubah.');
    }
}