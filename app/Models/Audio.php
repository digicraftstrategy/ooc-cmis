<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{
    protected $table = 'audios';

    protected $fillable = ['title','artist','album','release_year','genre','language',
        'duration','has_subtitle','cover_art_url','description',];

    public function classification()
    {
        return $this->morphOne(Classification::class, 'classifiable');
    }

    public function scopeSearch($q, $term)
    {
        // Replace 'title' with your actual main column, e.g. 'audio_title'
        return $q->when($term, fn($qq) => $qq->where('title', 'like', "%{$term}%"));
    }

    public function getTitleForListAttribute(): string
    {
        // return $this->audio_title ?? '';
        return $this->title ?? '';
    }
}
