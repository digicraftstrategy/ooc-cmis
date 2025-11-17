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
            // If you store files in cover_art_path and want to delete them,
            // you can decode JSON and delete from storage here.
            $this->selectedGame->delete();

            $this->closeDeleteModal();
            session()->flash('success', 'Video game deleted successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error deleting video game: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $term = '%'.$this->search.'%';

        $games = VideoGaming::query()
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
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        $stats = [
            'total'        => VideoGaming::count(),
            'classified'   => VideoGaming::whereHas('classification')->count(),
            'unclassified' => VideoGaming::whereDoesntHave('classification')->count(),
            'recent'       => VideoGaming::latest()->first(),
        ];

        return view('livewire.admin.classifications.video-game.video-game-table', [
            'games' => $games,
            'stats' => $stats,
        ]);
    }
}
