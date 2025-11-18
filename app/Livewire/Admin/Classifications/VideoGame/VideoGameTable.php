<?php

namespace App\Livewire\Admin\Classifications\VideoGame;

use App\Models\VideoGaming;
use Livewire\Component;
use Livewire\WithPagination;

class VideoGameTable extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'video_game_title';
    public $sortDirection = 'asc';
    public $perPage = 10;

    public $showDeleteModal = false;
    public $selectedGame = null;

    protected $queryString = [
        'search'        => ['except' => ''],
        'sortField'     => ['except' => 'video_game_title'],
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

    public function openDeleteModal($id)
    {
        $this->selectedGame = VideoGaming::findOrFail($id);
        $this->showDeleteModal = true;
    }

    public function closeDeleteModal()
    {
        $this->selectedGame = null;
        $this->showDeleteModal = false;
    }

    public function deleteGame()
    {
        try {
            $this->selectedGame->delete();

            $this->closeDeleteModal();
            session()->flash('success', 'Video game deleted successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error deleting video game: ' . $e->getMessage());
        }
    }

    /**
     * Base query so table + stats use the same filters.
     */
    protected function getBaseQuery()
    {
        $term = '%'.$this->search.'%';

        return VideoGaming::query()
            ->when($this->search, function ($q) use ($term) {
                $q->where(function ($qq) use ($term) {
                    $qq->where('video_game_title', 'like', $term)
                       ->orWhere('main_characters', 'like', $term)
                       ->orWhere('developer', 'like', $term)
                       ->orWhere('publisher', 'like', $term)
                       ->orWhere('platform', 'like', $term)
                       ->orWhere('genre', 'like', $term)
                       ->orWhere('language', 'like', $term)
                       ->orWhere('game_mode', 'like', $term);
                });
            });
    }

    public function render()
    {
        $baseQuery = $this->getBaseQuery();

        $games = (clone $baseQuery)
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        $stats = [
            'total'        => (clone $baseQuery)->count(),

            // Use has_classified (same pattern as Film & TvSeriesSeason)
            'classified'   => (clone $baseQuery)
                ->where('has_classified', true)
                ->count(),

            'unclassified' => (clone $baseQuery)
                ->where(function ($q) {
                    $q->where('has_classified', false)
                      ->orWhereNull('has_classified');
                })
                ->count(),

            'recent'       => (clone $baseQuery)->latest()->first(),
        ];

        return view('livewire.admin.classifications.video-game.video-game-table', [
            'games' => $games,
            'stats' => $stats,
        ]);
    }
}
