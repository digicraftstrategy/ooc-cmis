<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PremisesOwnerType extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'description'
    ];

    public function premises_owners(): HasMany
    {
        return $this->hasMany(PremisesOwner::class, 'premises_owner_type_id');
    }
}
