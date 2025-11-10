<?php

/*namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilmType extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'slug',
        'description',
    ];

    public function films(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Film::class);
    }
}*/

//<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilmType extends Model
{
    use HasFactory;

    protected $fillable = ['type','slug','description'];

    public function films()
    {
        return $this->hasMany(Film::class);
    }
}

