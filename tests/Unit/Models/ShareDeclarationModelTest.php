<?php

namespace Tests\Unit\Models;

use App\Models\User;
use App\Models\VillageBanking\ShareDeclaration;
use App\Models\VillageBanking\Month;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShareDeclarationModelTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->superAdmin()->create());
    }

    public function test_share_declaration_belongs_to_user(): void
    {
        $user = User::factory()->create();
        $sd   = ShareDeclaration::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $sd->user);
        $this->assertEquals($user->id, $sd->user->id);
    }

    public function test_share_declaration_belongs_to_month(): void
    {
        $month = Month::factory()->create();
        $sd    = ShareDeclaration::factory()->create(['month_id' => $month->id]);

        $this->assertInstanceOf(Month::class, $sd->month);
    }

    public function test_share_declaration_amount_cast_to_decimal(): void
    {
        $sd = ShareDeclaration::factory()->create(['amount' => 1500.75]);
        $sd->refresh();

        $this->assertEquals('1500.75', $sd->amount);
    }

    public function test_share_declaration_factory_creates_valid_record(): void
    {
        $sd = ShareDeclaration::factory()->create();

        $this->assertDatabaseHas('share_declarations', ['id' => $sd->id]);
        $this->assertNotNull($sd->user_id);
        $this->assertNotNull($sd->month_id);
    }
}
