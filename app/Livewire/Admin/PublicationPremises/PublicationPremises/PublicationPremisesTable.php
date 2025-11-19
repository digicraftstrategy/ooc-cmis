<?php

namespace App\Livewire\Admin\PublicationPremises\PublicationPremises;

use App\Models\PremisesOwner;
use App\Models\PublicationPremises;
use Livewire\Component;
use Livewire\WithPagination;

class PublicationPremisesTable extends Component
{
    use WithPagination;

    public PremisesOwner $premisesOwner;
    public string $premisesOwnerId;
    public $search = '';

    public $showCreateModal = false;
    public $showDeleteModal = false;
    public $showModal = false; 

    public $premiseToDelete = null;
    public $premisesToEdit = null;
    public $premisesToView = null;

    public $numericPremisesOwnerId;

    // Edit form fields
    public $premises_name;
    public $business_registration_no;
    public $contact_person;
    public $telephone;
    public $status;

    // Inline status edit
    public $editingStatusId = null;
    public $newStatus = '';

    protected $listeners = [
        'closeModal' => 'closeModal',
        'refreshPublicationPremises' => '$refresh',
        'modalClosed' => 'closeModal'
    ];

    public function mount(string $id): void
    {
        $this->premisesOwnerId = $id;
        $this->premisesOwner = PremisesOwner::with('premises_type')
            ->where('id', $id)
            ->orWhere('uuid', $id)
            ->firstOrFail();

        $this->numericPremisesOwnerId = $this->premisesOwner->id;
    }

    public function openCreateModal()
    {
        $this->showCreateModal = true;
    }

    public function closeModal()
    {
        $this->reset([
            'showCreateModal', 'showDeleteModal', 'showModal',
            'premiseToDelete', 'premisesToEdit', 'premisesToView',
            'premises_name', 'business_registration_no',
            'contact_person', 'telephone', 'status'
        ]);
    }

    public function showEditModal($premisesId)
    {
        $premise = PublicationPremises::findOrFail($premisesId);

        $this->premisesToEdit = $premise->id;
        $this->premises_name = $premise->premises_name;
        $this->business_registration_no = $premise->business_registration_no;
        $this->contact_person = $premise->contact_person;
        $this->telephone = $premise->telephone;
        $this->status = $premise->status;

        $this->showModal = true; // ✅ set true to open edit modal
    }

    public function updatePremises()
    {
        $this->validate([
            'premises_name' => 'required|string|max:255',
            'business_registration_no' => 'nullable|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'telephone' => 'nullable|string|max:50',
            'status' => 'required|in:operational,suspended,ceased',
        ]);

        $premise = PublicationPremises::findOrFail($this->premisesToEdit);
        $premise->update([
            'premises_name' => $this->premises_name,
            'business_registration_no' => $this->business_registration_no,
            'contact_person' => $this->contact_person,
            'telephone' => $this->telephone,
            'status' => $this->status,
        ]);

        session()->flash('message', 'Premises updated successfully.');
        $this->closeModal();
    }

    public function openDeleteModal($premisesId)
    {
        $this->premiseToDelete = $premisesId;
        $this->showDeleteModal = true;
    }

    public function deletePremise()
    {
        if ($this->premiseToDelete) {
            $premise = PublicationPremises::findOrFail($this->premiseToDelete);
            $premise->delete();
            $this->closeModal();
            session()->flash('message', 'Premises deleted successfully.');
        }
    }

    public function render()
    {
        $query = PublicationPremises::with([
            'premises_province:id,name',
            //'prescribedActivity:id,activity_type',
            //'prescribedActivities:id,activity_type'
        ])->where('premises_owner_id', $this->premisesOwner->id);

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('premises_name', 'like', '%' . $this->search . '%')
                    ->orWhere('business_registration_no', 'like', '%' . $this->search . '%')
                    ->orWhere('contact_person', 'like', '%' . $this->search . '%')
                    ->orWhere('telephone', 'like', '%' . $this->search . '%');
            });
        }

        $premises = $query->orderBy('premises_name')->paginate(10);

        return view('livewire.admin.publication-premises.publication-premises.publication-premises-table', [
            'premises' => $premises,
            'showCreatedModel' => $this->showCreateModal
        ]);
    }
}
