<?php

namespace App\Livewire\Admin\Classifications\Films;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Film;
use App\Models\FilmType;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;

class CreateFilm extends Component
{
    use WithFileUploads;

    public $film_title;
    public $film_type_id;
    public $casts;
    public $director;
    public $producer;
    public $production_company;
    public $release_year;
    public $genre;
    public $language;
    public $duration;
    public $has_subtitle = false;
    public $color;
    public $country;
    public $theme;
    public $poster;
    public $trailer_url;

    public function getReleaseYearConstraints()
    {
        $currentYear = date('Y');
        return [
            'maxYear' => $currentYear + 1,
            'minYear' => 1900
        ];
    }

    protected function rules()
    {
        $releaseYearConstraints = $this->getReleaseYearConstraints();

        return [
            'film_title' => 'required|string|max:255',
            'film_type_id' => 'required|exists:film_types,id',
            'casts' => 'nullable|string',
            'director' => 'nullable|string|max:255',
            'producer' => 'nullable|string|max:255',
            'production_company' => 'nullable|string|max:255',
            'release_year' => 'nullable|integer|min:'. $releaseYearConstraints['minYear'] . '|max:'. $releaseYearConstraints['maxYear'],
            'genre' => 'nullable|string|max:255',
            'language' => 'nullable|string|max:255',
            'duration' => 'required|integer|min:1',
            'has_subtitle' => 'boolean',
            'color' => 'nullable|string|max:50',
            'country' => 'nullable|string|max:255',
            'theme' => 'nullable|string',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'trailer_url' => 'nullable|url|max:500',
        ];
    }

    protected function messages()
    {
        $releaseYearConstraints = $this->getReleaseYearConstraints();

        return [
            'release_year.min' => 'Release year must be after 1900.',
            'release_year.max' => "Release year cannot be later than {$releaseYearConstraints['maxYear']}.",
            'poster.image' => 'The poster must be an image file.',
            'poster.mimes' => 'The poster must be a JPEG, PNG, JPG, or GIF file.',
            'poster.max' => 'The poster must not be larger than 2MB.',
            'trailer_url.url' => 'Please enter a valid URL for the trailer.',
        ];
    }

    public function save()
    {
        $this->validate();

        try {
            $film = new Film();
            $film->film_title = $this->film_title;
            $film->film_type_id = $this->film_type_id;
            $film->casts = $this->casts;
            $film->director = $this->director;
            $film->producer = $this->producer;
            $film->production_company = $this->production_company;
            $film->release_year = $this->release_year;
            $film->genre = $this->genre;
            $film->language = $this->language;
            $film->duration = $this->duration;
            $film->has_subtitle = $this->has_subtitle;
            $film->color = $this->color;
            $film->country = $this->country;
            $film->theme = $this->theme;
            $film->trailer_url = $this->trailer_url;
            $film->slug = Str::slug($this->film_title);

            // Handle poster upload
            if ($this->poster) {
                $posterPath = $this->poster->store('posters', 'public');
                $film->poster_path = $posterPath;
            }

            $film->save();

            // Redirect to films index with success message
            session()->flash('success', 'Film created successfully.');
            return redirect()->route('admin.classifications.films.index');

        } catch (\Exception $e) {
            session()->flash('error', 'Error creating film: ' . $e->getMessage());
        }
    }

    public function resetForm()
    {
        $this->reset();
        $this->resetErrorBag();
    }

    public function render()
    {
        $currentYear = date('Y');
        $years = range($currentYear, 1900);

        $colors = [
            'Color' => 'Color',
            'Black & White' => 'Black & White',
            'Both' => 'Both',
        ];

        $languages = [
            'English' => 'English',
            'Filipino' => 'Filipino',
            'Tagalog' => 'Tagalog',
            'Bisaya' => 'Bisaya',
            'Ilocano' => 'Ilocano',
            'Other' => 'Other',
        ];

        return view('livewire.admin.classifications.films.create-film', [
            'filmTypes' => FilmType::all(),
            'years' => $years,
            'colors' => $colors,
            'languages' => $languages,
        ]);
    }
}
