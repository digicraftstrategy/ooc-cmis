<?php

namespace App\Livewire\Admin\Classifications\Films;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Film;
use App\Models\FilmType;
use Illuminate\Support\Facades\Storage;

class FilmTable extends Component
{
    use WithPagination;

    public $search = '';
    public $filmTitleFilter = '';
    public $sortField = 'film_title';
    public $sortDirection = 'asc';
    public $perPage = 10;

    // Modal states (commented out create modal)
    // public $showCreateModal = false;
    public $showEditModal = false;
    public $showViewModal = false;
    public $showDeleteModal = false;

    // Selected film
    public $selectedFilm;

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

    /*
    public function getCreatePage()
    {
        return redirect()->route('admin.classifications.films.create');
    }
    */

    /*
    public function openCreateModal()
    {
        $this->showCreateModal = true;
    }

    public function closeCreateModal()
    {
        $this->showCreateModal = false;
    }
    */

    public function openEditModal($filmId)
    {
        $this->selectedFilm = Film::with('filmType')->findOrFail($filmId);
        $this->showEditModal = true;
    }

    public function closeEditModal()
    {
        $this->selectedFilm = null;
        $this->showEditModal = false;
    }

    public function openViewModal($filmId)
    {
        $this->selectedFilm = Film::with('filmType')->findOrFail($filmId);
        $this->showViewModal = true;
    }

    public function closeViewModal()
    {
        $this->selectedFilm = null;
        $this->showViewModal = false;
    }

    public function openDeleteModal($filmId)
    {
        $this->selectedFilm = Film::findOrFail($filmId);
        $this->showDeleteModal = true;
    }

    public function closeDeleteModal()
    {
        $this->selectedFilm = null;
        $this->showDeleteModal = false;
    }

    public function deleteFilm()
    {
        try {
            // Delete associated file if exists
            if ($this->selectedFilm->submission_file_path && Storage::exists($this->selectedFilm->submission_file_path)) {
                Storage::delete($this->selectedFilm->submission_file_path);
            }

            $this->selectedFilm->delete();

            $this->closeDeleteModal();
            session()->flash('success', 'Film deleted successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error deleting film: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $films = Film::query()
            ->with('filmType')
            ->when($this->search, function ($query) {
                // Quering film title, director, producer and casts fields for search
                $query->where('film_title', 'like', '%' . $this->search . '%')
                      ->orWhere('director', 'like', '%' . $this->search . '%')
                      ->orWhere('producer', 'like', '%' . $this->search . '%');
                      //->orWhere('production_compnay', '%' . $this->search . '%')
                      //->orWhere('casts', 'like', '%' . $this->search . '%');
            })
            ->when($this->filmTitleFilter, function ($query) {
            // Quering film type for filtering 
                $query->where('film_type_id', $this->filmTitleFilter);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        // stats to display on cards
        $stats = [
            'total' => Film::count(),
            'totalSingleTitles' => Film::whereHas('filmType', function($query) {
                $query->where('type', 'Single');
            })->count(),
            'totalSequelTitles' => Film::whereHas('filmType', function($query) {
                $query->where('type', 'Sequel');
            })->count(),
            'recent' => Film::latest()->first(),
        ];

        return view('livewire.admin.classifications.films.film-table', [
            'films' => $films,
            'stats' => $stats,
            'filmTypes' => FilmType::all(),
        ]);
    }
}
