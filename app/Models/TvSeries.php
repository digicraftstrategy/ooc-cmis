<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/*class TvSeries extends Model
{
    use HasFactory;

    protected $fillable = [
        'title','slug','genre','language','production_company','release_year',
    ];

    public function classification()
    {
        return $this->morphOne(Classification::class, 'classifiable')->latestOfMany();
    }
}*/

//<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TvSeries extends Model
{
    protected $fillable = ['title','slug','genre','language','production_company','release_year', /* add your columns */];

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
