<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class TvSeries extends Model
{
    use HasFactory;
    // use SoftDeletes;

    /** Explicit table name (matches your migration) */
    protected $table = 'tv_serieses';

    /** Mass-assignable fields (mirrors migration) */
    protected $fillable = [
        'tv_series_title',
        'slug',
        //'season_number',
       // 'season_title',
       // 'number_of_episodes',
       // 'duration',            // minutes
       // 'release_year',
       // 'casts',
       // 'director',
      //  'producer',
      //  'production_company',
       // 'genre',
       // 'language',
       // 'has_subtitle',
       // 'theme',
       // 'poster_path',
    ];

    /** Casts to keep types consistent with Film */
    protected $casts = [
        'has_subtitle'   => 'boolean',
        'release_year'   => 'integer',
        'season_number'  => 'integer',
        'duration'       => 'integer',
    ];

    /** Polymorphic classification */
    public function classification()
    {
        return $this->morphOne(Classification::class, 'classifiable');
    }

    /** Relationship to seasons */
    public function seasons(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(TvSeriesSeason::class);
    }

    /** Slug auto-generation (like Film) */
    protected static function booted(): void
    {
        static::creating(function (TvSeries $series) {
            if (blank($series->slug)) {
                $series->slug = Str::slug($series->tv_series_title);
            }
        });
    }

    /** Use slug for route model binding (like Film) */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected function posterPath(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? asset('storage/'.$value) : null,
        );
    }

    /** Search scope (aligns with your naming) */
    public function scopeSearch($q, ?string $term)
    {
        return $q->when($term, fn ($qq) => $qq->where('tv_series_title', 'like', "%{$term}%"));
    }

    /** UI helper parity with Film */
    public function getTitleForListAttribute(): string
    {
        return $this->tv_series_title ?? '';
    }
}

