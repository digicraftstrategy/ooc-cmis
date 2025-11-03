<?php

namespace App\Livewire\System\Analytics\Dashboard;

use Livewire\Component;
use App\Models\PrescribedActivity;

class ActivitiesStats extends Component
{
    public $totalActivities;
    public $activeActivities;

    public function mount()
    {
        $this->totalActivities = PrescribedActivity::count();
        $this->activeActivities = PrescribedActivity::where('is_active', true)->count();
    }

    public function render()
    {
        return view('livewire.system.analytics.dashboard.activities-stats');
    }
}
