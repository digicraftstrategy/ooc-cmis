<?php

namespace App\Livewire\Admin\Classifications\Films;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Film;
use App\Models\FilmType;
use Illuminate\Support\Str;

class CreateFilm extends Component
{
    use WithFileUploads;

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

    public function save()
    {
        $this->validate();

        try {
            $film = new Film();
            $film->film_title = $this->film_title;
            $film->film_type_id = $this->film_type_id;
            $film->casts = $this->casts;
            $film->duration = $this->duration;
            $film->director = $this->director;
            $film->producer = $this->producer;
            $film->production_company = $this->production_company;
            $film->synopsis = $this->synopsis;
            $film->distributor = $this->distributor;
            $film->origin_country = $this->origin_country;
            $film->film_color = $this->film_color;
            $film->slug = Str::slug($this->film_title);

            // Handle file upload
            if ($this->submission_file) {
                $filePath = $this->submission_file->store('submission_files', 'public');
                $film->submission_file_path = $filePath;
                $film->original_file_name = $this->submission_file->getClientOriginalName();
            }

            $film->save();

            $this->dispatch('film-created');
            $this->reset();

            session()->flash('success', 'Film created successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error creating film: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.classifications.films.create-film', [
            'filmTypes' => FilmType::all(),
        ]);
    }
}
