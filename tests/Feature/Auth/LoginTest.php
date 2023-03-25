<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testFailedValidation(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('password'),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => $user->email . 'wrong',
            'password' => 'wrong-password',
        ]
        );

        $response->assertStatus(422);
        $response->assertJsonStructure([
            'message',
            'errors' => [
                'email',
            ],
        ]);
    }

    /**
     */
    public function testLoginSuccessful(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('password'),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'password',
            ]
        );

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'access_token',
        ]);

    }

    /**
     */
    public function testLoginSuccessfulWithToken(): void
    {
        $token = User::factory()->create()->createToken('auth_token')->accessToken;
        $response = $this->get('/api/user', [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertStatus(200);
    }
}
