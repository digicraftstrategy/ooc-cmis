<?php

namespace App\Livewire\Admin\Classifications\Films;

use App\Models\Film;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\FilmType;

class FilmTable extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'film_title';
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $filmTitleFilter = '';

    public $filmTypes;

    public function mount()
    {
        $this->filmTypes = FilmType::orderBy('type')->get();
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

    public function updatingFilmTitleFilter()
    {
        $this->resetPage();
    }

    public function render()
    {
        $films = Film::query()
            ->with('filmType')
            ->when($this->search, function ($query) {
                $query->where('film_title', 'like', '%' . $this->search . '%');
            })
            ->when($this->filmTitleFilter, function ($query) {
                $query->where('film_type_id', 'like', '%' . $this->filmTitleFilter . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.admin.classifications.films.film-table', [
            'films' => $films,
        ]);
    }
}
