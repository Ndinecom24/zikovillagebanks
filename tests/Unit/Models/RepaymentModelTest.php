<?php

namespace Tests\Unit\Models;

use App\Models\User;
use App\Models\VillageBanking\Loan;
use App\Models\VillageBanking\Month;
use App\Models\VillageBanking\Repayment;
use App\Models\VillageBanking\ShareDeclaration;
use App\Models\VillageBanking\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RepaymentModelTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->superAdmin()->create());
    }

    public function test_repayment_belongs_to_loan(): void
    {
        $loan      = Loan::factory()->create();
        $repayment = Repayment::factory()->create(['loan_id' => $loan->id]);

        $this->assertInstanceOf(Loan::class, $repayment->loan);
        $this->assertEquals($loan->id, $repayment->loan->id);
    }

    public function test_repayment_decimal_casts(): void
    {
        $repayment = Repayment::factory()->create([
            'amount_paid'       => 500.50,
            'remaining_balance' => 1200.75,
            'penalty_applied'   => 50.25,
        ]);

        $repayment->refresh();
        $this->assertEquals('500.50', $repayment->amount_paid);
        $this->assertEquals('1200.75', $repayment->remaining_balance);
        $this->assertEquals('50.25', $repayment->penalty_applied);
    }

    public function test_repayment_factory_creates_valid_record(): void
    {
        $repayment = Repayment::factory()->create();

        $this->assertDatabaseHas('repayments', ['id' => $repayment->id]);
        $this->assertNotNull($repayment->loan_id);
    }

    public function test_multiple_repayments_for_same_loan(): void
    {
        $loan = Loan::factory()->create();

        Repayment::factory()->count(5)->create(['loan_id' => $loan->id]);

        $this->assertCount(5, $loan->repayments);
    }
}
