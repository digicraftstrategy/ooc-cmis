<?php

namespace App\Livewire;

use Livewire\Component;

class DashboardNavigation extends Component
{
     public function isActive($routePattern)
    {
        return request()->routeIs($routePattern);
    }

    public function render()
    {
        return view('livewire.dashboard-navigation');
    }
}
