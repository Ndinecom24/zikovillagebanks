<?php

namespace Database\Factories\VillageBanking;

use App\Models\VillageBanking\VillageBank;
use App\Models\VillageBanking\VillageBankConfiguration;
use Illuminate\Database\Eloquent\Factories\Factory;

class VillageBankConfigurationFactory extends Factory
{
    protected $model = VillageBankConfiguration::class;

    public function definition(): array
    {
        return [
            'village_bank_id'             => VillageBank::factory(),
            'circle_duration_months'      => 12,
            'share_unit_amount'           => 200.00,
            'min_shares_per_month'        => 1,
            'max_shares_per_month'        => 50,
            'insurance_type'              => 'fixed',
            'insurance_value'             => 100.00,
            'insurance_profit_to_members' => true,
            'max_loan_multiplier'         => 3,
            'default_interest_rate'       => 10.00,
            'interest_type'              => 'flat',
            'reducing_balance_rate'       => 0,
            'default_loan_duration'       => 1,
            'allow_multiple_active_loans' => false,
            'min_loan_amount'             => null,
            'max_loan_amount'             => null,
            'late_repayment_penalty_rate' => 5.00,
            'grace_period_days'           => 0,
        ];
    }
}
