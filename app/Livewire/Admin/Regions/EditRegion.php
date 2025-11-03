<?php

namespace App\Livewire\Admin\Regions;

use App\Models\Region;
use Livewire\Component;

class EditRegion extends Component
{
    public $regionId;
    public $name;
    public $code;
    public $showModal = false;

    protected $listeners = ['openEditModal', 'closeModal'];

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:regions,name,' . $this->regionId,
            'code' => 'nullable|string|max:50|unique:regions,code,' . $this->regionId,
        ];
    }

    public function openEditModal($regionId)
    {
        $region = Region::findOrFail($regionId);
        $this->regionId = $region->id;
        $this->name = $region->name;
        $this->code = $region->code;
        
        $this->resetValidation();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function update()
    {
        $this->validate();

        $region = Region::find($this->regionId);
        $region->update([
            'name' => $this->name,
            'code' => $this->code,
        ]);

        $this->closeModal();
        $this->dispatch('refreshRegions');
        session()->flash('message', 'Region updated successfully');
    }

    public function render()
    {
        return view('livewire.admin.regions.edit-region');
    }
}