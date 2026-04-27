<?php

namespace Tests\Unit\Models;

use App\Models\User;
use App\Models\VillageBanking\Circle;
use App\Models\VillageBanking\Loan;
use App\Models\VillageBanking\Month;
use App\Models\VillageBanking\Repayment;
use App\Models\VillageBanking\ShareDeclaration;
use App\Models\VillageBanking\Transaction;
use App\Models\VillageBanking\ShareoutAllocation;
use App\Models\VillageBanking\VillageBank;
use App\Models\Subscription\Subscription;
use App\Models\Subscription\License;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SoftDeletesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->superAdmin()->create());
    }

    /* ── Loan ── */

    public function test_loan_soft_deletes(): void
    {
        $loan = Loan::factory()->create();
        $loan->delete();

        $this->assertSoftDeleted('loans', ['id' => $loan->id]);
        $this->assertNull(Loan::find($loan->id));
        $this->assertNotNull(Loan::withTrashed()->find($loan->id));
    }

    public function test_loan_can_be_restored(): void
    {
        $loan = Loan::factory()->create();
        $loan->delete();
        $loan->restore();

        $this->assertNotNull(Loan::find($loan->id));
    }

    /* ── Repayment ── */

    public function test_repayment_soft_deletes(): void
    {
        $repayment = Repayment::factory()->create();
        $repayment->delete();

        $this->assertSoftDeleted('repayments', ['id' => $repayment->id]);
        $this->assertNotNull(Repayment::withTrashed()->find($repayment->id));
    }

    /* ── Circle ── */

    public function test_circle_soft_deletes(): void
    {
        $circle = Circle::factory()->create();
        $circle->delete();

        $this->assertSoftDeleted('circles', ['id' => $circle->id]);
        $this->assertNotNull(Circle::withTrashed()->find($circle->id));
    }

    /* ── ShareDeclaration ── */

    public function test_share_declaration_soft_deletes(): void
    {
        $sd = ShareDeclaration::factory()->create();
        $sd->delete();

        $this->assertSoftDeleted('share_declarations', ['id' => $sd->id]);
    }

    /* ── Subscription ── */

    public function test_subscription_soft_deletes(): void
    {
        $sub = Subscription::factory()->create();
        $sub->delete();

        $this->assertSoftDeleted('subscriptions', ['id' => $sub->id]);
        $this->assertNotNull(Subscription::withTrashed()->find($sub->id));
    }

    /* ── License ── */

    public function test_license_soft_deletes(): void
    {
        $license = License::factory()->create();
        $license->delete();

        $this->assertSoftDeleted('licenses', ['id' => $license->id]);
        $this->assertNotNull(License::withTrashed()->find($license->id));
    }

    /* ── Verify trashed records don't appear in normal queries ── */

    public function test_trashed_loans_excluded_from_default_query(): void
    {
        $loan1 = Loan::factory()->create();
        $loan2 = Loan::factory()->create();
        $loan1->delete();

        $this->assertCount(1, Loan::all());
        $this->assertCount(2, Loan::withTrashed()->get());
    }

    public function test_force_delete_permanently_removes_record(): void
    {
        $loan = Loan::factory()->create();
        $loan->forceDelete();

        $this->assertNull(Loan::withTrashed()->find($loan->id));
    }
}
