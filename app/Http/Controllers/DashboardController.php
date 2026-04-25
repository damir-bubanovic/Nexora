<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Bug;
use App\Models\Project;
use App\Models\Task;
use App\Models\TaskReport;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $user = Auth::user();

        $projectQuery = Project::query();
        $taskQuery = Task::query();
        $bugQuery = Bug::query();
        $reportQuery = TaskReport::query();
        $activityQuery = ActivityLog::query();

        if (! $user->isAdmin()) {
            $projectIds = $user->projects()->pluck('projects.id');

            $projectQuery->whereIn('id', $projectIds);

            $taskQuery->where(function ($query) use ($user, $projectIds) {
                $query->where('assigned_to', $user->id)
                    ->orWhereIn('project_id', $projectIds);
            });

            $bugQuery->whereHas('task', function ($query) use ($user, $projectIds) {
                $query->where('assigned_to', $user->id)
                    ->orWhereIn('project_id', $projectIds);
            });

            $reportQuery->whereHas('task', function ($query) use ($user, $projectIds) {
                $query->where('assigned_to', $user->id)
                    ->orWhereIn('project_id', $projectIds);
            });

            $activityQuery->where(function ($query) use ($projectIds) {
                $query->where('subject_type', 'project')
                    ->whereIn('subject_id', $projectIds);
            });
        }

        return view('dashboard', [
            'totalProjects' => (clone $projectQuery)->count(),
            'activeProjects' => (clone $projectQuery)->where('status', 'active')->count(),

            'totalTasks' => (clone $taskQuery)->count(),
            'pendingTasks' => (clone $taskQuery)->where('status', 'pending')->count(),
            'completedTasks' => (clone $taskQuery)->where('status', 'completed')->count(),

            'totalReports' => (clone $reportQuery)->count(),

            'totalBugs' => (clone $bugQuery)->count(),
            'openBugs' => (clone $bugQuery)->where('status', 'open')->count(),
            'inProgressBugs' => (clone $bugQuery)->where('status', 'in_progress')->count(),
            'resolvedBugs' => (clone $bugQuery)->where('status', 'resolved')->count(),

            'myTasksCount' => Task::where('assigned_to', $user->id)->count(),
            'myOpenBugs' => Bug::where('assigned_to', $user->id)
                ->where('status', '!=', 'resolved')
                ->count(),

            'recentActivities' => (clone $activityQuery)
                ->latest()
                ->take(10)
                ->get(),
        ]);
    }
}