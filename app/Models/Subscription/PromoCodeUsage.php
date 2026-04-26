<?php

namespace App\Models\Subscription;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PromoCodeUsage extends Model
{
    use HasFactory;

    protected $fillable = [
        'promo_code_id',
        'village_bank_id',
        'subscription_id',
        'discount_applied',
    ];

    protected $casts = [
        'discount_applied' => 'decimal:2',
    ];

    /* ── Relationships ────────────────── */

    public function promoCode()
    {
        return $this->belongsTo(PromoCode::class);
    }

    public function villageBank()
    {
        return $this->belongsTo(\App\Models\VillageBanking\VillageBank::class);
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }
}
