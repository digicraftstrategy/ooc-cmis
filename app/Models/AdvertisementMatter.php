<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvertisementMatter extends Model
{
    protected $fillable = [
    'advertising_matter',
    'slug',
    'description',
    'casts','director',
    'producer',
    'production_company',
    'client_company',
    'release_year',
    'duration',
    'genre',
    'language',
    'has_subtitle',
    'brand_promoted',
    'product_promoted',
    'theme',
    'user_id',
    'has_classified'
    ];

    protected $casts = [
        'has_classified' => 'boolean',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function classification()
    {
        return $this->morphOne(Classification::class, 'classifiable');
    }

    public function scopeSearch($q, $term)
    {
        return $q->when($term, fn($qq) => $qq->where('advertising_matter', 'like', "%{$term}%"));
    }

    public function getTitleForListAttribute(): string
    {
        return $this->advertising_matter ?? '';
    }

    public function getDisplayTitleAttribute(): string
    {
        return $this->advertising_matter
            ?? $this->title
            ?? $this->name
            ?? 'Advertisement #'.$this->id;
    }
}

