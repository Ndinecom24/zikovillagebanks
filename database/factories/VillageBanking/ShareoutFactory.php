<?php

namespace Database\Factories\VillageBanking;

use App\Models\VillageBanking\Circle;
use App\Models\VillageBanking\Shareout;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShareoutFactory extends Factory
{
    protected $model = Shareout::class;

    public function definition(): array
    {
        return [
            'circle_id'              => Circle::factory(),
            'total_contributions'    => $this->faker->randomFloat(2, 10000, 500000),
            'total_insurance'        => $this->faker->randomFloat(2, 1000, 50000),
            'total_interest'         => $this->faker->randomFloat(2, 500, 25000),
            'total_penalties'        => $this->faker->randomFloat(2, 0, 5000),
            'total_loans_outstanding'=> $this->faker->randomFloat(2, 0, 10000),
            'total_pool'             => $this->faker->randomFloat(2, 10000, 600000),
            'compound_rate'          => $this->faker->randomFloat(2, 1.0, 2.0),
        ];
    }
}
