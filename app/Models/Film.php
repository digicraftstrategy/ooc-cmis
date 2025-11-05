<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $fillable = [
        'film_title',
        'slug',
        'main_actor_actress',
        'director',
        'producer',
        'production_company',
        'release_year',
        'genre',
        'language',
        'duration',
        'subtitle',
        'theme',
        'film_type_id',
    ];

    public function filmType(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(FilmType::class);
    }
}
