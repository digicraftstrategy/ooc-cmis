<?php

namespace App\Livewire\Admin\Classifications\TvSeries;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\TvSeries; // <- ensure this matches your actual class/file name (TvSeries.php)
use Illuminate\Support\Facades\Storage;

class TvSeriestable extends Component
{
    use WithPagination;

    // Filters / sorting
    public string $search = '';
    public string $sortField = 'tv_series_title'; // default sort matches your column
    public string $sortDirection = 'asc';
    public int $perPage = 10;

    // Modal states (same UX as FilmTable)
    //public bool $showCreateModal = false;
    public bool $showEditModal   = false;
    public bool $showViewModal   = false;
    public bool $showDeleteModal = false;

    // Inside TvSeriestable (optional)
    /*protected $listeners = [
        'tvSeriesCreated' => '$refresh',
        'closeCreateModal' => 'closeCreateModal',
    ];*/

    // Selected row
    public ?TvSeries $selectedTVSeries = null;

    protected $queryString = [
        'search'        => ['except' => ''],
        'sortField'     => ['except' => 'tv_series_title'],
        'sortDirection' => ['except' => 'asc'],
    ];

    /** Toggle sort like FilmTable */
    public function sortBy(string $field): void
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
        $this->resetPage();
    }

    /** Keep pagination sensible while typing */
    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    // --- Modal open/close helpers (same pattern as FilmTable) ---

    /*public function openCreateModal(): void   { $this->showCreateModal = true;  }
    public function closeCreateModal(): void  { $this->showCreateModal = false; }*/

    public function openEditModal(int $id): void
    {
        $this->selectedTVSeries = TvSeries::with('classification.rating')->findOrFail($id);
        $this->showEditModal = true;
    }
    public function closeEditModal(): void
    {
        $this->selectedTVSeries = null;
        $this->showEditModal = false;
    }

    public function openViewModal(int $id): void
    {
        $this->selectedTVSeries = TvSeries::with('classification.rating')->findOrFail($id);
        $this->showViewModal = true;
    }
    public function closeViewModal(): void
    {
        $this->selectedTVSeries = null;
        $this->showViewModal = false;
    }

    public function openDeleteModal(int $id): void
    {
        $this->selectedTVSeries = TvSeries::findOrFail($id);
        $this->showDeleteModal = true;
    }
    public function closeDeleteModal(): void
    {
        $this->selectedTVSeries = null;
        $this->showDeleteModal = false;
    }

    public function deleteTVSeries(): void
    {
        try {
            optional($this->selectedTVSeries)->delete();
            $this->closeDeleteModal();
            session()->flash('success', 'TV Series deleted successfully.');
        } catch (\Throwable $e) {
            session()->flash('error', 'Error deleting TV Series: '.$e->getMessage());
        }
    }

    /** DATA SOURCE — aligned to your migration fields */
    public function render()
    {
        $term = '%'.$this->search.'%';

        $tvSerieses = TvSeries::query()
            ->with('seasons') // eager load seasons
            ->when($this->search, function ($q) use ($term) {
                $q->where(function ($qq) use ($term) {
                    $qq->where('tv_series_title', 'like', $term)
                       ->orWhere('season_number', 'like', $term)
                       ->orWhere('episode_number', 'like', $term)
                       ->orWhere('season_title', 'like', $term)
                       ->orWhere('episode_title', 'like', $term)
                       ->orWhere('duration', 'like', $term)
                       ->orWhere('slug', 'like', $term)
                       ->orWhere('genre', 'like', $term)
                       ->orWhere('language', 'like', $term)
                       ->orWhere('production_company', 'like', $term)
                       ->orWhere('release_year', 'like', $term)
                       ->orWhere('casts', 'like', $term)
                       ->orWhere('director', 'like', $term)
                       ->orWhere('producer', 'like', $term)
                       ->orWhere('theme', 'like', $term);
                });
            })
            // you can sort by any of these fields (UI should call sortBy on their <th>)
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        // Stats cards (simple example — mirror FilmTable feel)
        $stats = [
            'total'        => TvSeries::count(),
            'classified'   => TvSeries::whereHas('classification')->count(),
            'unclassified' => TvSeries::whereDoesntHave('classification')->count(),
            'recent'       => TvSeries::latest()->first(),
        ];

        return view('livewire.admin.classifications.tv-series.tv-seriestable', [
            'tvSerieses' => $tvSerieses,
            'stats'      => $stats,
        ]);
    }
}
