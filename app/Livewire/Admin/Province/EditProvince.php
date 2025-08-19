<?php

namespace App\Livewire\Admin\Province;

use App\Models\Province;
use App\Models\Region;
use Livewire\Component;

class EditProvince extends Component
{
    public $province;
    public $name;
    public $code;
    public $region_id;
    public $showModal = true;
    public $regions;

    public function mount($provinceId)
    {
        $this->province = Province::findOrFail($provinceId);
        $this->name = $this->province->name;
        $this->code = $this->province->code;
        $this->region_id = $this->province->region_id;
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

        $this->province->update([
            'name' => $this->name,
            'code' => $this->code,
            'region_id' => $this->region_id,
        ]);

        $this->closeModal();
        $this->dispatch('refreshProvinces');
        session()->flash('message', 'Province updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.province.edit-province');
    }
}
