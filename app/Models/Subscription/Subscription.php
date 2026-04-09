<?php

namespace App\Models\Subscription;

use App\Models\VillageBanking\VillageBank;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;

class Subscription extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = 'subscriptions';

    protected $fillable = [
        'village_bank_id', 'subscription_plan_id', 'status',
        'starts_at', 'ends_at', 'auto_renew',
    ];

    protected $casts = [
        'starts_at'  => 'datetime',
        'ends_at'    => 'datetime',
        'auto_renew' => 'boolean',
    ];

    /* ── Relationships ────────────────── */

    public function villageBank()
    {
        return $this->belongsTo(VillageBank::class);
    }

    public function plan()
    {
        return $this->belongsTo(SubscriptionPlan::class, 'subscription_plan_id');
    }

    public function payments()
    {
        return $this->hasMany(SubscriptionPayment::class);
    }

    public function license()
    {
        return $this->hasOne(License::class);
    }

    /* ── Helpers ──────────────────────── */

    public function isActive(): bool
    {
        return $this->status === 'active' && $this->ends_at && $this->ends_at->isFuture();
    }

    public function daysRemaining(): int
    {
        if (!$this->ends_at) return 0;
        return max(0, (int) now()->diffInDays($this->ends_at, false));
    }

    public function isExpiringSoon(int $withinDays = 14): bool
    {
        return $this->isActive() && $this->daysRemaining() <= $withinDays;
    }
}
