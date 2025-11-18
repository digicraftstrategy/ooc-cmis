<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        ];

    // If later you add user_id:
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    public function getDisplayTitleAttribute(): string
    {
        return $this->literature_title
            ?? $this->title
            ?? $this->name
            ?? 'Literature #'.$this->id;
    }
}
