<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * Register api feature test.
     *
     * @return void
     */
    public function test_register_api_request()
    {
//        $user = User::factory()->create([
//            "first_name" => "Stefan",
//            "last_name" => "Aritonovic",
//            "email" => "stefantestt2@gmail.com",
//            "password" => "testpass",
//            "password_confirmation" => "testpass"
//        ]);

        $response = $this->postJson('/api/register', [
            'first_name' => "Stefan",
            'last_name' => "Aritonovic",
            'email' => "stefannovii@gmail.com",
            'password' => "testpass",
            'password_confirmation' => "testpass"
        ]);

        $response->assertStatus(200);
    }
}
