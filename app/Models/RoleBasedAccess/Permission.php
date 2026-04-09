<?php

namespace App\Models\RoleBasedAccess;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;

class Permission extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = ['name', 'slug', 'description', 'group'];

    /**
     * The roles that belong to the permission.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permission')->withTimestamps();
    }
}
