<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // app/Models/User.php

    public function role()
    {
        return $this->belongsTo(Role::class); // SON Add this line
    }

    public function isRole(string $slug): bool
    {
        return $this->role && $this->role->slug === $slug; // SON Add this line
    }

    public function isAdmin(): bool
    {
        return $this->isRole('admin'); // SON Add this line
    }

    public function isSuperAdmin(): bool
    {
        return $this->isRole('super-admin');
    }
    /*public function hasRole(string $slug): bool
        {
        return $this->role && $this->role->slug === $slug;
    }*/

    // If later you want to allow multiple roles at once
    public function hasAnyRole(array $slugs): bool
    {
        return $this->role && in_array($this->role->slug, $slugs); // SON Add this line
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role_id',
        'account_status_id',
        'user_type_id',
        //'company_owner_id',
        'uuid',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
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

    public function user_type(): BelongsTo
    {
        return $this->belongsTo(UserType::class);
    }

    public function account_status(): BelongsTo
    {
        return $this->belongsTo(AccountStatus::class);
    }
}
