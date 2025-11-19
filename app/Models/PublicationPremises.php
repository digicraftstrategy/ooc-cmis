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
        'latitude',
        'longitude',
        // 'prescribed_activity_id', // keep commented if you no longer use it
    ];

    /**
     * Accessors we want automatically on JSON/array output.
     */
    protected $appends = [
        'contact_information',
        'full_address',
        'is_operational',
        'is_ceased',
        'is_suspended',
        'activity_type',
    ];

    /**
     * Relationships
     */

    public function premises_owner(): BelongsTo
    {
        return $this->belongsTo(PremisesOwner::class, 'premises_owner_id');
    }

    /**
     * Province this premises belongs to.
     *
     * provinces table: id, code, name, region_id, ...
     */
    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    // Backwards-compatible alias, if you already used premises_province() in views/controllers
    public function premises_province(): BelongsTo
    {
        return $this->province();
    }

    /**
     * Many-to-many relationship with prescribed activities using pivot table.
     */
    public function prescribedActivities(): BelongsToMany
    {
        return $this->belongsToMany(
            PrescribedActivity::class,
            'premises_activities',
            'premises_id',
            'activity_activity_id'
        )->withTimestamps();
    }

    /**
     * Fallback one-to-many style relationship (legacy).
     */
    public function prescribedActivity(): BelongsTo
    {
        return $this->belongsTo(PrescribedActivity::class, 'prescribed_activity_id');
    }

    /**
     * Derived properties
     */

    public function getActivityTypeAttribute()
    {
        // Prefer many-to-many
        if ($this->relationLoaded('prescribedActivities') && $this->prescribedActivities->count() > 0) {
            return $this->prescribedActivities->first()->activity_type;
        }

        // Fallback to legacy single relationship
        return $this->prescribedActivity->activity_type ?? 'N/A';
    }

    // Contact info helper
    public function getContactInformationAttribute(): string
    {
        $contactInfo = [];

        if ($this->telephone) {
            $contactInfo[] = "Tel: {$this->telephone}";
        }
        if ($this->mobile) {
            $contactInfo[] = "Mobile: {$this->mobile}";
        }

        return implode(', ', $contactInfo) ?: 'No contact information available';
    }

    // Full address helper (uses province relationship)
    public function getFullAddressAttribute(): string
    {
        $addressParts = array_filter([
            $this->address,
            $this->location,
            optional($this->province)->name,
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

    /**
     * Model boot: auto-generate UUID if missing.
     */
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

    /**
     * Scopes (handy for analytics / map)
     */

    public function scopeOperational($query)
    {
        return $query->where('status', 'operational');
    }

    public function scopeByProvince($query, int $provinceId)
    {
        return $query->where('province_id', $provinceId);
    }

    protected static function booted()
    {
        static::created(function ($premises) {
            dispatch(function () use ($premises) {
                \App\Helpers\GeocodeHelper::geocodePremises($premises);
            })->afterResponse();
        });
    }

}
