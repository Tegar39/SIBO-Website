<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class InventoryService
{
    public function isConfigured(): bool
    {
        return filled(config('services.inventory.base_url'));
    }

    public function summary(): array
    {
        if (! $this->isConfigured()) {
            return [
                'configured' => false,
                'items' => [],
                'message' => 'INVENTORY_API_URL belum diatur di file .env.',
            ];
        }

        try {
            $response = $this->client()->get('/api/items');

            if (! $response->successful()) {
                return [
                    'configured' => true,
                    'items' => [],
                    'message' => 'Gagal mengambil data inventaris. Status: ' . $response->status(),
                ];
            }

            $payload = $response->json();
            $items = $payload['data'] ?? $payload['items'] ?? $payload ?? [];

            return [
                'configured' => true,
                'items' => is_array($items) ? collect($items)->take(50)->values()->all() : [],
                'message' => 'Data inventaris berhasil diambil dari sistem eksternal.',
            ];
        } catch (\Throwable $e) {
            Log::warning('Inventory external API error', ['message' => $e->getMessage()]);

            return [
                'configured' => true,
                'items' => [],
                'message' => 'Koneksi ke sistem inventaris eksternal gagal: ' . $e->getMessage(),
            ];
        }
    }

    public function checkAvailability(?string $keyword = null): array
    {
        $summary = $this->summary();

        if (! $keyword || empty($summary['items'])) {
            return $summary;
        }

        $summary['items'] = collect($summary['items'])->filter(function ($item) use ($keyword) {
            $text = strtolower(json_encode($item));
            return str_contains($text, strtolower($keyword));
        })->values()->all();

        return $summary;
    }

    private function client()
    {
        $client = Http::timeout((int) config('services.inventory.timeout', 10))
            ->acceptJson();

        if (filled(config('services.inventory.token'))) {
            $client = $client->withToken(config('services.inventory.token'));
        }

        return $client->baseUrl(rtrim(config('services.inventory.base_url'), '/'));
    }
}
