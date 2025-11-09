<?php

namespace App\Livewire\Admin\Classifications;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\{Film, TvSeries, VideoGaming, AdvertisementMatter, Audio};

class ManageClassifications extends Component
{
    use WithPagination;

    public string $activeTab = 'films';   // films | tv | games | ads | audio
    public string $search = '';
    public int $perPage = 10;

    protected $queryString = [
        'activeTab' => ['except' => 'films'],
        'search'    => ['except' => ''],
        'page'      => ['except' => 1],
    ];

    public function updatedActiveTab(){ $this->resetPage(); }
    public function updatedSearch(){ $this->resetPage(); }
    public function setTab(string $tab){ $this->activeTab = $tab; $this->resetPage(); }

    public function getStatsProperty(): array
    {
        return match ($this->activeTab) {
            'tv' => [
                'Total Series' => TvSeries::count(),
                'Unclassified' => TvSeries::whereDoesntHave('classification')->count(),
                'Classified'   => TvSeries::whereHas('classification')->count(),
            ],
            'games' => [
                'Total Games'  => VideoGaming::count(),
                'Unclassified' => VideoGaming::whereDoesntHave('classification')->count(),
                'Classified'   => VideoGaming::whereHas('classification')->count(),
            ],
            'ads' => [
                'Total Ads'    => AdvertisementMatter::count(),
                'Unclassified' => AdvertisementMatter::whereDoesntHave('classification')->count(),
                'Classified'   => AdvertisementMatter::whereHas('classification')->count(),
            ],
            'audio' => [
                'Total Audio'  => Audio::count(),
                'Unclassified' => Audio::whereDoesntHave('classification')->count(),
                'Classified'   => Audio::whereHas('classification')->count(),
            ],
            default => [
                'Total Films'  => Film::count(),
                'Unclassified' => Film::whereDoesntHave('classification')->count(),
                'Classified'   => Film::whereHas('classification')->count(),
            ],
        };
    }

    public function getRowsProperty()
    {
        $term = $this->search;

        return match ($this->activeTab) {
            'tv' => TvSeries::query()
                ->search($term)
                ->with('classification.rating','classification.status')
                ->latest()
                ->paginate($this->perPage),

            'games' => VideoGaming::query()
                ->search($term) // searches 'video_game_title'
                ->with('classification.rating','classification.status')
                ->latest()
                ->paginate($this->perPage),

            'ads' => AdvertisementMatter::query()
                ->search($term) // searches 'advertising_matter'
                ->with('classification.rating','classification.status')
                ->latest()
                ->paginate($this->perPage),

            'audio' => Audio::query()
                ->search($term)
                ->with('classification.rating','classification.status')
                ->latest()
                ->paginate($this->perPage),

            default => Film::query()
                ->search($term) // searches 'film_title'
                ->with('classification.rating','classification.status')
                ->latest()
                ->paginate($this->perPage),
        };
    }

    public function render()
    {
        return view('livewire.admin.classifications.manage-classifications', [
            'rows'  => $this->rows,
            'stats' => $this->stats,
        ]);
    }
}
