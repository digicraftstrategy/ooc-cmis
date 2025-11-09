<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/*class AdvertisementMatter extends Model
{
    use HasFactory;

    protected $fillable = [
        'advertising_matter','slug','description','main_actor_actress','director','producer',
        'production_company','client_company','release_year','duration','genre','language',
        'has_subtitle','brand_promoted','product_promoted','theme'
    ];

    public function classification()
    {
        return $this->morphOne(Classification::class, 'classifiable')->latestOfMany();
    }
}*/
//<?php

//namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class AdvertisementMatter extends Model
{
    protected $fillable = [
        'advertising_matter','slug','description','main_actor_actress','director','producer',
        'production_company','client_company','release_year','duration','genre','language',
        'has_subtitle','brand_promoted','product_promoted','theme'
    ];

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
}
