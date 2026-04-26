<?php

namespace Database\Factories\VillageBanking;

use App\Models\User;
use App\Models\VillageBanking\Circle;
use App\Models\VillageBanking\VillageBank;
use Illuminate\Database\Eloquent\Factories\Factory;

class CircleFactory extends Factory
{
    protected $model = Circle::class;

    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('-6 months', 'now');

        return [
            'name'             => 'Circle ' . $this->faker->word(),
            'village_bank_id'  => VillageBank::factory(),
            'duration_months'  => 12,
            'start_date'       => $start,
            'end_date'         => (clone $start)->modify('+12 months'),
            'status'           => 'active',
            'created_by'       => User::factory(),
        ];
    }

    public function draft(): static
    {
        return $this->state(['status' => 'draft']);
    }

    public function completed(): static
    {
        return $this->state(['status' => 'completed']);
    }
}
