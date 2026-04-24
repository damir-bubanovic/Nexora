<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TaskController extends Controller
{
    private function authorizeProjectAccess(Project $project): void
    {
        /** @var User|null $user */
        $user = Auth::user();

        if (
            ! $user ||
            (
                ! $user->isAdmin() &&
                ! $project->users->contains($user->id)
            )
        ) {
            abort(403);
        }
    }

    private function authorizeTaskAccess(Task $task): void
    {
        /** @var User|null $user */
        $user = Auth::user();

        if (
            ! $user ||
            (
                ! $user->isAdmin() &&
                $task->assigned_to !== $user->id
            )
        ) {
            abort(403);
        }
    }

    public function index(Project $project): View
    {
        $this->authorizeProjectAccess($project);

        $tasks = $project->tasks()->latest()->get();

        return view('tasks.index', compact('project', 'tasks'));
    }

    public function create(Project $project): View
    {
        $this->authorizeProjectAccess($project);

        $users = User::all();

        return view('tasks.create', compact('project', 'users'));
    }

    public function store(Request $request, Project $project): RedirectResponse
    {
        $this->authorizeProjectAccess($project);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'string'],
            'priority' => ['required', 'integer'],
            'due_date' => ['nullable', 'date'],
            'assigned_to' => ['nullable', 'exists:users,id'],
        ]);

        $validated['project_id'] = $project->id;
        $validated['created_by'] = $request->user()->getAuthIdentifier();

        $task = Task::create($validated);

        ActivityLog::create([
            'user_id' => $request->user()->getAuthIdentifier(),
            'action' => 'create',
            'subject_type' => 'task',
            'subject_id' => $task->id,
            'description' => 'Created task: ' . $task->title,
        ]);

        return redirect()
            ->route('projects.tasks.index', $project)
            ->with('success', 'Task created successfully.');
    }

    public function edit(Project $project, Task $task): View
    {
        $this->authorizeProjectAccess($project);
        $this->authorizeTaskAccess($task);

        $users = User::all();

        return view('tasks.edit', compact('project', 'task', 'users'));
    }

    public function update(Request $request, Project $project, Task $task): RedirectResponse
    {
        $this->authorizeProjectAccess($project);
        $this->authorizeTaskAccess($task);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'string'],
            'priority' => ['required', 'integer'],
            'due_date' => ['nullable', 'date'],
            'assigned_to' => ['nullable', 'exists:users,id'],
        ]);

        $task->update($validated);

        ActivityLog::create([
            'user_id' => $request->user()->getAuthIdentifier(),
            'action' => 'update',
            'subject_type' => 'task',
            'subject_id' => $task->id,
            'description' => 'Updated task: ' . $task->title,
        ]);

        return redirect()
            ->route('projects.tasks.index', $project)
            ->with('success', 'Task updated successfully.');
    }

    public function destroy(Project $project, Task $task): RedirectResponse
    {
        $this->authorizeProjectAccess($project);
        $this->authorizeTaskAccess($task);

        $taskTitle = $task->title;
        $taskId = $task->id;

        $task->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'delete',
            'subject_type' => 'task',
            'subject_id' => $taskId,
            'description' => 'Deleted task: ' . $taskTitle,
        ]);

        return redirect()
            ->route('projects.tasks.index', $project)
            ->with('success', 'Task deleted successfully.');
    }

    public function myTasks(): View
    {
        $tasks = Task::where('assigned_to', Auth::id())
            ->latest()
            ->get();

        return view('tasks.my', compact('tasks'));
    }
}