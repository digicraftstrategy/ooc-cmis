<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class TvSeriesSeason extends Model
{
    use HasFactory;

    protected $table = 'seasons';

    protected $fillable = [
        'tv_series_id',
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
        'poster_path'
    ];

    protected $casts = [
        //'casts' => 'array',
        //'genre' => 'array',
        'has_subtitle' => 'boolean',
        'release_year' => 'integer',
        'season_number' => 'integer',
        //'number_of_episodes' => 'integer',
    ];

    public function tvSeries(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(TvSeries::class, 'tv_series_id');
    }

    public function episodes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(TvSeriesEpisode::class, 'season_id');
    }

    // Accessor for poster_path
    protected function posterPath(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? asset('storage/' . $value) : null,
        );
    }

    // Method to get full season title with series name
    public function getFullTitleAttribute(): string
    {
        return $this->tvSeries->title . ' - ' . $this->season_title;
    }

    // Method to check if season has episodes
    public function hasEpisodes(): bool
    {
        return $this->episodes()->exists();
    }

    // Scope for published seasons
    public function scopePublished($query)
    {
        return $query->where('released_year', '<=', now()->year);
    }

    // Scope for specific series
    public function scopeForSeries($query, $seriesId)
    {
        return $query->where('tv_series_id', $seriesId);
    }

    public function getDisplayTitleAttribute(): string
    {
        $seriesTitle = optional($this->tvSeries)->tv_series_title ?? 'TV Series';
        $seasonTitle = $this->season_title ?? 'Season';

        return "{$seriesTitle} - {$seasonTitle}";
    }
}
