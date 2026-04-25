<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Bug;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BugController extends Controller
{
    public function index(Project $project, Task $task): View
    {
        $this->authorizeNestedTask($project, $task);
        $this->authorizeTaskAccess($task);

        $bugs = $task->bugs()->latest()->get();

        return view('bugs.index', compact('project', 'task', 'bugs'));
    }

    public function create(Project $project, Task $task): View
    {
        $this->authorizeNestedTask($project, $task);
        $this->authorizeTaskAccess($task);

        $users = User::all();

        return view('bugs.create', compact('project', 'task', 'users'));
    }

    public function store(Request $request, Project $project, Task $task): RedirectResponse
    {
        $this->authorizeNestedTask($project, $task);
        $this->authorizeTaskAccess($task);

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
        $this->authorizeNestedTask($project, $task);
        $this->authorizeBugAccess($task, $bug);

        $users = User::all();

        return view('bugs.edit', compact('project', 'task', 'bug', 'users'));
    }

    public function update(Request $request, Project $project, Task $task, Bug $bug): RedirectResponse
    {
        $this->authorizeNestedTask($project, $task);
        $this->authorizeBugAccess($task, $bug);

        $validated = $request->validate([
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'status' => ['required', 'in:open,in_progress,resolved'],
            'assigned_to' => ['nullable', 'exists:users,id'],
        ]);

        /** @var User $user */
        $user = $request->user();

        if (
            $validated['status'] === 'resolved' &&
            ! $user->isAdmin() &&
            $bug->assigned_to !== $user->getAuthIdentifier()
        ) {
            abort(403, 'Only assigned developer can resolve this bug.');
        }

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
        $this->authorizeNestedTask($project, $task);
        $this->authorizeBugAccess($task, $bug);

        $bugTitle = $bug->title;
        $bugId = $bug->id;

        $bug->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'delete',
            'subject_type' => 'bug',
            'subject_id' => $bugId,
            'description' => 'Deleted bug: ' . $bugTitle,
        ]);

        return redirect()
            ->route('projects.tasks.bugs.index', [$project, $task])
            ->with('success', 'Bug deleted successfully.');
    }
}