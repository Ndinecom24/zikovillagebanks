<?php

namespace App\Models\VillageBanking;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialFundUsage extends Model
{
    use HasFactory;

    protected $table = 'social_fund_usages';

    protected $fillable = [
        'social_fund_id',
        'type',
        'description',
        'amount',
        'recipient',
        'usage_date',
        'recorded_by',
        'notes',
    ];

    protected $casts = [
        'amount'     => 'decimal:2',
        'usage_date' => 'date',
    ];

    /* ── Relationships ────────────────── */

    public function socialFund()
    {
        return $this->belongsTo(SocialFund::class);
    }

    public function recorder()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }

    /* ── Accessors ────────────────────── */

    public function getTypeLabelAttribute(): string
    {
        return match ($this->type) {
            'shareout' => 'Share Out',
            'donation' => 'Donation',
            'payment'  => 'Payment',
            default    => 'Other',
        };
    }

    public function getTypeBadgeClassAttribute(): string
    {
        return match ($this->type) {
            'shareout' => 'badge-success',
            'donation' => 'badge-info',
            'payment'  => 'badge-warning',
            default    => 'badge-secondary',
        };
    }
}
