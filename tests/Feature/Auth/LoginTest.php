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
    public function testFailedValidation(): User
    {
        $user = User::factory()->create([
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/api/login', [
            'email' => $user->email . 'wrong',
            'password' => 'wrong-password',
        ],
            [
                'Accept' => 'application/json',
            ]
        );

        $response->assertStatus(422);
        $response->assertJsonStructure([
            'message',
            'errors' => [
                'email',
            ],
        ]);

        return $user;
    }

    /**
     * @depends testFailedValidation
     */
    public function testLoginSuccessful(User $user): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ],
            [
                'Accept' => 'application/json',
            ]
        );

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'access_token',
        ]);

    }

    /**
     * @depends testLoginSuccessful
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
