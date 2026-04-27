<?php

namespace Tests\Unit\Models;

use App\Models\Subscription\BankApplication;
use App\Models\Subscription\SubscriptionPlan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BankApplicationModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_bank_application_belongs_to_plan(): void
    {
        $plan = SubscriptionPlan::factory()->create();
        $app  = BankApplication::factory()->create(['subscription_plan_id' => $plan->id]);

        $this->assertInstanceOf(SubscriptionPlan::class, $app->plan);
        $this->assertEquals($plan->id, $app->plan->id);
    }

    public function test_bank_application_default_status_is_pending(): void
    {
        $app = BankApplication::factory()->create();

        $this->assertEquals('pending', $app->status);
    }

    public function test_bank_application_approved_state(): void
    {
        $app = BankApplication::factory()->approved()->create();

        $this->assertEquals('approved', $app->status);
        $this->assertNotNull($app->reviewed_at);
    }

    public function test_bank_application_rejected_state(): void
    {
        $app = BankApplication::factory()->rejected()->create();

        $this->assertEquals('rejected', $app->status);
        $this->assertNotNull($app->admin_remarks);
    }

    public function test_bank_application_reviewed_at_cast(): void
    {
        $app = BankApplication::factory()->approved()->create();

        $this->assertInstanceOf(\Carbon\Carbon::class, $app->reviewed_at);
    }

    public function test_bank_application_reviewer_relationship(): void
    {
        $admin = User::factory()->superAdmin()->create();
        $app   = BankApplication::factory()->create([
            'reviewed_by' => $admin->id,
        ]);

        $this->assertInstanceOf(User::class, $app->reviewer);
        $this->assertEquals($admin->id, $app->reviewer->id);
    }

    public function test_bank_application_factory_creates_valid_record(): void
    {
        $app = BankApplication::factory()->create();

        $this->assertDatabaseHas('bank_applications', ['id' => $app->id]);
        $this->assertNotEmpty($app->bank_name);
        $this->assertNotEmpty($app->contact_email);
        $this->assertNotEmpty($app->contact_staff_no);
    }
}
