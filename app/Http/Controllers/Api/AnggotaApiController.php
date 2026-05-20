<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\User;
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
