<?php

namespace Tests\Unit\Models;

use App\Models\User;
use App\Models\VillageBanking\Circle;
use App\Models\VillageBanking\Loan;
use App\Models\VillageBanking\Month;
use App\Models\VillageBanking\Repayment;
use App\Models\VillageBanking\ShareDeclaration;
use App\Models\VillageBanking\Shareout;
use App\Models\VillageBanking\VillageBank;
use App\Models\VillageBanking\VillageBankConfiguration;
use App\Models\VillageBanking\Penalty;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VillageBankModelTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;
    private VillageBank $bank;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a super-admin user so scopes don't interfere
        $this->admin = User::factory()->superAdmin()->create();
        $this->actingAs($this->admin);

        $this->bank = VillageBank::factory()->create(['created_by' => $this->admin->id]);
    }

    /* ── Basic CRUD ── */

    public function test_village_bank_can_be_created(): void
    {
        $this->assertDatabaseHas('village_banks', ['id' => $this->bank->id]);
        $this->assertEquals('active', $this->bank->status);
    }

    public function test_village_bank_fillable_attributes(): void
    {
        $bank = VillageBank::factory()->create([
            'name'   => 'Test Bank',
            'code'   => 'TB-001',
            'status' => 'inactive',
        ]);

        $this->assertEquals('Test Bank', $bank->name);
        $this->assertEquals('TB-001', $bank->code);
        $this->assertEquals('inactive', $bank->status);
    }

    /* ── Relationships ── */

    public function test_village_bank_belongs_to_creator(): void
    {
        $this->assertInstanceOf(User::class, $this->bank->creator);
        $this->assertEquals($this->admin->id, $this->bank->creator->id);
    }

    public function test_village_bank_has_many_circles(): void
    {
        Circle::factory()->count(3)->create(['village_bank_id' => $this->bank->id]);
        $this->assertCount(3, $this->bank->circles);
    }

    public function test_village_bank_has_one_configuration(): void
    {
        $config = VillageBankConfiguration::factory()->create([
            'village_bank_id' => $this->bank->id,
        ]);

        $this->assertInstanceOf(VillageBankConfiguration::class, $this->bank->configuration);
        $this->assertEquals($config->id, $this->bank->configuration->id);
    }

    public function test_village_bank_members_relationship(): void
    {
        $users = User::factory()->count(3)->create();
        foreach ($users as $user) {
            $this->bank->members()->attach($user->id, [
                'role'      => 'member',
                'joined_at' => now(),
            ]);
        }

        $this->assertCount(3, $this->bank->members);
    }

    public function test_village_bank_admins_filtered_relationship(): void
    {
        $admin  = User::factory()->create();
        $member = User::factory()->create();

        $this->bank->members()->attach($admin->id, ['role' => 'admin', 'joined_at' => now()]);
        $this->bank->members()->attach($member->id, ['role' => 'member', 'joined_at' => now()]);

        $this->assertCount(1, $this->bank->admins);
        $this->assertEquals($admin->id, $this->bank->admins->first()->id);
    }

    public function test_village_bank_has_many_through_months(): void
    {
        $circle = Circle::factory()->create(['village_bank_id' => $this->bank->id]);
        Month::factory()->count(3)->create(['circle_id' => $circle->id]);

        $this->assertCount(3, $this->bank->months);
    }

    public function test_village_bank_has_many_through_shareouts(): void
    {
        $circle = Circle::factory()->create(['village_bank_id' => $this->bank->id]);
        Shareout::factory()->create(['circle_id' => $circle->id]);

        $this->assertCount(1, $this->bank->shareouts);
    }

    /* ── getOrCreateConfig ── */

    public function test_get_or_create_config_creates_default(): void
    {
        $config = $this->bank->getOrCreateConfig();

        $this->assertInstanceOf(VillageBankConfiguration::class, $config);
        $this->assertEquals($this->bank->id, $config->village_bank_id);
        $this->assertEquals(200.00, $config->share_unit_amount);
        $this->assertEquals(12, $config->circle_duration_months);
        $this->assertEquals(10.00, $config->default_interest_rate);
    }

    public function test_get_or_create_config_returns_existing(): void
    {
        $existing = VillageBankConfiguration::factory()->create([
            'village_bank_id'    => $this->bank->id,
            'share_unit_amount'  => 500.00,
        ]);

        $config = $this->bank->getOrCreateConfig();
        $this->assertEquals($existing->id, $config->id);
        $this->assertEquals(500.00, $config->share_unit_amount);
    }

    /* ── Active subscription/license ── */

    public function test_active_subscription_returns_active_only(): void
    {
        \App\Models\Subscription\Subscription::factory()->create([
            'village_bank_id' => $this->bank->id,
            'status'          => 'expired',
        ]);

        $this->assertNull($this->bank->activeSubscription);

        \App\Models\Subscription\Subscription::factory()->create([
            'village_bank_id' => $this->bank->id,
            'status'          => 'active',
        ]);

        $this->bank->refresh();
        $this->assertNotNull($this->bank->activeSubscription);
    }

    public function test_active_license_returns_valid_only(): void
    {
        \App\Models\Subscription\License::factory()->expired()->create([
            'village_bank_id' => $this->bank->id,
        ]);

        $this->assertNull($this->bank->activeLicense);

        \App\Models\Subscription\License::factory()->create([
            'village_bank_id' => $this->bank->id,
            'status'          => 'active',
            'expires_at'      => now()->addDays(30),
        ]);

        $this->bank->refresh();
        $this->assertNotNull($this->bank->activeLicense);
    }
}
