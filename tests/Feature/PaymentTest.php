<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class PaymentTest extends TestCase
{
    /**
     * Get payments api feature test.
     *
     * @return void
     */
    public function test_get_payment_api_request()
    {
        Sanctum::actingAs(
            User::factory()->create()
        );

        $response = $this->withHeaders([
            'X-Accept' => 'application/json',
        ])->getJson('/api/payment');

        $response->assertOk();
    }

    /**
     * Create a payment api feature test.
     *
     * @return void
     */
    public function test_create_payment_api_request()
    {
        Sanctum::actingAs(
            User::factory()->create()
        );

        $response = $this->withHeaders([
            'X-Accept' => 'application/json',
        ])->postJson('/api/payment', [
            'user_id' => 1,
            'total_amount' => "100.00",
        ]);

        $response->assertCreated();
    }

    /**
     * Show payment api feature test.
     *
     * @return void
     */
    public function test_show_payment_api_request()
    {
        Sanctum::actingAs(
            User::factory()->create()
        );

        $response = $this->withHeaders([
            'X-Accept' => 'application/json',
        ])->getJson('/api/payment/202');

        $response->assertOk();
    }

    /**
     * Update payment api feature test.
     *
     * @return void
     */
    public function test_update_payment_api_request()
    {
        Sanctum::actingAs(
            User::factory()->create()
        );

        $response = $this->withHeaders([
            'X-Accept' => 'application/json',
        ])->putJson('/api/payment/202', [
            'total_amount' => 550
        ]);

        $response->assertOk();
    }

    /**
     * Delete payment api feature test.
     *
     * @return void
     */
    public function test_delete_payment_api_request()
    {
        Sanctum::actingAs(
            User::factory()->create()
        );

        $response = $this->withHeaders([
            'X-Accept' => 'application/json',
        ])->deleteJson('/api/payment/202');

        $response->assertOk();
    }
}
