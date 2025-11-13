<?php

namespace App\Livewire\Admin\Classifications\TvSeries;

use App\Models\TvSeriesSeason;
use Livewire\Component;
use Livewire\WithPagination;

class TvSeriesTitleTable extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $sortField = 'season_number';
    public $sortDirection = 'asc';
    public $selectedSeasons = [];

    protected $listeners = ['seasonDeleted' => '$refresh'];

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function deleteSeason($seasonId)
    {
        $season = TvSeriesSeason::findOrFail($seasonId);
        $season->delete();

        $this->dispatch('seasonDeleted');
        session()->flash('message', 'Season deleted successfully.');
    }

    public function bulkDelete()
    {
        TvSeriesSeason::whereIn('id', $this->selectedSeasons)->delete();
        $this->selectedSeasons = [];
        session()->flash('message', 'Selected seasons deleted successfully.');
    }

    public function render()
    {
        $seasons = TvSeriesSeason::with('tvSeries')
            ->when($this->search, function ($query) {
                $query->where('season_title', 'like', '%' . $this->search . '%')
                    ->orWhere('slug', 'like', '%' . $this->search . '%')
                    ->orWhereHas('tvSeries', function ($query) {
                        $query->where('title', 'like', '%' . $this->search . '%');
                    });
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.admin.classifications.tv-series.tv-series-title-table', compact('seasons'));
    }
}
