<?php

namespace App\Livewire\Admin\Regions;

use App\Models\Region;
use Livewire\Component;
use Livewire\WithPagination;

class RegionsTable extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'name';
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $showDeleteModal = false;
    public $regionIdBeingDeleted;

    protected $listeners = [
        'openCreateModal',
        'openEditModal',
        'openViewModal',
        'closeModal',
        'refreshRegions' => '$refresh'
    ];

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
        $this->dispatch('openCreateModal')->to('admin.regions.create-region');
    }

    public function openEditModal($regionId)
    {
        $this->dispatch('openEditModal', regionId: $regionId)->to('admin.regions.edit-region');
    }

    public function openViewModal($regionId)
    {
        $this->dispatch('openViewModal', regionId: $regionId)->to('admin.regions.view-region');
    }

    public function openDeleteModal($regionId)
    {
        $this->regionIdBeingDeleted = $regionId;
        $this->showDeleteModal = true;
    }

    public function closeModal()
    {
        $this->dispatch('closeModal')->to('admin.regions.create-region');
        $this->dispatch('closeModal')->to('admin.regions.edit-region');
        $this->dispatch('closeModal')->to('admin.regions.view-region');
        $this->showDeleteModal = false;
    }

    public function deleteRegion()
    {
        $region = Region::findOrFail($this->regionIdBeingDeleted);
        $region->delete();

        session()->flash('message', 'Region deleted successfully.');
        $this->closeModal();
    }

    public function render()
    {
        $regions = Region::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('code', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.admin.regions.regions-table', [
            'regions' => $regions,
        ]);
    }
}