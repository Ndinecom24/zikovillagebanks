<?php

namespace Tests\Unit\Models;

use App\Models\User;
use App\Models\VillageBanking\Circle;
use App\Models\VillageBanking\Month;
use App\Models\VillageBanking\ShareDeclaration;
use App\Models\VillageBanking\VillageBank;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CircleMonthModelTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->superAdmin()->create());
    }

    /* ── Circle ── */

    public function test_circle_belongs_to_village_bank(): void
    {
        $bank   = VillageBank::factory()->create();
        $circle = Circle::factory()->create(['village_bank_id' => $bank->id]);

        $this->assertInstanceOf(VillageBank::class, $circle->villageBank);
        $this->assertEquals($bank->id, $circle->villageBank->id);
    }

    public function test_circle_has_many_months(): void
    {
        $circle = Circle::factory()->create();
        Month::factory()->count(12)->create(['circle_id' => $circle->id]);

        $this->assertCount(12, $circle->months);
    }

    public function test_circle_belongs_to_creator(): void
    {
        $user   = User::factory()->create();
        $circle = Circle::factory()->create(['created_by' => $user->id]);

        $this->assertInstanceOf(User::class, $circle->creator);
        $this->assertEquals($user->id, $circle->creator->id);
    }

    public function test_circle_members_belong_to_many(): void
    {
        $circle = Circle::factory()->create();
        $users  = User::factory()->count(5)->create();

        foreach ($users as $user) {
            $circle->members()->attach($user->id, ['joined_at' => now()]);
        }

        $this->assertCount(5, $circle->members);
    }

    public function test_circle_date_casts(): void
    {
        $circle = Circle::factory()->create([
            'start_date' => '2026-01-15',
            'end_date'   => '2027-01-15',
        ]);

        $this->assertInstanceOf(\Carbon\Carbon::class, $circle->start_date);
        $this->assertInstanceOf(\Carbon\Carbon::class, $circle->end_date);
    }

    /* ── Month ── */

    public function test_month_belongs_to_circle(): void
    {
        $circle = Circle::factory()->create();
        $month  = Month::factory()->create(['circle_id' => $circle->id]);

        $this->assertInstanceOf(Circle::class, $month->circle);
    }

    public function test_month_has_many_share_declarations(): void
    {
        $month = Month::factory()->create();
        ShareDeclaration::factory()->count(5)->create(['month_id' => $month->id]);

        $this->assertCount(5, $month->shareDeclarations);
    }

    public function test_month_boolean_casts(): void
    {
        $month = Month::factory()->create([
            'allow_share_declarations'     => true,
            'allow_insurance_declarations' => false,
            'allow_loan_requests'          => true,
            'allow_loan_repayments'        => false,
            'is_shareout_month'            => true,
        ]);

        $month->refresh();
        $this->assertTrue($month->allow_share_declarations);
        $this->assertFalse($month->allow_insurance_declarations);
        $this->assertTrue($month->is_shareout_month);
    }

    public function test_month_has_many_loans(): void
    {
        $month = Month::factory()->create();
        \App\Models\VillageBanking\Loan::factory()->count(3)->create(['month_id' => $month->id]);

        $this->assertCount(3, $month->loans);
    }
}
