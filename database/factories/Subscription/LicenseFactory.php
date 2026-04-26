<?php

namespace Database\Factories\Subscription;

use App\Models\Subscription\License;
use App\Models\Subscription\Subscription;
use App\Models\VillageBanking\VillageBank;
use Illuminate\Database\Eloquent\Factories\Factory;

class LicenseFactory extends Factory
{
    protected $model = License::class;

    public function definition(): array
    {
        return [
            'village_bank_id'  => VillageBank::factory(),
            'subscription_id'  => Subscription::factory(),
            'license_key'      => License::generateKey(),
            'status'           => 'active',
            'issued_at'        => now(),
            'expires_at'       => now()->addDays(30),
            'revoked_at'       => null,
            'revoke_reason'    => null,
        ];
    }

    public function expired(): static
    {
        return $this->state([
            'status'     => 'expired',
            'expires_at' => now()->subDays(5),
        ]);
    }

    public function revoked(): static
    {
        return $this->state([
            'status'        => 'revoked',
            'revoked_at'    => now(),
            'revoke_reason' => 'Revoked for testing',
        ]);
    }

    public function expiringSoon(): static
    {
        return $this->state([
            'expires_at' => now()->addDays(7),
        ]);
    }
}
