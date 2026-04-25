<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\TaskReport;
use App\Models\TaskReportRevision;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaskReportRevisionController extends Controller
{
    public function index(Project $project, Task $task, TaskReport $report): View
    {
        $this->authorizeNestedTask($project, $task);
        $this->authorizeReportAccess($task, $report);

        $revisions = $report->revisions()->latest()->get();

        return view('task-report-revisions.index', compact('project', 'task', 'report', 'revisions'));
    }

    public function create(Project $project, Task $task, TaskReport $report): View
    {
        $this->authorizeNestedTask($project, $task);
        $this->authorizeReportAccess($task, $report);

        return view('task-report-revisions.create', compact('project', 'task', 'report'));
    }

    public function store(Request $request, Project $project, Task $task, TaskReport $report): RedirectResponse
    {
        $this->authorizeNestedTask($project, $task);
        $this->authorizeReportAccess($task, $report);

        $validated = $request->validate([
            'notes' => ['required', 'string'],
            'status' => ['required', 'string', 'max:50'],
        ]);

        $validated['task_report_id'] = $report->id;
        $validated['created_by'] = $request->user()->id;
        $validated['revision_number'] = $report->revisions()->count() + 1;

        TaskReportRevision::create($validated);

        return redirect()
            ->route('projects.tasks.reports.revisions.index', [$project, $task, $report])
            ->with('success', 'Revision created successfully.');
    }
}