<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Pendaftaran;
use App\Events\PendaftaranSelesai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PendaftaranController extends Controller
{
    // ========== ANGGOTA ==========
    public function daftar(Request $request, $id_kegiatan)
    {
        $user = Auth::user();
        $anggota = $user->anggota;
        if (!$anggota) {
            return back()->with('error', 'Data anggota belum lengkap. Hubungi admin.');
        }

        $kegiatan = Kegiatan::findOrFail($id_kegiatan);
        if ($kegiatan->status != 'aktif' || !$kegiatan->bisaDaftar) {
            return back()->with('error', 'Pendaftaran kegiatan sudah ditutup.');
        }

        $request->validate([
            'jenis_daftar' => 'required|in:self,other',
            'nama_peserta' => 'required_if:jenis_daftar,other|nullable|string|max:100',
            'kontak_peserta' => 'required_if:jenis_daftar,other|nullable|string|max:20',
        ]);

        $jenisDaftar = $request->jenis_daftar;
        $namaPeserta = $jenisDaftar === 'self'
            ? $anggota->nama_lengkap
            : trim((string) $request->nama_peserta);
        $kontakPeserta = $jenisDaftar === 'self'
            ? $anggota->kontak
            : trim((string) $request->kontak_peserta);

        // Check database: satu anggota hanya boleh mendaftarkan dirinya sendiri satu kali
        // pada kegiatan yang sama selama statusnya masih aktif/pending/disetujui.
        if ($jenisDaftar === 'self') {
            $sudahDaftarSelf = Pendaftaran::query()
                ->where('id_kegiatan', $kegiatan->id_kegiatan)
                ->where('id_anggota', $anggota->id_anggota)
                ->where('jenis_daftar', 'self')
                ->whereIn('status', ['pending', 'disetujui'])
                ->exists();

            if ($sudahDaftarSelf) {
                return back()->with('error', 'Kamu sudah mendaftar untuk kegiatan ini.');
            }
        }

        // Check database: daftar untuk orang lain boleh lebih dari satu kali,
        // tetapi orang yang sama tidak boleh didaftarkan dua kali oleh akun yang sama
        // pada kegiatan yang sama. Pengecekan memakai nama + kontak agar tetap fleksibel.
        if ($jenisDaftar === 'other') {
            $namaNormal = $this->normalisasiNamaPeserta($namaPeserta);
            $kontakNormal = $this->normalisasiKontakPeserta($kontakPeserta);

            $duplikatPeserta = Pendaftaran::query()
                ->where('id_kegiatan', $kegiatan->id_kegiatan)
                ->where('created_by', $user->id)
                ->where('jenis_daftar', 'other')
                ->whereIn('status', ['pending', 'disetujui'])
                ->get()
                ->contains(function (Pendaftaran $pendaftaran) use ($namaNormal, $kontakNormal) {
                    return $this->normalisasiNamaPeserta($pendaftaran->nama_peserta) === $namaNormal
                        && $this->normalisasiKontakPeserta($pendaftaran->kontak_peserta) === $kontakNormal;
                });

            if ($duplikatPeserta) {
                return back()->with('error', 'Peserta tersebut sudah pernah kamu daftarkan pada kegiatan ini.');
            }
        }

        // Cek kuota (hitung yang sudah disetujui)
        $jumlahDisetujui = Pendaftaran::where('id_kegiatan', $id_kegiatan)
            ->where('status', 'disetujui')->count();
        if ($kegiatan->kuota > 0 && $jumlahDisetujui >= $kegiatan->kuota) {
            return back()->with('error', 'Kuota kegiatan sudah penuh.');
        }

        Pendaftaran::create([
            'id_kegiatan' => $kegiatan->id_kegiatan,
            'id_anggota' => $anggota->id_anggota,
            'nama_peserta' => $namaPeserta,
            'kontak_peserta' => $kontakPeserta,
            'jenis_daftar' => $jenisDaftar,
            'tgl_daftar' => now(),
            'status' => 'pending',
            'created_by' => $user->id,
        ]);

        $pesan = $jenisDaftar === 'other'
            ? 'Pendaftaran peserta atas nama ' . $namaPeserta . ' berhasil dikirim.'
            : 'Pendaftaran berhasil dikirim.';

        return redirect()->route('anggota.riwayat')->with('success', $pesan);
    }

    public function riwayat()
    {
        $user = Auth::user();
        $anggota = $user->anggota;
        if (!$anggota) {
            return redirect()->route('home')->with('error', 'Data anggota tidak ditemukan.');
        }
        $pendaftarans = Pendaftaran::with(['kegiatan', 'absensi', 'certificate'])
            ->where(function ($q) use ($anggota, $user) {
                $q->where('id_anggota', $anggota->id_anggota)
                  ->orWhere('created_by', $user->id);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('anggota.riwayat', compact('pendaftarans'));
    }

    // ========== ADMIN ==========
    public function index(Request $request)
    {
        $kegiatans = Kegiatan::withCount('pendaftarans')
            ->with('pamflet')
            ->when($request->search, fn($q, $s) => $q->where('judul', 'like', "%{$s}%"))
            ->orderBy('created_at', 'desc')
            ->paginate(3)
            ->withQueryString();
        return view('admin.pendaftaran.index', compact('kegiatans'));
    }

    public function show($id_kegiatan)
    {
        $kegiatan = Kegiatan::findOrFail($id_kegiatan);
        $pendaftarans = Pendaftaran::with('anggota.user', 'creator')
            ->where('id_kegiatan', $id_kegiatan)
            ->latest()
            ->paginate(20);
        return view('admin.pendaftaran.show', compact('kegiatan', 'pendaftarans'));
    }

    public function createByAdmin($id_kegiatan)
    {
        $kegiatan = Kegiatan::findOrFail($id_kegiatan);
        return view('admin.pendaftaran.create', compact('kegiatan'));
    }

    public function storeByAdmin(Request $request, $id_kegiatan)
    {
        $kegiatan = Kegiatan::findOrFail($id_kegiatan);
        $request->validate([
            'nama_peserta' => 'required|string|max:100',
            'kontak_peserta' => 'required|string|max:20',
            'status' => 'required|in:pending,disetujui,batal,ditolak',
        ]);

        if ($request->status == 'disetujui') {
            $jumlahDisetujui = Pendaftaran::where('id_kegiatan', $id_kegiatan)
                ->where('status', 'disetujui')->count();
            if ($kegiatan->kuota > 0 && $jumlahDisetujui >= $kegiatan->kuota) {
                return back()->with('error', 'Kuota penuh, tidak bisa menyetujui.');
            }
        }

        $pendaftaran = Pendaftaran::create([
            'id_kegiatan' => $kegiatan->id_kegiatan,
            'nama_peserta' => $request->nama_peserta,
            'kontak_peserta' => $request->kontak_peserta,
            'tgl_daftar' => now(),
            'status' => $request->status,
            'created_by' => Auth::id(),
            'id_anggota' => null,
            'jenis_daftar' => 'admin',
        ]);

        // 🔔 Trigger event jika status = disetujui
        if ($request->status == 'disetujui') {
            event(new PendaftaranSelesai($pendaftaran));
        }

        return redirect()->route('admin.pendaftaran.show', $id_kegiatan)
            ->with('success', 'Peserta berhasil ditambahkan.');
    }

    public function updateStatus(Request $request, $id_daftar)
    {
        $request->validate(['status' => 'required|in:disetujui,ditolak,batal']);
        $pendaftaran = Pendaftaran::findOrFail($id_daftar);
        $kegiatan = $pendaftaran->kegiatan;

        if ($request->status == 'disetujui' && $pendaftaran->status != 'disetujui') {
            $disetujui = Pendaftaran::where('id_kegiatan', $kegiatan->id_kegiatan)
                ->where('status', 'disetujui')->count();
            if ($kegiatan->kuota > 0 && $disetujui >= $kegiatan->kuota) {
                return back()->with('error', 'Kuota penuh, tidak bisa menyetujui.');
            }
        }

        $pendaftaran->update(['status' => $request->status]);

        // Trigger event jika status baru menjadi 'disetujui'
        if ($request->status == 'disetujui') {
            event(new PendaftaranSelesai($pendaftaran));
        }

        return back()->with('success', 'Status pendaftaran diupdate.');
    }

    private function normalisasiNamaPeserta(?string $nama): string
    {
        return Str::of((string) $nama)->lower()->squish()->toString();
    }

    private function normalisasiKontakPeserta(?string $kontak): string
    {
        return preg_replace('/\D+/', '', (string) $kontak) ?: '';
    }
}
