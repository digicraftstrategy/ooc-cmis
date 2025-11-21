<?php

namespace App\Livewire\Admin\Classifications\TvSeries;

use Livewire\Component;
use App\Models\TvSeriesSeason;
use App\Models\TvSeries;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Carbon;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class EditTvSeries extends Component
{
    use WithFileUploads;

    public TvSeriesSeason $season;

    // Season fields
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

    // TV Series info (read-only)
    public string $tv_series_title = '';
    public int $tv_series_id;

    // UX flags
    public bool $autoSeasonSlug = true;

    protected function rules(): array
    {
        $thisYearPlusOne = Carbon::now()->year + 1;

        return [
            'season_title' => ['required', 'string', 'max:255'],
            'season_slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('seasons', 'season_slug')->ignore($this->season->id),
            ],
            'season_number' => [
                'required',
                'integer',
                'min:1',
                'max:10000',
                Rule::unique('seasons', 'season_number')
                    ->where('tv_series_id', $this->tv_series_id)
                    ->ignore($this->season->id),
            ],
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
    }

    protected function messages(): array
    {
        return [
            'season_title.required' => 'Season title is required.',
            'season_slug.required' => 'Season slug is required.',
            'season_slug.unique' => 'This season slug already exists.',
            'season_number.required' => 'Season number is required.',
            'season_number.unique' => 'This season number already exists for this TV Series.',
            'number_of_episodes.required' => 'Number of episodes is required.',
            'release_year.required' => 'Release year is required.',
            'poster_path.image' => 'The poster must be an image.',
            'poster_path.max' => 'The poster must not exceed 2MB.',
        ];
    }

    public function mount(TvSeriesSeason $season): void
    {
        $this->season = $season;
        $this->tv_series_id = $season->tv_series_id;
        $this->tv_series_title = $season->tvSeries->tv_series_title ?? '';

        // Populate form fields
        $this->season_title = $season->season_title;
        $this->season_slug = $season->season_slug;
        $this->season_number = $season->season_number;
        $this->number_of_episodes = $season->number_of_episodes;
        $this->duration = $season->duration;
        $this->release_year = $season->release_year;
        $this->casts = $season->casts ?? '';
        $this->director = $season->director ?? '';
        $this->producer = $season->producer ?? '';
        $this->production_company = $season->production_company ?? '';
        $this->genre = $season->genre ?? '';
        $this->language = $season->language ?? '';
        $this->has_subtitle = $season->has_subtitle;
        $this->theme = $season->theme ?? '';
    }

    public function updated($field): void
    {
        // Auto-generate season slug
        if ($this->autoSeasonSlug && in_array($field, ['season_number', 'season_title'])) {
            $this->season_slug = $this->makeUniqueSeasonSlug();
        }

        $this->validateOnly($field);
    }

    protected function makeUniqueSeasonSlug(): string
    {
        $seriesTitle = $this->tv_series_title;
        $seasonNumber = $this->season_number;
        $seasonTitle = $this->season_title;

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

        while (TvSeriesSeason::where('season_slug', $slug)
            ->where('id', '!=', $this->season->id)
            ->exists()) {
            $slug = $base . '-' . $i;
            $i++;
            if ($i > 9999) {
                $slug = $base . '-' . Str::random(6);
                break;
            }
        }

        return $slug;
    }

    public function update(): void
    {
        if (blank($this->season_slug)) {
            $this->season_slug = $this->makeUniqueSeasonSlug();
        }

        $validated = $this->validate();

        try {
            // Handle poster upload
            $posterPath = $this->season->getRawOriginal('poster_path');
            if ($this->poster_path) {
                // Delete old poster if exists
                if ($posterPath) {
                    Storage::disk('public')->delete($posterPath);
                }
                $posterPath = $this->poster_path->store('posters', 'public');
            }

            // Update season data
            $this->season->update([
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
            ]);

            session()->flash('success', 'TV Series Season updated successfully.');

            $this->dispatch('tvSeriesUpdated');
            $this->dispatch('closeEditModal');

        } catch (\Exception $e) {
            session()->flash('error', 'Failed to update TV Series Season: ' . $e->getMessage());
            \Log::error('TV Series Season update error: ' . $e->getMessage());
        }
    }

    public function downloadPoster(): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        $posterPath = $this->season->getRawOriginal('poster_path');
        
        if ($posterPath && Storage::disk('public')->exists($posterPath)) {
            return Storage::disk('public')->download($posterPath);
        }

        session()->flash('error', 'Poster file not found.');
        return redirect()->back();
    }

    public function render()
    {
        return view('livewire.admin.classifications.tv-series.edit-tv-series');
    }
}