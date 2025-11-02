<?php

namespace App\Livewire\System\Analytics\Dashboard;

use Livewire\Component;
use App\Models\PremisesOwner;

class OwnersStats extends Component
{
    public $totalOwners;
    public $ownersWithWebsite;

    public function mount()
    {
        $this->totalOwners       = PremisesOwner::count();
        $this->ownersWithWebsite = PremisesOwner::whereNotNull('website')->count();
    }

    public function render()
    {
        return view('livewire.system.analytics.dashboard.owners-stats');
    }
}
