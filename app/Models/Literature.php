<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Literature extends Model
{
    use HasFactory;

    protected $fillable = [
            'literature_title',
            'slug',
            'author',
            'publisher',
            'publication_year',
            'pages',
            'genre',
            'summary',
            'cover_art_path',
            'has_classified'
        ];

    protected $casts = [
        'has_classified' => 'boolean',
    ];

    // If later you add user_id:
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    // Optional relationship to classification if you have it:
    public function classification(): MorphOne
    {
        return $this->morphOne(Classification::class, 'classifiable');
    }

    public function scopeClassified($query)
    {
        return $query->whereHas('classification');
    }

    public function scopeUnclassified($query)
    {
        return $query->whereDoesntHave('classification');
    }

    public function getDisplayTitleAttribute(): string
    {
        return $this->literature_title
            ?? $this->title
            ?? $this->name
            ?? 'Literature #'.$this->id;
    }
}
