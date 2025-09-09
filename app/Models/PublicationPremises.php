<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PublicationPremises extends Model
{
    use HasFactory;

    protected $table = 'premises';

    protected $fillable = [
        'uuid',
        'premises_name',
        'business_registration_no',
        'contact_person',
        'location',
        'address',
        'telephone',
        'mobile',
        'status',
        'premises_owner_id',
        'province_id',
        'prescribed_activity_id' // Keep this for backward compatibility if needed
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

    // Keep the old belongsTo relationship for backward compatibility if needed
    public function prescribedActivity(): BelongsTo
    {
        return $this->belongsTo(PrescribedActivity::class, 'prescribed_activity_id');
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
