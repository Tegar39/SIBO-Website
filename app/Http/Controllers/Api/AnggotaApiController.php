<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\User;
<<<<<<< HEAD
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AnggotaApiController extends Controller
{
    // Daftar PAC yang valid (sama dengan di AnggotaController)
    const PAC_LIST = [
        'BADAS', 'PARE', 'KANDANGAN', 'PURWOASRI', 'PAPAR', 'KUNJANG', 'PLEMAHAN', 'GAMPENGREJO',
        'NGASEM', 'GURAH', 'PAGU', 'PLOSOKLATEN', 'WATES', 'KANDAT', 'KRAS', 'RINGINREJO',
        'NGADILUWIH', 'SEMEN', 'MOJO', 'BANYAKAN', 'GROGOL', 'TAROKAN', 'KAYENKIDUL', 'NGANCAR',
        'PUNCU', 'KEPUNG'
    ];

    private $serverIp = "10.245.131.72"; // Ganti dengan IP server Laravel Anda

    /**
     * Get list of PAC for spinner
     */
    public function getPacList()
    {
        $pacList = [];
        foreach (self::PAC_LIST as $pac) {
            $pacList[] = ['pac' => $pac];
        }
        return response()->json($pacList);
    }

    /**
     * Show data anggota with filter by nama
     */
    public function showData(Request $request)
    {
        $nama = $request->input('nama', '');

        $data = DB::table('anggotas')
            ->leftJoin('users', 'anggotas.id_user', '=', 'users.id')
            ->select(
                'anggotas.nomor_anggota',
                'anggotas.nama_lengkap',
                'anggotas.kontak',
                'anggotas.pac',
                'anggotas.tempat_lahir',
                'anggotas.tgl_lahir',
                'anggotas.alamat',
                'users.email',
                DB::raw("CONCAT('http://{$this->serverIp}:8000/storage/', anggotas.foto_profil) as url")
            )
            ->where('anggotas.nama_lengkap', 'like', "%$nama%")
            ->orderBy('anggotas.nama_lengkap', 'asc')
            ->get();

        return response()->json($data);
    }

    /**
     * Show single anggota detail by nomor_anggota
     */
    public function showDetail($nomorAnggota)
    {
        $data = DB::table('anggotas')
            ->leftJoin('users', 'anggotas.id_user', '=', 'users.id')
            ->select(
                'anggotas.nomor_anggota',
                'anggotas.nama_lengkap',
                'anggotas.kontak',
                'anggotas.pac',
                'anggotas.tempat_lahir',
                'anggotas.tgl_lahir',
                'anggotas.alamat',
                'users.email',
                DB::raw("CONCAT('http://{$this->serverIp}:8000/storage/', anggotas.foto_profil) as url")
            )
            ->where('anggotas.nomor_anggota', $nomorAnggota)
            ->first();

        if (!$data) {
            return response()->json(['message' => 'Anggota tidak ditemukan'], 404);
        }

        return response()->json($data);
    }

    /**
     * CRUD operations (Insert, Update, Delete)
     */
    public function queryCrud(Request $request)
    {
        $mode = $request->mode;

        try {
            if ($mode == "insert") {
                // Validasi input
                if (!$request->nomor_anggota || !$request->nama_lengkap) {
                    return response()->json(['kode' => '111', 'message' => 'Nomor anggota dan nama lengkap wajib diisi']);
                }

                // Cek apakah nomor anggota sudah ada
                $existing = Anggota::where('nomor_anggota', $request->nomor_anggota)->first();
                if ($existing) {
                    return response()->json(['kode' => '111', 'message' => 'Nomor anggota sudah terdaftar']);
                }

                $namaFile = $request->file ?: null;

                // Buat user terlebih dahulu
                $user = User::create([
                    'name' => $request->nama_lengkap,
                    'email' => $request->email ?? $request->nomor_anggota . '@sibo.com',
                    'password' => Hash::make('password123'),
                    'role' => 'anggota',
                ]);

                // Insert ke tabel anggotas
                DB::table('anggotas')->insert([
                    'id_user' => $user->id,
                    'nomor_anggota' => $request->nomor_anggota,
                    'nama_lengkap' => $request->nama_lengkap,
                    'tempat_lahir' => $request->tempat_lahir ?? null,
                    'tgl_lahir' => $request->tgl_lahir ?? null,
                    'alamat' => $request->alamat ?? null,
                    'kontak' => $request->kontak ?? '',
                    'pac' => $request->pac ?? null,
                    'foto_profil' => $namaFile,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                // Upload file gambar jika ada
                if ($request->image != "" && $namaFile) {
                    $path = storage_path('app/public/foto_profil');
                    if (!file_exists($path)) {
                        mkdir($path, 0777, true);
                    }
                    file_put_contents(
                        storage_path('app/public/foto_profil/' . $namaFile),
                        base64_decode($request->image)
                    );
                }

                return response()->json(['kode' => '000', 'message' => 'Anggota berhasil ditambahkan']);
            } 
            elseif ($mode == "update") {
                // Validasi input
                if (!$request->nomor_anggota) {
                    return response()->json(['kode' => '111', 'message' => 'Nomor anggota wajib diisi']);
                }

                $dataUpdate = [
                    'nama_lengkap' => $request->nama_lengkap,
                    'tempat_lahir' => $request->tempat_lahir ?? null,
                    'tgl_lahir' => $request->tgl_lahir ?? null,
                    'alamat' => $request->alamat ?? null,
                    'kontak' => $request->kontak ?? '',
                    'pac' => $request->pac ?? null,
                    'updated_at' => now()
                ];

                // Update gambar jika ada
                if ($request->image != "") {
                    $namaFile = $request->file;
                    
                    // Hapus foto lama
                    $old = DB::table('anggotas')
                        ->where('nomor_anggota', $request->nomor_anggota)
                        ->first();
                    if ($old && $old->foto_profil) {
                        $oldPath = storage_path('app/public/foto_profil/' . $old->foto_profil);
                        if (file_exists($oldPath)) {
                            unlink($oldPath);
                        }
                    }

                    $dataUpdate['foto_profil'] = $namaFile;
                    
                    // Upload file gambar baru
                    file_put_contents(
                        storage_path('app/public/foto_profil/' . $namaFile),
                        base64_decode($request->image)
                    );
                }

                // Update data anggota
                DB::table('anggotas')
                    ->where('nomor_anggota', $request->nomor_anggota)
                    ->update($dataUpdate);

                // Update user name
                $anggota = Anggota::where('nomor_anggota', $request->nomor_anggota)->first();
                if ($anggota && $anggota->id_user) {
                    DB::table('users')
                        ->where('id', $anggota->id_user)
                        ->update(['name' => $request->nama_lengkap]);
                }

                return response()->json(['kode' => '000', 'message' => 'Anggota berhasil diupdate']);
            } 
            elseif ($mode == "delete") {
                if (!$request->nomor_anggota) {
                    return response()->json(['kode' => '111', 'message' => 'Nomor anggota wajib diisi']);
                }

                $anggota = DB::table('anggotas')
                    ->where('nomor_anggota', $request->nomor_anggota)
                    ->first();

                if ($anggota) {
                    // Hapus file foto
                    if ($anggota->foto_profil) {
                        $path = storage_path('app/public/foto_profil/' . $anggota->foto_profil);
                        if (file_exists($path)) {
                            unlink($path);
                        }
                    }

                    // Hapus user
                    if ($anggota->id_user) {
                        DB::table('users')->where('id', $anggota->id_user)->delete();
                    }

                    // Hapus anggota
                    DB::table('anggotas')
                        ->where('nomor_anggota', $request->nomor_anggota)
                        ->delete();
                }

                return response()->json(['kode' => '000', 'message' => 'Anggota berhasil dihapus']);
            }

            return response()->json(['kode' => '111', 'message' => 'Mode tidak dikenal']);
        } catch (\Exception $e) {
            return response()->json([
                'kode' => '111',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    

    }
    public function getStats(Request $request)
    {
        $totalAnggota = DB::table('anggotas')->count();
        $totalKegiatan = DB::table('kegiatans')->count();
        $totalPac = count(self::PAC_LIST);
        
        return response()->json([
            'total_anggota' => $totalAnggota,
            'total_kegiatan' => $totalKegiatan,
            'total_pac' => $totalPac
        ]);
    }
}
=======
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AnggotaApiController extends Controller
{
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
            if ($d->foto_profil) {
                $d->url = asset('storage/' . $d->foto_profil);
            } else {
                $d->url = asset('images/logo-sibo.png');
            }
            $d->email = $d->user->email ?? '-';
        }

        return response()->json($data);
    }



    public function stats(): JsonResponse
    {
        return response()->json([
            'total_anggota' => Anggota::count(),
            'total_kegiatan' => DB::table('kegiatans')->count(),
            'total_pac' => Anggota::select('pac')->distinct()->whereNotNull('pac')->count()
        ]);
    }

    public function pacList(): JsonResponse
    {
        $existingPacs = Anggota::select('pac as pac')->distinct()->whereNotNull('pac')->pluck('pac')->toArray();
        $defaults = ['BADAS', 'PARE', 'KANDANGAN', 'PURWOASRI', 'PAPAR', 'KUNJANG', 'PLEMAHAN', 'GAMPENGREJO',
        'NGASEM', 'GURAH', 'PAGU', 'PLOSOKLATEN', 'WATES', 'KANDAT', 'KRAS', 'RINGINREJO',
        'NGADILUWIH', 'SEMEN', 'MOJO', 'BANYAKAN', 'GROGOL', 'TAROKAN', 'KAYENKIDUL', 'NGANCAR',
        'PUNCU', 'KEPUNG'
        ];

        $combined = array_unique(array_merge($existingPacs, $defaults));
        sort($combined);

        $res = [];
        foreach($combined as $p) {
            $res[] = ['pac' => $p];
        }

        return response()->json($res);
    }

    public function crud(Request $request): JsonResponse
    {
        $mode = $request->input('mode');
        $id_anggota = $request->input('id_anggota');

        try {
            if ($mode === 'insert' || $mode === 'update') {
                $fotoName = $request->input('file');
                $imageSaved = false;

                // Handle base64 image upload dari Android
                if ($request->filled('image')) {
                    $base64Image = $request->input('image');
                    
                    // Remove data:image prefix jika ada
                    if (strpos($base64Image, ';base64,') !== false) {
                        $base64Image = substr($base64Image, strpos($base64Image, ';base64,') + 8);
                    }
                    
                    $image = base64_decode($base64Image);
                    
                    if ($image === false) {
                        \Log::error('Base64 decode failed');
                        return response()->json(['kode' => '111', 'message' => 'Invalid image data']);
                    }
                    
                    $filenameOnly = 'AGT_' . time() . '_' . uniqid() . '.jpg';
                    
                    $fotoName = 'foto_profil/' . $filenameOnly;
                    $filePath = storage_path('app/public/' . $fotoName);
                    
                   $directory = dirname($filePath);
                    if (!file_exists($directory)) {
                        mkdir($directory, 0755, true);
                    }
                    
                    $result = file_put_contents($filePath, $image);
                    
                    if ($result === false) {
                        \Log::error('Failed to save file: ' . $filePath);
                        return response()->json(['kode' => '111', 'message' => 'Failed to save image']);
                    }
                    
                    chmod($filePath, 0644);
                    
                    $imageSaved = true;
                    \Log::info('Image saved: ' . $fotoName);
                }

                $dataAnggota = [
                    'nama_lengkap' => $request->input('nama_lengkap'),
                    'kontak' => $request->input('kontak'),
                    'pac' => $request->input('pac'),
                    'tempat_lahir' => $request->input('tempat_lahir'),
                    'tgl_lahir' => $request->input('tgl_lahir'),
                    'alamat' => $request->input('alamat'),
                ];

                if ($imageSaved) {
                    $dataAnggota['foto_profil'] = $fotoName;
                }

                if ($mode === 'insert') {
                    if (User::where('email', $request->email)->exists()) {
                        return response()->json(['kode' => '111', 'message' => 'Email sudah digunakan']);
                    }

                    $user = User::create([
                        'name' => $request->input('nama_lengkap'),
                        'email' => $request->input('email'),
                        'password' => Hash::make($request->input('password')),
                        'role' => 'anggota'
                    ]);

                    $nextId = (Anggota::max('id_anggota') ?? 0) + 1;
                    $dataAnggota['nomor_anggota'] = str_pad($nextId, 5, '0', STR_PAD_LEFT);
                    $dataAnggota['id_user'] = $user->id;

                    Anggota::create($dataAnggota);
                    \Log::info('New anggota created: ' . $dataAnggota['nama_lengkap'] . ' | Foto: ' . ($fotoName ?? 'none'));
                    
                } else {
                    $existingAnggota = Anggota::find($id_anggota);
                    
                    if ($imageSaved && $existingAnggota && $existingAnggota->foto_profil) {
                        $oldPath = storage_path('app/public/' . $existingAnggota->foto_profil);
                        if (file_exists($oldPath)) {
                            unlink($oldPath);
                            \Log::info('Old image deleted: ' . $existingAnggota->foto_profil);
                        }
                    }
                    
                    Anggota::where('id_anggota', $id_anggota)->update($dataAnggota);
                    \Log::info('Anggota updated: ' . $dataAnggota['nama_lengkap'] . ' | Foto: ' . ($fotoName ?? 'none'));

                    if ($existingAnggota && $existingAnggota->id_user) {
                        User::where('id', $existingAnggota->id_user)->update([
                            'name' => $request->input('nama_lengkap'),
                        ]);
                    }
                }
                
            } elseif ($mode === 'delete') {
                $anggota = Anggota::find($id_anggota);
                if ($anggota) {
                    if ($anggota->foto_profil) {
                        $imagePath = storage_path('app/public/' . $anggota->foto_profil);
                        if (file_exists($imagePath)) {
                            unlink($imagePath);
                        }
                    }
                    if ($anggota->id_user) {
                        User::where('id', $anggota->id_user)->delete();
                    }
                    $anggota->delete();
                    \Log::info('Anggota deleted: ' . $id_anggota);
                }
            }

            return response()->json(['kode' => '000']);
        } catch (\Exception $e) {
            \Log::error('CRUD Error: ' . $e->getMessage());
            return response()->json(['kode' => '111', 'message' => $e->getMessage()]);
        }
    }
}
>>>>>>> a9a0fcbfa43e1f8baa8cad7886bc3bb0713fbfae
