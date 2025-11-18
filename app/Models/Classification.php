<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Film;
use App\Models\TvSeriesSeason;
use App\Models\Literature;
use App\Models\AdvertisementMatter;
use App\Models\Audio;
use App\Models\PremisesOwner;
use App\Models\ClassificationRating;
use App\Models\ClassificationCategory;
use App\Models\VideoGaming;

class Classification extends Model
{
    protected $fillable = [
        'classification_reason',
        'classification_date',
        'viewed_by',
        'is_second_opinion',
        'second_opinion_by',
        'classification_status',
        'notes',
        'classifiable_id',
        'classifiable_type',
        'classification_rating_id',
        'classification_category_id',
    ];

    protected $casts = [
        'is_second_opinion'    => 'boolean',
        'classification_date'  => 'date',
    ];

    protected $attributes = [
        'is_second_opinion'    => false,
        'classification_status'=> 'Approved',
    ];

    /**
     * Automatically keep has_classified in sync on supported classifiable models.
     * One classifiable (e.g. Film, Season, Literature, etc.) has at most one Classification.
     */
    protected static function booted()
    {
        static::created(function (Classification $classification) {
            $model = $classification->classifiable;

            if (static::supportsHasClassified($model)) {
                $model->update(['has_classified' => true]);
            }
        });

        static::deleted(function (Classification $classification) {
            $model = $classification->classifiable;

            if (static::supportsHasClassified($model)) {
                $model->update(['has_classified' => false]);
            }
        });
    }

    /**
     * Only flip has_classified for the content models we care about.
     */
    protected static function supportsHasClassified($model): bool
    {
        if (! $model) {
            return false;
        }

        $isSupportedType =
            $model instanceof Film
            || $model instanceof TvSeriesSeason
            || $model instanceof Literature
            || $model instanceof AdvertisementMatter
            || $model instanceof Audio
            || $model instanceof VideoGaming;

        return $isSupportedType && $model->isFillable('has_classified');
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function classifiable(): MorphTo
    {
        return $this->morphTo();
    }

    public function rating(): BelongsTo
    {
        return $this->belongsTo(ClassificationRating::class, 'classification_rating_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ClassificationCategory::class, 'classification_category_id');
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(PremisesOwner::class, 'owner_id');
    }

    /**
     * Virtual "film" attribute so Blade can use $classification->film->film_title.
     */
    public function getFilmAttribute()
    {
        if ($this->classifiable_type === Film::class) {
            return $this->classifiable;
        }

        return null;
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors / View Helpers
    |--------------------------------------------------------------------------
    */

    public function getItemTitleAttribute(): string
    {
        if (! $this->classifiable) {
            return 'N/A';
        }

        switch ($this->classifiable_type) {
            case Film::class:
                return $this->classifiable->display_title
                    ?? $this->classifiable->film_title
                    ?? 'N/A';

            case TvSeriesSeason::class:
                return $this->classifiable->display_title
                    ?? ($this->classifiable->season_title
                        ?? $this->classifiable->tv_series_title
                        ?? 'N/A');

            case Literature::class:
                return $this->classifiable->display_title
                    ?? $this->classifiable->literature_title
                    ?? 'N/A';

            case AdvertisementMatter::class:
                return $this->classifiable->display_title
                    ?? $this->classifiable->advertising_matter
                    ?? 'N/A';

            case Audio::class:
                return $this->classifiable->display_title
                    ?? $this->classifiable->audio_title
                    ?? $this->classifiable->title
                    ?? 'N/A';

            case VideoGaming::class:
                return $this->classifiable->display_title
                    ?? $this->classifiable->video_game_title
                    ?? $this->classifiable->title
                    ?? 'N/A';

            default:
                return $this->classifiable->display_title
                    ?? $this->classifiable->title
                    ?? $this->classifiable->name
                    ?? 'N/A';
        }
    }

    public function getMediaTypeLabelAttribute(): string
    {
        switch ($this->classifiable_type) {
            case Film::class:
                return 'Film';
            case TvSeriesSeason::class:
                return 'TV Series';
            case Literature::class:
                return 'Literature';
            case AdvertisementMatter::class:
                return 'Advertisement';
            case Audio::class:
                return 'Audio';
            case VideoGaming::class:
                return 'Video Game';
            default:
                return class_basename($this->classifiable_type ?? 'Item');
        }
    }

    public function getDisplayTitleAttribute(): string
    {
        return $this->media_type_label . ' – ' . $this->item_title;
    }

    public function getStatusBadgeColorAttribute(): string
    {
        return match ($this->classification_status) {
            'Approved' => 'bg-green-100 text-green-800',
            'Rejected' => 'bg-red-100 text-red-800',
            default    => 'bg-gray-100 text-gray-800',
        };
    }

    /*
    |--------------------------------------------------------------------------
    | Backwards-compatible helper methods
    |--------------------------------------------------------------------------
    */

    public function getClassifiableTitle(): string
    {
        return $this->item_title;
    }

    public function getClassifiableTypeName(): string
    {
        return $this->media_type_label;
    }

    public function getStatusBadgeColor(): string
    {
        return $this->status_badge_color;
    }
}
