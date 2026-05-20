<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class KegiatanApiController extends Controller
{
    public function indexPublik(Request $request): JsonResponse
    {
        $kategoriId = $request->integer('kategori_id');
        $search = $request->string('search')->toString();

        $query = Kegiatan::query()
            ->with(['kategori', 'pamflet'])
            ->where('status', 'aktif')
            ->orderBy('tanggal', 'desc');

        if ($kategoriId) {
            $query->where('id_kategori', $kategoriId);
        }

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('lokasi', 'like', "%{$search}%");
            });
        }

        $kegiatans = $query->paginate(10);

        return response()->json([
            'data' => $kegiatans->items(),
            'meta' => [
                'current_page' => $kegiatans->currentPage(),
                'per_page' => $kegiatans->perPage(),
                'total' => $kegiatans->total(),
            ],
        ]);
    }

    public function showPublik(int $id): JsonResponse
    {
        $kegiatan = Kegiatan::with(['kategori', 'creator', 'pamflet', 'galeris'])
            ->findOrFail($id);

        return response()->json([
            'data' => $kegiatan,
        ]);
    }
}
