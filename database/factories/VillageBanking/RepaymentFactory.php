<?php

namespace Database\Factories\VillageBanking;

use App\Models\VillageBanking\Loan;
use App\Models\VillageBanking\Repayment;
use Illuminate\Database\Eloquent\Factories\Factory;

class RepaymentFactory extends Factory
{
    protected $model = Repayment::class;

    public function definition(): array
    {
        return [
            'loan_id'           => Loan::factory(),
            'amount_paid'       => $this->faker->randomFloat(2, 100, 5000),
            'remaining_balance' => $this->faker->randomFloat(2, 0, 45000),
            'penalty_applied'   => 0,
        ];
    }
}
