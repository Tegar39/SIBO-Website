<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KegiatanApiController extends Controller
{
    public function indexPublik(Request $request): JsonResponse
    {
        $kategoriId = $request->integer('kategori_id');
        $search = $request->string('search')->toString();

        $query = Kegiatan::query()
            ->with(['kategori', 'pamflet'])
            ->whereIn('status', ['aktif', 'tutup', 'selesai'])
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
            'data' => collect($kegiatans->items())->map(fn (Kegiatan $kegiatan) => $this->payload($kegiatan)),
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
            'data' => $this->payload($kegiatan, true),
        ]);
    }

    private function payload(Kegiatan $kegiatan, bool $detail = false): array
    {
        $pamfletPath = $kegiatan->pamflet?->path_file;
        $pamfletUrl = $this->publicStorageUrl($pamfletPath);

        return [
            'id' => $kegiatan->id_kegiatan,
            'id_kegiatan' => $kegiatan->id_kegiatan,
            'judul' => $kegiatan->judul,
            'nama_kegiatan' => $kegiatan->judul,
            'deskripsi' => $kegiatan->deskripsi,
            'tanggal' => $kegiatan->tanggal,
            'waktu' => $kegiatan->waktu,
            'lokasi' => $kegiatan->lokasi,
            'kuota' => $kegiatan->kuota,
            'status' => $kegiatan->status,
            'kategori' => $kegiatan->kategori?->nama,
            'kategori_nama' => $kegiatan->kategori?->nama,
            'id_kategori' => $kegiatan->id_kategori,
            'pamflet_path' => $pamfletPath,
            'pamflet_url' => $pamfletUrl,
            'image_url' => $pamfletUrl,
            'gambar' => $pamfletUrl,
            'galeri' => $detail ? $kegiatan->galeris?->map(fn ($galeri) => [
                'id_foto' => $galeri->id_foto,
                'judul_foto' => $galeri->judul_foto,
                'deskripsi' => $galeri->deskripsi,
                'path_file' => $galeri->path_file,
                'file_url' => $this->publicStorageUrl($galeri->path_file),
                'image_url' => $this->publicStorageUrl($galeri->path_file),
            ]) : [],
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
        return request()->getSchemeAndHttpHost().'/storage/'.$path;
    }
}
