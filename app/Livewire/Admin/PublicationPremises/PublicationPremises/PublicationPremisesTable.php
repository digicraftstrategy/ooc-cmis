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
    public $premiseToDelete = null;
    public $premisesToEdit = null;
    public $premisesToView = null;
    public $numericPremisesOwnerId;

    // Properties for inline editing of status
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
        $this->showCreateModal = false;
        $this->showDeleteModal = false;
        $this->premiseToDelete = null;
        $this->premisesToEdit = null;
        $this->premisesToView = null;
    }

    public function editStatus($premiseId, $currentStatus)
    {
        $this->editingStatusId = $premiseId;
        $this->newStatus = $currentStatus;
    }

    public function showEditModal($premisesId)
    {
        $this->premisesToEdit = $premisesId;
    }

    public function showViewModal($premisesId)
    {
        $this->premisesToView = $premisesId;
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

     public function saveStatus($premiseId)
    {
        $this->validate([
            'newStatus' => 'required|string|in:operational,suspended,ceased'
        ]);

        $premise = PublicationPremises::findOrFail($premiseId);
        $premise->update(['status' => $this->newStatus]);
        $this->cancelEdit();
        session()->flash('message', 'Status updated successfully.');
    }

    public function cancelEdit()
    {
        $this->editingStatusId = null;
        $this->newStatus = '';
    }

    public function render()
    {
        $query = PublicationPremises::with([
            'premises_province:id,name',
            'prescribedActivity:id,activity_type'
        ])
        ->where('premises_owner_id', $this->premisesOwner->id);

        // Add search functionality
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
