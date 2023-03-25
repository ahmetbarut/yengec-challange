<?php

namespace Tests\Feature\Console\Commands;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DestroyIntegrationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testDestroyIntegration(): void
    {
        $integration = \App\Models\Integration::factory()->create();
        $command = $this->artisan('app:destroy-integration')
            ->expectsQuestion('Integrations ID?', $integration->id)
            ->expectsOutput('Integration deleted')
            ->assertExitCode(0);
    }

    public function testDestroyIntegrationWithWrongId()
    {
        $command = $this->artisan('app:destroy-integration', [
            '--id' => 0,
        ])
            ->expectsOutput('Integration not found')
            ->assertExitCode(1);
    }
}
