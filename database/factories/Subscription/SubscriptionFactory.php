<?php

namespace Database\Factories\Subscription;

use App\Models\Subscription\Subscription;
use App\Models\Subscription\SubscriptionPlan;
use App\Models\VillageBanking\VillageBank;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriptionFactory extends Factory
{
    protected $model = Subscription::class;

    public function definition(): array
    {
        return [
            'village_bank_id'      => VillageBank::factory(),
            'subscription_plan_id' => SubscriptionPlan::factory(),
            'status'               => 'active',
            'starts_at'            => now(),
            'ends_at'              => now()->addDays(30),
            'auto_renew'           => false,
        ];
    }

    public function expired(): static
    {
        return $this->state([
            'status'    => 'expired',
            'starts_at' => now()->subDays(60),
            'ends_at'   => now()->subDays(30),
        ]);
    }

    public function expiringSoon(): static
    {
        return $this->state([
            'starts_at' => now()->subDays(20),
            'ends_at'   => now()->addDays(7),
        ]);
    }
}
