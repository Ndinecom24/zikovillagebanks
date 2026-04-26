<?php

namespace Database\Factories\Subscription;

use App\Models\Subscription\SubscriptionPlan;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriptionPlanFactory extends Factory
{
    protected $model = SubscriptionPlan::class;

    public function definition(): array
    {
        return [
            'name'          => $this->faker->randomElement(['Basic', 'Standard', 'Premium']),
            'slug'          => $this->faker->unique()->slug(2),
            'description'   => $this->faker->sentence(),
            'price'         => $this->faker->randomFloat(2, 500, 5000),
            'billing_cycle' => 'monthly',
            'duration_days' => 30,
            'max_circles'   => 5,
            'max_members'   => 50,
            'features'      => ['basic_reports', 'loan_management'],
            'is_active'     => true,
            'sort_order'    => 1,
            'is_featured'   => false,
        ];
    }

    public function yearly(): static
    {
        return $this->state([
            'billing_cycle' => 'yearly',
            'duration_days' => 365,
            'price'         => 5000.00,
        ]);
    }
}
