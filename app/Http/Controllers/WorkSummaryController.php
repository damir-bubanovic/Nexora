<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskReport;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class WorkSummaryController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        $taskQuery = Task::query();
        $reportQuery = TaskReport::query();

        if (! $user->isAdmin()) {
            $projectIds = $user->projects()->pluck('projects.id');

            $taskQuery->where(function ($query) use ($user, $projectIds) {
                $query->where('assigned_to', $user->id)
                    ->orWhereIn('project_id', $projectIds);
            });

            $reportQuery->whereHas('task', function ($query) use ($user, $projectIds) {
                $query->where('assigned_to', $user->id)
                    ->orWhereIn('project_id', $projectIds);
            });
        }

        $completedTasksByMonth = (clone $taskQuery)
            ->where('status', 'completed')
            ->whereNotNull('updated_at')
            ->get()
            ->groupBy(fn ($task) => $task->updated_at->format('Y-m'))
            ->map(fn ($tasks) => $tasks->count());

        $reportsByMonth = (clone $reportQuery)
            ->whereNotNull('created_at')
            ->get()
            ->groupBy(fn ($report) => $report->created_at->format('Y-m'))
            ->map(fn ($reports) => $reports->count());

        $actualHoursByMonth = (clone $taskQuery)
            ->whereNotNull('actual_hours')
            ->get()
            ->groupBy(fn ($task) => $task->updated_at->format('Y-m'))
            ->map(fn ($tasks) => $tasks->sum('actual_hours'));

        $months = collect()
            ->merge($completedTasksByMonth->keys())
            ->merge($reportsByMonth->keys())
            ->merge($actualHoursByMonth->keys())
            ->unique()
            ->sortDesc()
            ->values();

        return view('work-summary.index', compact(
            'months',
            'completedTasksByMonth',
            'reportsByMonth',
            'actualHoursByMonth'
        ));
    }
}