<?php

namespace App\Livewire\Admin\Classifications\TvSeries;

use Livewire\Component;
use App\Models\TvSeries;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Carbon;

class CreateTvSeries extends Component
{
    // --- Form state (aligned to columns used in your table/search) ---
    public string $tv_series_title = '';
    public ?int   $season_number = null;
    public string $season_title = '';
    public ?int   $number_of_episodes = null;   // note: table displays "Episodes #"
    public ?int   $duration = null;             // minutes (per episode or average)
    public string $casts = '';
    public string $director = '';
    public string $producer = '';
    public string $production_company = '';
    public string $language = '';
    public string $theme = '';
    public ?int   $release_year = null;
    public string $genre = '';
    public string $slug = '';

    // Optional UX flags
    public bool $autoSlug = true;

    // Validation rules
    protected function rules(): array
    {
        $thisYearPlusOne = Carbon::now()->year + 1;

        return [
            'tv_series_title'     => ['required', 'string', 'min:2', 'max:255'],
            'season_number'       => ['nullable', 'integer', 'min:1', 'max:10000'],
            'season_title'        => ['nullable', 'string', 'max:255'],
            'number_of_episodes'  => ['nullable', 'integer', 'min:1', 'max:10000'],
            'duration'            => ['nullable', 'integer', 'min:1', 'max:5000'],
            'casts'               => ['nullable', 'string', 'max:1000'],
            'director'            => ['nullable', 'string', 'max:255'],
            'producer'            => ['nullable', 'string', 'max:255'],
            'production_company'  => ['nullable', 'string', 'max:255'],
            'language'            => ['nullable', 'string', 'max:100'],
            'theme'               => ['nullable', 'string', 'max:1000'],
            'release_year'        => ['nullable', 'integer', 'min:1900', "max:{$thisYearPlusOne}"],
            'genre'               => ['nullable', 'string', 'max:255'],
            'slug'                => [
                'required',
                'string',
                'max:255',
                Rule::unique('tv_series', 'slug'),
            ],
        ];
    }

    // Real-time validation
    public function updated($field): void
    {
        // Auto-generate slug as user types, if enabled
        if ($this->autoSlug && $field === 'tv_series_title') {
            $this->slug = $this->makeUniqueSlug($this->tv_series_title);
        }

        $this->validateOnly($field);
    }

    // Helper: create a unique slug based on title
    protected function makeUniqueSlug(string $title): string
    {
        $base = Str::slug($title);
        if ($base === '') {
            $base = 'tv-series';
        }

        $slug = $base;
        $i = 1;

        while (TvSeries::where('slug', $slug)->exists()) {
            $slug = $base.'-'.$i;
            $i++;
            if ($i > 9999) { // fail-safe
                $slug = $base.'-'.Str::random(6);
                break;
            }
        }

        return $slug;
    }

    public function save(): void
    {
        // Ensure slug exists even if user disabled autoSlug or cleared it
        if (blank($this->slug)) {
            $this->slug = $this->makeUniqueSlug($this->tv_series_title);
        }

        $data = $this->validate();

        // Persist
        $tvSeries = TvSeries::create([
            'tv_series_title'     => $data['tv_series_title'],
            'season_number'       => $data['season_number'],
            'season_title'        => $data['season_title'],
            'number_of_episodes'  => $data['number_of_episodes'],
            'duration'            => $data['duration'],
            'casts'               => $data['casts'],
            'director'            => $data['director'],
            'producer'            => $data['producer'],
            'production_company'  => $data['production_company'],
            'language'            => $data['language'],
            'theme'               => $data['theme'],
            'release_year'        => $data['release_year'],
            'genre'               => $data['genre'],
            'slug'                => $data['slug'],
        ]);

        // Flash + notify parent (table) to refresh and close modal
        session()->flash('success', 'TV Series created successfully.');

        // Emit events (Livewire v3)
        // Parent can listen and react: e.g. -> on('tvSeriesCreated', fn () => $this->closeCreateModal())
        $this->dispatch('tvSeriesCreated', id: $tvSeries->id);
        $this->dispatch('closeCreateModal');

        $this->resetForm();
    }

    protected function resetForm(): void
    {
        $this->reset([
            'tv_series_title',
            'season_number',
            'season_title',
            'number_of_episodes',
            'duration',
            'casts',
            'director',
            'producer',
            'production_company',
            'language',
            'theme',
            'release_year',
            'genre',
            'slug',
        ]);
        $this->autoSlug = true;
    }

    public function render()
    {
        return view('livewire.admin.classifications.tv-series.create-tv-series');
        //->layout('layouts.app');   // or whatever your app layout is
    }
}
