<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\str;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Role extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($role) {
            if (empty($role->slug)) {
                $role->slug = Str::slug($role->name);
            }
        });

        static::updating(function ($role) {
            if ($role->isDirty('name') && empty($role->slug)) {
                $role->slug = Str::slug($role->name);
            }
        });
    }

    /**
     * Get the users that belong to this role.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions', 'role_id', 'permission_id');
    }
    public function permission(): HasManyThrough
    {
        return $this->hasManyThrough(
            Permission::class,
            RolePermission::class,
            'role_id',                // Foreign key on intermediate table (RolePermission) that references this model
            'id',                     // Foreign key on target table (Permissions)
            'id',                     // Local key on this model
            'permission_id'
        );
    }

    public function hasPermission($permissionSlug)
    {

        return $this->permission->slug === $permissionSlug;
    }

    public function hasAnyPermission(array $permissionSlugs): bool
    {
        return $this->permissions()
            ->whereIn('slug', $permissionSlugs)
            ->exists();
    }

    /**
     * Get formatted status for display.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
