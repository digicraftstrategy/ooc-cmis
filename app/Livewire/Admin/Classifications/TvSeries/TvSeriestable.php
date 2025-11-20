<?php 

namespace App\Livewire\Admin\Classifications\TvSeries;

use App\Models\TvSeriesSeason;
use Livewire\Component;
use Livewire\WithPagination;

class TvSeriestable extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $sortField = 'season_number';
    public $sortDirection = 'asc';
    public $selectedSeasons = [];

    // Modal states
    public $showViewModal = false;
    public $showEditModal = false;
    public $showDeleteModal = false;
    public $selectedSeason = null;

    // protected $listeners = [
    //     'seasonUpdated' => '$refresh', 
    //     'seasonCreated' => '$refresh'
    // ];
        protected $listeners = [
        'delete-season-confirmed' => 'deleteSeason',
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

    // View Methods
    public function openViewModal($seasonId)
    {
        $this->selectedSeason = TvSeriesSeason::with('tvSeries')->findOrFail($seasonId);
        $this->showViewModal = true;
    }

    public function closeViewModal()
    {
        $this->showViewModal = false;
        $this->selectedSeason = null;
    }

    // Edit Methods
    public function openEditModal($seasonId)
    {
        $this->selectedSeason = TvSeriesSeason::findOrFail($seasonId);
        $this->showEditModal = true;
    }

    public function closeEditModal()
    {
        $this->showEditModal = false;
        $this->selectedSeason = null;
    }

    public function updateSeason()
    {
        $this->validate([
            'selectedSeason.season_title'       => 'required|string|max:255',
            'selectedSeason.season_number'      => 'required|integer|min:1',
            'selectedSeason.number_of_episodes' => 'required|integer|min:1',
            'selectedSeason.released_year'      => 'required|integer|min:1900|max:' . date('Y'),
        ]);

        $this->selectedSeason->save();

        $this->closeEditModal();
        $this->dispatch('seasonUpdated');
        session()->flash('message', 'Season updated successfully.');
    }

    // Delete Methods
    public function openDeleteModal($seasonId)
    {
        $this->selectedSeason = TvSeriesSeason::findOrFail($seasonId);
        $this->showDeleteModal = true;
    }

    public function closeDeleteModal()
    {
        $this->showDeleteModal = false;
        $this->selectedSeason = null;
    }

    public function deleteSeason(): void
    {
        try {
            if (!$this->selectedSeason) {
                throw new \Exception('No season selected for deletion.');
            }

            $season = $this->selectedSeason;

            // Perform the delete
            $season->delete();

            // Clear selection / local modal state
            $this->selectedSeason   = null;
            $this->showDeleteModal  = false;

            // Flash success for the centered dialog
            session()->flash('success', 'Season deleted successfully.');

            // Redirect to the listing so layout + dialog re-render
            $this->redirectRoute('admin.classifications.tv-series'); // adjust route name if needed

        } catch (\Throwable $e) {
            session()->flash('error', 'Error deleting Season: ' . $e->getMessage());
        }
    }

    public function bulkDelete()
    {
        TvSeriesSeason::whereIn('id', $this->selectedSeasons)->delete();
        $this->selectedSeasons = [];
        session()->flash('message', 'Selected seasons deleted successfully.');
    }

    protected function getBaseQuery()
    {
        return TvSeriesSeason::with('tvSeries')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('season_title', 'like', '%' . $this->search . '%')
                      ->orWhere('season_slug', 'like', '%' . $this->search . '%')
                      ->orWhereHas('tvSeries', function ($q2) {
                          $q2->where('tv_series_title', 'like', '%' . $this->search . '%');
                      });
                });
            });
    }

    public function render()
    {
        $baseQuery = $this->getBaseQuery();

        $seasons = (clone $baseQuery)
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        $stats = [
            'total'             => (clone $baseQuery)->count(),
            'totalClassified'   => (clone $baseQuery)
                ->where('has_classified', true)
                ->count(),
            'totalUnclassified' => (clone $baseQuery)
                ->where(function ($q) {
                    $q->where('has_classified', false)
                      ->orWhereNull('has_classified');
                })
                ->count(),
            'recent'            => (clone $baseQuery)->latest()->first(),
        ];

        return view('livewire.admin.classifications.tv-series.tv-seriestable', [
            'seasons' => $seasons,
            'stats'   => $stats,
        ]);
    }
}
