<?php

namespace App\Livewire\Admin\Classifications\Advertisement;

use Livewire\Component;
use Livewire\WithPagination;

class AdvertisementTable extends Component
{
    use WithPagination;
    public $search = '';
    public $filmTitleFilter = '';
    public $sortField = 'film_title';
    public $sortDirection = 'asc';
    public $perPage = 10;

    public $showEditModal = false;

    public $showDeleteModal = false;

    public $showViewModal = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'filmTitleFilter' => ['except' => ''],
        'sortField' => ['except' => 'film_title'],
        'sortDirection' => ['except' => 'asc'],
    ];
    
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }
    public function render()
    {
        return view('livewire.admin.classifications.advertisement.advertisement-table');
    }
}
