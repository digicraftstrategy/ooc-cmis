<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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
     * The accessors to append to the model's array form.
     */
    protected $appends = ['icon_url'];

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
     * Relationships to classifications that use this rating
     */
    public function classifications(): HasMany
    {
        return $this->hasMany(Classification::class, 'classification_rating_id');
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
        return !$this->films()->exists() && !$this->classifications()->exists();
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
     * Get the full URL to the icon with multiple fallback strategies
     */
    public function getIconUrlAttribute(): ?string
    {
        if (!$this->icon_path) {
            return null;
        }

        // If it's already a full URL (external image), return as is
        if (filter_var($this->icon_path, FILTER_VALIDATE_URL)) {
            return $this->icon_path;
        }

        // Check if the file exists in storage
        if (Storage::disk('public')->exists($this->icon_path)) {
            return Storage::disk('public')->url($this->icon_path);
        }

        // Check if it's a relative path in public directory
        $publicPath = public_path($this->icon_path);
        if (file_exists($publicPath)) {
            return asset($this->icon_path);
        }

        // If using the storage path format without disk
        if (str_starts_with($this->icon_path, 'classification-ratings/')) {
            return Storage::disk('public')->url($this->icon_path);
        }

        // Final fallback - try asset with storage path
        return asset('storage/' . ltrim($this->icon_path, '/'));
    }

    /**
     * Check if the icon file actually exists
     */
    public function iconExists(): bool
    {
        if (!$this->icon_path) {
            return false;
        }

        if (filter_var($this->icon_path, FILTER_VALIDATE_URL)) {
            return $this->checkRemoteFileExists($this->icon_path);
        }

        // Check local storage
        if (Storage::disk('public')->exists($this->icon_path)) {
            return true;
        }

        // Check public directory
        if (file_exists(public_path($this->icon_path))) {
            return true;
        }

        return false;
    }

    /**
     * Check if a remote file exists
     */
    private function checkRemoteFileExists(string $url): bool
    {
        try {
            $headers = @get_headers($url);
            return $headers && strpos($headers[0], '200') !== false;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Delete the associated icon file
     */
    public function deleteIconFile(): bool
    {
        if (!$this->icon_path || filter_var($this->icon_path, FILTER_VALIDATE_URL)) {
            return false;
        }

        try {
            if (Storage::disk('public')->exists($this->icon_path)) {
                return Storage::disk('public')->delete($this->icon_path);
            }
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Get a fallback icon based on rating
     */
    public function getFallbackIcon(): string
    {
        // Create a simple fallback icon using the first 2 characters
        $abbreviation = strtoupper(substr($this->rating, 0, 2));

        // You could also map specific ratings to colors
        $colorMap = [
            'G' => 'green',
            'PG' => 'blue',
            'M' => 'yellow',
            'R' => 'orange',
            'X' => 'red',
        ];

        $color = $colorMap[strtoupper($this->rating)] ?? 'blue';

        return "<div class='w-12 h-12 flex items-center justify-center bg-{$color}-100 rounded-lg border border-{$color}-200'>
            <span class='text-sm font-bold text-{$color}-700'>{$abbreviation}</span>
        </div>";
    }
}
