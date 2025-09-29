<?php

namespace App\Livewire\Admin\PublicationPremises\PremisesOwner;

use App\Models\PremisesOwnerType;
use App\Models\PremisesOwner;
use Livewire\Component;

class CreatePremisesOwners extends Component
{
    public $logo;
    public $website;
    public $owners_name;
    public $phone;
    public $address;
    public $email;
    public $premises_owner_type_id;

    public $showModal = true;
    public $premisesOwnerTypes;

    public function mount()
    {
        $this->premisesOwnerTypes = PremisesOwnerType::orderBy('type')->get();
    }

    public function closeModal()
    {
        $this->dispatch('closeModal');
    }

    public function save()
    {
        $this->validate([
            'owners_name' => 'required|string|max:75|unique:premises_owners,owners_name',
            'phone' => 'nullable|string|max:10',
            'address' => 'nullable|string|max:255',
            'email' => 'required|string|email',
            'premises_owner_type_id' => 'required|exists:premises_owner_types,id',
            'website' => 'nullable|url|max:255',
            'logo' => 'nullable|image|max:5120', // 5MB max
        ]);

        // Handle logo upload
        $logoPath = null;
        if ($this->logo) {
            $logoPath = $this->logo->store('premises-owners/logos', 'public');
        }

        PremisesOwner::create([
            'owners_name' => $this->owners_name,
            'phone' => $this->phone,
            'address' => $this->address,
            'email' => $this->email,
            'logo' => $logoPath,
            'website' => $this->website,
            'premises_owner_type_id' => $this->premises_owner_type_id,
        ]);

        $this->closeModal();
        $this->dispatch('refreshPremisesOwner');
        session()->flash('message', 'Premises Owner created successfully.');
    }
    public function render()
    {
        return view('livewire.admin.publication-premises.premises-owner.create-premises-owners');
    }
}
