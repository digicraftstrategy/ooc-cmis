<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Classification;

class VideoGaming extends Model
{
    use HasFactory;
    protected $table = 'video_games'; // IMPORTANT: because model name is VideoGaming
    protected $fillable = [
        'video_game_title',
        'slug',
        'main_characters',
        'developer',
        'publisher',
        'release_year',
        'release_date',
        'genre',
        'platform',
        'average_playtime',
        'game_mode',        // 'Single-player','Multi-player','Both'
        'language',
        'has_subtitle',
        'cover_art_path', 
    ];

    protected $casts = [
        'release_date'     => 'date',
        'has_subtitle'     => 'boolean',
        'average_playtime' => 'integer',
    ];

    // If you want to track creator later:
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Optional relationship to classification if you have it:
    public function classification()
    {
        return $this->morphOne(Classification::class, 'classifiable');
    }

    public function scopeSearch($q, $term)
    {
        return $q->when($term, fn($qq) => $qq->where('video_game_title', 'like', "%{$term}%"));
    }

    public function getTitleForListAttribute(): string
    {
        return $this->video_game_title ?? '';
    }
}

