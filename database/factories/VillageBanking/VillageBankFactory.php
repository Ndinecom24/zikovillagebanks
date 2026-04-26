<?php

namespace Database\Factories\VillageBanking;

use App\Models\User;
use App\Models\VillageBanking\VillageBank;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class VillageBankFactory extends Factory
{
    protected $model = VillageBank::class;

    public function definition(): array
    {
        return [
            'name'        => $this->faker->company() . ' Village Bank',
            'code'        => 'VB-' . strtoupper(Str::random(6)),
            'description' => $this->faker->sentence(),
            'address'     => $this->faker->address(),
            'phone'       => $this->faker->phoneNumber(),
            'email'       => $this->faker->companyEmail(),
            'status'      => 'active',
            'created_by'  => User::factory(),
        ];
    }

    public function inactive(): static
    {
        return $this->state(['status' => 'inactive']);
    }
}
