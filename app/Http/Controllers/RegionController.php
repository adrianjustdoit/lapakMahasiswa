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
            $response = Http::get("{$this->baseUrl}/provinces.json");
            return $response->json();
        });

        return response()->json($data);
    }

    /**
     * Get regencies by province code
     */
    public function regencies($provinceCode)
    {
        $data = Cache::remember("regencies_{$provinceCode}", 86400, function () use ($provinceCode) {
            $response = Http::get("{$this->baseUrl}/regencies/{$provinceCode}.json");
            return $response->json();
        });

        return response()->json($data);
    }

    /**
     * Get districts by regency code
     */
    public function districts($regencyCode)
    {
        $data = Cache::remember("districts_{$regencyCode}", 86400, function () use ($regencyCode) {
            $response = Http::get("{$this->baseUrl}/districts/{$regencyCode}.json");
            return $response->json();
        });

        return response()->json($data);
    }

    /**
     * Get villages by district code
     */
    public function villages($districtCode)
    {
        $data = Cache::remember("villages_{$districtCode}", 86400, function () use ($districtCode) {
            $response = Http::get("{$this->baseUrl}/villages/{$districtCode}.json");
            return $response->json();
        });

        return response()->json($data);
    }
}
