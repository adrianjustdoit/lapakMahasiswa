<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class RegionController extends Controller
{
    private $baseUrl = 'https://wilayah.id/api';

    /**
     * Get all provinces
     */
    public function provinces()
    {
        $data = Cache::remember('provinces', 86400, function () {
            return $this->fetchRegionData("{$this->baseUrl}/provinces.json");
        });

        return response()->json($data);
    }

    /**
     * Get regencies by province code
     */
    public function regencies($provinceCode)
    {
        $data = Cache::remember("regencies_{$provinceCode}", 86400, function () use ($provinceCode) {
            return $this->fetchRegionData("{$this->baseUrl}/regencies/{$provinceCode}.json");
        });

        return response()->json($data);
    }

    /**
     * Get districts by regency code
     */
    public function districts($regencyCode)
    {
        $data = Cache::remember("districts_{$regencyCode}", 86400, function () use ($regencyCode) {
            return $this->fetchRegionData("{$this->baseUrl}/districts/{$regencyCode}.json");
        });

        return response()->json($data);
    }

    /**
     * Get villages by district code
     */
    public function villages($districtCode)
    {
        $data = Cache::remember("villages_{$districtCode}", 86400, function () use ($districtCode) {
            return $this->fetchRegionData("{$this->baseUrl}/villages/{$districtCode}.json");
        });

        return response()->json($data);
    }

    private function fetchRegionData(string $url): array
    {
        try {
            $response = Http::timeout(8)->acceptJson()->get($url);

            if (!$response->successful()) {
                return ['data' => []];
            }

            return $response->json() ?? ['data' => []];
        } catch (\Throwable $e) {
            \Log::warning('Region API request failed: ' . $e->getMessage());

            return ['data' => []];
        }
    }
}
