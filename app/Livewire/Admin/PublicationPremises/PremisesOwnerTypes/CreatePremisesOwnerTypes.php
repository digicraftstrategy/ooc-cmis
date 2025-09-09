<?php

namespace App\Livewire\Admin\PublicationPremises\PremisesOwnerTypes;

use App\Models\PremisesOwnerType;
use Livewire\Component;

class CreatePremisesOwnerTypes extends Component
{
    public $type;
    public $description;
    public $showModal = false;

    protected $rules = [
        'type' => 'required|string|max:50|unique:premises_owner_types,type',
        'description' => 'string|max:255'
    ];

    protected $listeners = [
        'openCreateModal',
        'closeModal'
    ];

    public function openCreateModal()
    {
        $this->reset(['type', 'description']);
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

        PremisesOwnerType::create([
            'type' => $this->type,
            'description' => $this->description
        ]);

        $this->dispatch('refreshPremisesOwnerTypes');
        session()->flash('message', 'Premises owner type created successfully.');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.admin.publication-premises.premises-owner-types.create-premises-owner-types');
    }
}
