<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Bug;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

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
            'status' => ['required', 'in:open,in_progress,resolved'],
            'assigned_to' => ['nullable', 'exists:users,id'],
        ]);

        $validated['task_id'] = $task->id;
        $validated['created_by'] = $request->user()->getAuthIdentifier();

        $bug = Bug::create($validated);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'create',
            'subject_type' => 'bug',
            'subject_id' => $bug->id,
            'description' => 'Reported bug: ' . $bug->title,
        ]);

        return redirect()
            ->route('projects.tasks.bugs.index', [$project, $task])
            ->with('success', 'Bug created successfully.');
    }


    public function edit(Project $project, Task $task, Bug $bug): View
    {
        $users = User::all();

        return view('bugs.edit', compact('project', 'task', 'bug', 'users'));
    }

    public function update(Request $request, Project $project, Task $task, Bug $bug): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'status' => ['required', 'in:open,in_progress,resolved'],
            'assigned_to' => ['nullable', 'exists:users,id'],
        ]);

        $bug->update($validated);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'subject_type' => 'bug',
            'subject_id' => $bug->id,
            'description' => 'Updated bug: ' . $bug->title,
        ]);

        return redirect()
            ->route('projects.tasks.bugs.index', [$project, $task])
            ->with('success', 'Bug updated successfully.');
    }

    public function destroy(Project $project, Task $task, Bug $bug): RedirectResponse
    {
        $bugTitle = $bug->title;

        $bug->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'delete',
            'subject_type' => 'bug',
            'subject_id' => $bug->id,
            'description' => 'Deleted bug: ' . $bugTitle,
        ]);

        return redirect()
            ->route('projects.tasks.bugs.index', [$project, $task])
            ->with('success', 'Bug deleted successfully.');
    }



}