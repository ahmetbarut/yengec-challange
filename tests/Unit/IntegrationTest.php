<?php

namespace Tests\Unit;

use App\Contracts\IntegrationContract;
use App\Models\Integration;
use Tests\TestCase;

class IntegrationTest extends TestCase
{
    /**
     * @var IntegrationContract $integrationRepository
     */
    protected $integrationRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->integrationRepository = $this->app->make(IntegrationContract::class);
    }

    /**
     * A basic unit test example.
     */
    public function testCreate(): void
    {
        $user = \App\Models\User::factory()->create();
        $integration = $this->integrationRepository->create([
            'name' => 'Test Integration',
            'marketplace' => 'Test Integration Description',
            'password' => bcrypt('test_password'),
            'user_id' => $user->id,
        ]);

        $this->assertNotNull($integration);

        $this->assertEquals('Test Integration', $integration->name);
    }

    public function testFind(): void
    {
        $user = \App\Models\User::factory()->create();

        $integration = $this->integrationRepository->create([
            'name' => 'Test Integration',
            'marketplace' => 'Test Integration Description',
            'password' => bcrypt('test_password'),
            'user_id' => $user->id,
        ]);

        $this->assertNotNull($integration);

        $integration = $this->integrationRepository->find($integration->id);

        $this->assertNotNull($integration);

        $this->assertEquals('Test Integration', $integration->name);

        $integration = $this->integrationRepository->findOneOrFail($integration->id);

        $this->assertNotNull($integration);

        $this->assertEquals('Test Integration', $integration->name);
    }

    public function testUpdate(): void
    {
        $user = \App\Models\User::factory()->create();

        $integration = $this->integrationRepository->create([
            'name' => 'Test Integration',
            'marketplace' => 'Test Integration Description',
            'password' => bcrypt('test_password'),
            'user_id' => $user->id,
        ]);

        $this->assertNotNull($integration);

        $updated = $integration->update([
            'name' => 'Test Integration Updated',
            'marketplace' => 'Test Integration Description Updated',
            'password' => bcrypt('test_password_updated'),
        ]);

        $integration = $this->integrationRepository->find($integration->id);

        $this->assertTrue($updated);
        $this->assertNotNull($integration);

        $this->assertEquals('Test Integration Updated', $integration->name);
        $this->assertEquals('Test Integration Description Updated', $integration->marketplace);
    }

    public function testDelete(): void
    {
        $user = \App\Models\User::factory()->create();

        $integration = $this->integrationRepository->create([
            'name' => 'Test Integration',
            'marketplace' => 'Test Integration Description',
            'password' => bcrypt('test_password'),
            'user_id' => $user->id,
        ]);

        $this->assertNotNull($integration);

        $deleted = $integration->delete();

        $this->assertTrue($deleted);
    }

    public function testListIntegrations(): void
    {
        Integration::factory(15)->create();

        $integrations = $this->integrationRepository->list();

        $this->assertNotNull($integrations);

        $this->assertEquals(15, $integrations->count());

        $integrations = $this->integrationRepository->list(
            limit: 5
        );

        $this->assertNotNull($integrations);

        $this->assertEquals(5, $integrations->count());
    }
}
