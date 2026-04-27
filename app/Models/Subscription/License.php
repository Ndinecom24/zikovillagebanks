<?php

namespace App\Models\Subscription;

use App\Models\VillageBanking\VillageBank;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Traits\LogsActivity;

class License extends Model
{
    use HasFactory;
    use LogsActivity;
    use SoftDeletes;

    protected $table = 'licenses';

    protected $fillable = [
        'village_bank_id', 'subscription_id', 'license_key',
        'status', 'issued_at', 'expires_at',
        'revoked_at', 'revoke_reason',
    ];

    protected $casts = [
        'issued_at'  => 'datetime',
        'expires_at' => 'datetime',
        'revoked_at' => 'datetime',
    ];

    /* ── Relationships ────────────────── */

    public function villageBank()
    {
        return $this->belongsTo(VillageBank::class);
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    /* ── Helpers ──────────────────────── */

    public static function generateKey(): string
    {
        return 'VB-' . strtoupper(Str::random(4)) . '-' . strtoupper(Str::random(4)) . '-' . strtoupper(Str::random(4));
    }

    public function isValid(): bool
    {
        return $this->status === 'active' && $this->expires_at && $this->expires_at->isFuture();
    }

    public function daysRemaining(): int
    {
        if (!$this->expires_at) {
            return 0;
        }
        return max(0, (int) now()->diffInDays($this->expires_at, false));
    }

    public function isExpiringSoon(int $withinDays = 14): bool
    {
        return $this->isValid() && $this->daysRemaining() <= $withinDays;
    }
}
