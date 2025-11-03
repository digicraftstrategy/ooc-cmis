<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        //'prescribed_activity_id' // Keep this for backward compatibility if needed
    ];

    public function premises_owner(): BelongsTo
    {
        return $this->belongsTo(PremisesOwner::class, 'premises_owner_id');
    }

    public function premises_province(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    // Many-to-many relationship with prescribed activities using Pivot table
    public function prescribedActivities(): BelongsToMany
    {
        return $this->belongsToMany(PrescribedActivity::class,
        'premises_activities',
        'premises_id',
        'activity_activity_id'
        )->withTimestamps();
    }

    // Fallback to one-to-many relationship for backward compatibility if needed
    public function prescribedActivity(): BelongsTo
    {
        return $this->belongsTo(PrescribedActivity::class, 'prescribed_activity_id');
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

    // Accessor for contact information
    public function getContactInformationAttribute(): string
    {
        $contactInfo = [];

        if ($this->telephone) $contactInfo[] = "Tel: {$this->telephone}";
        if ($this->mobile) $contactInfo[] = "Mobile: {$this->mobile}";

        return implode(', ', $contactInfo) ?: 'No contact information available';
    }

    // Accessor for full address
    public function getFullAddressAttribute(): string
    {
        $addressParts = array_filter([
            $this->address,
            $this->location,
            $this->premises_province ? $this->premises_province->name : null,
        ]);

        return implode(', ', $addressParts) ?: 'No address available';
    }

    public function getIsOperationalAttribute(): bool
    {
        return $this->status === 'operational';
    }

    public function getIsCeasedAttribute(): bool
    {
        return $this->status === 'ceased';
    }

    public function getIsSuspendedAttribute(): bool
    {
        return $this->status === 'suspended';
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
