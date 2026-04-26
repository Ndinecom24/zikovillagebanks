<?php

namespace Tests\Unit\Services;

use App\Models\User;
use App\Models\VillageBanking\Circle;
use App\Models\VillageBanking\Loan;
use App\Models\VillageBanking\Month;
use App\Models\VillageBanking\ShareDeclaration;
use App\Models\VillageBanking\VillageBank;
use App\Models\VillageBanking\VillageBankConfiguration;
use App\Services\LoanEligibilityService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoanEligibilityServiceTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;
    private VillageBank $bank;
    private Circle $circle;
    private Month $month;
    private User $borrower;
    private VillageBankConfiguration $config;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->superAdmin()->create();
        $this->actingAs($this->admin);

        $this->bank   = VillageBank::factory()->create(['created_by' => $this->admin->id]);
        $this->config = VillageBankConfiguration::factory()->create([
            'village_bank_id'             => $this->bank->id,
            'max_loan_multiplier'         => 3,
            'allow_multiple_active_loans' => false,
        ]);

        $this->circle   = Circle::factory()->create(['village_bank_id' => $this->bank->id]);
        $this->month    = Month::factory()->create([
            'circle_id'          => $this->circle->id,
            'allow_loan_requests'=> true,
            'start_date'         => now()->startOfMonth(),
            'end_date'           => now()->endOfMonth(),
        ]);
        $this->borrower = User::factory()->create();

        // Attach borrower to bank
        $this->bank->members()->attach($this->borrower->id, ['role' => 'member', 'joined_at' => now()]);
    }

    public function test_eligible_borrower_with_savings(): void
    {
        // Borrower saves 1000 across circle months
        ShareDeclaration::factory()->create([
            'user_id'  => $this->borrower->id,
            'month_id' => $this->month->id,
            'amount'   => 1000.00,
        ]);

        $result = LoanEligibilityService::calculate($this->borrower->id, $this->month->id);

        $this->assertEquals(1000.00, $result['total_member_savings']);
        $this->assertEquals(3000.00, $result['savings_limit']); // 1000 * 3
        $this->assertEquals(3, $result['multiplier']);
        $this->assertFalse($result['has_active_loan']);
        $this->assertEmpty($result['errors']);
        // max_borrowable = min(savings_limit, available_funds)
        $this->assertGreaterThan(0, $result['max_borrowable']);
    }

    public function test_no_savings_returns_error(): void
    {
        $result = LoanEligibilityService::calculate($this->borrower->id, $this->month->id);

        $this->assertEquals(0, $result['total_member_savings']);
        $this->assertEquals(0, $result['max_borrowable']);
        $this->assertNotEmpty($result['errors']);
        $this->assertStringContainsString('no savings', $result['errors'][0]);
    }

    public function test_existing_active_loan_blocks_new_loan(): void
    {
        ShareDeclaration::factory()->create([
            'user_id'  => $this->borrower->id,
            'month_id' => $this->month->id,
            'amount'   => 1000.00,
        ]);

        Loan::factory()->create([
            'borrower_id' => $this->borrower->id,
            'month_id'    => $this->month->id,
            'status'      => 'active',
        ]);

        $result = LoanEligibilityService::calculate($this->borrower->id, $this->month->id);

        $this->assertTrue($result['has_active_loan']);
        $this->assertEquals(0, $result['max_borrowable']);
        $this->assertNotEmpty($result['errors']);
    }

    public function test_loan_requests_not_allowed_in_month(): void
    {
        $closedMonth = Month::factory()->create([
            'circle_id'           => $this->circle->id,
            'allow_loan_requests' => false,
        ]);

        ShareDeclaration::factory()->create([
            'user_id'  => $this->borrower->id,
            'month_id' => $closedMonth->id,
            'amount'   => 1000.00,
        ]);

        $result = LoanEligibilityService::calculate($this->borrower->id, $closedMonth->id);

        $this->assertEquals(0, $result['max_borrowable']);
        $this->assertNotEmpty($result['errors']);
        $this->assertStringContainsString('not allowed', $result['errors'][0]);
    }

    public function test_max_borrowable_capped_by_available_funds(): void
    {
        // Borrower has lots of savings, but pool is limited
        ShareDeclaration::factory()->create([
            'user_id'  => $this->borrower->id,
            'month_id' => $this->month->id,
            'amount'   => 50000.00,
        ]);

        // Total inflow is just the shares (50000), available = 50000 - 0 loans
        // Savings limit = 50000 * 3 = 150000
        // Max borrowable = min(150000, 50000) = 50000

        $result = LoanEligibilityService::calculate($this->borrower->id, $this->month->id);

        $this->assertEquals(150000.00, $result['savings_limit']);
        $this->assertEquals(50000.00, $result['available_funds']);
        $this->assertEquals(50000.00, $result['max_borrowable']);
    }

    public function test_max_loan_amount_config_cap(): void
    {
        $this->config->update(['max_loan_amount' => 2000.00]);

        ShareDeclaration::factory()->create([
            'user_id'  => $this->borrower->id,
            'month_id' => $this->month->id,
            'amount'   => 5000.00,
        ]);

        $result = LoanEligibilityService::calculate($this->borrower->id, $this->month->id);

        $this->assertEquals(2000.00, $result['max_borrowable']);
    }

    public function test_return_structure(): void
    {
        ShareDeclaration::factory()->create([
            'user_id'  => $this->borrower->id,
            'month_id' => $this->month->id,
            'amount'   => 1000.00,
        ]);

        $result = LoanEligibilityService::calculate($this->borrower->id, $this->month->id);

        $this->assertArrayHasKey('max_borrowable', $result);
        $this->assertArrayHasKey('total_member_savings', $result);
        $this->assertArrayHasKey('multiplier', $result);
        $this->assertArrayHasKey('savings_limit', $result);
        $this->assertArrayHasKey('available_funds', $result);
        $this->assertArrayHasKey('month_inflow', $result);
        $this->assertArrayHasKey('month_loans_out', $result);
        $this->assertArrayHasKey('has_active_loan', $result);
        $this->assertArrayHasKey('errors', $result);
    }
}
