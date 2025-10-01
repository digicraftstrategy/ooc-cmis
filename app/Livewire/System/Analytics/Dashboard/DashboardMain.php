<?php

namespace App\Http\Livewire\System\Analytics\Dashboard;

use Livewire\Component;

class DashboardMain extends Component
{
    public function render()
    {
        return view('livewire.system.analytics.dashboard.dashboard-main');
            //->layout('layouts.app'); // adjust to your layout (e.g. 'layouts.app', 'layouts.admin')
    }
}
