<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResponsibleOffices extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'responsible_offices';
    protected $fillable = ['responsible_office', 'office_status'];

    /* ── Relationships ────────────────── */

    /**
     * Users that belong to this office.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'office_user', 'office_id', 'user_id')
                    ->withPivot('role_in_office')
                    ->withTimestamps();
    }

    /**
     * Tasks assigned to this office (via task-management module).
     */
    public function tasks()
    {
        return $this->belongsToMany(\App\Models\ProcessTask::class, 'office_task', 'office_id', 'task_id')
                    ->withPivot('status', 'remarks', 'assigned_at');
    }

    /**
     * Roles assigned to this office.
     */
    public function roles()
    {
        return $this->belongsToMany(\App\Models\Role::class, 'role_office', 'office_id', 'role_id')->withTimestamps();
    }
}
