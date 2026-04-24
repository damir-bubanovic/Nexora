<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use App\Models\TaskReport;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        $damir = User::create([
            'name' => 'Damir',
            'email' => 'damir@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // Create other users (developers)
        $otherUsers = User::factory()->count(4)->create([
            'password' => Hash::make('password123'),
            'role' => 'developer',
        ]);

        // Combine users
        $users = $otherUsers->prepend($damir);

        // Create projects
        Project::factory()
            ->count(30)
            ->make()
            ->each(function ($project) use ($users) {
                $owner = $users->random();

                $project->created_by = $owner->id;
                $project->save();

                // Assign 1–3 random users to the project
                $assignedUsers = $users->random(rand(1, 3))->pluck('id')->toArray();

                // Make sure the project owner is assigned too
                if (! in_array($owner->id, $assignedUsers)) {
                    $assignedUsers[] = $owner->id;
                }

                $project->users()->sync($assignedUsers);

                // Create tasks
                Task::factory()
                    ->count(rand(1, 10))
                    ->create([
                        'project_id' => $project->id,
                        'created_by' => $owner->id,
                        'assigned_to' => $users->random()->id,
                    ])
                    ->each(function ($task) use ($owner) {

                        // Create reports
                        TaskReport::factory()
                            ->count(rand(1, 3))
                            ->create([
                                'task_id' => $task->id,
                                'created_by' => $owner->id,
                            ]);
                    });
            });
    }
}