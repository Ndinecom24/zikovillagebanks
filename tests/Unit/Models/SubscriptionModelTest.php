<?php

namespace Tests\Unit\Models;

use App\Models\Subscription\License;
use App\Models\Subscription\Subscription;
use App\Models\Subscription\SubscriptionPlan;
use App\Models\User;
use App\Models\VillageBanking\VillageBank;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubscriptionModelTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->superAdmin()->create());
    }

    /* ══════════════════════════════════════
       Subscription
       ══════════════════════════════════════ */

    public function test_subscription_belongs_to_village_bank(): void
    {
        $sub = Subscription::factory()->create();
        $this->assertInstanceOf(VillageBank::class, $sub->villageBank);
    }

    public function test_subscription_belongs_to_plan(): void
    {
        $plan = SubscriptionPlan::factory()->create();
        $sub  = Subscription::factory()->create(['subscription_plan_id' => $plan->id]);

        $this->assertInstanceOf(SubscriptionPlan::class, $sub->plan);
        $this->assertEquals($plan->id, $sub->plan->id);
    }

    public function test_subscription_is_active(): void
    {
        $active = Subscription::factory()->create([
            'status'  => 'active',
            'ends_at' => now()->addDays(30),
        ]);

        $expired = Subscription::factory()->expired()->create();

        $this->assertTrue($active->isActive());
        $this->assertFalse($expired->isActive());
    }

    public function test_subscription_days_remaining(): void
    {
        $sub = Subscription::factory()->create([
            'ends_at' => now()->addDays(15),
        ]);

        $remaining = $sub->daysRemaining();
        $this->assertGreaterThanOrEqual(14, $remaining);
        $this->assertLessThanOrEqual(15, $remaining);
    }

    public function test_subscription_days_remaining_returns_zero_when_expired(): void
    {
        $sub = Subscription::factory()->expired()->create();
        $this->assertEquals(0, $sub->daysRemaining());
    }

    public function test_subscription_is_expiring_soon(): void
    {
        $soonSub = Subscription::factory()->expiringSoon()->create();
        $farSub  = Subscription::factory()->create([
            'status'  => 'active',
            'ends_at' => now()->addDays(60),
        ]);

        $this->assertTrue($soonSub->isExpiringSoon());
        $this->assertFalse($farSub->isExpiringSoon());
    }

    public function test_subscription_has_one_license(): void
    {
        $sub     = Subscription::factory()->create();
        $license = License::factory()->create([
            'subscription_id' => $sub->id,
            'village_bank_id' => $sub->village_bank_id,
        ]);

        $this->assertInstanceOf(License::class, $sub->license);
    }

    /* ══════════════════════════════════════
       License
       ══════════════════════════════════════ */

    public function test_license_generate_key_format(): void
    {
        $key = License::generateKey();

        $this->assertMatchesRegularExpression('/^VB-[A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{4}$/', $key);
    }

    public function test_license_generate_key_uniqueness(): void
    {
        $keys = array_map(fn () => License::generateKey(), range(1, 20));
        $this->assertCount(20, array_unique($keys));
    }

    public function test_license_is_valid(): void
    {
        $valid   = License::factory()->create([
            'status'     => 'active',
            'expires_at' => now()->addDays(30),
        ]);
        $expired = License::factory()->expired()->create();
        $revoked = License::factory()->revoked()->create();

        $this->assertTrue($valid->isValid());
        $this->assertFalse($expired->isValid());
        $this->assertFalse($revoked->isValid());
    }

    public function test_license_days_remaining(): void
    {
        $license = License::factory()->create([
            'expires_at' => now()->addDays(20),
        ]);

        $remaining = $license->daysRemaining();
        $this->assertGreaterThanOrEqual(19, $remaining);
        $this->assertLessThanOrEqual(20, $remaining);
    }

    public function test_license_is_expiring_soon(): void
    {
        $soon = License::factory()->expiringSoon()->create();
        $far  = License::factory()->create([
            'expires_at' => now()->addDays(60),
        ]);

        $this->assertTrue($soon->isExpiringSoon());
        $this->assertFalse($far->isExpiringSoon());
    }

    public function test_license_belongs_to_village_bank(): void
    {
        $license = License::factory()->create();
        $this->assertInstanceOf(VillageBank::class, $license->villageBank);
    }

    public function test_license_belongs_to_subscription(): void
    {
        $license = License::factory()->create();
        $this->assertInstanceOf(Subscription::class, $license->subscription);
    }

    /* ══════════════════════════════════════
       SubscriptionPlan
       ══════════════════════════════════════ */

    public function test_plan_formatted_price(): void
    {
        $plan = SubscriptionPlan::factory()->create(['price' => 1234.56]);
        $this->assertEquals('K1,234.56', $plan->formattedPrice());
    }

    public function test_plan_cycle_name(): void
    {
        $monthly   = SubscriptionPlan::factory()->create(['billing_cycle' => 'monthly']);
        $quarterly = SubscriptionPlan::factory()->create(['billing_cycle' => 'quarterly']);
        $yearly    = SubscriptionPlan::factory()->create(['billing_cycle' => 'yearly']);

        $this->assertEquals('/month', $monthly->cycleName());
        $this->assertEquals('/quarter', $quarterly->cycleName());
        $this->assertEquals('/year', $yearly->cycleName());
    }

    public function test_plan_features_cast(): void
    {
        $plan = SubscriptionPlan::factory()->create([
            'features' => ['reports', 'loan_management', 'exports'],
        ]);

        $plan->refresh();
        $this->assertIsArray($plan->features);
        $this->assertContains('reports', $plan->features);
    }

    public function test_plan_boolean_casts(): void
    {
        $plan = SubscriptionPlan::factory()->create([
            'is_active'   => true,
            'is_featured' => false,
        ]);

        $plan->refresh();
        $this->assertTrue($plan->is_active);
        $this->assertFalse($plan->is_featured);
    }
}
