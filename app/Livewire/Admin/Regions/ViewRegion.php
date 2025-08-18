<?php

namespace App\Livewire\Admin\Regions;

use App\Models\Region;
use Livewire\Component;

class ViewRegion extends Component
{
    public $regionId;
    public $name;
    public $code;
    public $showModal = false;

    protected $listeners = ['openViewModal', 'closeModal'];

    public function openViewModal($regionId)
    {
        $region = Region::findOrFail($regionId);
        $this->regionId = $region->id;
        $this->name = $region->name;
        $this->code = $region->code;
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function render()
    {
        return view('livewire.admin.regions.view-region');
    }
}