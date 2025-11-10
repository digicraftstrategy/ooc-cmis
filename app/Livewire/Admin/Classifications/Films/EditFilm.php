<?php

namespace App\Livewire\Admin\Classifications\Films;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Film;
use App\Models\FilmType;
use Illuminate\Support\Str;

class EditFilm extends Component
{
    use WithFileUploads;

    public $film;
    public $film_title;
    public $film_type_id;
    public $casts;
    public $duration;
    public $director;
    public $producer;
    public $production_company;
    public $synopsis;
    public $distributor;
    public $origin_country;
    public $film_color;
    public $submission_file;

    protected $rules = [
        'film_title' => 'required|string|max:255',
        'film_type_id' => 'required|exists:film_types,id',
        'casts' => 'required|string',
        'duration' => 'required|integer|min:1',
        'director' => 'required|string|max:255',
        'producer' => 'required|string|max:255',
        'production_company' => 'required|string|max:255',
        'synopsis' => 'required|string',
        'distributor' => 'nullable|string|max:255',
        'origin_country' => 'required|string|max:255',
        'film_color' => 'required|string|max:50',
        'submission_file' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
    ];

    public function mount($film)
    {
        $this->film = $film;
        $this->film_title = $film->film_title;
        $this->film_type_id = $film->film_type_id;
        $this->casts = $film->casts;
        $this->duration = $film->duration;
        $this->director = $film->director;
        $this->producer = $film->producer;
        $this->production_company = $film->production_company;
        $this->synopsis = $film->synopsis;
        $this->distributor = $film->distributor;
        $this->origin_country = $film->origin_country;
        $this->film_color = $film->film_color;
    }

    public function update()
    {
        $this->validate();

        try {
            $this->film->film_title = $this->film_title;
            $this->film->film_type_id = $this->film_type_id;
            $this->film->casts = $this->casts;
            $this->film->duration = $this->duration;
            $this->film->director = $this->director;
            $this->film->producer = $this->producer;
            $this->film->production_company = $this->production_company;
            $this->film->synopsis = $this->synopsis;
            $this->film->distributor = $this->distributor;
            $this->film->origin_country = $this->origin_country;
            $this->film->film_color = $this->film_color;
            $this->film->slug = Str::slug($this->film_title);

            // Handle file upload
            if ($this->submission_file) {
                // Delete old file if exists
                if ($this->film->submission_file_path) {
                    \Storage::disk('public')->delete($this->film->submission_file_path);
                }

                $filePath = $this->submission_file->store('submission_files', 'public');
                $this->film->submission_file_path = $filePath;
                $this->film->original_file_name = $this->submission_file->getClientOriginalName();
            }

            $this->film->save();

            $this->dispatch('film-updated');

            session()->flash('success', 'Film updated successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error updating film: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.classifications.films.edit-film', [
            'filmTypes' => FilmType::all(),
        ]);
    }
}
