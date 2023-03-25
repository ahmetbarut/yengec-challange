<?php

namespace Tests\Feature\Console\Commands;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateIntegrationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testCreateIntegration(): void
    {
        $user = \App\Models\User::factory()->create();
        $command = $this->artisan('app:create-integration')
        ->expectsQuestion('User?', $user->email)
        ->expectsQuestion('Name?', 'test')
        ->expectsQuestion('Marketplace?', 'n11')
        ->expectsQuestion('Password?', 'test')
        ->assertSuccessful()
        ->expectsOutput('Integration created')
        ->expectsOutputToContain('test')
        ;
    }

    public function testCreateIntegrationWithWrongUser()
    {
        $command = $this->artisan('app:create-integration', [
            'marketplace' => 'n11',
            'name' => 'test',
            'password' => 'test',
        ])->expectsQuestion('User?', 0)
            ->assertExitCode(1);
    }
}
