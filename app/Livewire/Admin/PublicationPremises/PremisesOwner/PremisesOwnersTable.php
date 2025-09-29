<?php

namespace App\Livewire\Admin\PublicationPremises\PremisesOwner;

use App\Models\PremisesOwner;
use App\Models\PremisesOwnerType;
use Livewire\Component;
use Livewire\WithPagination;

class PremisesOwnersTable extends Component
{
    use WithPagination;

    public $search = '';
    public $premisesOwnerFilter = '';
    public $sortField = 'owners_name';
    public $sortDirection = 'asc';
    public $perPage = 10;

    public $premisesOwnerTypes;

    public $showDeleteModal = false;
    public $premisesOwnerIdBeingDeleted;
    public $premisesOwnerIdBeingViewed = null;
    public $premisesOwnerIdBeingEdited = null;
    public $showCreateModal = false;
    //public $showEditModal = false; //Added by SONN
    protected $listeners = [
        'closeModal',
        'refreshPremisesOwner' => 'refresh'
    ];

    public function mount()
    {
        $this->premisesOwnerTypes = PremisesOwnerType::orderBy('type')->get();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPremisesOwnerFilter()
    {
        $this->resetPage();
    }

    public function openCreateModal()
    {
        $this->showCreateModal = true;
    }

    // Trigger the modal
    public function openEditModal($uuid)
    {
        $this->premisesOwnerIdBeingEdited = $uuid;
        //$this->showEditModal = true;
    }

    // Close modal
    public function closeEditModal()
    {
        //$this->showEditModal = false;
        $this->premisesOwnerIdBeingEdited = null;
    }

    public function showViewModal($premisesOwnerId)
    {
        $this->premisesOwnerIdBeingEdited = $premisesOwnerId;
    }

    public function openDeleteModal($premisesOwnerId)
    {
        $this->premisesOwnerIdBeingDeleted = $premisesOwnerId;
        $this->showDeleteModal = true;
    }

    public function closeModal()
    {
        $this->showDeleteModal = false;
        $this->showCreateModal = false;
        $this->premisesOwnerIdBeingEdited = null;
        $this->premisesOwnerIdBeingViewed = null;
    }

    public function deletePremisesOwner()
    {
        $premisesOwner = PremisesOwner::findOrFail($this->premisesOwnerIdBeingDeleted);
        $premisesOwner->delete();

        session()->flash('message', 'Premises Owner deleted successfully.');
        $this->closeModal();
    }
    public function render() 
    {
        $premisesOwners = PremisesOwner::query()
            ->with('premises_type')
            ->when($this->search, function ($query) {
                $query->where('owners_name', 'like', '%' . $this->search . '%');
            })
            ->when($this->premisesOwnerFilter, function ($query) {
                $query->where('premises_owner_type_id', $this->premisesOwnerFilter);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
        return view('livewire.admin.publication-premises.premises-owner.premises-owners-table', [
            'premisesOwners' => $premisesOwners,
            //'premisesOwners' => PremisesOwner::paginate(10),
        ]);
    }
}
