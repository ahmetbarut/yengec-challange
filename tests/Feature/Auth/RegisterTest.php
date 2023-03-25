<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class RegisterTest extends TestCase
{
    public function testHasValidationError(): void
    {
        $response = $this->post(
            '/api/register',
            [
                'name' => null,
                'email' => 'email_test',
                'password' => 'password',
                'password_confirmation' => 'not-confirmed',
            ],
            [
                'Accept' => 'application/json',
            ]
        );

        $response->assertStatus(422);


        $response->assertJsonValidationErrors([
            'name',
            'email',
            'password',
        ]);
    }

    public function testExistEmailError()
    {
        $user = User::factory()->create();

        $response = $this->postJson(
            '/api/register',
            [
                'name' => 'John Doe',
                'email' => $user->email,
                'password' => 'password',
                'password_confirmation' => 'password',
            ],
        );

        $response->assertStatus(422);


        $response->assertJsonValidationErrors([
            'email',
        ]);

        $user->delete();
    }

    /**
     * A basic feature test example.
     */
    public function testRegister(): string
    {
        $response = $this->postJson(
            '/api/register',
            [
                'name' => 'John Doe',
                'email' => 'email_test@email.com',
                'password' => 'password',
                'password_confirmation' => 'password',
            ]
        );

        $response->assertStatus(201);

        $response->assertJsonStructure([
            'access_token',
        ]);

        $token = $response->json('access_token');

        return $token;
    }
}
