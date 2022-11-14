<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Gate;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ApprovePaymentTest extends TestCase
{
    /**
     * Approve a payment api feature test.
     *
     * @return void
     */
    public function test_approve_payment_request()
    {
        $user = User::factory()->create();

        Sanctum::actingAs(
            $user
        );

        Gate::forUser($user)->authorize('approve-payment');

        $response = $this->withHeaders([
            'X-Accept' => 'application/json',
        ])->postJson('/api/payment/13/approve');

        $response->assertStatus(201);
    }

    /**
     * Create approval payment api feature test.
     *
     * @return void
     */
    public function test_create_approval_payment_request()
    {
        Sanctum::actingAs(
            User::factory()->create()
        );

        $response = $this->withHeaders([
            'X-Accept' => 'application/json',
        ])->postJson('/api/payment-approval', [
            'user_id' => 5,
            'payment_id' => 20,
            'payment_type' => 'credit card',
            'status' => 'APPROVED'
        ]);

        $response->assertStatus(201);
    }

    /**
     * Create approval payment api feature test.
     *
     * @return void
     */
    public function test_get_approved_payments_request()
    {
        Sanctum::actingAs(
            User::factory()->create()
        );

        $response = $this->withHeaders([
            'X-Accept' => 'application/json',
        ])->getJson('/api/approved-payments');

        $response->assertOk();
    }
}
