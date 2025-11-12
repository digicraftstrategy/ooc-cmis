<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TvSeriesSeason extends Model
{
    use HasFactory;

    protected $table = 'seasons';

     protected $fillable = [
        'tv_series_id',
        'season_title',
        'slug',
        'season_number',
        'number_of_episodes',
        'duration',
        'theme',
    ];

    public function tv_series(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(TvSeries::class, 'tv_series_id');
    }
}
