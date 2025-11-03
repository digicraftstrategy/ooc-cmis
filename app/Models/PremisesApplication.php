<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PremisesApplication extends Model
{
    use HasFactory;

    protected $table = 'premises_applications';

    protected $fillable = [
        'application_number',
        'premises_owner_id',
        'premises_name',
        'application_status',
        'province_id',
    ];

    public function premises_owner(): BelongsTo
    {
        return $this->belongsTo(PremisesOwner::class, 'premises_owner_id');
    }

    public function premises_province(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    // Many-to-many relationship with prescribed activities
    public function prescribedActivities(): BelongsToMany
    {
        return $this->belongsToMany(PrescribedActivity::class, 'premises_activities', 'premises_id', 'activity_id')
                    ->withTimestamps();
    }


    public function getActivityTypeAttribute()
    {
        // Return the first activity if using many-to-many
        if ($this->prescribedActivities->count() > 0) {
            return $this->prescribedActivities->first()->activity_type;
        }

        // Fallback to the one-to-many relationship
        return $this->prescribedActivity->activity_type ?? 'N/A';
    }

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
}
