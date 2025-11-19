<?php

namespace App\Livewire\System\Analytics\Dashboard;

use Livewire\Component;
use App\Models\Province;
use App\Models\PublicationPremises;

class PremisesMap extends Component
{
    public array $markers = [];

    public function mount()
    {
        // Get all provinces that actually have premises,
        // with a count of how many premises each has.
        /*$provinces = Province::withCount('premises')
            ->whereHas('premises')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();

        $this->markers = $provinces->map(function ($province) {
            return [
                'lat'      => (float) $province->latitude,
                'lng'      => (float) $province->longitude,
                'province' => $province->name,
                'total'    => (int) $province->premises_count,
            ];
        })->toArray();*/
        $locations = PublicationPremises::with('province')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();

        $this->markers = $locations->map(function ($p) {
            return [
                'lat'            => (float) $p->latitude,
                'lng'            => (float) $p->longitude,
                'name'           => $p->premises_name,
                'location'       => $p->location,
                'province'       => optional($p->province)->name,
                'owners_name'     => optional($p->premises_owner)->owners_name,
                'owner_code'     => optional($p->premises_owner)->owners_code ?? null, // if you have it
                'contact_person' => $p->contact_person,
                'telephone'      => $p->telephone,
                'mobile'         => $p->mobile,
                'geocode_status' => $p->geocode_status ?? 'unknown',
            ];
        })->toArray();
    }

    public function render()
    {
        return view('livewire.system.analytics.dashboard.premises-map');
    }
}
