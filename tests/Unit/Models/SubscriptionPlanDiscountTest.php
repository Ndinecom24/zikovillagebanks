<?php

namespace Tests\Unit\Models;

use App\Models\Subscription\SubscriptionPlan;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubscriptionPlanDiscountTest extends TestCase
{
    use RefreshDatabase;

    /* ── hasActiveDiscount ── */

    public function test_no_discount_when_type_is_none(): void
    {
        $plan = SubscriptionPlan::factory()->create([
            'discount_type'  => 'none',
            'discount_value' => 0,
        ]);

        $this->assertFalse($plan->hasActiveDiscount());
    }

    public function test_percentage_discount_active(): void
    {
        $plan = SubscriptionPlan::factory()->create([
            'discount_type'      => 'percentage',
            'discount_value'     => 20,
            'discount_starts_at' => now()->subDay(),
            'discount_ends_at'   => now()->addDays(10),
        ]);

        $this->assertTrue($plan->hasActiveDiscount());
    }

    public function test_discount_not_started_yet(): void
    {
        $plan = SubscriptionPlan::factory()->create([
            'discount_type'      => 'percentage',
            'discount_value'     => 15,
            'discount_starts_at' => now()->addDays(5),
            'discount_ends_at'   => now()->addDays(15),
        ]);

        $this->assertFalse($plan->hasActiveDiscount());
    }

    public function test_discount_already_ended(): void
    {
        $plan = SubscriptionPlan::factory()->create([
            'discount_type'      => 'percentage',
            'discount_value'     => 15,
            'discount_starts_at' => now()->subDays(20),
            'discount_ends_at'   => now()->subDays(5),
        ]);

        $this->assertFalse($plan->hasActiveDiscount());
    }

    /* ── discountAmount ── */

    public function test_percentage_discount_amount(): void
    {
        $plan = SubscriptionPlan::factory()->create([
            'price'              => 1000.00,
            'discount_type'      => 'percentage',
            'discount_value'     => 25,
            'discount_starts_at' => now()->subDay(),
            'discount_ends_at'   => now()->addDays(10),
        ]);

        $this->assertEquals(250.00, $plan->discountAmount());
    }

    public function test_fixed_discount_amount(): void
    {
        $plan = SubscriptionPlan::factory()->create([
            'price'              => 1000.00,
            'discount_type'      => 'fixed',
            'discount_value'     => 200,
            'discount_starts_at' => now()->subDay(),
            'discount_ends_at'   => now()->addDays(10),
        ]);

        $this->assertEquals(200.00, $plan->discountAmount());
    }

    public function test_fixed_discount_capped_at_price(): void
    {
        $plan = SubscriptionPlan::factory()->create([
            'price'              => 500.00,
            'discount_type'      => 'fixed',
            'discount_value'     => 9999,
            'discount_starts_at' => now()->subDay(),
            'discount_ends_at'   => now()->addDays(10),
        ]);

        $this->assertEquals(500.00, $plan->discountAmount());
    }

    /* ── effectivePrice ── */

    public function test_effective_price_with_percentage_discount(): void
    {
        $plan = SubscriptionPlan::factory()->create([
            'price'              => 1000.00,
            'discount_type'      => 'percentage',
            'discount_value'     => 30,
            'discount_starts_at' => now()->subDay(),
            'discount_ends_at'   => now()->addDays(10),
        ]);

        $this->assertEquals(700.00, $plan->effectivePrice());
    }

    public function test_effective_price_without_discount(): void
    {
        $plan = SubscriptionPlan::factory()->create([
            'price'         => 2500.00,
            'discount_type' => 'none',
        ]);

        $this->assertEquals(2500.00, $plan->effectivePrice());
    }

    /* ── Formatting helpers ── */

    public function test_formatted_price(): void
    {
        $plan = SubscriptionPlan::factory()->create(['price' => 1500.00]);

        $this->assertEquals('K1,500.00', $plan->formattedPrice());
    }

    public function test_cycle_name(): void
    {
        $monthly   = SubscriptionPlan::factory()->create(['billing_cycle' => 'monthly']);
        $quarterly = SubscriptionPlan::factory()->create(['billing_cycle' => 'quarterly']);
        $yearly    = SubscriptionPlan::factory()->create(['billing_cycle' => 'yearly']);

        $this->assertEquals('/month', $monthly->cycleName());
        $this->assertEquals('/quarter', $quarterly->cycleName());
        $this->assertEquals('/year', $yearly->cycleName());
    }

    public function test_discount_badge_percentage(): void
    {
        $plan = SubscriptionPlan::factory()->create([
            'discount_type'      => 'percentage',
            'discount_value'     => 15,
            'discount_starts_at' => now()->subDay(),
            'discount_ends_at'   => now()->addDays(10),
        ]);

        $this->assertEquals('15% OFF', $plan->discountBadge());
    }

    public function test_discount_badge_fixed(): void
    {
        $plan = SubscriptionPlan::factory()->create([
            'discount_type'      => 'fixed',
            'discount_value'     => 500,
            'discount_starts_at' => now()->subDay(),
            'discount_ends_at'   => now()->addDays(10),
        ]);

        $this->assertEquals('K500 OFF', $plan->discountBadge());
    }

    public function test_is_discount_urgent_when_ending_soon(): void
    {
        $plan = SubscriptionPlan::factory()->create([
            'discount_type'      => 'percentage',
            'discount_value'     => 10,
            'discount_starts_at' => now()->subDays(5),
            'discount_ends_at'   => now()->addDays(2),
        ]);

        $this->assertTrue($plan->isDiscountUrgent());
    }

    public function test_savings_percentage(): void
    {
        $plan = SubscriptionPlan::factory()->create([
            'price'              => 1000.00,
            'discount_type'      => 'percentage',
            'discount_value'     => 20,
            'discount_starts_at' => now()->subDay(),
            'discount_ends_at'   => now()->addDays(10),
        ]);

        $this->assertEquals(20, $plan->savingsPercentage());
    }
}
