<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IntegrationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testCreateIntegration(): void
    {
        $user = \App\Models\User::factory()->create();

        $response = $this->actingAs($user, 'api')->postJson('/api/integrations', [
            'marketplace' => 'n11',
            'name' => 'test',
            'password' => 'test',
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('integrations', [
            'marketplace' => 'n11',
            'name' => 'test',
            'password' => 'test',
        ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
        ]);
    }

    public function testWithoutAuthenticationCreateIntegration()
    {
        $response = $this->postJson('/api/integrations', [
            'marketplace' => 'n11',
            'name' => 'test',
            'password' => 'test',
        ]);

        $response->assertStatus(401);
    }

    public function testCreateValidationErrors()
    {
        $user = \App\Models\User::factory()->create();

        $response = $this->actingAs($user, 'api')->postJson('/api/integrations', [
            'marketplace' => 'n11',
            'name' => 'test',
        ]);

        $response->assertStatus(422);

        $response->assertJsonValidationErrors(['password']);
    }

    public function testUpdateIntegration(): void
    {
        $user = \App\Models\User::factory()->create();

        $integration = \App\Models\Integration::factory()->create([
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user, 'api')->putJson('/api/integrations/' . $integration->id, [
            'marketplace' => 'n11',
            'name' => 'test',
        ]);

        $response->assertStatus(204);

        $this->assertDatabaseHas('integrations', [
            'marketplace' => 'n11',
            'name' => 'test',
            'id' => $integration->id,
        ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
        ]);
    }

    public function testUpdateIntegrationWithoutAuthentication(): void
    {
        $integration = \App\Models\Integration::factory()->create();

        $response = $this->putJson('/api/integrations/' . $integration->id, [
            'marketplace' => 'n11',
            'name' => 'test',
        ]);

        $response->assertStatus(401);
    }

    public function testUpdateIntegrationWithoutAuthorization(): void
    {
        $user = \App\Models\User::factory()->create();

        $integration = \App\Models\Integration::factory()->create();

        $response = $this->actingAs($user, 'api')->putJson('/api/integrations/' . $integration->id, [
            'marketplace' => 'n11',
            'name' => 'test',
        ]);

        $response->assertStatus(403);
    }

    public function testUpdateIntegrationValidationErrors(): void
    {
        $user = \App\Models\User::factory()->create();

        $integration = \App\Models\Integration::factory()->create([
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user, 'api')->putJson('/api/integrations/' . $integration->id, [
            'marketplace' => 'n11',
        ]);

        $response->assertStatus(422);

        $response->assertJsonValidationErrors(['name']);
    }

    public function testDeleteIntegration(): void
    {
        $user = \App\Models\User::factory()->create();

        $integration = \App\Models\Integration::factory()->create([
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user, 'api')->deleteJson('/api/integrations/' . $integration->id);

        $response->assertStatus(204);

        $this->assertDatabaseMissing('integrations', [
            'id' => $integration->id,
        ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
        ]);
    }
}
