<?php

namespace App\Models;

use App\Models\UserPaymentMethod;
use App\Models\VillageBanking\Circle;
use App\Models\VillageBanking\CircleMember;
use App\Models\VillageBanking\Loan;
use App\Models\VillageBanking\ShareDeclaration;
use App\Models\VillageBanking\VillageBank;
use App\Models\VillageBanking\VillageBankMember;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\HasRolesAndPermissions;
use App\Traits\LogsActivity;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRolesAndPermissions;
    use SoftDeletes;
    use LogsActivity;

    protected static string $activityLogName = 'User';
    protected static array $logExcept = ['password', 'remember_token', 'current_session_id', 'total_login'];

    protected $table = 'users';

    protected $fillable = [
        'name',
        'username',
        'email',
        'avatar',
        'nrc_photo',
        'passport_photo',
        // Employment
        'employment_status',
        'job_title',
        'company_name',
        'company_location',
        // Identity
        'date_of_birth',
        'gender',
        'national_id',
        // Contact
        'mobile_no',
        'phone',
        // Address
        'country',
        'province',
        'city',
        'home_address',
        // Next of Kin
        'nok_name',
        'nok_relationship',
        'nok_contact',
        'nok_address',
        // System
        'user_role_id',
        'password',
        'password_changed',
        'total_login',
        'uuid',
        'guarantor_id',
        'status',
        'current_session_id',
        // Legacy (kept for backward compat)
        'user_unit',
        'directorate',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'date_of_birth'     => 'date',
    ];

    /* ── Village Banking Relationships ── */

    /**
     * The guarantor for this member.
     */
    public function guarantor()
    {
        return $this->belongsTo(User::class, 'guarantor_id');
    }

    /**
     * Members this user guarantees.
     */
    public function guarantees()
    {
        return $this->hasMany(User::class, 'guarantor_id');
    }

    /**
     * Circles this user belongs to.
     */
    public function circles()
    {
        return $this->belongsToMany(Circle::class, 'circle_members')
                    ->using(CircleMember::class)
                    ->withPivot('joined_at');
    }

    /**
     * Loans where this user is the borrower.
     */
    public function loans()
    {
        return $this->hasMany(Loan::class, 'borrower_id');
    }

    /**
     * Share declarations for this user.
     */
    public function shareDeclarations()
    {
        return $this->hasMany(ShareDeclaration::class);
    }

    /**
     * Village Banks this user belongs to.
     */
    public function villageBanks()
    {
        return $this->belongsToMany(VillageBank::class, 'village_bank_members')
                    ->using(VillageBankMember::class)
                    ->withPivot('role', 'joined_at')
                    ->withTimestamps();
    }

    /**
     * Village Banks where user is admin.
     */
    public function adminVillageBanks()
    {
        return $this->villageBanks()->wherePivot('role', 'admin');
    }

    /**
     * Payment methods (bank accounts & mobile money) for this user.
     */
    public function paymentMethods()
    {
        return $this->hasMany(UserPaymentMethod::class)
                    ->orderByDesc('is_primary')
                    ->orderBy('created_at');
    }

    /**
     * The user's primary payment method (if any).
     */
    public function primaryPaymentMethod()
    {
        return $this->hasOne(UserPaymentMethod::class)
                    ->where('is_primary', true)
                    ->where('status', 'active');
    }

    /**
     * Send the password reset notification with a custom branded email.
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /* ── Role Helpers ───────────────────── */

    /**
     * Check if user is super admin (sees all banks/data).
     */
    public function isSuperAdmin(): bool
    {
        return (int) $this->user_role_id === 1;
    }

    /**
     * Get IDs of village banks this user belongs to.
     */
    public function villageBankIds(): array
    {
        return VillageBankMember::where('user_id', $this->id)
            ->pluck('village_bank_id')
            ->toArray();
    }
}
