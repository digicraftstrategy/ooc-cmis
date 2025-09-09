<?php

namespace App\Livewire\Admin\PublicationPremises\PremisesOwnerTypes;

use App\Models\PremisesOwnerType;
use Livewire\Component;
use Livewire\WithPagination;

class PremisesOwnerTypesTable extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'type';
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $premisesOwnerTypes;

    public $showDeleteModal = false;
    public $PremisesOwnerTypeIdBeingDeleted;

    protected $listeners = [
        'openCreateModal',
        'openEditModal',
        'openViewModal',
        'closeModal',
        'refreshPremisesOwnerTypes' => 'refresh'
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

    public function openCreateModal()
    {
        $this->dispatch('openCreateModal')
        ->to('admin.publication-premises.premises-owner-types.create-premises-owner-types');
    }

    public function openEditModal($premisesOwnerTypeId)
    {
        $this->dispatch('openEditmodal', premisesOwnerTypeId: $premisesOwnerTypeId)
            ->to('admin.publication-premises.premises-owner-types.edit-premises-owner-types');
    }

    public function openViewModal($premisesOwnerTypeId)
    {
        $this->dispatch('openViewModal', premisesOwnerTypeId: $premisesOwnerTypeId)
            ->to('admin.publication-premises.premises-owner-types.view-premises-owner-types');
    }

    public function openDeleteModal($premisesOwnerTypeId)
    {
        $this->PremisesOwnerTypeIdBeingDeleted = $premisesOwnerTypeId;
        $this->showDeleteModal = true;
    }

    public function closeModal()
    {
        $this->dispatch('closeModal')
            ->to('admin.publication-premises.premises-owner-types.create-premises-owner-types');

        $this->dispatch('closeModal')
            ->to('admin.publication-premises.premises-owner-types.edit-premises-owner-types');

        $this->dispatch('closeModal')
            ->to('admin.publication-premises.premises-owner-types.view-premises-owner-types');

        $this->showDeleteModal = false;
    }

    public function deletePremisesOwnerType()
    {
        $premisesOwnerType = PremisesOwnerType::findOrFail($this->PremisesOwnerTypeIdBeingDeleted);
        $premisesOwnerType->delete();

        // Referesh Premises Owner type list
        $this->premisesOwnerTypes = PremisesOwnerType::orderBy('type')->get();

        session()->flash('message', 'Premises owner type deleted successfully.');
        $this->closeModal();
    }

    public function render()
    {
        $paginatedPremisesOwnerTypes = PremisesOwnerType::where('type', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.admin.publication-premises.premises-owner-types.premises-owner-types-table', [
            'paginatedPremisesOwnerTypes' => $paginatedPremisesOwnerTypes,
        ]);
    }
}
