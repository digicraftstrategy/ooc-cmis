<?php

namespace App\Http\Livewire\System\Analytics\Dashboard;

use Livewire\Component;
use App\Models\Province;
use App\Models\Region;

class GeoStats extends Component
{
    public $totalProvinces;
    public $totalRegions;

    public function mount()
    {
        $this->totalProvinces = Province::count();
        $this->totalRegions   = Region::count();
    }

    public function render()
    {
        return view('livewire.system.analytics.dashboard.geo-stats');
    }
}
