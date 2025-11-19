<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class GeocodeHelper
{
    public static function geocodePremises($premises)
    {
        $queryFull = "{$premises->premises_name}, {$premises->location}, Papua New Guinea";
        $queryBasic = "{$premises->location}, Papua New Guinea";

        $result = self::query($queryFull)
               ?? self::query($queryBasic);

        if ($result) {
            $premises->latitude  = $result['lat'];
            $premises->longitude = $result['lon'];
            $premises->geocode_status = 'auto';
            $premises->save();
            return;
        }

        // province fallback
        if ($premises->province && $premises->province->latitude) {
            $premises->latitude  = $premises->province->latitude;
            $premises->longitude = $premises->province->longitude;
            $premises->geocode_status = 'province_fallback';
            $premises->save();
            return;
        }

        $premises->geocode_status = 'unmatched';
        $premises->save();
    }

    private static function query($query)
    {
        $response = Http::withHeaders([
            'User-Agent' => 'OOC-CMIS/1.0 (support@ooc.gov.pg)',
        ])->get('https://nominatim.openstreetmap.org/search', [
            'q' => $query,
            'format' => 'json',
            'limit' => 1,
        ]);

        if (!$response->ok()) return null;

        $data = $response->json();

        return !empty($data) ? $data[0] : null;
    }
}
