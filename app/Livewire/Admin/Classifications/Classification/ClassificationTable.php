<?php

namespace App\Livewire\Admin\Classifications\Classification;

use App\Models\Classification;
use App\Models\Film;
use App\Models\TvSeriesSeason;
use App\Models\Literature;
use App\Models\AdvertisementMatter;
use App\Models\Audio;
use Livewire\Component;
use Livewire\WithPagination;

class ClassificationTable extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    protected $queryString = ['search'];

    public function deleteClassification($classificationId)
    {
        $classification = Classification::findOrFail($classificationId);
        $classification->delete();

        session()->flash('message', 'Classification deleted successfully.');
    }

    public function render()
    {
        $search = trim($this->search);

        $classifications = Classification::with([
                'rating',
                'category',
                'owner',
                'classifiable', // polymorphic target (Film, TvSeriesSeason, etc.)
            ])
            ->when($search, function ($query) use ($search) {
                $like = '%' . $search . '%';

                $query->where(function ($q) use ($like) {
                    $q->where('classification_reason', 'like', $like)
                        ->orWhere('viewed_by', 'like', $like)
                        ->orWhere('second_opinion_by', 'like', $like)
                        ->orWhere('classification_status', 'like', $like)
                        ->orWhere('notes', 'like', $like)
                        // Classification Rating
                        ->orWhereHas('rating', function ($ratingQuery) use ($like) {
                            $ratingQuery->where('rating', 'like', $like);
                        })
                        // Classification Category, eg: Film, TV Series, Music, TV Ads, Video Gaming
                        ->orWhereHas('category', function ($categoryQuery) use ($like) {
                            $categoryQuery->where('name', 'like', $like);
                        })
                        ->orWhereHas('owner', function ($ownerQuery) use ($like) {
                            $ownerQuery->where('owners_name', 'like', $like);
                        })

                        // Film classifications
                        ->orWhereHasMorph('classifiable', [Film::class], function ($morphQuery) use ($like) {
                            $morphQuery->where('film_title', 'like', $like);
                        })

                        // Season classifications (season title with its parent TV series title)
                        ->orWhereHasMorph('classifiable', [TvSeriesSeason::class], function ($morphQuery) use ($like) {
                            $morphQuery->where('season_title', 'like', $like)
                                ->orWhereHas('tvSeries', function ($tvQuery) use ($like) {
                                    $tvQuery->where('tv_series_title', 'like', $like);
                                });
                        })

                        // Literature classifications
                        ->orWhereHasMorph('classifiable', [Literature::class], function ($morphQuery) use ($like) {
                            $morphQuery->where('literature_title', 'like', $like);
                        })

                        // Advertisement classifications
                        ->orWhereHasMorph('classifiable', [AdvertisementMatter::class], function ($morphQuery) use ($like) {
                            $morphQuery->where('advertising_matter', 'like', $like);
                        })

                        // Audio classifications
                        ->orWhereHasMorph('classifiable', [Audio::class], function ($morphQuery) use ($like) {
                            $morphQuery->where('audio_title', 'like', $like)
                                       ->orWhere('title', 'like', $like);
                        });
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

            // Get stats for the current filtered results
            $totalApproved = $classifications->where('classification_status', 'Approved')->count();
            $totalRejected = $classifications->where('classification_status', 'Rejected')->count();
            $totalSecondOpinion = $classifications->where('is_second_opinion', true)->count();

        return view('livewire.admin.classifications.classification.classification-table', [
            'classifications' => $classifications,
            'totalApproved' => $totalApproved,
            'totalRejected' => $totalRejected,
            'totalSecondOpinion' => $totalSecondOpinion,
        ]);
    }
}
