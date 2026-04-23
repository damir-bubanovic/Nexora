<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\TaskReport;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaskReportController extends Controller
{
    public function index(Project $project, Task $task): View
    {
        $reports = $task->reports()->latest()->get();

        return view('task-reports.index', compact('project', 'task', 'reports'));
    }

    public function create(Project $project, Task $task): View
    {
        return view('task-reports.create', compact('project', 'task'));
    }

    public function store(Request $request, Project $project, Task $task): RedirectResponse
    {
        $validated = $request->validate([
            'summary' => ['required', 'string'],
            'changed_files' => ['nullable', 'string'],
            'changed_lines' => ['nullable', 'string'],
            'sql_queries' => ['nullable', 'string'],
            'testing_notes' => ['nullable', 'string'],
        ]);

        $validated['task_id'] = $task->id;
        $validated['created_by'] = $request->user()->id;

        TaskReport::create($validated);

        return redirect()
            ->route('projects.tasks.reports.index', [$project, $task])
            ->with('success', 'Task report created successfully.');
    }
}