<?php

namespace App\Livewire\Admin\Classifications\TvSeries;

use Livewire\Component;
use App\Models\TvSeriesSeason;
use Illuminate\Support\Facades\Storage;

class ViewTvSeries extends Component
{
    public TvSeriesSeason $season;

    public function mount(TvSeriesSeason $season): void
    {
        $this->season = $season->load(['tvSeries', 'classification', 'episodes']);
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
        return view('livewire.admin.classifications.tv-series.view-tv-series');
    }
}
