<?php

namespace App\Livewire\Admin\Classifications\Films;

use Livewire\Component;
use App\Models\Film;

class ViewFilm extends Component
{
    public $film;

    public function mount($film)
    {
       // $this->film = $film;
       $this->film = Film::where('slug', $film)->firstOrFail();
    }

    public function downloadFile()
    {
        if ($this->film->submission_file_path) {
            return response()->download(
                storage_path('app/public/' . $this->film->submission_file_path),
                $this->film->original_file_name
            );
        }

        session()->flash('error', 'No file available for download.');
    }

    public function render()
    {
        return view('livewire.admin.classifications.films.view-film');
    }
}
