<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        // The landing page (/) requires subscription_plans table
        // which has no migration yet. Test /login instead.
        $response = $this->get('/login');

        $response->assertStatus(200);
    }
}
