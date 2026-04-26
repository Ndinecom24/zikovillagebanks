<?php

namespace Tests\Unit\Services;

use App\Models\Subscription\License;
use App\Models\Subscription\Subscription;
use App\Models\Subscription\SubscriptionPlan;
use App\Models\User;
use App\Models\VillageBanking\Circle;
use App\Models\VillageBanking\VillageBank;
use App\Services\LicenseEnforcement;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LicenseEnforcementTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;
    private VillageBank $bank;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->superAdmin()->create();
        $this->actingAs($this->admin);
        $this->bank = VillageBank::factory()->create(['created_by' => $this->admin->id]);
    }

    /* ── hasValidLicense ── */

    public function test_has_valid_license_returns_true_when_active(): void
    {
        License::factory()->create([
            'village_bank_id' => $this->bank->id,
            'status'          => 'active',
            'expires_at'      => now()->addDays(30),
        ]);

        $enforcer = LicenseEnforcement::forBank($this->bank->id);
        $this->assertTrue($enforcer->hasValidLicense());
    }

    public function test_has_valid_license_returns_false_when_expired(): void
    {
        License::factory()->expired()->create([
            'village_bank_id' => $this->bank->id,
        ]);

        $enforcer = LicenseEnforcement::forBank($this->bank->id);
        $this->assertFalse($enforcer->hasValidLicense());
    }

    public function test_has_valid_license_returns_false_when_no_license(): void
    {
        $enforcer = LicenseEnforcement::forBank($this->bank->id);
        $this->assertFalse($enforcer->hasValidLicense());
    }

    /* ── activeSubscription ── */

    public function test_active_subscription_returns_active(): void
    {
        $plan = SubscriptionPlan::factory()->create();
        Subscription::factory()->create([
            'village_bank_id'      => $this->bank->id,
            'subscription_plan_id' => $plan->id,
            'status'               => 'active',
        ]);

        $enforcer = LicenseEnforcement::forBank($this->bank->id);
        $sub = $enforcer->activeSubscription();

        $this->assertNotNull($sub);
        $this->assertNotNull($sub->plan);
    }

    public function test_active_subscription_returns_null_when_none(): void
    {
        $enforcer = LicenseEnforcement::forBank($this->bank->id);
        $this->assertNull($enforcer->activeSubscription());
    }

    /* ── planLimits ── */

    public function test_plan_limits_with_no_subscription(): void
    {
        $enforcer = LicenseEnforcement::forBank($this->bank->id);
        $limits = $enforcer->planLimits();

        $this->assertEquals('No Plan', $limits['plan_name']);
        $this->assertNull($limits['max_members']);
        $this->assertNull($limits['max_circles']);
    }

    public function test_plan_limits_with_active_subscription(): void
    {
        $plan = SubscriptionPlan::factory()->create([
            'name'        => 'Premium',
            'max_members' => 100,
            'max_circles' => 10,
        ]);
        Subscription::factory()->create([
            'village_bank_id'      => $this->bank->id,
            'subscription_plan_id' => $plan->id,
            'status'               => 'active',
        ]);

        $enforcer = LicenseEnforcement::forBank($this->bank->id);
        $limits = $enforcer->planLimits();

        $this->assertEquals('Premium', $limits['plan_name']);
        $this->assertEquals(100, $limits['max_members']);
        $this->assertEquals(10, $limits['max_circles']);
    }

    /* ── canAddMembers ── */

    public function test_can_add_members_within_limit(): void
    {
        $plan = SubscriptionPlan::factory()->create(['max_members' => 5]);
        Subscription::factory()->create([
            'village_bank_id'      => $this->bank->id,
            'subscription_plan_id' => $plan->id,
            'status'               => 'active',
        ]);

        // Add 3 members
        $users = User::factory()->count(3)->create();
        foreach ($users as $user) {
            $this->bank->members()->attach($user->id, ['role' => 'member', 'joined_at' => now()]);
        }

        $enforcer = LicenseEnforcement::forBank($this->bank->id);
        $result = $enforcer->canAddMembers(1);

        $this->assertTrue($result['allowed']);
        $this->assertEquals(3, $result['current']);
        $this->assertEquals(5, $result['max']);
        $this->assertEquals(2, $result['remaining']);
    }

    public function test_cannot_add_members_at_limit(): void
    {
        $plan = SubscriptionPlan::factory()->create(['max_members' => 2]);
        Subscription::factory()->create([
            'village_bank_id'      => $this->bank->id,
            'subscription_plan_id' => $plan->id,
            'status'               => 'active',
        ]);

        $users = User::factory()->count(2)->create();
        foreach ($users as $user) {
            $this->bank->members()->attach($user->id, ['role' => 'member', 'joined_at' => now()]);
        }

        $enforcer = LicenseEnforcement::forBank($this->bank->id);
        $result = $enforcer->canAddMembers(1);

        $this->assertFalse($result['allowed']);
        $this->assertEquals(0, $result['remaining']);
    }

    public function test_can_add_members_unlimited(): void
    {
        // No subscription = null limits = unlimited
        $enforcer = LicenseEnforcement::forBank($this->bank->id);
        $result = $enforcer->canAddMembers(100);

        $this->assertTrue($result['allowed']);
        $this->assertNull($result['max']);
    }

    /* ── canAddCircles ── */

    public function test_can_add_circles_within_limit(): void
    {
        $plan = SubscriptionPlan::factory()->create(['max_circles' => 5]);
        Subscription::factory()->create([
            'village_bank_id'      => $this->bank->id,
            'subscription_plan_id' => $plan->id,
            'status'               => 'active',
        ]);

        Circle::factory()->count(3)->create(['village_bank_id' => $this->bank->id]);

        $enforcer = LicenseEnforcement::forBank($this->bank->id);
        $result = $enforcer->canAddCircles(1);

        $this->assertTrue($result['allowed']);
        $this->assertEquals(3, $result['current']);
        $this->assertEquals(2, $result['remaining']);
    }

    public function test_cannot_add_circles_at_limit(): void
    {
        $plan = SubscriptionPlan::factory()->create(['max_circles' => 1]);
        Subscription::factory()->create([
            'village_bank_id'      => $this->bank->id,
            'subscription_plan_id' => $plan->id,
            'status'               => 'active',
        ]);

        Circle::factory()->create(['village_bank_id' => $this->bank->id]);

        $enforcer = LicenseEnforcement::forBank($this->bank->id);
        $this->assertFalse($enforcer->circlesAllowed());
    }

    /* ── usageSummary ── */

    public function test_usage_summary_structure(): void
    {
        $enforcer = LicenseEnforcement::forBank($this->bank->id);
        $summary = $enforcer->usageSummary();

        $this->assertArrayHasKey('plan_name', $summary);
        $this->assertArrayHasKey('has_license', $summary);
        $this->assertArrayHasKey('members', $summary);
        $this->assertArrayHasKey('circles', $summary);
        $this->assertArrayHasKey('features', $summary);
    }
}
