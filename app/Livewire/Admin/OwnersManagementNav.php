<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class OwnersManagementNav extends Component
{
    public $premisesOwnerUuid;

    public function mount($premisesOwnerUuid = null)
    {
        $this->premisesOwnerUuid = $premisesOwnerUuid;
    }

    public function isActive($routePattern)
    {
        return request()->routeIs($routePattern);
    }

    public function render()
    {
        return view('livewire.admin.owners-management-nav');
    }
}
