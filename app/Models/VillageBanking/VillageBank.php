<?php

namespace App\Models\VillageBanking;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;

class VillageBank extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = 'village_banks';

    protected $fillable = [
        'name',
        'code',
        'description',
        'logo',
        'address',
        'phone',
        'email',
        'status',
        'created_by',
    ];

    /* ── Relationships ────────────────── */

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'village_bank_members')
                    ->using(VillageBankMember::class)
                    ->withPivot('role', 'joined_at')
                    ->withTimestamps();
    }

    public function admins()
    {
        return $this->members()->wherePivot('role', 'admin');
    }

    public function bankMemberships()
    {
        return $this->hasMany(VillageBankMember::class);
    }

    public function circles()
    {
        return $this->hasMany(Circle::class);
    }

    public function rules()
    {
        return $this->hasMany(Rule::class)->orderBy('sort_order');
    }

    public function activeRules()
    {
        return $this->rules()->where('is_active', true);
    }

    public function constitution()
    {
        return $this->hasOne(Constitution::class);
    }

    public function configuration()
    {
        return $this->hasOne(VillageBankConfiguration::class);
    }

    /**
     * Get config or create default if none exists.
     */
    public function getOrCreateConfig(): VillageBankConfiguration
    {
        return VillageBankConfiguration::forBank($this->id);
    }

    public function polls()
    {
        return $this->hasMany(Poll::class)->orderByDesc('created_at');
    }

    public function accounts()
    {
        return $this->hasMany(VillageBankAccount::class)->orderBy('sort_order');
    }

    public function activeAccounts()
    {
        return $this->accounts()->where('is_active', true);
    }

    public function monthConfigs()
    {
        return $this->hasMany(VillageBankMonthConfig::class)->orderBy('month_number');
    }

    /* ── Scoped queries through circles ── */

    public function months()
    {
        return $this->hasManyThrough(Month::class, Circle::class);
    }

    public function loans()
    {
        return Loan::whereHas('month.circle', fn ($q) => $q->where('village_bank_id', $this->id));
    }

    public function shareouts()
    {
        return $this->hasManyThrough(Shareout::class, Circle::class);
    }

    /* ── Subscription & License ── */

    public function subscriptions()
    {
        return $this->hasMany(\App\Models\Subscription\Subscription::class);
    }

    public function activeSubscription()
    {
        return $this->hasOne(\App\Models\Subscription\Subscription::class)
            ->where('status', 'active')
            ->latest();
    }

    public function licenses()
    {
        return $this->hasMany(\App\Models\Subscription\License::class);
    }

    public function activeLicense()
    {
        return $this->hasOne(\App\Models\Subscription\License::class)
            ->where('status', 'active')
            ->where('expires_at', '>', now())
            ->latest();
    }

    /* ── Constitution & Compliance ────── */

    /**
     * Does this bank have a constitution uploaded/created?
     */
    public function hasConstitution(): bool
    {
        return $this->constitution()->exists();
    }

    /**
     * Is the constitution feature enabled in config?
     */
    public function isConstitutionEnabled(): bool
    {
        $config = $this->configuration ?? $this->getOrCreateConfig();
        return (bool) $config->constitution_enabled;
    }

    /**
     * Check if a user (member) is fully compliant to operate.
     */
    public function isMemberCompliant(int $userId): bool
    {
        $membership = $this->bankMemberships()->where('user_id', $userId)->first();
        if (! $membership) return false;

        return $membership->isCompliant();
    }

    /**
     * Get compliance gaps for a user.
     */
    public function memberComplianceGaps(int $userId): array
    {
        $membership = $this->bankMemberships()->where('user_id', $userId)->first();
        if (! $membership) return ['You are not a member of this village bank.'];

        return $membership->complianceGaps();
    }
}
