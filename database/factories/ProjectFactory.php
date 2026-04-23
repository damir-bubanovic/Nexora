<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'status' => fake()->randomElement(['active', 'pending', 'completed']),
            'start_date' => fake()->optional()->date(),
            'end_date' => fake()->optional()->date(),
        ];
    }
}