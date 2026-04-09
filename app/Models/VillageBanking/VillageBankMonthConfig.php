<?php

namespace App\Models\VillageBanking;

use App\Traits\ScopedToVillageBank;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VillageBankMonthConfig extends Model
{
    use HasFactory;
    use ScopedToVillageBank;

    public string $villageBankScopeTier = 'direct';

    protected $table = 'village_bank_month_configs';

    protected $fillable = [
        'village_bank_id',
        'month_number',
        'label',
        'allow_share_declarations',
        'allow_insurance_declarations',
        'allow_loan_requests',
        'allow_loan_repayments',
        'is_shareout_month',
    ];

    protected $casts = [
        'month_number'                 => 'integer',
        'allow_share_declarations'     => 'boolean',
        'allow_insurance_declarations' => 'boolean',
        'allow_loan_requests'          => 'boolean',
        'allow_loan_repayments'        => 'boolean',
        'is_shareout_month'            => 'boolean',
    ];

    /* ── Relationships ────────────────── */

    public function villageBank()
    {
        return $this->belongsTo(VillageBank::class);
    }

    /* ── Helpers ──────────────────────── */

    /**
     * Generate default month configs for a village bank.
     *
     * Defaults:
     * - All months: shares ✓, insurance ✓, repayments ✓
     * - Last month: shareout, no loans, no shares, no insurance
     * - Second-to-last month: no loans (repayments only + shares/insurance)
     * - All other months: loan requests allowed
     */
    public static function generateDefaults(int $villageBankId, int $totalMonths): void
    {
        // Clear existing
        static::where('village_bank_id', $villageBankId)->delete();

        for ($i = 1; $i <= $totalMonths; $i++) {
            $isLast       = ($i === $totalMonths);
            $isSecondLast = ($i === $totalMonths - 1);

            static::create([
                'village_bank_id'              => $villageBankId,
                'month_number'                 => $i,
                'label'                        => $isLast ? "Month {$i} – Shareout" : "Month {$i}",
                'allow_share_declarations'     => !$isLast,
                'allow_insurance_declarations' => !$isLast,
                'allow_loan_requests'          => !$isLast && !$isSecondLast,
                'allow_loan_repayments'        => true,
                'is_shareout_month'            => $isLast,
            ]);
        }
    }
}
