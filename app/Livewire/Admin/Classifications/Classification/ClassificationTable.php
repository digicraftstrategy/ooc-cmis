<?php

namespace App\Livewire\Admin\Classifications\Classification;

use App\Models\AdvertisementMatter;
use App\Models\Audio;
use App\Models\Classification;
use App\Models\Film;
use App\Models\Literature;
use App\Models\TvSeriesSeason;
use Livewire\Component;
use Livewire\WithPagination;

class ClassificationTable extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    // NEW: type filter for dropdown
    public $typeFilter = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'typeFilter' => ['except' => ''],
    ];

    // Optional: reset page when filters/search change
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingTypeFilter()
    {
        $this->resetPage();
    }

    public function deleteClassification($classificationId)
    {
        $classification = Classification::findOrFail($classificationId);
        $classification->delete();

        session()->flash('message', 'Classification deleted successfully.');
    }

    public function render()
    {
        $search = trim($this->search);

        // ---------- BASE FILTERED QUERY (type + search) ----------
        $query = Classification::with([
            'rating',
            'category',
            'owner',
            'classifiable',
        ]);

        // 1) Filter by media type from dropdown
        if ($this->typeFilter) {
            switch ($this->typeFilter) {
                case 'film':
                    $query->whereHasMorph('classifiable', [Film::class]);
                    break;
                case 'season': // TV Series Seasons
                    $query->whereHasMorph('classifiable', [TvSeriesSeason::class]);
                    break;
                case 'literature':
                    $query->whereHasMorph('classifiable', [Literature::class]);
                    break;
                case 'advertisement_matter':
                    $query->whereHasMorph('classifiable', [AdvertisementMatter::class]);
                    break;
                case 'audio':
                    $query->whereHasMorph('classifiable', [Audio::class]);
                    break;
            }
        }

        // 2) Search across classification + classifiable models
        if ($search !== '') {
            $like = '%' . $search . '%';

            $query->where(function ($q) use ($like) {
                $q->where('classification_reason', 'like', $like)
                    ->orWhere('viewed_by', 'like', $like)
                    ->orWhere('second_opinion_by', 'like', $like)
                    ->orWhere('classification_status', 'like', $like)
                    ->orWhere('notes', 'like', $like)

                    // Rating
                    ->orWhereHas('rating', function ($ratingQuery) use ($like) {
                        $ratingQuery->where('rating', 'like', $like);
                    })

                    // Category
                    ->orWhereHas('category', function ($categoryQuery) use ($like) {
                        $categoryQuery->where('name', 'like', $like);
                    })

                    // Owner
                    ->orWhereHas('owner', function ($ownerQuery) use ($like) {
                        $ownerQuery->where('owners_name', 'like', $like);
                    })

                    // Film
                    ->orWhereHasMorph('classifiable', [Film::class], function ($morphQuery) use ($like) {
                        $morphQuery->where('film_title', 'like', $like);
                    })

                    // TV Series Season (and parent series)
                    ->orWhereHasMorph('classifiable', [TvSeriesSeason::class], function ($morphQuery) use ($like) {
                        $morphQuery->where('season_title', 'like', $like)
                            ->orWhereHas('tvSeries', function ($tvQuery) use ($like) {
                                $tvQuery->where('tv_series_title', 'like', $like);
                            });
                    })

                    // Literature
                    ->orWhereHasMorph('classifiable', [Literature::class], function ($morphQuery) use ($like) {
                        $morphQuery->where('literature_title', 'like', $like);
                    })

                    // Advertisement
                    ->orWhereHasMorph('classifiable', [AdvertisementMatter::class], function ($morphQuery) use ($like) {
                        $morphQuery->where('advertising_matter', 'like', $like);
                    })

                    // Audio
                    ->orWhereHasMorph('classifiable', [Audio::class], function ($morphQuery) use ($like) {
                        $morphQuery->where('audio_title', 'like', $like)
                                   ->orWhere('title', 'like', $like);
                    });
            });
        }

        // ---------- TABLE (paginated) ----------
        $classifications = (clone $query)
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

        // ---------- STATS (for CURRENT FILTER + SEARCH, NOT JUST CURRENT PAGE) ----------
        $totalApproved = (clone $query)
            ->where('classification_status', 'Approved')
            ->count();

        $totalRejected = (clone $query)
            ->where('classification_status', 'Rejected')
            ->count();

        $totalSecondOpinion = (clone $query)
            ->where('is_second_opinion', true)
            ->count();

        return view('livewire.admin.classifications.classification.classification-table', [
            'classifications'      => $classifications,
            'totalApproved'        => $totalApproved,
            'totalRejected'        => $totalRejected,
            'totalSecondOpinion'   => $totalSecondOpinion,
        ]);
    }
}
