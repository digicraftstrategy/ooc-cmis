<?php

namespace App\Livewire\Admin\PublicationPremises\PremisesOwner;

use App\Models\PremisesOwnerType;
use App\Models\PremisesOwner;
use Livewire\Component;

class EditPremisesOwners extends Component
{
    public $premisesOwner;
    public $owners_name;
    public $phone;
    public $address;
    public $email;
    public $premises_owner_type_id;
    public $premisesOwnerIdBeingEdited = null;

    public $showModal = true;
    public $premisesOwnerTypes;

    public function mount($premisesOwnerId)
    {
        $this->premisesOwner = PremisesOwner::findOrFail($premisesOwnerId);

        $this->owners_name = $this->premisesOwner->owners_name;
        $this->phone = $this->premisesOwner->phone;
        $this->address = $this->premisesOwner->address;
        $this->email = $this->premisesOwner->email;
        $this->premises_owner_type_id = $this->premisesOwner->premises_owner_type_id;

        $this->premisesOwnerTypes = PremisesOwnerType::orderBy('type')->get();
    }

    public function closeModal()
    {
        $this->dispatch('closeModal');
    }

    public function update()
    {
        $this->validate([
            'owners_name' => 'required|string|max:75|unique:premises_owners,owners_name,' . $this->premisesOwner->id,
            'phone' => 'nullable|string|max:10',
            'address' => 'nullable|string|max:255',
            'email' => 'required|string|email',
            'premises_owner_type_id' => 'required|exists:premises_owner_types,id',
        ]);

        $this->premisesOwner->update([
            'owners_name' => $this->owners_name,
            'phone' => $this->phone,
            'address' => $this->address,
            'email' => $this->email,
            'premises_owner_type_id' => $this->premises_owner_type_id,
        ]);

        $this->closeModal();
        $this->dispatch('refreshPremisesOwner');
        session()->flash('message', 'Premises Owner updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.publication-premises.premises-owner.edit-premises-owners');
    }
}
