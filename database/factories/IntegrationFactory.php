<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Integration>
 */
class IntegrationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'marketplace' => collect(['n11', 'trendyol'])->random(),
            'password' => bcrypt('test_password'),
            'user_id' => \App\Models\User::factory()->create()->id,
        ];
    }
}
