<?php

namespace App\Http\Livewire\System\Analytics\Dashboard;

use Livewire\Component;
use App\Models\PremisesApplication;

class ApplicationsStats extends Component
{
    public $totalApplications;
    public $pendingApplications;
    public $approvedApplications;

    public function mount()
    {
        $this->totalApplications   = PremisesApplication::count();
        $this->pendingApplications = PremisesApplication::where('application_status', 'pending')->count();
        $this->approvedApplications = PremisesApplication::where('application_status', 'approved')->count();
    }

    public function render()
    {
        return view('livewire.system.analytics.dashboard.applications-stats');
    }
}
