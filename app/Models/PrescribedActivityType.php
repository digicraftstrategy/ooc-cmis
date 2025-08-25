<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PrescribedActivityType extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'description'
    ];

    public function prescribedActivities()
    {
        return $this->hasMany(PrescribedActivity::class, 'prescribed_activity_type_id');
    }
}
