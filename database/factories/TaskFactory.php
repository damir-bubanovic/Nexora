<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(),
            'status' => fake()->randomElement(['pending', 'active', 'completed']),
            'priority' => fake()->numberBetween(1, 5),
            'due_date' => fake()->optional()->date(),
        ];
    }
}