<?php

namespace App\Livewire\Admin\Regions;

use App\Models\Region;
use Livewire\Component;

class CreateRegion extends Component
{
    public $name;
    public $code;
    public $showModal = false;

    protected $rules = [
        'name' => 'required|string|max:255|unique:regions,name',
        'code' => 'nullable|string|max:50|unique:regions,code',
    ];

    protected $listeners = ['openCreateModal', 'closeModal'];

    public function openCreateModal()
    {
        $this->reset(['name', 'code']);
        $this->resetValidation();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function create()
    {
        $this->validate();

        Region::create([
            'name' => $this->name,
            'code' => $this->code,
        ]);

        $this->closeModal();
        $this->dispatch('refreshRegions');
        session()->flash('message', 'Region created successfully.');
    }

    public function render()
    {
        return view('livewire.admin.regions.create-region');
    }
}