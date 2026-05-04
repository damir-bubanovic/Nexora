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
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;


class TaskController extends Controller
{
    public function index(Project $project): View
    {
        $this->authorizeProjectAccess($project);

        $tasks = $project->tasks()->latest()->get();

        return view('tasks.index', compact('project', 'tasks'));
    }


    public function show(Project $project, Task $task)
    {
        $this->authorizeProjectAccess($project);

        return view('tasks.show', compact('project', 'task'));
    }


    public function create(Project $project): View
    {
        $this->authorizeProjectAccess($project);

        $users = User::all();

        return view('tasks.create', compact('project', 'users'));
    }

    public function store(StoreTaskRequest $request, Project $project): RedirectResponse
    {
        $this->authorizeProjectAccess($project);

        $validated = $request->validated();

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
        $this->authorizeNestedTask($project, $task);
        $this->authorizeTaskAccess($task);

        $users = User::all();

        return view('tasks.edit', compact('project', 'task', 'users'));
    }

    public function update(UpdateTaskRequest $request, Project $project, Task $task): RedirectResponse
    {
        $this->authorizeNestedTask($project, $task);
        $this->authorizeTaskAccess($task);

        $validated = $request->validated();

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
        $this->authorizeNestedTask($project, $task);
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