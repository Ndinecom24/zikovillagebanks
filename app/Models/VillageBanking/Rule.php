<?php

namespace App\Models\VillageBanking;

use App\Models\User;
use App\Traits\ScopedToVillageBank;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    use HasFactory;
    use ScopedToVillageBank;

    public string $villageBankScopeTier = 'direct';

    protected $table = 'village_bank_rules';

    protected $fillable = [
        'village_bank_id',
        'title',
        'description',
        'category',
        'sort_order',
        'is_active',
        'created_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public const CATEGORIES = [
        'general'    => 'General',
        'loans'      => 'Loans',
        'shares'     => 'Shares & Contributions',
        'penalties'  => 'Penalties & Fines',
        'membership' => 'Membership',
        'meetings'   => 'Meetings',
    ];

    /* ── Relationships ────────────────── */

    public function villageBank()
    {
        return $this->belongsTo(VillageBank::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function acknowledgements()
    {
        return $this->hasMany(RuleAcknowledgement::class, 'rule_id');
    }

    public function acknowledgedUsers()
    {
        return $this->belongsToMany(User::class, 'rule_acknowledgements', 'rule_id', 'user_id')
                    ->withPivot('acknowledged_at')
                    ->withTimestamps();
    }

    /* ── Helpers ──────────────────────── */

    public function isAcknowledgedBy($userId): bool
    {
        return $this->acknowledgements()->where('user_id', $userId)->exists();
    }

    public function acknowledgementRate(): float
    {
        $totalMembers = $this->villageBank->members()->count();
        if ($totalMembers === 0) return 0;

        $acked = $this->acknowledgements()->count();
        return round(($acked / $totalMembers) * 100, 1);
    }
}
