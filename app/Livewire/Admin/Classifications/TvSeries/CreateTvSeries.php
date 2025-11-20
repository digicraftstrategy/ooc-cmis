<?php

namespace App\Livewire\Admin\Classifications\TvSeries;

use Livewire\Component;
use App\Models\TvSeries;
use App\Models\TvSeriesSeason;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Carbon;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;

class CreateTvSeries extends Component
{
    use WithFileUploads;

    // TV Series fields (for tv_serieses table)
    public string $tv_series_title = '';
    public string $slug = '';

    // Season fields (for seasons table)
    public string $season_title = '';
    public string $season_slug = '';
    public ?int $season_number = null;
    public string $number_of_episodes = '';
    public ?int $duration = null;
    public ?int $release_year = null;
    public string $casts = '';
    public string $director = '';
    public string $producer = '';
    public string $production_company = '';
    public string $genre = '';
    public string $language = '';
    public bool $has_subtitle = false;
    public string $theme = '';
    public $poster_path = null;

    // UX flags
    public bool $autoSlug = true;
    public bool $autoSeasonSlug = true;
    public bool $createNewSeries = true;
    public $selectedSeriesId = null;

    // For existing series dropdown
    public $existingSeries = [];

    protected function rules(): array
    {
        $thisYearPlusOne = Carbon::now()->year + 1;

        $rules = [
            // TV Series validation (for tv_serieses table)
            'tv_series_title' => ['required', 'string', 'min:2', 'max:255'],
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tv_serieses', 'slug')->ignore($this->selectedSeriesId),
            ],

            // Season validation (for seasons table)
            'season_title' => ['required', 'string', 'max:255'],
            'season_slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('seasons', 'season_slug'),
            ],
            'season_number' => ['required', 'integer', 'min:1', 'max:10000'],
            'number_of_episodes' => ['required', 'string', 'max:255'],
            'duration' => ['nullable', 'integer', 'min:1', 'max:5000'],
            'release_year' => ['required', 'integer', 'min:1900', "max:{$thisYearPlusOne}"],
            'casts' => ['nullable', 'string', 'max:1000'],
            'director' => ['nullable', 'string', 'max:255'],
            'producer' => ['nullable', 'string', 'max:255'],
            'production_company' => ['nullable', 'string', 'max:255'],
            'genre' => ['nullable', 'string', 'max:255'],
            'language' => ['nullable', 'string', 'max:100'],
            'has_subtitle' => ['boolean'],
            'theme' => ['nullable', 'string', 'max:1000'],
            'poster_path' => ['nullable', 'image', 'max:2048'],
        ];

        // Only validate TV series fields when creating new series
        if ($this->createNewSeries) {
            $rules['tv_series_title'][] = Rule::unique('tv_serieses', 'tv_series_title');
        } else {
            // When using existing series, make TV series selection required
            $rules['selectedSeriesId'] = ['required', 'exists:tv_serieses,id'];

            // Add unique season number validation for existing series
            if ($this->selectedSeriesId) {
                $rules['season_number'][] = Rule::unique('seasons', 'season_number')
                    ->where('tv_series_id', $this->selectedSeriesId);
            }
        }

        return $rules;
    }

    protected function messages(): array
    {
        return [
            'tv_series_title.required' => 'TV Series title is required.',
            'tv_series_title.unique' => 'This TV Series title already exists.',
            'selectedSeriesId.required' => 'Please select a TV Series.',
            'selectedSeriesId.exists' => 'The selected TV Series does not exist.',
            'season_title.required' => 'Season title is required.',
            'season_slug.required' => 'Season slug is required.',
            'season_slug.unique' => 'This season slug already exists.',
            'season_number.required' => 'Season number is required.',
            'season_number.unique' => 'This season number already exists for the selected TV Series.',
            'number_of_episodes.required' => 'Number of episodes is required.',
            'release_year.required' => 'Release year is required.',
            'poster_path.image' => 'The poster must be an image.',
            'poster_path.max' => 'The poster must not exceed 2MB.',
        ];
    }

    public function mount(): void
    {
        $this->loadExistingSeries();
        $this->release_year = Carbon::now()->year;
    }

    protected function loadExistingSeries(): void
    {
        $this->existingSeries = TvSeries::orderBy('tv_series_title')->get();
    }

    public function updated($field): void
    {
        // Auto-generate TV series slug
        if ($this->autoSlug && $field === 'tv_series_title' && $this->createNewSeries) {
            $this->slug = $this->makeUniqueSeriesSlug($this->tv_series_title);
        }

        // Auto-generate season slug
        if ($this->autoSeasonSlug && in_array($field, ['tv_series_title', 'season_number', 'season_title'])) {
            $this->season_slug = $this->makeUniqueSeasonSlug();
        }

        // When switching to existing series, clear TV series title validation
        if ($field === 'createNewSeries') {
            if (!$this->createNewSeries) {
                $this->resetValidation(['tv_series_title', 'slug']);
                // Clear the TV series title when switching to existing series
                $this->tv_series_title = '';
                $this->slug = '';
            } else {
                $this->resetValidation(['selectedSeriesId', 'season_number']);
                $this->selectedSeriesId = null;
            }
        }

        // When selected series changes, revalidate season number
        if ($field === 'selectedSeriesId') {
            $this->resetValidation(['season_number']);
        }

        $this->validateOnly($field);
    }

    public function updatedSelectedSeriesId($value): void
    {
        if ($value) {
            $series = TvSeries::find($value);
            if ($series) {
                $this->tv_series_title = $series->tv_series_title;
                $this->slug = $series->slug;
                // Regenerate season slug when series changes
                $this->season_slug = $this->makeUniqueSeasonSlug();

                // Get existing season numbers for the selected series
                $existingSeasonNumbers = TvSeriesSeason::where('tv_series_id', $value)
                    ->pluck('season_number')
                    ->toArray();

                // Suggest the next available season number
                if (!empty($existingSeasonNumbers)) {
                    $maxSeason = max($existingSeasonNumbers);
                    $this->season_number = $maxSeason + 1;
                } else {
                    $this->season_number = 1;
                }
            }
        } else {
            // Clear the fields if no series is selected
            $this->tv_series_title = '';
            $this->slug = '';
        }
    }

    public function updatedSeasonNumber($value): void
    {
        if ($this->autoSeasonSlug) {
            $this->season_slug = $this->makeUniqueSeasonSlug();
        }

        // Validate season number uniqueness when it changes
        if ($this->selectedSeriesId && $value) {
            $this->validateOnly('season_number');
        }
    }

    public function updatedSeasonTitle($value): void
    {
        if ($this->autoSeasonSlug) {
            $this->season_slug = $this->makeUniqueSeasonSlug();
        }
    }

    protected function makeUniqueSeriesSlug(string $title): string
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
            if ($i > 9999) {
                $slug = $base.'-'.Str::random(6);
                break;
            }
        }

        return $slug;
    }

    protected function makeUniqueSeasonSlug(): string
    {
        $seriesTitle = $this->tv_series_title;
        $seasonNumber = $this->season_number;
        $seasonTitle = $this->season_title;

        // Build base slug from available data
        if ($seriesTitle && $seasonNumber) {
            $base = Str::slug($seriesTitle) . '-season-' . $seasonNumber;
        } elseif ($seriesTitle && $seasonTitle) {
            $base = Str::slug($seriesTitle) . '-' . Str::slug($seasonTitle);
        } elseif ($seriesTitle) {
            $base = Str::slug($seriesTitle) . '-season';
        } else {
            $base = 'season';
        }

        $slug = $base;
        $i = 1;

        while (TvSeriesSeason::where('season_slug', $slug)->exists()) {
            $slug = $base.'-'.$i;
            $i++;
            if ($i > 9999) {
                $slug = $base.'-'.Str::random(6);
                break;
            }
        }

        return $slug;
    }

    public function save(): void
    {
        // Ensure slugs exist
        if (blank($this->slug) && $this->createNewSeries) {
            $this->slug = $this->makeUniqueSeriesSlug($this->tv_series_title);
        }

        if (blank($this->season_slug)) {
            $this->season_slug = $this->makeUniqueSeasonSlug();
        }

        // Additional validation for season number uniqueness
        if (!$this->createNewSeries && $this->selectedSeriesId) {
            $exists = TvSeriesSeason::where('tv_series_id', $this->selectedSeriesId)
                ->where('season_number', $this->season_number)
                ->exists();

            if ($exists) {
                session()->flash('error', 'This season number already exists for the selected TV Series.');
                return;
            }
        }

        $validated = $this->validate();

        try {
            // Use database transaction
            DB::transaction(function () use ($validated) {
                // Step 1: Find or create TV Series
                if ($this->createNewSeries) {
                    $tvSeries = TvSeries::create([
                        'tv_series_title' => $validated['tv_series_title'],
                        'slug' => $validated['slug'],
                    ]);

                    // For new series, check if season number exists
                    $exists = TvSeriesSeason::where('tv_series_id', $tvSeries->id)
                        ->where('season_number', $validated['season_number'])
                        ->exists();

                    if ($exists) {
                        throw new \Exception('This season number already exists for the selected TV Series.');
                    }
                } else {
                    $tvSeries = TvSeries::findOrFail($this->selectedSeriesId);
                }

                // Step 2: Handle poster upload
                $posterPath = null;
                if ($this->poster_path) {
                    $posterPath = $this->poster_path->store('posters', 'public');
                }

                // Step 3: Prepare season data
                $seasonData = [
                    'tv_series_id' => $tvSeries->id,
                    'season_title' => $validated['season_title'],
                    'season_slug' => $validated['season_slug'],
                    'season_number' => $validated['season_number'],
                    'number_of_episodes' => $validated['number_of_episodes'],
                    'duration' => $this->duration,
                    'release_year' => $validated['release_year'],
                    'casts' => $this->casts ?: null,
                    'director' => $this->director ?: null,
                    'producer' => $this->producer ?: null,
                    'production_company' => $this->production_company ?: null,
                    'genre' => $this->genre ?: null,
                    'language' => $this->language ?: null,
                    'has_subtitle' => $this->has_subtitle,
                    'theme' => $this->theme ?: null,
                    'poster_path' => $posterPath,
                ];

                // Step 4: Create season
                TvSeriesSeason::create($seasonData);
            });

            // Success message
            session()->flash('success', 
            $this->createNewSeries

                ? 'TV Series and Season created successfully.'
                : 'New season added to existing TV Series successfully.'
            );

                 // IMPORTANT: adjust this route name to match your actual listing route
            $this->redirectRoute('admin.classifications.tv-series');

            // // Emit events
            $this->dispatch('tvSeriesCreated');
            $this->dispatch('closeCreateModal');

            $this->resetForm();

        } catch (\Exception $e) {
            session()->flash('error', 'Failed to create TV Series and Season: ' . $e->getMessage());
            \Log::error('TV Series creation error: ' . $e->getMessage());
        }
    }

    protected function resetForm(): void
    {
        $this->reset([
            'tv_series_title',
            'slug',
            'season_title',
            'season_slug',
            'season_number',
            'number_of_episodes',
            'duration',
            'release_year',
            'casts',
            'director',
            'producer',
            'production_company',
            'genre',
            'language',
            'has_subtitle',
            'theme',
            'poster_path',
            'selectedSeriesId',
        ]);

        $this->autoSlug = true;
        $this->autoSeasonSlug = true;
        $this->createNewSeries = true;
        $this->has_subtitle = false;
        $this->release_year = Carbon::now()->year;

        $this->loadExistingSeries();
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.admin.classifications.tv-series.create-tv-series');
    }
}
