<?php

namespace App\Livewire\Admin\PublicationPremises\PremisesOwner;

use App\Models\PremisesOwnerType;
use App\Models\PremisesOwner;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditPremisesOwners extends Component
{
    use WithFileUploads;

    public $premisesOwner;
    public $owners_name;
    public $phone;
    public $address;
    public $email;
    public $premises_owner_type_id;
    public $premisesOwnerIdBeingEdited = null;

    // ✅ Add new fields
    public $logo;
    public $website;

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

         // ✅ Map new fields
        $this->logo = $this->premisesOwner->logo;
        $this->website = $this->premisesOwner->website;
    }

    public function closeModal()
    {
        $this->dispatch('closeModal');
    }

    protected $listeners = ['editPremisesOwner' => 'edit'];

    //Open edit form through event listener/route
    public function edit($id)
    {
        $this->premisesOwner = PremisesOwner::findOrFail($id);

        $this->owners_name = $this->premisesOwner->owners_name;
        $this->phone = $this->premisesOwner->phone;
        $this->address = $this->premisesOwner->address;
        $this->email = $this->premisesOwner->email;
        $this->premises_owner_type_id = $this->premisesOwner->premises_owner_type_id;

        // ✅ Load new fields
        $this->logo = $this->premisesOwner->logo;
        $this->website = $this->premisesOwner->website;

        $this->premisesOwnerTypes = PremisesOwnerType::orderBy('type')->get();

        //$this->showModal = true;
    }
    public function update()
    {
        $this->validate([
            'owners_name' => 'required|string|max:75|unique:premises_owners,owners_name,' . $this->premisesOwner->id,

            'phone' => 'nullable|string|max:10',
            'address' => 'nullable|string|max:255',
            'email' => 'required|string|email',
            'premises_owner_type_id' => 'required|exists:premises_owner_types,id',

            // ✅ Validation rules for new fields
            'logo' => 'nullable|image|max:5120', // same as create
            'website' => 'nullable|url|max:255',
        ]);

        // Handle logo upload (only if a new file was uploaded)
        $logoPath = $this->premisesOwner->logo; // keep old if none uploaded
        if ($this->logo && !is_string($this->logo)) {
            $logoPath = $this->logo->store('premises-owners/logos', 'public');
        }

        $this->premisesOwner->update([
            'owners_name' => $this->owners_name,
            'phone' => $this->phone,
            'address' => $this->address,
            'email' => $this->email,
            'premises_owner_type_id' => $this->premises_owner_type_id,

            // ✅ Save new fields
            'logo' => $logoPath,
            'website' => $this->website,
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
