<?php

namespace App\Http\Livewire\System\Analytics\Dashboard;

use Livewire\Component;
use App\Models\User;

class UsersStats extends Component
{
    public $totalUsers;
    public $activeUsers;

    public function mount()
    {
        $this->totalUsers  = User::count();
        $this->activeUsers = User::whereHas('accountStatus', function ($q) {
            $q->where('status', 'active');
        })->count();
    }

    public function render()
    {
        return view('livewire.system.analytics.dashboard.users-stats');
    }
}
