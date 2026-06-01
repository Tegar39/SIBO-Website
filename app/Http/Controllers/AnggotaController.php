<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Services\AuditService;

class AnggotaController extends Controller
{
    // Daftar PAC yang valid
    const PAC_LIST = [
        'BADAS', 'PARE', 'KANDANGAN', 'PURWOASRI', 'PAPAR', 'KUNJANG', 'PLEMAHAN', 'GAMPENGREJO',
        'NGASEM', 'GURAH', 'PAGU', 'PLOSOKLATEN', 'WATES', 'KANDAT', 'KRAS', 'RINGINREJO',
        'NGADILUWIH', 'SEMEN', 'MOJO', 'BANYAKAN', 'GROGOL', 'TAROKAN', 'KAYENKIDUL', 'NGANCAR',
        'PUNCU', 'KEPUNG'
    ];

    public function index(Request $request)
    {
        $anggota = Anggota::with('user')
            ->when($request->filled('q'), function ($query) use ($request) {
                $keyword = trim($request->q);
                $query->where(function ($q) use ($keyword) {
                    $q->where('nama_lengkap', 'like', "%{$keyword}%")
                      ->orWhere('nomor_anggota', 'like', "%{$keyword}%")
                      ->orWhere('kontak', 'like', "%{$keyword}%")
                      ->orWhere('pac', 'like', "%{$keyword}%")
                      ->orWhereHas('user', function ($userQuery) use ($keyword) {
                          $userQuery->where('email', 'like', "%{$keyword}%");
                      });
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('admin.anggota.index', compact('anggota'));
    }

    public function create()
    {
        return view('admin.anggota.create');
    }

    public function store(Request $request, AuditService $audit)
    {
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
            'pac' => 'required|in:' . implode(',', self::PAC_LIST),
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

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

        $anggota = Anggota::create($dataAnggota);
        $audit->log('create_anggota', 'anggota', $anggota, null, $anggota->only(['nomor_anggota', 'nama_lengkap', 'pac']), $request);

        return redirect()->route('admin.anggota.index')
            ->with('success', "Anggota berhasil ditambahkan (ID: {$newNumber})");
    }

    public function edit($id)
    {
        $anggota = Anggota::findOrFail($id);
        return view('admin.anggota.edit', compact('anggota'));
    }

    public function update(Request $request, $id, AuditService $audit)
    {
        $anggota = Anggota::findOrFail($id);
        $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'kontak' => ['required', 'regex:/^(08|\+62)[0-9]{8,}$/'],
            'pac' => 'required|in:' . implode(',', self::PAC_LIST),
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $dataAnggota = $request->only(['nama_lengkap', 'tempat_lahir', 'tgl_lahir', 'alamat', 'kontak', 'pac']);

        if ($request->hasFile('foto_profil')) {
            if ($anggota->foto_profil && Storage::disk('public')->exists($anggota->foto_profil)) {
                Storage::disk('public')->delete($anggota->foto_profil);
            }
            $dataAnggota['foto_profil'] = $request->file('foto_profil')->store('foto_profil', 'public');
        }

        $old = $anggota->only(['nama_lengkap', 'kontak', 'pac']);
        $anggota->update($dataAnggota);
        $anggota->user->update(['name' => $request->nama_lengkap]);
        $audit->log('update_anggota', 'anggota', $anggota, $old, $anggota->only(['nama_lengkap', 'kontak', 'pac']), $request);

        return redirect()->route('admin.anggota.index')->with('success', 'Data anggota berhasil diperbarui');
    }

    public function destroy($id, AuditService $audit)
    {
        $anggota = Anggota::findOrFail($id);
        if ($anggota->foto_profil) {
            Storage::disk('public')->delete($anggota->foto_profil);
        }
        $user = $anggota->user;
        $old = $anggota->only(['nomor_anggota', 'nama_lengkap', 'pac']);
        $audit->log('delete_anggota', 'anggota', $anggota, $old, null, request());
        $anggota->delete();
        if ($user) $user->delete();
        return redirect()->route('admin.anggota.index')->with('success', 'Anggota dan akun user berhasil dihapus');
    }
}