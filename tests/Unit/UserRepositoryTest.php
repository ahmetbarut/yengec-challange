<?php

namespace Tests\Unit;

use App\Contracts\UserContract;
use App\Models\User;
use App\Repositories\UserRepository;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    /**
     * @var UserRepository $userRepository
     */
    protected $userRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->userRepository = $this->app->make(UserContract::class);
    }
    /**
     * A basic unit test example.
     */
    public function testCreateUser(): void
    {
        $user = $this->userRepository->create([
            'name' => 'Test User',
            'email' => 'test_user_email@test.email',
            'password' => bcrypt('test_password'),
        ]);

        $this->assertNotNull($user);

        $this->assertEquals('Test User', $user->name);
    }

    public function testFindUser(): void
    {
        $user = $this->userRepository->create([
            'name' => 'Test User',
            'email' => 'test_user_email@test.email',
            'password' => bcrypt('test_password'),
        ]);

        $this->assertNotNull($user);

        $user = $this->userRepository->find($user->id);

        $this->assertNotNull($user);

        $this->assertEquals('Test User', $user->name);

        $user = $this->userRepository->findOneOrFail($user->id);

        $this->assertNotNull($user);

        $this->assertEquals('Test User', $user->name);

        $user = $this->userRepository->findByEmail('test_user_email@test.email');

        $this->assertNotNull($user);
    }

    public function testUpdateUser(): void
    {
        $user = $this->userRepository->create([
            'name' => 'Test User',
            'email' => 'test_user_email@test.email',
            'password' => bcrypt('test_password'),
        ]);

        $this->assertNotNull($user);

        $updated = $user->update([
            'name' => 'Test User Updated',
            'email' => 'test_user_email@test.email',
            'password' => bcrypt('test_password'),
        ]);

        $this->assertTrue($updated);

        $user = $this->userRepository->findOneOrFail($user->id);

        $this->assertNotNull($user);

        $this->assertEquals('Test User Updated', $user->name);
    }

    public function testDeleteUser(): void
    {
        $user = $this->userRepository->create([
            'name' => 'Test User',
            'email' => 'test_user_email@test.email',
            'password' => bcrypt('test_password'),
        ]);

        $this->assertNotNull($user);

        $deleted = $user->delete();

        $this->assertTrue($deleted);
    }

    public function testListUsers(): void
    {
        User::factory(15)->create();

        $users = $this->userRepository->list(
            limit : 10,
        );

        $this->assertNotNull($users);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $users);

        $this->assertCount(10, $users);
    }
}
