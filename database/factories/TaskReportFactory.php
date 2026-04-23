<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TaskReportFactory extends Factory
{
    public function definition(): array
    {
        return [
            'summary' => fake()->paragraph(),

            'changed_files' => fake()->randomElement([
                "app/Http/Controllers/ProjectController.php",
                "resources/views/projects/index.blade.php",
                "app/Models/Task.php",
            ]),

            'changed_lines' => fake()->randomElement([
                "12-30",
                "45-78",
                "101-140",
            ]),

            'sql_queries' => fake()->boolean(40)
                ? "ALTER TABLE tasks ADD COLUMN example VARCHAR(255);"
                : null,

            'testing_notes' => fake()->sentence(),
        ];
    }
}