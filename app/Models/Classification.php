<?php

namespace App\Models;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Factories\HasFactory;
=======
>>>>>>> 3338ecc (Management Classifications.)
use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
<<<<<<< HEAD
    use HasFactory;
=======
    protected $fillable = [
        'classifiable_type','classifiable_id',
        'classification_rating_id','classification_status_id',
        'remarks','issued_at'
    ];

    public function classifiable()
    {
        return $this->morphTo();
    }

    public function rating()
    {
        return $this->belongsTo(ClassificationRating::class, 'classification_rating_id');
    }

    public function status()
    {
        return $this->belongsTo(ClassificationStatus::class, 'classification_status_id');
    }
>>>>>>> 3338ecc (Management Classifications.)
}
