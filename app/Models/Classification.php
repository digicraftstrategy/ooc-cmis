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
     * Automatically keep has_classified in sync on the classifiable model.
     * One classifiable (e.g. Film) has at most one Classification.
     */
    protected static function booted()
    {
        static::created(function (Classification $classification) {
            $model = $classification->classifiable;

            if ($model && $model->isFillable('has_classified')) {
                $model->update(['has_classified' => true]);
            }
        });

        static::deleted(function (Classification $classification) {
            $model = $classification->classifiable;

            if ($model && $model->isFillable('has_classified')) {
                $model->update(['has_classified' => false]);
            }
        });
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
     * This does NOT run another query – it just reuses the polymorphic relation.
     */
    public function getFilmAttribute()
    {
        if ($this->classifiable_type === Film::class) {
            return $this->classifiable; // already a Film instance when loaded
        }

        return null;
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors / View Helpers
    |--------------------------------------------------------------------------
    |
    | These give you nice properties like:
    | - $classification->item_title
    | - $classification->media_type_label
    | - $classification->display_title
    | - $classification->status_badge_color
    |
    | And the older helper methods now just proxy to these accessors.
    |
    */

    /**
     * Title of the underlying item (Film, Season, Literature, etc.).
     * Usage: $classification->item_title
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

            default:
                return $this->classifiable->display_title
                    ?? $this->classifiable->title
                    ?? $this->classifiable->name
                    ?? 'N/A';
        }
    }

    /**
     * Human-readable media type.
     * Usage: $classification->media_type_label
     */
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
            default:
                return class_basename($this->classifiable_type ?? 'Item');
        }
    }

    /**
     * Combined label, e.g. "Film – The Lion King"
     * Usage: $classification->display_title
     */
    public function getDisplayTitleAttribute(): string
    {
        return $this->media_type_label . ' – ' . $this->item_title;
    }

    /**
     * Status badge color classes (Tailwind).
     * Usage: $classification->status_badge_color
     */
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

    /**
     * For compatibility with existing Blade.
     */
    public function getStatusBadgeColor(): string
    {
        return $this->status_badge_color;
    }
}
