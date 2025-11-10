<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TvSeries extends Model
{
    protected $table = 'tv_serieses';
    protected $fillable = [
        'title','slug','genre','language','production_company','release_year', /* add your columns */];

    public function classification()
    {
        return $this->morphOne(Classification::class, 'classifiable');
    }

    public function scopeSearch($q, $term)
    {
        return $q->when($term, fn($qq) => $qq->where('title', 'like', "%{$term}%"));
    }

    public function getTitleForListAttribute(): string
    {
        return $this->title ?? '';
    }
}
