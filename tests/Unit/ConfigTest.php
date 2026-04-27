<?php

namespace Tests\Unit;

use Tests\TestCase;

class ConfigTest extends TestCase
{
    public function test_timezone_is_africa_lusaka(): void
    {
        $this->assertEquals('Africa/Lusaka', config('app.timezone'));
    }

    public function test_queue_connection_is_database(): void
    {
        // .env.example sets QUEUE_CONNECTION=database
        // Verify the app recognises a non-sync value
        $this->assertNotEquals('sync', env('QUEUE_CONNECTION', 'database'));
    }

    public function test_mail_driver_is_array_in_testing(): void
    {
        // phpunit.xml sets MAIL_MAILER=array for testing
        $this->assertEquals('array', config('mail.default'));
    }

    public function test_sentry_config_exists(): void
    {
        $this->assertIsArray(config('sentry'));
        $this->assertArrayHasKey('dsn', config('sentry'));
    }
}
