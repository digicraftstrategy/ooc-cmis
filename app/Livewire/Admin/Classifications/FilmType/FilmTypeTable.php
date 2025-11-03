<?php

namespace App\Livewire\Admin\Classifications\FilmType;

use Livewire\Component;
use Livewire\WithPagination;

class FilmTypeTable extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'type';
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $film_types;

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

    public function render()
    {
        $paginateFilmTypes = \App\Models\FilmType::where('type', 'like', '%' . $this->search . '%')
            ->orWhere('slug', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.admin.classifications.film-type.film-type-table', [
            'paginateFilmTypes' => $paginateFilmTypes,
        ]);
    }
}
