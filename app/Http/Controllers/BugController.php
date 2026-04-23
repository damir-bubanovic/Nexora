<?php

namespace App\Http\Controllers;

use App\Models\Bug;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\ActivityLog;


class BugController extends Controller
{
    public function index(Project $project, Task $task): View
    {
        $bugs = $task->bugs()->latest()->get();

        return view('bugs.index', compact('project', 'task', 'bugs'));
    }

    public function create(Project $project, Task $task): View
    {
        $users = User::all();

        return view('bugs.create', compact('project', 'task', 'users'));
    }

    public function store(Request $request, Project $project, Task $task): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'status' => ['required', 'string'],
            'assigned_to' => ['nullable', 'exists:users,id'],
        ]);

        $validated['task_id'] = $task->id;
        $validated['created_by'] = $request->user()->id;

        $bug = Bug::create($validated);

        ActivityLog::create([
            'user_id' => $request->user()->id,
            'action' => 'create',
            'subject_type' => 'bug',
            'subject_id' => $bug->id,
            'description' => 'Reported bug: ' . $bug->title,
        ]);

        return redirect()
            ->route('projects.tasks.bugs.index', [$project, $task])
            ->with('success', 'Bug created successfully.');
    }
}