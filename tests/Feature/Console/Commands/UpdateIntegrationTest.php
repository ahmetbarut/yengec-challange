<?php

namespace Tests\Feature\Console\Commands;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateIntegrationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testUpdateIntegration(): void
    {
        $integration = \App\Models\Integration::factory()->create();

        $command = $this->artisan('app:update-integration')
            ->expectsQuestion('Integrations ID?', $integration->id)
            ->expectsQuestion('Name', 'test')
            ->expectsQuestion('Marketplace?', 'n11')
            ->expectsQuestion('Password? if you dont want to change password, leave it blank', 'test')

            ->expectsOutput('Integration updated')
            ->expectsOutputToContain('test');
    }

    public function testUpdateIntegrationWithWrongId()
    {
        $command = $this->artisan('app:update-integration', [
            '--id' => 0,
        ])
            ->expectsOutput('Integration not found')
            ->assertExitCode(1);
    }
}
