<?php

namespace Database\Factories\VillageBanking;

use App\Models\VillageBanking\Loan;
use App\Models\VillageBanking\Penalty;
use Illuminate\Database\Eloquent\Factories\Factory;

class PenaltyFactory extends Factory
{
    protected $model = Penalty::class;

    public function definition(): array
    {
        return [
            'loan_id'    => Loan::factory(),
            'percentage' => 5.00,
            'amount'     => $this->faker->randomFloat(2, 50, 2000),
            'applied_at' => now(),
        ];
    }
}
