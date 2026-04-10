<?php

namespace App\Models\VillageBanking;

use App\Models\User;
use App\Traits\ScopedToVillageBank;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialFund extends Model
{
    use HasFactory;
    use ScopedToVillageBank;

    public string $villageBankScopeTier = 'circle';

    protected $table = 'social_funds';

    protected $fillable = [
        'circle_id',
        'shareout_id',
        'total_insurance_profit',
        'total_penalties',
        'total_fund',
        'total_used',
        'total_remaining',
        'status',
    ];

    protected $casts = [
        'total_insurance_profit' => 'decimal:2',
        'total_penalties'        => 'decimal:2',
        'total_fund'             => 'decimal:2',
        'total_used'             => 'decimal:2',
        'total_remaining'        => 'decimal:2',
    ];

    /* ── Relationships ────────────────── */

    public function circle()
    {
        return $this->belongsTo(Circle::class);
    }

    public function shareout()
    {
        return $this->belongsTo(Shareout::class);
    }

    public function usages()
    {
        return $this->hasMany(SocialFundUsage::class);
    }

    /* ── Helpers ──────────────────────── */

    /**
     * Recalculate totals from usage records.
     */
    public function recalculate(): void
    {
        $this->total_used      = round($this->usages()->sum('amount'), 2);
        $this->total_remaining = round($this->total_fund - $this->total_used, 2);
        $this->status          = $this->total_remaining <= 0 ? 'depleted' : 'active';
        $this->save();
    }
}
