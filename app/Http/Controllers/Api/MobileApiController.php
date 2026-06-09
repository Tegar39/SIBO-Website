<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Anggota;
use App\Models\Certificate;
use App\Models\Galeri;
use App\Models\Kegiatan;
use App\Models\Notifikasi;
use App\Models\Pendaftaran;
use App\Models\User;
use App\Services\InventoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class MobileApiController extends Controller
{
    public function me(Request $request): JsonResponse
    {
        return response()->json(['data' => $this->userPayload($request->user())]);
    }

    public function dashboard(Request $request): JsonResponse
    {
        $user = $request->user();
        $anggota = $user->anggota;

        return response()->json([
            'data' => [
                'user' => $this->userPayload($user),
                'summary' => [
                    'total_anggota' => Anggota::count(),
                    'total_kegiatan' => Kegiatan::count(),
                    'total_kegiatan_aktif' => Kegiatan::where('status', 'aktif')->count(),
                    'total_pendaftar' => Pendaftaran::count(),
                    'total_notifikasi_unread' => $anggota ? Notifikasi::where('id_anggota', $anggota->id_anggota)->where('is_read', false)->count() : 0,
                    'total_sertifikat' => $anggota ? Certificate::whereHas('pendaftaran', fn ($q) => $q->where('id_anggota', $anggota->id_anggota))->count() : 0,
                ],
                'kegiatan_terbaru' => Kegiatan::with(['kategori', 'pamflet'])
                    ->orderByDesc('tanggal')
                    ->limit(5)
                    ->get()
                    ->map(fn (Kegiatan $kegiatan) => $this->kegiatanPayload($kegiatan)),
            ],
        ]);
    }

    public function kegiatan(Request $request): JsonResponse
    {
        $query = Kegiatan::with(['kategori', 'pamflet'])
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->status))
            ->when(! $request->filled('status'), fn ($q) => $q->whereIn('status', ['aktif', 'tutup', 'selesai']))
            ->when($request->filled('search'), function ($q) use ($request) {
                $search = $request->string('search')->toString();
                $q->where(fn ($sub) => $sub->where('judul', 'like', "%{$search}%")
                    ->orWhere('lokasi', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%"));
            })
            ->when($request->filled('id_kategori'), fn ($q) => $q->where('id_kategori', $request->integer('id_kategori')))
            ->orderByDesc('tanggal');

        $kegiatans = $query->paginate((int) $request->input('per_page', 10));

        return response()->json([
            'data' => collect($kegiatans->items())->map(fn (Kegiatan $kegiatan) => $this->kegiatanPayload($kegiatan)),
            'meta' => $this->paginationMeta($kegiatans),
        ]);
    }

    public function showKegiatan(Request $request, int $id): JsonResponse
    {
        $kegiatan = Kegiatan::with(['kategori', 'pamflet', 'galeris', 'pendaftarans.absensi'])->findOrFail($id);
        $anggota = $request->user()?->anggota;

        $pendaftaranSelf = null;
        $jumlahOtherSaya = 0;
        if ($anggota) {
            $pendaftaranSelf = Pendaftaran::where('id_kegiatan', $id)
                ->where('id_anggota', $anggota->id_anggota)
                ->where('jenis_daftar', 'self')
                ->whereIn('status', ['pending', 'disetujui'])
                ->first();
            $jumlahOtherSaya = Pendaftaran::where('id_kegiatan', $id)
                ->where('created_by', $request->user()->id)
                ->where('jenis_daftar', 'other')
                ->whereIn('status', ['pending', 'disetujui'])
                ->count();
        }

        return response()->json([
            'data' => array_merge($this->kegiatanPayload($kegiatan, true), [
                'sudah_daftar_self' => (bool) $pendaftaranSelf,
                'pendaftaran_self' => $pendaftaranSelf,
                'jumlah_peserta_lain_saya' => $jumlahOtherSaya,
                'galeri' => $kegiatan->galeris->map(fn (Galeri $galeri) => $this->galeriPayload($galeri)),
            ]),
        ]);
    }

    public function daftarKegiatan(Request $request, int $id): JsonResponse
    {
        $user = $request->user();
        $anggota = $user->anggota;
        if (! $anggota) {
            return response()->json(['message' => 'Data anggota belum lengkap.'], 422);
        }

        $kegiatan = Kegiatan::findOrFail($id);
        if ($kegiatan->status !== 'aktif' || ! $kegiatan->bisaDaftar) {
            return response()->json(['message' => 'Pendaftaran kegiatan sudah ditutup.'], 422);
        }

        $validated = $request->validate([
            'jenis_daftar' => ['required', 'in:self,other'],
            'nama_peserta' => ['required_if:jenis_daftar,other', 'nullable', 'string', 'max:100'],
            'kontak_peserta' => ['required_if:jenis_daftar,other', 'nullable', 'string', 'max:20'],
        ]);

        $jenisDaftar = $validated['jenis_daftar'];
        $namaPeserta = $jenisDaftar === 'self' ? $anggota->nama_lengkap : trim((string) $request->nama_peserta);
        $kontakPeserta = $jenisDaftar === 'self' ? $anggota->kontak : trim((string) $request->kontak_peserta);

        if ($jenisDaftar === 'self') {
            $exists = Pendaftaran::where('id_kegiatan', $kegiatan->id_kegiatan)
                ->where('id_anggota', $anggota->id_anggota)
                ->where('jenis_daftar', 'self')
                ->whereIn('status', ['pending', 'disetujui'])
                ->exists();
            if ($exists) {
                return response()->json(['message' => 'Kamu sudah mendaftar untuk kegiatan ini.'], 409);
            }
        }

        if ($jenisDaftar === 'other') {
            $namaNormal = $this->normalisasiNama($namaPeserta);
            $kontakNormal = $this->normalisasiKontak($kontakPeserta);
            $duplikat = Pendaftaran::where('id_kegiatan', $kegiatan->id_kegiatan)
                ->where('created_by', $user->id)
                ->where('jenis_daftar', 'other')
                ->whereIn('status', ['pending', 'disetujui'])
                ->get()
                ->contains(fn (Pendaftaran $p) => $this->normalisasiNama($p->nama_peserta) === $namaNormal
                    && $this->normalisasiKontak($p->kontak_peserta) === $kontakNormal);
            if ($duplikat) {
                return response()->json(['message' => 'Peserta tersebut sudah pernah kamu daftarkan pada kegiatan ini.'], 409);
            }
        }

        $jumlahDisetujui = Pendaftaran::where('id_kegiatan', $kegiatan->id_kegiatan)->where('status', 'disetujui')->count();
        if ($kegiatan->kuota > 0 && $jumlahDisetujui >= $kegiatan->kuota) {
            return response()->json(['message' => 'Kuota kegiatan sudah penuh.'], 422);
        }

        $pendaftaran = Pendaftaran::create([
            'id_kegiatan' => $kegiatan->id_kegiatan,
            'id_anggota' => $anggota->id_anggota,
            'nama_peserta' => $namaPeserta,
            'kontak_peserta' => $kontakPeserta,
            'jenis_daftar' => $jenisDaftar,
            'tgl_daftar' => now(),
            'status' => 'pending',
            'created_by' => $user->id,
        ]);

        return response()->json(['message' => 'Pendaftaran berhasil dikirim.', 'data' => $this->pendaftaranPayload($pendaftaran->load(['kegiatan', 'absensi', 'certificate']))], 201);
    }

    public function riwayat(Request $request): JsonResponse
    {
        $user = $request->user();
        $anggota = $user->anggota;
        if (! $anggota) {
            return response()->json(['data' => []]);
        }

        $riwayat = Pendaftaran::with(['kegiatan.kategori', 'absensi', 'certificate'])
            ->where(fn ($q) => $q->where('id_anggota', $anggota->id_anggota)->orWhere('created_by', $user->id))
            ->orderByDesc('created_at')
            ->paginate((int) $request->input('per_page', 10));

        return response()->json([
            'data' => collect($riwayat->items())->map(fn (Pendaftaran $p) => $this->pendaftaranPayload($p)),
            'meta' => $this->paginationMeta($riwayat),
        ]);
    }

    public function notifikasi(Request $request): JsonResponse
    {
        $anggota = $request->user()->anggota;
        if (! $anggota) {
            return response()->json(['data' => []]);
        }
        $items = Notifikasi::where('id_anggota', $anggota->id_anggota)
            ->orderByDesc('created_at')
            ->paginate((int) $request->input('per_page', 10));
        return response()->json(['data' => $items->items(), 'meta' => $this->paginationMeta($items)]);
    }

    public function readNotifikasi(Request $request, int $id): JsonResponse
    {
        $anggota = $request->user()->anggota;
        abort_unless($anggota, 403);
        $notifikasi = Notifikasi::where('id_anggota', $anggota->id_anggota)->findOrFail($id);
        $notifikasi->update(['is_read' => true]);
        return response()->json(['message' => 'Notifikasi ditandai sudah dibaca.', 'data' => $notifikasi]);
    }

    public function sertifikat(Request $request): JsonResponse
    {
        $anggota = $request->user()->anggota;
        if (! $anggota) {
            return response()->json(['data' => []]);
        }
        $certificates = Certificate::with('pendaftaran.kegiatan')
            ->whereHas('pendaftaran', fn ($q) => $q->where('id_anggota', $anggota->id_anggota))
            ->latest()
            ->get();

        return response()->json([
            'data' => $certificates->map(fn (Certificate $certificate) => $this->certificatePayload($certificate)),
        ]);
    }

    public function downloadSertifikat(Request $request, int $id)
    {
        $certificate = Certificate::with('pendaftaran.anggota')->findOrFail($id);
        $user = $request->user();
        $anggota = $user->anggota;

        abort_unless($user->role === 'admin' || ($anggota && (int) $certificate->pendaftaran?->id_anggota === (int) $anggota->id_anggota), 403);
        abort_unless(Storage::disk('public')->exists($certificate->file_path), 404, 'File sertifikat tidak ditemukan.');

        return Storage::disk('public')->download($certificate->file_path, "sertifikat_{$certificate->certificate_number}.pdf");
    }

    public function profil(Request $request): JsonResponse
    {
        return response()->json(['data' => $this->userPayload($request->user())]);
    }

    public function updateProfil(Request $request): JsonResponse
    {
        $user = $request->user();
        $anggota = $user->anggota;
        if (! $anggota) {
            return response()->json(['message' => 'Data anggota belum lengkap.'], 422);
        }

        $validated = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:100'],
            'tempat_lahir' => ['nullable', 'string', 'max:50'],
            'tgl_lahir' => ['nullable', 'date'],
            'alamat' => ['nullable', 'string'],
            'kontak' => ['required', 'regex:/^(08|\\+62)[0-9]{8,}$/'],
        ]);

        $user->update(['name' => $validated['nama_lengkap']]);
        $anggota->update($validated);

        return response()->json(['message' => 'Profil berhasil diperbarui.', 'data' => $this->userPayload($user->refresh())]);
    }

    public function requestPasswordOtp(Request $request, AuthenticatedSessionController $authController): JsonResponse
    {
        $user = $request->user();
        if ($user->role === 'admin' || ! ($user->two_factor_enabled ?? true)) {
            $user->forceFill(['login_otp_code' => null, 'login_otp_expires_at' => now()->addMinutes((int) config('auth.login_otp_expires_minutes', 10))])->save();
            return response()->json(['message' => 'Admin atau akun tanpa OTP dapat langsung mengganti password.', 'otp_required' => false]);
        }

        $authController->sendLoginOtp($user, $request);
        return response()->json(['message' => 'Kode OTP untuk ganti password sudah dikirim ke email akun.', 'otp_required' => true]);
    }

    public function updatePassword(Request $request): JsonResponse
    {
        $user = $request->user();
        $rules = [
            'current_password' => ['required', 'string'],
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised()],
        ];
        if ($user->role !== 'admin' && ($user->two_factor_enabled ?? true)) {
            $rules['otp'] = ['required', 'digits:6'];
        }
        $validated = $request->validate($rules);

        if (! Hash::check($validated['current_password'], $user->password)) {
            throw ValidationException::withMessages(['current_password' => ['Password lama tidak sesuai.']]);
        }

        if (isset($rules['otp'])) {
            if (! $user->login_otp_code || ! $user->login_otp_expires_at || now()->gt($user->login_otp_expires_at)) {
                throw ValidationException::withMessages(['otp' => ['Kode OTP sudah kedaluwarsa. Silakan kirim ulang kode.']]);
            }
            if (! Hash::check($validated['otp'], $user->login_otp_code)) {
                $user->increment('login_otp_attempts');
                throw ValidationException::withMessages(['otp' => ['Kode OTP tidak sesuai.']]);
            }
        }

        $user->forceFill([
            'password' => Hash::make($validated['password']),
            'login_otp_code' => null,
            'login_otp_expires_at' => null,
            'login_otp_attempts' => 0,
        ])->save();

        return response()->json(['message' => 'Password berhasil diubah.']);
    }

    public function pacList(): JsonResponse
    {
        $pacs = Anggota::selectRaw('pac, COUNT(*) as total_anggota')
            ->whereNotNull('pac')
            ->where('pac', '!=', '')
            ->groupBy('pac')
            ->orderBy('pac')
            ->get()
            ->map(function ($row) {
                return [
                    'pac' => $row->pac,
                    'total_anggota' => (int) $row->total_anggota,
                    'total_kegiatan' => Kegiatan::whereHas('pendaftarans.anggota', fn ($q) => $q->where('pac', $row->pac))->distinct()->count('id_kegiatan'),
                ];
            });

        return response()->json(['data' => $pacs]);
    }

    public function pacShow(string $pac): JsonResponse
    {
        $pac = urldecode($pac);
        $anggota = Anggota::with('user')->where('pac', $pac)->orderBy('nama_lengkap')->get();
        $kegiatans = Kegiatan::withCount(['pendaftarans' => fn ($q) => $q->whereHas('anggota', fn ($sub) => $sub->where('pac', $pac))])
            ->whereHas('pendaftarans.anggota', fn ($q) => $q->where('pac', $pac))
            ->orderByDesc('tanggal')
            ->limit(20)
            ->get();

        $pendaftaranPac = Pendaftaran::whereHas('anggota', fn ($q) => $q->where('pac', $pac));
        $pendaftaranIds = (clone $pendaftaranPac)->pluck('id_daftar');

        return response()->json([
            'data' => [
                'pac' => $pac,
                'total_anggota' => $anggota->count(),
                'total_kegiatan' => $kegiatans->count(),
                'total_hadir' => Absensi::whereIn('id_daftar', $pendaftaranIds)->where('hadir', true)->count(),
                'total_tidak_hadir' => Absensi::whereIn('id_daftar', $pendaftaranIds)->where('hadir', false)->count(),
                'anggota' => $anggota->map(fn (Anggota $a) => $this->anggotaPayload($a)),
                'kegiatan' => $kegiatans->map(fn (Kegiatan $k) => $this->kegiatanPayload($k)),
            ],
        ]);
    }

    public function galeri(Request $request): JsonResponse
    {
        if ($request->boolean('grouped') && ! $request->filled('id_kegiatan')) {
            $folders = Kegiatan::query()
                ->whereHas('galeris')
                ->withCount('galeris')
                ->with(['galeris' => fn ($q) => $q->orderByDesc('is_unggulan')->orderByDesc('tgl_upload')->limit(1), 'kategori'])
                ->orderByDesc('tanggal')
                ->paginate((int) $request->input('per_page', 12));

            return response()->json([
                'data' => collect($folders->items())->map(fn (Kegiatan $kegiatan) => $this->galeriFolderPayload($kegiatan)),
                'meta' => $this->paginationMeta($folders),
            ]);
        }

        $items = Galeri::with('kegiatan')
            ->when($request->filled('id_kegiatan'), fn ($q) => $q->where('id_kegiatan', $request->integer('id_kegiatan')))
            ->orderByDesc('is_unggulan')
            ->orderByDesc('tgl_upload')
            ->paginate((int) $request->input('per_page', 12));

        return response()->json([
            'data' => collect($items->items())->map(fn (Galeri $g) => $this->galeriPayload($g)),
            'meta' => $this->paginationMeta($items),
        ]);
    }


    public function adminKegiatan(Request $request): JsonResponse
    {
        abort_unless($request->user()?->role === 'admin', 403);
        $items = Kegiatan::with(['kategori', 'pamflet'])
            ->when($request->search, fn($q,$search) => $q->where(fn($sub) => $sub->where('judul','like',"%{$search}%")->orWhere('lokasi','like',"%{$search}%")))
            ->orderByDesc('tanggal')
            ->get()
            ->map(fn(Kegiatan $k) => $this->kegiatanPayload($k));
        return response()->json(['data' => $items]);
    }

    public function adminStoreKegiatan(Request $request): JsonResponse
    {
        abort_unless($request->user()?->role === 'admin', 403);
        $data = $request->validate([
            'judul' => ['required','string','max:150'],
            'deskripsi' => ['nullable','string'],
            'tanggal' => ['required','date'],
            'waktu' => ['nullable','date_format:H:i'],
            'lokasi' => ['required','string','max:150'],
            'kuota' => ['nullable','integer','min:0'],
            'status' => ['nullable','in:aktif,tutup,selesai,batal'],
            'id_kategori' => ['nullable','integer'],
        ]);
        $data['status'] = $data['status'] ?? 'aktif';
        $item = Kegiatan::create($data);
        return response()->json(['message'=>'Kegiatan berhasil ditambahkan','data'=>$this->kegiatanPayload($item->load(['kategori','pamflet']))],201);
    }

    public function adminUpdateKegiatan(Request $request, int $id): JsonResponse
    {
        abort_unless($request->user()?->role === 'admin', 403);
        $item = Kegiatan::findOrFail($id);
        $data = $request->validate([
            'judul' => ['required','string','max:150'],
            'deskripsi' => ['nullable','string'],
            'tanggal' => ['required','date'],
            'waktu' => ['nullable','date_format:H:i'],
            'lokasi' => ['required','string','max:150'],
            'kuota' => ['nullable','integer','min:0'],
            'status' => ['nullable','in:aktif,tutup,selesai,batal'],
            'id_kategori' => ['nullable','integer'],
        ]);
        $item->update($data);
        return response()->json(['message'=>'Kegiatan berhasil diperbarui','data'=>$this->kegiatanPayload($item->refresh()->load(['kategori','pamflet']))]);
    }

    public function adminDeleteKegiatan(Request $request, int $id): JsonResponse
    {
        abort_unless($request->user()?->role === 'admin', 403);
        Kegiatan::findOrFail($id)->delete();
        return response()->json(['message'=>'Kegiatan berhasil dihapus']);
    }

    public function adminGaleri(Request $request): JsonResponse
    {
        abort_unless($request->user()?->role === 'admin', 403);
        $items = Galeri::with('kegiatan')->orderByDesc('tgl_upload')->get()->map(fn(Galeri $g) => $this->galeriPayload($g));
        return response()->json(['data'=>$items]);
    }

    public function adminStoreGaleri(Request $request): JsonResponse
    {
        abort_unless($request->user()?->role === 'admin', 403);
        $data = $request->validate([
            'id_kegiatan' => ['required','integer'],
            'judul_foto' => ['required','string','max:150'],
            'deskripsi' => ['nullable','string'],
            'jenis_media' => ['nullable','in:foto,video'],
            'path_file' => ['required','string'],
        ]);
        $data['tgl_upload'] = now();
        $data['is_unggulan'] = $request->boolean('is_unggulan');
        $item = Galeri::create($data);
        return response()->json(['message'=>'Dokumentasi berhasil ditambahkan','data'=>$this->galeriPayload($item->load('kegiatan'))],201);
    }

    public function adminDeleteGaleri(Request $request, int $id): JsonResponse
    {
        abort_unless($request->user()?->role === 'admin', 403);
        Galeri::findOrFail($id)->delete();
        return response()->json(['message'=>'Dokumentasi berhasil dihapus']);
    }

    public function inventory(Request $request, InventoryService $inventory): JsonResponse
    {
        return response()->json(['data' => $inventory->checkAvailability($request->string('keyword')->toString() ?: null)]);
    }

    public function laporanRingkasan(): JsonResponse
    {
        $totalHadir = Absensi::where('hadir', true)->count();
        $totalTidakHadir = Absensi::where('hadir', false)->count();

        return response()->json([
            'data' => [
                'total_anggota' => Anggota::count(),
                'total_kegiatan' => Kegiatan::count(),
                'total_pendaftar' => Pendaftaran::count(),
                'total_hadir' => $totalHadir,
                'total_tidak_hadir' => $totalTidakHadir,
                'anggota_by_pac' => Anggota::selectRaw('pac, COUNT(*) as total')->whereNotNull('pac')->groupBy('pac')->orderBy('pac')->get(),
                'kegiatan_by_status' => Kegiatan::selectRaw('status, COUNT(*) as total')->groupBy('status')->get(),
                'export_urls' => [
                    'anggota_pdf' => url('/admin/laporan/anggota/export/pdf'),
                    'kegiatan_pdf' => url('/admin/laporan/kegiatan/export/pdf'),
                    'absensi_pdf' => url('/admin/laporan/absensi/export/pdf'),
                ],
            ],
        ]);
    }

    private function userPayload(User $user): array
    {
        $anggota = $user->anggota;
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
            'account_status' => $user->account_status ?? 'aktif',
            'two_factor_enabled' => (bool) ($user->two_factor_enabled ?? true),
            'anggota' => $anggota ? $this->anggotaPayload($anggota) : null,
        ];
    }

    private function anggotaPayload(Anggota $anggota): array
    {
        return [
            'id_anggota' => $anggota->id_anggota,
            'id_user' => $anggota->id_user,
            'nomor_anggota' => $anggota->nomor_anggota,
            'nama_lengkap' => $anggota->nama_lengkap,
            'tempat_lahir' => $anggota->tempat_lahir,
            'tgl_lahir' => $this->formatDate($anggota->tgl_lahir),
            'alamat' => $anggota->alamat,
            'kontak' => $anggota->kontak,
            'pac' => $anggota->pac,
            'email' => $anggota->user->email ?? null,
            'foto_profil' => $anggota->foto_profil,
            'foto_profil_url' => $anggota->foto_profil ? asset('storage/'.$anggota->foto_profil) : asset('images/logo-sibo.png'),
        ];
    }

    private function kegiatanPayload(Kegiatan $kegiatan, bool $detail = false): array
    {
        $pamfletPath = $kegiatan->pamflet?->path_file;
        $pamfletUrl = $this->publicStorageUrl($pamfletPath);

        $payload = [
            'id_kegiatan' => $kegiatan->id_kegiatan,
            'id' => $kegiatan->id_kegiatan,
            'judul' => $kegiatan->judul,
            'nama_kegiatan' => $kegiatan->judul,
            'deskripsi' => $kegiatan->deskripsi,
            'tanggal' => $this->formatDate($kegiatan->tanggal),
            'waktu' => $kegiatan->waktu ? $kegiatan->waktu->format('H:i') : null,
            'lokasi' => $kegiatan->lokasi,
            'kuota' => $kegiatan->kuota,
            'status' => $kegiatan->status,
            'kategori' => $kegiatan->kategori?->nama,
            'kategori_nama' => $kegiatan->kategori?->nama,
            'id_kategori' => $kegiatan->id_kategori,
            'jumlah_peserta' => $kegiatan->pendaftarans()->where('status', 'disetujui')->count(),
            'bisa_daftar' => (bool) $kegiatan->bisaDaftar,
            'pamflet_path' => $pamfletPath,
            'pamflet_url' => $pamfletUrl,
            'image_url' => $pamfletUrl,
            'gambar' => $pamfletUrl,
            'thumbnail' => $pamfletUrl,
        ];
        if ($detail) {
            $payload['total_hadir'] = $kegiatan->pendaftarans->filter(fn ($p) => $p->absensi && $p->absensi->hadir)->count();
            $payload['total_tidak_hadir'] = $kegiatan->pendaftarans->filter(fn ($p) => $p->absensi && ! $p->absensi->hadir)->count();
        }
        return $payload;
    }

    private function pendaftaranPayload(Pendaftaran $pendaftaran): array
    {
        return [
            'id_daftar' => $pendaftaran->id_daftar,
            'id_kegiatan' => $pendaftaran->id_kegiatan,
            'id_anggota' => $pendaftaran->id_anggota,
            'nama_peserta' => $pendaftaran->display_name,
            'kontak_peserta' => $pendaftaran->display_contact,
            'jenis_daftar' => $pendaftaran->jenis_daftar,
            'tgl_daftar' => $this->formatDateTime($pendaftaran->tgl_daftar),
            'status' => $pendaftaran->status,
            'keterangan' => $pendaftaran->keterangan,
            'kegiatan' => $pendaftaran->kegiatan ? $this->kegiatanPayload($pendaftaran->kegiatan) : null,
            'absensi' => $pendaftaran->absensi ? [
                'id_absensi' => $pendaftaran->absensi->id_absensi,
                'hadir' => (bool) $pendaftaran->absensi->hadir,
                'waktu_hadir' => $pendaftaran->absensi->waktu_hadir,
                'keterangan' => $pendaftaran->absensi->keterangan,
            ] : null,
            'certificate' => $pendaftaran->certificate ? $this->certificatePayload($pendaftaran->certificate) : null,
        ];
    }

    private function certificatePayload(Certificate $certificate): array
    {
        return [
            'id' => $certificate->id,
            'id_pendaftaran' => $certificate->id_pendaftaran,
            'certificate_number' => $certificate->certificate_number,
            'file_path' => $certificate->file_path,
            'download_url' => url('/api/v1/mobile/sertifikat/'.$certificate->id.'/download'),
            'kegiatan' => $certificate->pendaftaran?->kegiatan?->judul,
            'created_at' => $this->formatDateTime($certificate->created_at),
        ];
    }

    private function galeriFolderPayload(Kegiatan $kegiatan): array
    {
        $cover = $kegiatan->galeris->first();
        $coverUrl = $cover ? $this->publicStorageUrl($cover->path_file) : null;

        return [
            'type' => 'folder',
            'id' => $kegiatan->id_kegiatan,
            'id_kegiatan' => $kegiatan->id_kegiatan,
            'judul' => $kegiatan->judul,
            'nama_kegiatan' => $kegiatan->judul,
            'tanggal' => $this->formatDate($kegiatan->tanggal),
            'lokasi' => $kegiatan->lokasi,
            'kategori' => $kegiatan->kategori?->nama,
            'total_media' => (int) ($kegiatan->galeris_count ?? 0),
            'cover_url' => $coverUrl,
            'image_url' => $coverUrl,
            'thumbnail' => $coverUrl,
            'jenis_media_cover' => $cover?->jenis_media ?? 'foto',
        ];
    }

    private function galeriPayload(Galeri $galeri): array
    {
        $fileUrl = $this->publicStorageUrl($galeri->path_file);
        $jenisMedia = $galeri->jenis_media ?: (Str::startsWith((string) $galeri->mime_type, 'video/') ? 'video' : 'foto');

        return [
            'type' => 'media',
            'id_foto' => $galeri->id_foto,
            'id' => $galeri->id_foto,
            'id_kegiatan' => $galeri->id_kegiatan,
            'judul_foto' => $galeri->judul_foto,
            'judul' => $galeri->judul_foto,
            'deskripsi' => $galeri->deskripsi,
            'path_file' => $galeri->path_file,
            'jenis_media' => $jenisMedia,
            'media_type' => $jenisMedia,
            'mime_type' => $galeri->mime_type,
            'ukuran_file' => $galeri->ukuran_file,
            'file_url' => $fileUrl,
            'media_url' => $fileUrl,
            'video_url' => $jenisMedia === 'video' ? $fileUrl : null,
            'image_url' => $fileUrl,
            'gambar' => $fileUrl,
            'thumbnail' => $fileUrl,
            'tgl_upload' => $galeri->tgl_upload,
            'is_unggulan' => (bool) $galeri->is_unggulan,
            'kegiatan' => $galeri->kegiatan?->judul,
        ];
    }


    private function publicStorageUrl(?string $path): ?string
    {
        if (! $path) {
            return null;
        }

        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        $path = Str::of($path)->replace('\\', '/')->ltrim('/')->toString();
        if (Str::startsWith($path, 'public/')) {
            $path = Str::after($path, 'public/');
        }

        // Menggunakan root dari request aktif agar URL gambar mengikuti host yang dipakai mobile
        // misalnya http://10.0.2.2:8000, bukan APP_URL localhost.
        return request()->getSchemeAndHttpHost().'/storage/'.$path;
    }

    private function paginationMeta($paginator): array
    {
        return [
            'current_page' => $paginator->currentPage(),
            'per_page' => $paginator->perPage(),
            'total' => $paginator->total(),
            'last_page' => $paginator->lastPage(),
        ];
    }

    private function formatDate($value): ?string
    {
        if (! $value) {
            return null;
        }
        return $value instanceof \Carbon\CarbonInterface ? $value->format('Y-m-d') : (string) $value;
    }

    private function formatDateTime($value): ?string
    {
        if (! $value) {
            return null;
        }
        return $value instanceof \Carbon\CarbonInterface ? $value->format('Y-m-d H:i:s') : (string) $value;
    }

    private function normalisasiNama(?string $nama): string
    {
        return Str::of((string) $nama)->lower()->squish()->toString();
    }

    private function normalisasiKontak(?string $kontak): string
    {
        return preg_replace('/\D+/', '', (string) $kontak) ?: '';
    }
}
