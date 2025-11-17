<?php

namespace App\Livewire\Admin\Classifications\VideoGame;

use App\Models\VideoGaming;
use Livewire\Component;

class ViewVideoGame extends Component
{
    public VideoGaming $game;

    public function mount(VideoGaming $game)
    {
        $this->game = $game->load('user');
    }

    public function render()
    {
        return view('livewire.admin.classifications.video-game.view-video-game', [
            'game' => $this->game
        ]);
    }
}
