<?php

namespace App\Models\VillageBanking;

use App\Traits\ScopedToVillageBank;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VillageBankAccount extends Model
{
    use HasFactory;
    use ScopedToVillageBank;

    public string $villageBankScopeTier = 'direct';

    protected $table = 'village_bank_accounts';

    protected $fillable = [
        'village_bank_id',
        'account_type',
        'provider_name',
        'account_name',
        'account_number',
        'branch',
        'is_active',
        'is_primary',
        'sort_order',
    ];

    protected $casts = [
        'is_active'  => 'boolean',
        'is_primary' => 'boolean',
        'sort_order' => 'integer',
    ];

    /* ── Relationships ────────────────── */

    public function villageBank()
    {
        return $this->belongsTo(VillageBank::class);
    }

    /* ── Scopes ───────────────────────── */

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopePrimary($query)
    {
        return $query->where('is_primary', true);
    }

    /* ── Helpers ──────────────────────── */

    public function getDisplayTypeAttribute(): string
    {
        return $this->account_type === 'mobile_money' ? 'Mobile Money' : 'Bank Account';
    }
}
