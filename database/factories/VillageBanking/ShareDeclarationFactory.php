<?php

namespace Database\Factories\VillageBanking;

use App\Models\User;
use App\Models\VillageBanking\Month;
use App\Models\VillageBanking\ShareDeclaration;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShareDeclarationFactory extends Factory
{
    protected $model = ShareDeclaration::class;

    public function definition(): array
    {
        return [
            'user_id'  => User::factory(),
            'month_id' => Month::factory(),
            'amount'   => $this->faker->randomFloat(2, 200, 10000),
        ];
    }
}
