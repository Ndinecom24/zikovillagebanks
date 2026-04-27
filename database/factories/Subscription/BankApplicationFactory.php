<?php

namespace Database\Factories\Subscription;

use App\Models\Subscription\BankApplication;
use App\Models\Subscription\SubscriptionPlan;
use Illuminate\Database\Eloquent\Factories\Factory;

class BankApplicationFactory extends Factory
{
    protected $model = BankApplication::class;

    public function definition(): array
    {
        return [
            'bank_name'            => $this->faker->company() . ' Village Bank',
            'bank_code'            => 'VB-' . strtoupper($this->faker->bothify('######')),
            'bank_description'     => $this->faker->sentence(),
            'bank_address'         => $this->faker->address(),
            'bank_phone'           => $this->faker->phoneNumber(),
            'bank_email'           => $this->faker->companyEmail(),
            'contact_name'         => $this->faker->name(),
            'contact_email'        => $this->faker->safeEmail(),
            'contact_phone'        => $this->faker->phoneNumber(),
            'contact_staff_no'     => 'MBR-' . str_pad($this->faker->unique()->randomNumber(6), 8, '0', STR_PAD_LEFT),
            'subscription_plan_id' => SubscriptionPlan::factory(),
            'status'               => 'pending',
            'amount_due'           => $this->faker->randomFloat(2, 500, 5000),
        ];
    }

    public function approved(): static
    {
        return $this->state([
            'status'        => 'approved',
            'admin_remarks' => 'Application approved.',
            'reviewed_at'   => now(),
        ]);
    }

    public function rejected(): static
    {
        return $this->state([
            'status'        => 'rejected',
            'admin_remarks' => 'Application rejected for testing.',
            'reviewed_at'   => now(),
        ]);
    }
}
