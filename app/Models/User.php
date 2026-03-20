<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\HasRolesAndPermissions;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRolesAndPermissions;
    use SoftDeletes;
        /**
         * The attributes that are mass assignable.
         *
         * @var array<int, string>
         */
    protected $table = 'users';

    protected $fillable = [

        'name',
        'staff_no',
        'directorate',
        'email',
        'avatar',
        'job_title',
        'user_unit',

        'mobile_no',
        'user_role_id',
        'password',
        'password_changed',
        'total_login',
        'uuid'
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
    ];

    /* ── Relationships ────────────────── */

    /**
     * Offices this user belongs to.
     */
    public function offices()
    {
        return $this->belongsToMany(ResponsibleOffices::class, 'office_user', 'user_id', 'office_id')
                    ->withPivot('role_in_office')
                    ->withTimestamps();
    }
}
