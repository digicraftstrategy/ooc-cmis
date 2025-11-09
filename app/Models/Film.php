<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\FilmType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Classification;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

class Film extends Model
{

    use HasFactory, softDeletes;

    protected $fillable = [
        'film_title',
        'slug',
        'casts',
        'director',
        'producer',
        'production_company',
        'release_year',
        'genre',
        'language',
        'duration',
        'has_subtitle',
        'theme',
        'poster_path',
        'trailer_url',
        'film_type_id',
    ];

    // Attribute casting
    protected $casts = [
        'has_subtitle' => 'boolean',
        'release_year' => 'integer',
        'duration' => 'integer',
    ];

    
   

    public function classification()
    {
        return $this->morphOne(Classification::class, 'classifiable');
    }

    // Relationships to the film type that the film falls under
    public function filmType(): BelongsTo
    {
        return $this->belongsTo(FilmType::class, 'film_type_id');
    }

    // Automatically generate slug from film title when creating a new film
    protected static function booted()
    {
        static::creating(function ($film) {
            $film->slug = Str::slug($film->film_title);
        });
    }

    // Get the route key name for model binding, using slug instead of id
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Accessor for the poster path attribute
    protected function posterPath(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => asset('storage/' . $value),
        );
    }

    // Scope for filtering films by relaease year
    public function scopeReleaseYear($query, $year)
    {
        return $query->where('release_year', $year);
    }

    /** Optional helpers */
    public function scopeSearch($q, $term)
    {
        return $q->when($term, fn($qq) => $qq->where('film_title', 'like', "%{$term}%"));
    }

    public function getTitleForListAttribute(): string
    {
        return $this->film_title ?? '';
    }
}
