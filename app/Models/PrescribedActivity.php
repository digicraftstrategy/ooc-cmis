<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
//use Illuminate\Database\Eloquent\SoftDeletes;

class PrescribedActivity extends Model
{
    use HasFactory; //SoftDeletes;

    protected $fillable = [
        'uuid',
        'activity_type',
        'prescribed_fee',
        //'description',
        'is_active',
        'prescribed_activity_type_id'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = self::generateUniqueUuid();
            }
        });
    }

    public static function generateUniqueUuid(): string
    {
        do {
            $uuid = strtoupper(bin2hex(random_bytes(48)) . uniqid());
            $exists = self::where('uuid', $uuid)->exists();
        } while ($exists);

        return $uuid;
    }

    public function prescribedType()
    {
        return $this->belongsTo(PrescribedActivityType::class, 'prescribed_activity_type_id');
    }
}
