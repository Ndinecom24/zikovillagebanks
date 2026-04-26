<?php

namespace Tests\Unit\Models;

use App\Models\User;
use App\Models\VillageBanking\Circle;
use App\Models\VillageBanking\Loan;
use App\Models\VillageBanking\Month;
use App\Models\VillageBanking\Penalty;
use App\Models\VillageBanking\Repayment;
use App\Models\VillageBanking\ShareDeclaration;
use App\Models\VillageBanking\VillageBank;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoanModelTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->superAdmin()->create());
    }

    /* ── Relationships ── */

    public function test_loan_belongs_to_borrower(): void
    {
        $user = User::factory()->create();
        $loan = Loan::factory()->create(['borrower_id' => $user->id]);

        $this->assertInstanceOf(User::class, $loan->borrower);
        $this->assertEquals($user->id, $loan->borrower->id);
    }

    public function test_loan_belongs_to_month(): void
    {
        $month = Month::factory()->create();
        $loan  = Loan::factory()->create(['month_id' => $month->id]);

        $this->assertInstanceOf(Month::class, $loan->month);
    }

    public function test_loan_has_many_repayments(): void
    {
        $loan = Loan::factory()->create();
        Repayment::factory()->count(3)->create(['loan_id' => $loan->id]);

        $this->assertCount(3, $loan->repayments);
    }

    public function test_loan_has_many_penalties(): void
    {
        $loan = Loan::factory()->create();
        Penalty::factory()->count(2)->create(['loan_id' => $loan->id]);

        $this->assertCount(2, $loan->penalties);
    }

    /* ── Scopes ── */

    public function test_scope_voluntary(): void
    {
        Loan::factory()->count(2)->create(['type' => 'voluntary']);
        Loan::factory()->create(['type' => 'forced']);

        $this->assertEquals(2, Loan::voluntary()->count());
    }

    public function test_scope_forced(): void
    {
        Loan::factory()->create(['type' => 'voluntary']);
        Loan::factory()->count(3)->create(['type' => 'forced']);

        $this->assertEquals(3, Loan::forced()->count());
    }

    /* ── Custom Methods ── */

    public function test_is_forced(): void
    {
        $voluntary = Loan::factory()->create(['type' => 'voluntary']);
        $forced    = Loan::factory()->create(['type' => 'forced']);

        $this->assertFalse($voluntary->isForced());
        $this->assertTrue($forced->isForced());
    }

    /* ── Casts ── */

    public function test_decimal_casts(): void
    {
        $loan = Loan::factory()->create([
            'amount'             => 1234.56,
            'interest_rate'      => 10.50,
            'total_payable'      => 1358.02,
            'outstanding_balance'=> 1358.02,
        ]);

        $loan->refresh();
        $this->assertIsString($loan->amount);
        $this->assertEquals('1234.56', $loan->amount);
        $this->assertEquals('10.50', $loan->interest_rate);
    }
}
