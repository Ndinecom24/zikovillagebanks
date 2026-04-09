<?php

namespace App\Models\VillageBanking;

use App\Traits\ScopedToVillageBank;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VillageBankConfiguration extends Model
{
    use HasFactory;
    use ScopedToVillageBank;

    public string $villageBankScopeTier = 'direct';

    protected $table = 'village_bank_configurations';

    protected $fillable = [
        'village_bank_id',
        'circle_duration_months',
        'share_unit_amount',
        'min_shares_per_month',
        'max_shares_per_month',
        'insurance_type',
        'insurance_value',
        'max_loan_multiplier',
        'default_interest_rate',
        'interest_type',
        'reducing_balance_rate',
        'default_loan_duration',
        'allow_multiple_active_loans',
        'min_loan_amount',
        'max_loan_amount',
        'late_repayment_penalty_rate',
        'grace_period_days',
    ];

    protected $casts = [
        'circle_duration_months'      => 'integer',
        'share_unit_amount'           => 'decimal:2',
        'min_shares_per_month'        => 'integer',
        'max_shares_per_month'        => 'integer',
        'insurance_value'             => 'decimal:2',
        'max_loan_multiplier'         => 'integer',
        'default_interest_rate'       => 'decimal:2',
        'reducing_balance_rate'       => 'decimal:2',
        'default_loan_duration'       => 'integer',
        'allow_multiple_active_loans' => 'boolean',
        'min_loan_amount'             => 'decimal:2',
        'max_loan_amount'             => 'decimal:2',
        'late_repayment_penalty_rate' => 'decimal:2',
        'grace_period_days'           => 'integer',
    ];

    /* ── Relationships ────────────────── */

    public function villageBank()
    {
        return $this->belongsTo(VillageBank::class);
    }

    /* ── Defaults ─────────────────────── */

    /**
     * Return the configuration for a village bank, or sensible defaults.
     */
    public static function forBank(int $villageBankId): self
    {
        return static::firstOrCreate(
            ['village_bank_id' => $villageBankId],
            [
                'circle_duration_months'     => 12,
                'share_unit_amount'          => 200.00,
                'min_shares_per_month'       => 1,
                'max_shares_per_month'       => 50,
                'insurance_type'             => 'fixed',
                'insurance_value'            => 100.00,
                'max_loan_multiplier'        => 3,
                'default_interest_rate'      => 10.00,
                'interest_type'              => 'flat',
                'reducing_balance_rate'      => 0,
                'default_loan_duration'      => 1,
                'allow_multiple_active_loans' => false,
                'min_loan_amount'            => null,
                'max_loan_amount'            => null,
                'late_repayment_penalty_rate' => 5.00,
                'grace_period_days'          => 0,
            ]
        );
    }
}
