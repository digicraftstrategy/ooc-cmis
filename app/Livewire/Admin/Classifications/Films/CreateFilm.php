<?php

/*namespace App\Livewire\Admin\Classifications\Films;

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
}*/

namespace App\Livewire\Admin\Classifications\Films;

use Livewire\Component;
use App\Models\Film;
use App\Models\FilmType;
use Illuminate\Support\Str;

class CreateFilm extends Component
{
    public bool $open = false;

    public $film_title = '';
    public $film_type_id = '';
    public $main_actor_actress = '';
    public $duration = '';
    public $director = '';
    public $producer = '';
    public $production_company = '';
    public $genre = '';
    public $language = '';
    public $release_year = '';
    public $has_subtitle = false;
    public $poster_url = '';
    public $trailer_url = '';
    public $theme = '';
    public $synopsis = '';

    public $filmTypes;

    protected $listeners = ['openCreateFilm' => 'open'];

    public function mount()
    {
        $this->filmTypes = FilmType::orderBy('type')->get();
    }

    public function open()
    {
        $this->resetValidation();
        $this->resetExcept('filmTypes');
        $this->open = true;
    }

    public function close()
    {
        $this->open = false;
    }

    protected function rules(): array
    {
        return [
            'film_title'        => ['required','string','max:255'],
            'film_type_id'      => ['nullable','exists:film_types,id'],
            'main_actor_actress'=> ['nullable','string','max:255'],
            'duration'          => ['nullable','integer','min:1','max:14400'],
            'director'          => ['nullable','string','max:255'],
            'producer'          => ['nullable','string','max:255'],
            'production_company'=> ['nullable','string','max:255'],
            'genre'             => ['nullable','string','max:255'],
            'language'          => ['nullable','string','max:100'],
            'release_year'      => ['nullable','integer','min:1878','max:'.(now()->year+1)],
            'has_subtitle'      => ['boolean'],
            'poster_url'        => ['nullable','url','max:2048'],
            'trailer_url'       => ['nullable','url','max:2048'],
            'theme'             => ['nullable','string','max:255'],
            'synopsis'          => ['nullable','string','max:2000'],
        ];
    }

    public function save()
    {
        $data = $this->validate();

        // Make a slug from title; ensure uniqueness by appending a counter if needed.
        $base = Str::slug($this->film_title);
        $slug = $base;
        $i = 2;
        while (Film::where('slug', $slug)->exists()) {
            $slug = $base.'-'.$i++;
        }

        $film = Film::create(array_merge($data, [
            'slug' => $slug,
        ]));

        // Optional: create an empty classification record here, or leave for later workflow.

        $this->dispatch('film-created'); // tell parent tables to refresh
        $this->close();
        $this->dispatch('notify', title: 'Film created', body: '“'.$film->film_title.'” added successfully.');
    }

    public function render()
    {
        return view('livewire.admin.classifications.films.create-film');
    }
}

