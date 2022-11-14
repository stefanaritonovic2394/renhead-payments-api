<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TravelPaymentTest extends TestCase
{
    /**
     * Get travel payments api feature test.
     *
     * @return void
     */
    public function test_get_travel_payment_api_request()
    {
        Sanctum::actingAs(
            User::factory()->create()
        );

        $response = $this->withHeaders([
            'X-Accept' => 'application/json',
        ])->getJson('/api/travel-payment');

        $response->assertOk();
    }

    /**
     * Create a travel payment api feature test.
     *
     * @return void
     */
    public function test_create_travel_payment_api_request()
    {
        Sanctum::actingAs(
            User::factory()->create()
        );

        $response = $this->withHeaders([
            'X-Accept' => 'application/json',
        ])->postJson('/api/travel-payment', [
            'user_id' => 1,
            'amount' => "100.00",
        ]);

        $response->assertCreated();
    }

    /**
     * Show travel payment api feature test.
     *
     * @return void
     */
    public function test_show_travel_payment_api_request()
    {
        Sanctum::actingAs(
            User::factory()->create()
        );

        $response = $this->withHeaders([
            'X-Accept' => 'application/json',
        ])->getJson('/api/travel-payment/201');

        $response->assertOk();
    }

    /**
     * Update travel payment api feature test.
     *
     * @return void
     */
    public function test_update_travel_payment_api_request()
    {
        Sanctum::actingAs(
            User::factory()->create()
        );

        $response = $this->withHeaders([
            'X-Accept' => 'application/json',
        ])->putJson('/api/travel-payment/201', [
            'amount' => 550
        ]);

        $response->assertOk();
    }

    /**
     * Delete travel payment api feature test.
     *
     * @return void
     */
    public function test_delete_travel_payment_api_request()
    {
        Sanctum::actingAs(
            User::factory()->create()
        );

        $response = $this->withHeaders([
            'X-Accept' => 'application/json',
        ])->deleteJson('/api/travel-payment/201');

        $response->assertOk();
    }
}
