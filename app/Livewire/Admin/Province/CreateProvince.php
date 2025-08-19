<?php

namespace App\Livewire\Admin\Province;

use App\Models\Province;
use App\Models\Region;
use Livewire\Component;

class CreateProvince extends Component
{
    public $name;
    public $code;
    public $region_id;
    public $showModal = true;
    public $regions;

    public function mount()
    {
        $this->regions = Region::orderBy('name')->get();
    }

    public function closeModal()
    {
        $this->dispatch('closeModal');
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50',
            'region_id' => 'required|exists:regions,id',
        ]);

        Province::create([
            'name' => $this->name,
            'code' => $this->code,
            'region_id' => $this->region_id,
        ]);

        $this->closeModal();
        $this->dispatch('refreshProvinces');
        session()->flash('message', 'Province created successfully.');
    }

    public function render()
    {
        return view('livewire.admin.province.create-province');
    }
}
