<?php

namespace Tests\Unit\Services;

use App\Services\HelperService;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HelperServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_generate_reference_with_empty_table(): void
    {
        $ref = HelperService::generateReference('INV', 'users', '-ZM', 6);

        // 0 existing users + 1 = 1
        $this->assertEquals('INV000001-ZM', $ref);
    }

    public function test_generate_reference_increments_with_existing_records(): void
    {
        User::factory()->count(5)->create();

        $ref = HelperService::generateReference('USR', 'users', '', 4);

        $this->assertEquals('USR0006', $ref);
    }

    public function test_generate_reference_default_padding(): void
    {
        $ref = HelperService::generateReference('TX', 'users');

        $this->assertEquals('TX000001', $ref);
    }

    public function test_generate_reference_with_suffix(): void
    {
        $ref = HelperService::generateReference('LN', 'loans', '/2025', 8);

        $this->assertEquals('LN00000001/2025', $ref);
    }
}
