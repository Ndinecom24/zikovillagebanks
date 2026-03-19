<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description'];

    /**
     * The permissions that belong to the role.
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permission')->withTimestamps();
    }

    /**
     * The users that belong to the role.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user')->withTimestamps();
    }

    /**
     * Check if role has a specific permission.
     */
    public function hasPermission(string $slug): bool
    {
        return $this->permissions()->where('slug', $slug)->exists();
    }

    /**
     * Give a permission to this role.
     */
    public function givePermission(Permission $permission): void
    {
        if (!$this->hasPermission($permission->slug)) {
            $this->permissions()->attach($permission);
        }
    }

    /**
     * Revoke a permission from this role.
     */
    public function revokePermission(Permission $permission): void
    {
        $this->permissions()->detach($permission);
    }
}
