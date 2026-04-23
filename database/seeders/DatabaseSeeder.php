<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Models\TaskReport;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $damir = User::factory()->create([
            'name' => 'Damir',
            'email' => 'damir@gmail.com',
            'password' => Hash::make('password123'),
        ]);

        $otherUsers = User::factory()->count(4)->create();

        $users = $otherUsers->prepend($damir);

        Project::factory()
            ->count(30)
            ->make()
            ->each(function ($project) use ($users) {
                $owner = $users->random();

                $project->created_by = $owner->id;
                $project->save();

                Task::factory()
                    ->count(rand(1, 10))
                    ->make()
                    ->each(function ($task) use ($project, $owner) {
                        $task->project_id = $project->id;
                        $task->created_by = $owner->id;
                        $task->save();

                        TaskReport::factory()
                            ->count(rand(1, 3))
                            ->make()
                            ->each(function ($report) use ($task, $owner) {
                                $report->task_id = $task->id;
                                $report->created_by = $owner->id;
                                $report->save();
                            });
                    });
            });
    }
}