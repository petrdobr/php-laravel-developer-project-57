<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->title(),
            'description' => fake()->text(),
            'id' => fake()->unique()->randomNumber(),
            'status_id' => fake()->unique()->randomNumber(),
            'created_by_id' => fake()->unique()->randomNumber(),
            'assigned_to_id' => fake()->unique()->randomNumber(),
        ];
    }
}
