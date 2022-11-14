<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    /**
     * Logout api feature test.
     *
     * @return void
     */
    public function test_logout_api_request()
    {
        Sanctum::actingAs(
            User::factory()->create()
        );

        $response = $this->withHeaders([
            'X-Accept' => 'application/json',
        ])->postJson('/api/logout');

        $response->assertOk();
    }
}
