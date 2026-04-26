<?php

namespace Database\Seeders;

use App\Models\ActivityLog;
use App\Models\Bug;
use App\Models\Project;
use App\Models\Task;
use App\Models\TaskReport;
use App\Models\TaskReportRevision;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@nexora.test'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        $developerOne = User::firstOrCreate(
            ['email' => 'developer@nexora.test'],
            [
                'name' => 'Developer User',
                'password' => Hash::make('password'),
                'role' => 'developer',
            ]
        );

        $developerTwo = User::firstOrCreate(
            ['email' => 'developer2@nexora.test'],
            [
                'name' => 'Second Developer',
                'password' => Hash::make('password'),
                'role' => 'developer',
            ]
        );

        $client = User::firstOrCreate(
            ['email' => 'client@nexora.test'],
            [
                'name' => 'Client User',
                'password' => Hash::make('password'),
                'role' => 'client',
            ]
        );

        $project = Project::firstOrCreate(
            ['name' => 'Nexora Client Portal'],
            [
                'description' => 'A client project management portal for tasks, reports, bugs, and work summaries.',
                'status' => 'active',
                'created_by' => $admin->id,
            ]
        );

        $project->users()->syncWithoutDetaching([
            $developerOne->id,
            $developerTwo->id,
            $client->id,
        ]);

        $taskOne = Task::firstOrCreate(
            [
                'project_id' => $project->id,
                'title' => 'Build project dashboard',
            ],
            [
                'description' => 'Create dashboard cards for projects, tasks, reports, and bugs.',
                'status' => 'completed',
                'priority' => 8,
                'due_date' => now()->subDays(5)->toDateString(),
                'assigned_to' => $developerOne->id,
                'created_by' => $admin->id,
                'estimated_hours' => 6,
                'actual_hours' => 7.5,
                'agreed_cost' => 300,
            ]
        );

        $taskTwo = Task::firstOrCreate(
            [
                'project_id' => $project->id,
                'title' => 'Implement bug tracking',
            ],
            [
                'description' => 'Allow developers to create, assign, update, and resolve bugs.',
                'status' => 'active',
                'priority' => 7,
                'due_date' => now()->addDays(3)->toDateString(),
                'assigned_to' => $developerTwo->id,
                'created_by' => $admin->id,
                'estimated_hours' => 5,
                'actual_hours' => 2,
                'agreed_cost' => 250,
            ]
        );

        $taskThree = Task::firstOrCreate(
            [
                'project_id' => $project->id,
                'title' => 'Prepare monthly work summary',
            ],
            [
                'description' => 'Summarize completed tasks, reports, and hours worked per month.',
                'status' => 'pending',
                'priority' => 5,
                'due_date' => now()->addWeek()->toDateString(),
                'assigned_to' => $developerOne->id,
                'created_by' => $admin->id,
                'estimated_hours' => 4,
                'actual_hours' => null,
                'agreed_cost' => 200,
            ]
        );

        $bug = Bug::firstOrCreate(
            [
                'task_id' => $taskTwo->id,
                'title' => 'Bug status badge color mismatch',
            ],
            [
                'description' => 'Resolved bugs should show a clear visual badge.',
                'status' => 'open',
                'assigned_to' => $developerTwo->id,
                'created_by' => $admin->id,
            ]
        );

        $report = TaskReport::firstOrCreate(
            [
                'task_id' => $taskOne->id,
                'summary' => 'Dashboard cards were implemented and scoped by user role.',
            ],
            [
                'changed_files' => "DashboardController.php\nresources/views/dashboard.blade.php",
                'changed_lines' => 'Added role-based queries and dashboard card rendering.',
                'sql_queries' => null,
                'testing_notes' => 'Manually tested as admin, developer, and client.',
                'created_by' => $developerOne->id,
            ]
        );

        TaskReportRevision::firstOrCreate(
            [
                'task_report_id' => $report->id,
                'revision_number' => 1,
            ],
            [
                'notes' => 'Initial report created after dashboard implementation.',
                'status' => 'submitted',
                'created_by' => $developerOne->id,
            ]
        );

        ActivityLog::firstOrCreate(
            [
                'user_id' => $admin->id,
                'action' => 'create',
                'subject_type' => 'project',
                'subject_id' => $project->id,
            ],
            [
                'description' => 'Created project: ' . $project->name,
            ]
        );

        ActivityLog::firstOrCreate(
            [
                'user_id' => $developerOne->id,
                'action' => 'create',
                'subject_type' => 'task_report',
                'subject_id' => $report->id,
            ],
            [
                'description' => 'Created report for task: ' . $taskOne->title,
            ]
        );

        ActivityLog::firstOrCreate(
            [
                'user_id' => $admin->id,
                'action' => 'create',
                'subject_type' => 'bug',
                'subject_id' => $bug->id,
            ],
            [
                'description' => 'Reported bug: ' . $bug->title,
            ]
        );
    }
}