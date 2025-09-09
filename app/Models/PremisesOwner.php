<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PremisesOwner extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'owners_name',
        'phone',
        'address',
        'email',
        'premises_owner_type_id'
    ];

    public function premises_type(): BelongsTo
    {
        return $this->belongsTo(PremisesOwnerType::class, 'premises_owner_type_id');
    }

    public function publication_premises(): HasMany
    {
        return $this->hasMany(PublicationPremises::class, 'premises_owner_id');
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
