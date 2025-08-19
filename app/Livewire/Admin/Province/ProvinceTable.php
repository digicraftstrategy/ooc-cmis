<?php

namespace App\Livewire\Admin\Province;

use App\Models\Province;
use App\Models\Region;
use Livewire\Component;
use Livewire\WithPagination;

class ProvinceTable extends Component
{
    use WithPagination;

    public $search = '';
    public $regionFilter = '';
    public $sortField = 'name';
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $showDeleteModal = false;
    public $provinceIdBeingDeleted;
    public $provinceIdBeingEdited = null;
    public $provinceIdBeingViewed = null;
    public $showCreateModal = false;
    public $regions;

    protected $listeners = [
        'closeModal',
        'refreshProvinces' => '$refresh'
    ];

    public function mount()
    {
        $this->regions = Region::orderBy('name')->get();
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

    public function updatingRegionFilter()
    {
        $this->resetPage();
    }

    public function openCreateModal()
    {
        $this->showCreateModal = true;
    }

    public function openEditModal($provinceId)
    {
        $this->provinceIdBeingEdited = $provinceId;
    }

    public function openViewModal($provinceId)
    {
        $this->provinceIdBeingViewed = $provinceId;
    }

    public function openDeleteModal($provinceId)
    {
        $this->provinceIdBeingDeleted = $provinceId;
        $this->showDeleteModal = true;
    }

    public function closeModal()
    {
        $this->showDeleteModal = false;
        $this->showCreateModal = false;
        $this->provinceIdBeingEdited = null;
        $this->provinceIdBeingViewed = null;
    }

    public function deleteProvince()
    {
        $province = Province::findOrFail($this->provinceIdBeingDeleted);
        $province->delete();

        session()->flash('message', 'Province deleted successfully.');
        $this->closeModal();
    }

    public function render()
    {
        $provinces = Province::query()
            ->with('region')
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('code', 'like', '%' . $this->search . '%');
            })
            ->when($this->regionFilter, function ($query) {
                $query->where('region_id', $this->regionFilter);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.admin.province.province-table', [
            'provinces' => $provinces,
        ]);
    }
}
