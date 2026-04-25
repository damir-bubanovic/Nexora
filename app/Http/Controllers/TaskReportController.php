<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Project;
use App\Models\Task;
use App\Models\TaskReport;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Requests\StoreTaskReportRequest;


class TaskReportController extends Controller
{
    public function index(Project $project, Task $task): View
    {
        $this->authorizeNestedTask($project, $task);
        $this->authorizeTaskAccess($task);

        $reports = $task->reports()->latest()->get();

        return view('task-reports.index', compact('project', 'task', 'reports'));
    }

    public function create(Project $project, Task $task): View
    {
        $this->authorizeNestedTask($project, $task);
        $this->authorizeTaskAccess($task);

        return view('task-reports.create', compact('project', 'task'));
    }

    public function store(StoreTaskReportRequest $request, Project $project, Task $task): RedirectResponse
    {
        $this->authorizeNestedTask($project, $task);
        $this->authorizeTaskAccess($task);

        $validated = $request->validated();

        $validated['task_id'] = $task->id;
        $validated['created_by'] = $request->user()->id;

        $report = TaskReport::create($validated);

        ActivityLog::create([
            'user_id' => $request->user()->id,
            'action' => 'create',
            'subject_type' => 'task_report',
            'subject_id' => $report->id,
            'description' => 'Created report for task: ' . $task->title,
        ]);

        return redirect()
            ->route('projects.tasks.reports.index', [$project, $task])
            ->with('success', 'Task report created successfully.');
    }

    public function export(Project $project, Task $task): View
    {
        $this->authorizeNestedTask($project, $task);
        $this->authorizeTaskAccess($task);

        $reports = $task->reports()->latest()->get();

        return view('task-reports.export', compact('project', 'task', 'reports'));
    }
    

    public function download(Project $project, Task $task)
    {
        $this->authorizeNestedTask($project, $task);
        $this->authorizeTaskAccess($task);

        $reports = $task->reports()->latest()->get();

        $content = "# Task Reports for: {$task->title}\n\n";

        foreach ($reports as $report) {
            $content .= "## Report #{$report->id}\n";
            $content .= "Summary:\n{$report->summary}\n\n";

            if ($report->changed_files) {
                $content .= "Changed Files:\n{$report->changed_files}\n\n";
            }

            if ($report->changed_lines) {
                $content .= "Changed Lines:\n{$report->changed_lines}\n\n";
            }

            if ($report->sql_queries) {
                $content .= "SQL Queries:\n{$report->sql_queries}\n\n";
            }

            if ($report->testing_notes) {
                $content .= "Testing Notes:\n{$report->testing_notes}\n\n";
            }

            $content .= "-----------------------------\n\n";
        }

        $filename = 'task-' . $task->id . '-reports.md';

        return response($content)
            ->header('Content-Type', 'text/markdown')
            ->header('Content-Disposition', "attachment; filename=\"{$filename}\"");
    }




}