<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AnggotaApiController extends Controller
{
    /**
     * Daftar PAC default (sama dengan yang ada di sistem)
     */
    const PAC_LIST = [
        'BADAS', 'PARE', 'KANDANGAN', 'PURWOASRI', 'PAPAR', 'KUNJANG', 'PLEMAHAN', 'GAMPENGREJO',
        'NGASEM', 'GURAH', 'PAGU', 'PLOSOKLATEN', 'WATES', 'KANDAT', 'KRAS', 'RINGINREJO',
        'NGADILUWIH', 'SEMEN', 'MOJO', 'BANYAKAN', 'GROGOL', 'TAROKAN', 'KAYENKIDUL', 'NGANCAR',
        'PUNCU', 'KEPUNG'
    ];

    /**
     * GET /api/anggota
     * Menampilkan daftar anggota dengan filter (search & pac)
     */
    public function index(Request $request): JsonResponse
    {
        $search = $request->input('search', '');
        $pac = $request->input('pac', '');

        $data = Anggota::query()
            ->with('user')
            ->when($search, function ($query, $search) {
                return $query->where('nama_lengkap', 'like', '%' . $search . '%')
                             ->orWhere('nomor_anggota', 'like', '%' . $search . '%');
            })
            ->when($pac, function ($query, $pac) {
                return $query->where('pac', $pac);
            })
            ->orderBy('id_anggota', 'desc')
            ->get();

        foreach ($data as $d) {
            $d->url = $d->foto_profil
                ? asset('storage/' . $d->foto_profil)
                : asset('images/logo-sibo.png');
            $d->email = $d->user->email ?? '-';
        }

        return response()->json($data);
    }

    /**
     * GET /api/anggota/show-data?nama=...
     * Filter berdasarkan nama_lengkap (khusus untuk tampilan tertentu)
     */
    public function showData(Request $request): JsonResponse
    {
        $nama = $request->input('nama', '');

        $data = Anggota::with('user')
            ->where('nama_lengkap', 'like', "%$nama%")
            ->orderBy('nama_lengkap', 'asc')
            ->get(['nomor_anggota', 'nama_lengkap', 'kontak', 'pac', 'tempat_lahir', 'tgl_lahir', 'alamat', 'foto_profil']);

        foreach ($data as $d) {
            $d->url = $d->foto_profil
                ? asset('storage/' . $d->foto_profil)
                : asset('images/logo-sibo.png');
            $d->email = $d->user->email ?? '-';
        }

        return response()->json($data);
    }

    /**
     * GET /api/anggota/show-detail/{nomorAnggota}
     * Detail satu anggota berdasarkan nomor_anggota
     */
    public function showDetail($nomorAnggota): JsonResponse
    {
        $data = Anggota::with('user')
            ->where('nomor_anggota', $nomorAnggota)
            ->first(['nomor_anggota', 'nama_lengkap', 'kontak', 'pac', 'tempat_lahir', 'tgl_lahir', 'alamat', 'foto_profil']);

        if (!$data) {
            return response()->json(['message' => 'Anggota tidak ditemukan'], 404);
        }

        $data->url = $data->foto_profil
            ? asset('storage/' . $data->foto_profil)
            : asset('images/logo-sibo.png');
        $data->email = $data->user->email ?? '-';

        return response()->json($data);
    }

    /**
     * GET /api/anggota/stats
     * Statistik jumlah anggota, kegiatan, dan PAC
     */
    public function stats(): JsonResponse
    {
        return response()->json([
            'total_anggota' => Anggota::count(),
            'total_kegiatan' => DB::table('kegiatans')->count(),
            'total_pac' => Anggota::select('pac')->distinct()->whereNotNull('pac')->count()
        ]);
    }

    /**
     * GET /api/anggota/pac-list
     * Daftar PAC (gabungan dari konstanta + yang sudah ada di database)
     */
    public function pacList(): JsonResponse
    {
        $existingPacs = Anggota::select('pac')->distinct()->whereNotNull('pac')->pluck('pac')->toArray();
        $combined = array_unique(array_merge($existingPacs, self::PAC_LIST));
        sort($combined);

        $res = [];
        foreach ($combined as $p) {
            $res[] = ['pac' => $p];
        }

        return response()->json($res);
    }

    /**
     * POST /api/anggota/crud
     * Mode: insert, update, delete
     * Handle create/update/delete anggota dengan upload foto base64
     */
    public function crud(Request $request): JsonResponse
    {
        $mode = $request->input('mode');
        $id_anggota = $request->input('id_anggota');

        try {
            if ($mode === 'insert' || $mode === 'update') {
                $fotoName = null;
                $imageSaved = false;

                // Proses upload foto jika ada (base64 dari Android)
                if ($request->filled('image')) {
                    $base64Image = $request->input('image');
                    // Hapus prefix data:image jika ada
                    if (strpos($base64Image, ';base64,') !== false) {
                        $base64Image = substr($base64Image, strpos($base64Image, ';base64,') + 8);
                    }

                    $image = base64_decode($base64Image);
                    if ($image === false) {
                        return response()->json(['kode' => '111', 'message' => 'Data gambar tidak valid']);
                    }

                    $filenameOnly = 'AGT_' . time() . '_' . uniqid() . '.jpg';
                    $fotoName = 'foto_profil/' . $filenameOnly;
                    $filePath = storage_path('app/public/' . $fotoName);

                    $directory = dirname($filePath);
                    if (!file_exists($directory)) {
                        mkdir($directory, 0755, true);
                    }

                    if (file_put_contents($filePath, $image) === false) {
                        return response()->json(['kode' => '111', 'message' => 'Gagal menyimpan gambar']);
                    }

                    chmod($filePath, 0644);
                    $imageSaved = true;
                    Log::info('Image saved: ' . $fotoName);
                }

                // Data yang akan disimpan ke tabel anggotas
                $dataAnggota = [
                    'nama_lengkap' => $request->input('nama_lengkap'),
                    'kontak'       => $request->input('kontak'),
                    'pac'          => $request->input('pac'),
                    'tempat_lahir' => $request->input('tempat_lahir'),
                    'tgl_lahir'    => $request->input('tgl_lahir'),
                    'alamat'       => $request->input('alamat'),
                ];

                if ($imageSaved) {
                    $dataAnggota['foto_profil'] = $fotoName;
                }

                if ($mode === 'insert') {
                    // Validasi email unik
                    if (User::where('email', $request->input('email'))->exists()) {
                        return response()->json(['kode' => '111', 'message' => 'Email sudah digunakan']);
                    }

                    // Buat user
                    $user = User::create([
                        'name'     => $request->input('nama_lengkap'),
                        'email'    => $request->input('email'),
                        'password' => Hash::make($request->input('password', 'password123')),
                        'role'     => 'anggota'
                    ]);

                    // Generate nomor_anggota otomatis (diisi setelah insert)
                    $nextId = (Anggota::max('id_anggota') ?? 0) + 1;
                    $dataAnggota['nomor_anggota'] = str_pad($nextId, 5, '0', STR_PAD_LEFT);
                    $dataAnggota['id_user'] = $user->id;

                    Anggota::create($dataAnggota);
                    Log::info('New anggota created: ' . $dataAnggota['nama_lengkap']);
                } else { // update
                    $existingAnggota = Anggota::find($id_anggota);
                    if (!$existingAnggota) {
                        return response()->json(['kode' => '111', 'message' => 'Anggota tidak ditemukan']);
                    }

                    // Hapus foto lama jika diganti
                    if ($imageSaved && $existingAnggota->foto_profil) {
                        $oldPath = storage_path('app/public/' . $existingAnggota->foto_profil);
                        if (file_exists($oldPath)) {
                            unlink($oldPath);
                        }
                    }

                    Anggota::where('id_anggota', $id_anggota)->update($dataAnggota);

                    // Update nama user jika perlu
                    if ($existingAnggota->id_user) {
                        User::where('id', $existingAnggota->id_user)->update([
                            'name' => $request->input('nama_lengkap')
                        ]);
                    }
                    Log::info('Anggota updated: ' . $id_anggota);
                }
            } elseif ($mode === 'delete') {
                $anggota = Anggota::find($id_anggota);
                if ($anggota) {
                    // Hapus foto profil
                    if ($anggota->foto_profil) {
                        $imagePath = storage_path('app/public/' . $anggota->foto_profil);
                        if (file_exists($imagePath)) {
                            unlink($imagePath);
                        }
                    }
                    // Hapus user terkait
                    if ($anggota->id_user) {
                        User::where('id', $anggota->id_user)->delete();
                    }
                    $anggota->delete();
                    Log::info('Anggota deleted: ' . $id_anggota);
                }
            } else {
                return response()->json(['kode' => '111', 'message' => 'Mode tidak dikenal']);
            }

            return response()->json(['kode' => '000', 'message' => 'Operasi berhasil']);
        } catch (\Exception $e) {
            Log::error('CRUD Error: ' . $e->getMessage());
            return response()->json(['kode' => '111', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}