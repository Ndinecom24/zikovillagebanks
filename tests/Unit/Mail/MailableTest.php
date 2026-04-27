<?php

namespace Tests\Unit\Mail;

use App\Mail\Subscription\ApplicationApproved;
use App\Mail\Subscription\ApplicationReceived;
use App\Mail\Subscription\ApplicationRejected;
use App\Mail\Subscription\LicenseExpiringSoon;
use App\Mail\Subscription\LicenseExpiryAdminAlert;
use App\Mail\Subscription\NewApplicationAdminAlert;
use App\Models\Subscription\BankApplication;
use App\Models\Subscription\License;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MailableTest extends TestCase
{
    use RefreshDatabase;

    /* ── ShouldQueue interface ── */

    public function test_application_approved_implements_should_queue(): void
    {
        $app = BankApplication::factory()->create();
        $mailable = new ApplicationApproved($app, 'LIC-KEY-123', 'MBR-00000001', 'securePass99');

        $this->assertInstanceOf(ShouldQueue::class, $mailable);
    }

    public function test_application_rejected_implements_should_queue(): void
    {
        $app = BankApplication::factory()->create();
        $mailable = new ApplicationRejected($app);

        $this->assertInstanceOf(ShouldQueue::class, $mailable);
    }

    public function test_application_received_implements_should_queue(): void
    {
        $app = BankApplication::factory()->create();
        $mailable = new ApplicationReceived($app);

        $this->assertInstanceOf(ShouldQueue::class, $mailable);
    }

    public function test_new_application_admin_alert_implements_should_queue(): void
    {
        $app = BankApplication::factory()->create();
        $mailable = new NewApplicationAdminAlert($app);

        $this->assertInstanceOf(ShouldQueue::class, $mailable);
    }

    public function test_license_expiring_soon_implements_should_queue(): void
    {
        $license = License::factory()->expiringSoon()->create();
        $mailable = new LicenseExpiringSoon($license, 7);

        $this->assertInstanceOf(ShouldQueue::class, $mailable);
    }

    public function test_license_expiry_admin_alert_implements_should_queue(): void
    {
        $license = License::factory()->expiringSoon()->create();
        $mailable = new LicenseExpiryAdminAlert($license, 7);

        $this->assertInstanceOf(ShouldQueue::class, $mailable);
    }

    /* ── ApplicationApproved content ── */

    public function test_application_approved_has_correct_subject(): void
    {
        $app = BankApplication::factory()->create();
        $mailable = new ApplicationApproved($app, 'LIC-KEY-123', 'MBR-00000001', 'securePass99');
        $mailable->build();

        $this->assertEquals('Application Approved — Village Banking Platform', $mailable->subject);
    }

    public function test_application_approved_passes_data_to_view(): void
    {
        $app = BankApplication::factory()->create();
        $mailable = new ApplicationApproved($app, 'LIC-KEY-XYZ', 'MBR-00000042', 'testpwd123');

        $this->assertEquals('LIC-KEY-XYZ', $mailable->licenseKey);
        $this->assertEquals('MBR-00000042', $mailable->staffNo);
        $this->assertEquals('testpwd123', $mailable->defaultPassword);
    }

    public function test_application_approved_does_not_use_hardcoded_password(): void
    {
        $app = BankApplication::factory()->create();
        $mailable = new ApplicationApproved($app, 'LIC-123', 'MBR-00000001', 'randomStr');

        $this->assertNotEquals('password123', $mailable->defaultPassword);
    }

    /* ── ApplicationRejected content ── */

    public function test_application_rejected_has_correct_subject(): void
    {
        $app = BankApplication::factory()->rejected()->create();
        $mailable = new ApplicationRejected($app);
        $mailable->build();

        $this->assertStringContainsString('Rejected', $mailable->subject);
    }
}
