<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * Login api feature test.
     *
     * @return void
     */
    public function test_login_api_request()
    {
        $response = $this->postJson('/api/login', [
            'email' => "stefantest@gmail.com",
            'password' => "testpass",
        ]);

        $response->assertOk();
    }
}
