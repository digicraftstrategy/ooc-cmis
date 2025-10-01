<?php

namespace App\Http\Livewire\System\Analytics\Dashboard;

use Livewire\Component;
use App\Models\PublicationPremises;

class PremisesStats extends Component
{
    public $totalPremises;
    public $activePremises;
    public $inactivePremises;

    public function mount()
    {
        $this->totalPremises   = PublicationPremises::count();
        $this->activePremises  = PublicationPremises::where('status', 'active')->count();
        $this->inactivePremises = PublicationPremises::where('status', 'inactive')->count();
    }

    public function render()
    {
        return view('livewire.system.analytics.dashboard.premises-stats');
    }
}
