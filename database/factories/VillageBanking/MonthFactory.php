<?php

namespace Database\Factories\VillageBanking;

use App\Models\VillageBanking\Circle;
use App\Models\VillageBanking\Month;
use Illuminate\Database\Eloquent\Factories\Factory;

class MonthFactory extends Factory
{
    protected $model = Month::class;

    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('-6 months', 'now');

        return [
            'circle_id'                    => Circle::factory(),
            'month_number'                 => $this->faker->numberBetween(1, 12),
            'label'                        => $this->faker->monthName(),
            'start_date'                   => $start,
            'end_date'                     => (clone $start)->modify('+1 month'),
            'status'                       => 'active',
            'allow_share_declarations'     => true,
            'allow_insurance_declarations' => true,
            'allow_loan_requests'          => true,
            'allow_loan_repayments'        => true,
            'is_shareout_month'            => false,
        ];
    }

    public function closed(): static
    {
        return $this->state(['status' => 'closed']);
    }

    public function shareoutMonth(): static
    {
        return $this->state(['is_shareout_month' => true]);
    }
}
