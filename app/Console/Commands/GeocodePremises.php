<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PublicationPremises;
use Illuminate\Support\Facades\Http;

class GeocodePremises extends Command
{
    protected $signature = 'premises:geocode';
    protected $description = 'Geocode all premises that do not yet have latitude/longitude';

    public function handle(): int
    {
        $premisesList = PublicationPremises::with('province')
            ->whereNull('latitude')
            ->orWhereNull('longitude')
            ->get();

        if ($premisesList->isEmpty()) {
            $this->info('All premises already have coordinates.');
            return Command::SUCCESS;
        }

        $this->info("Geocoding {$premisesList->count()} premises…");

        foreach ($premisesList as $premises) {

            // ---------------------------------------------------
            // Try 1: Full geocode (building name + location)
            // ---------------------------------------------------

            $queryFull = "{$premises->premises_name}, {$premises->location}, Papua New Guinea";

            $this->info("Searching precise: {$queryFull}");
            $result = $this->geocode($queryFull);

            if ($result) {
                $this->saveCoords($premises, $result, 'precise');
                continue;
            }

            // ---------------------------------------------------
            // Try 2: Basic location only
            // ---------------------------------------------------

            $queryBasic = "{$premises->location}, Papua New Guinea";

            $this->info("Searching approximate: {$queryBasic}");
            $result = $this->geocode($queryBasic);

            if ($result) {
                $this->saveCoords($premises, $result, 'approximate');
                continue;
            }

            // ---------------------------------------------------
            // Try 3: Province fallback
            // ---------------------------------------------------

            if ($premises->province && $premises->province->latitude) {

                $premises->latitude  = $premises->province->latitude;
                $premises->longitude = $premises->province->longitude;
                $premises->geocode_status = 'province_fallback';
                $premises->save();

                $this->warn("  -> Province fallback used for {$premises->premises_name}");
                continue;
            }

            // ---------------------------------------------------
            // Try 4: Could not geocode
            // ---------------------------------------------------

            $premises->geocode_status = 'unmatched';
            $premises->save();

            $this->error("  -> Could not geocode {$premises->premises_name}");
        }

        $this->info("Geocoding finished.");

        return Command::SUCCESS;
    }

    // -------------------------------------------------------
    // Helper method: perform geocoding request
    // -------------------------------------------------------
    private function geocode(string $query): ?array
    {
        try {
            $this->line("  -> HTTP request for: {$query}");

            $response = Http::withHeaders([
                    // Nominatim requires an identifiable User-Agent
                    'User-Agent' => 'OOC-CMIS/1.0 (support@ooc.gov.pg)',
                ])
                ->get('https://nominatim.openstreetmap.org/search', [
                    'q'      => $query,
                    'format' => 'json',
                    'limit'  => 1,
                ]);

            $this->line("  -> Status: " . $response->status());

            if (! $response->ok()) {
                $this->error("  -> HTTP error for query: {$query}");
                return null;
            }

            $data = $response->json();

            $this->line("  -> Raw result: " . json_encode($data));

            return !empty($data) ? $data[0] : null;

        } catch (\Throwable $e) {
            $this->error("  -> Exception for {$query}: " . $e->getMessage());
            return null;
        }
    }
    // -------------------------------------------------------
    // Helper method: save latitude/longitude
    // -------------------------------------------------------
    private function saveCoords($premises, $data, $status)
    {
        $premises->latitude = $data['lat'];
        $premises->longitude = $data['lon'];
        $premises->geocode_status = $status;
        $premises->save();

        $this->info("  -> Saved {$status} coords: lat={$data['lat']}, lon={$data['lon']}");

        // friendly delay (avoid API rate abuse)
        usleep(300000);
    }
}
