<?php

namespace Database\Factories\VillageBanking;

use App\Models\User;
use App\Models\VillageBanking\Loan;
use App\Models\VillageBanking\Month;
use Illuminate\Database\Eloquent\Factories\Factory;

class LoanFactory extends Factory
{
    protected $model = Loan::class;

    public function definition(): array
    {
        $amount  = $this->faker->randomFloat(2, 500, 50000);
        $rate    = 10.00;
        $payable = round($amount * (1 + $rate / 100), 2);

        return [
            'borrower_id'        => User::factory(),
            'month_id'           => Month::factory(),
            'amount'             => $amount,
            'interest_rate'      => $rate,
            'duration'           => 1,
            'total_payable'      => $payable,
            'outstanding_balance'=> $payable,
            'status'             => 'pending',
            'type'               => 'voluntary',
        ];
    }

    public function approved(): static
    {
        return $this->state(['status' => 'approved']);
    }

    public function active(): static
    {
        return $this->state(['status' => 'active']);
    }

    public function forced(User $admin = null): static
    {
        return $this->state([
            'type'      => 'forced',
            'status'    => 'approved',
            'forced_by' => $admin?->id,
        ]);
    }

    public function repaid(): static
    {
        return $this->state([
            'status'             => 'repaid',
            'outstanding_balance'=> 0,
        ]);
    }
}
