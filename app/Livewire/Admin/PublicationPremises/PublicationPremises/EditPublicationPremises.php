<?php

namespace App\Livewire\Admin\PublicationPremises\PublicationPremises;

use App\Models\PublicationPremises;
use Livewire\Component;

class EditPublicationPremises extends Component
{
    public $premise;

    // Form fields
    public $premises_name;
    public $business_registration_no;
    public $contact_person;
    public $telephone;
    public $status;

    public $premisesIdBeingEdited = null;
    public $showModal = true;

    protected $listeners = ['editPremises' => 'edit'];

    public function mount($premisesId)
    {
        $this->premise = PublicationPremises::findOrFail($premisesId);

        $this->premises_name = $this->premise->premises_name;
        $this->business_registration_no = $this->premise->business_registration_no;
        $this->contact_person = $this->premise->contact_person;
        $this->telephone = $this->premise->telephone;
        $this->status = $this->premise->status;
    }

    public function closeModal()
    {
        $this->dispatch('closeModal');
    }

    // Open edit form through event listener
    public function edit($id)
    {
        $this->premise = PublicationPremises::findOrFail($id);

        $this->premises_name = $this->premise->premises_name;
        $this->business_registration_no = $this->premise->business_registration_no;
        $this->contact_person = $this->premise->contact_person;
        $this->telephone = $this->premise->telephone;
        $this->status = $this->premise->status;

        $this->premisesIdBeingEdited = $id;
        //$this->showModal = true;
    }

    public function update()
    {
        $this->validate([
            'premises_name' => 'required|string|max:255|unique:publication_premises,premises_name,' . $this->premise->id,
            'business_registration_no' => 'nullable|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'telephone' => 'nullable|string|max:50',
            'status' => 'required|in:operational,suspended,ceased',
        ]);

        $this->premise->update([
            'premises_name' => $this->premises_name,
            'business_registration_no' => $this->business_registration_no,
            'contact_person' => $this->contact_person,
            'telephone' => $this->telephone,
            'status' => $this->status,
        ]);

        $this->closeModal();
        $this->dispatch('refreshPublicationPremises');
        session()->flash('message', 'Publication Premises updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.publication-premises.publication-premises.edit-publication-premises');
    }
}
