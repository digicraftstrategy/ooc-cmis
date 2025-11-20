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
    public $theme;
    public $distributor;
    public $origin_country;
    public $film_color;
    public $submission_file;

    protected $rules = [
        'film_title'        => 'required|string|max:255',
        'film_type_id'      => 'required|exists:film_types,id',
        'casts'             => 'required|string',
        'duration'          => 'required|integer|min:1',
        'director'          => 'required|string|max:255',
        'producer'          => 'required|string|max:255',
        'production_company'=> 'required|string|max:255',
        'theme'          => 'required|string',
        'distributor'       => 'nullable|string|max:255',
        'origin_country'    => 'required|string|max:255',
        'film_color'        => 'required|string|max:50',
        'submission_file'   => 'nullable|file|mimes:pdf,doc,docx|max:10240',
    ];

    public function mount($film)
{
    // Support 3 input types: Film model, id, or slug
    if ($film instanceof Film) {
        $this->film = $film;
    } elseif (is_numeric($film)) {
        // Called with an ID (e.g. from a modal)
        $this->film = Film::findOrFail($film);
    } else {
        // Called with a slug (e.g. from the route /films/{slug}/edit)
        $this->film = Film::where('slug', $film)->firstOrFail();
    }

    // Hydrate form fields from the model
    $this->film_title         = $this->film->film_title;
    $this->film_type_id       = $this->film->film_type_id;
    $this->casts              = $this->film->casts;
    $this->duration           = $this->film->duration;
    $this->director           = $this->film->director;
    $this->producer           = $this->film->producer;
    $this->production_company = $this->film->production_company;
    $this->theme           = $this->film->theme;
    $this->distributor        = $this->film->distributor;
    $this->origin_country     = $this->film->origin_country;
    $this->film_color         = $this->film->film_color;
}


    public function update(): void
    {
        $this->validate();

        try {
            // Map component properties to actual DB columns
            $this->film->film_title         = $this->film_title;
            $this->film->film_type_id       = $this->film_type_id;
            $this->film->casts              = $this->casts;
            $this->film->duration           = $this->duration;
            $this->film->director           = $this->director;
            $this->film->producer           = $this->producer;
            $this->film->production_company = $this->production_company;

            // films.theme (DB) ⇐ $this->theme (form field)
            $this->film->theme              = $this->theme;

            // films.country (DB) ⇐ $this->origin_country (form field)
            $this->film->country            = $this->origin_country;

            // films.color (DB) ⇐ $this->film_color (form field)
            $this->film->color              = $this->film_color;

            // Slug
            $this->film->slug               = Str::slug($this->film_title);

            // Handle file upload (submission_file_path, original_file_name)
            if ($this->submission_file) {
                if ($this->film->submission_file_path) {
                    \Storage::disk('public')->delete($this->film->submission_file_path);
                }

                $filePath = $this->submission_file->store('submission_files', 'public');
                $this->film->submission_file_path = $filePath;
                $this->film->original_file_name   = $this->submission_file->getClientOriginalName();
            }

            $this->film->save();

            // Event if you still use it
            $this->dispatch('film-updated');

            // Centered success dialog
            session()->flash('success', 'Film updated successfully.');

            // Redirect back to listing so the layout + dialog render
            $this->redirectRoute('admin.classifications.films');

        } catch (\Throwable $e) {
            session()->flash('error', 'Error updating film: ' . $this->film->film_title . ' ' . $e->getMessage());
        }
    }


    public function render()
    {
        return view('livewire.admin.classifications.films.edit-film', [
            'filmTypes' => FilmType::all(),
        ]);
    }
}
