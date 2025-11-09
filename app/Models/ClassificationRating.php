<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassificationRating extends Model
{
    use HasFactory;

    protected $table = 'classification_ratings';

    protected $fillable = [
        'rating',
        'slug',
        'description',
        'icon_path',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::creating(function ($classificationRating) {
            // Generate slug from rating if not provided
            if (empty($classificationRating->slug)) {
                $classificationRating->slug = Str::slug($classificationRating->rating);
            }
        });

        static::updating(function ($classificationRating) {
            // Update slug if rating changed and slug wasn't manually modified
            if ($classificationRating->isDirty('rating') && !$classificationRating->isDirty('slug')) {
                $classificationRating->slug = Str::slug($classificationRating->rating);
            }
        });
    }

    /**
     * Relationships to films that have this classification rating
     */
    public function films(): HasMany
    {
        return $this->hasMany(Film::class, 'classification_rating_id');
    }

    /**
     * Scope a query to only include active classification ratings.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to order by rating.
     */
    public function scopeOrderByRating(Builder $query, string $direction = 'asc'): Builder
    {
        return $query->orderBy('rating', $direction);
    }

    /**
     * Scope a query to find by slug.
     */
    public function scopeWhereSlug(Builder $query, string $slug): Builder
    {
        return $query->where('slug', $slug);
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Check if rating can be deleted (has no associated films)
     */
    public function canBeDeleted(): bool
    {
        return !$this->films()->exists();
    }

    /**
     * Activate the classification rating
     */
    public function activate(): bool
    {
        return $this->update(['is_active' => true]);
    }

    /**
     * Deactivate the classification rating
     */
    public function deactivate(): bool
    {
        return $this->update(['is_active' => false]);
    }

    /**
     * Get the full URL to the icon
     */
    public function getIconUrlAttribute(): ?string
    {
        if (!$this->icon_path) {
            return null;
        }

        // Check if it's already a full URL
        if (filter_var($this->icon_path, FILTER_VALIDATE_URL)) {
            return $this->icon_path;
        }

        // Return storage URL for locally stored icons
        return asset('storage/' . ltrim($this->icon_path, '/'));
    }
}
