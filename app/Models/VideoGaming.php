<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/*class VideoGaming extends Model
{
    use HasFactory;

    /**
     * Force Eloquent to use the existing table name.
     */
    /*protected $table = 'video_games'; // ← IMPORTANT

    protected $fillable = [
        'video_game_title','slug','main_characters','developer','publisher',
        'release_year','release_date','genre','platform','average_playtime',
        'game_mode','language','has_subtitle','cover_art_url'
    ];

    public function classification()
    {
        return $this->morphOne(Classification::class, 'classifiable')->latestOfMany();
    }
}*/
//<?php

//namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class VideoGaming extends Model
{
    protected $table = 'video_games'; // IMPORTANT: because model name is VideoGaming
    protected $fillable = [
        'video_game_title','slug','main_characters','developer','publisher',
        'release_year','release_date','genre','platform','average_playtime',
        'game_mode','language','has_subtitle','cover_art_url'
    ];

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

