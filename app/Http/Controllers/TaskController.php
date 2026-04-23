<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\User;


class TaskController extends Controller
{
    public function index(Project $project): View
    {
        $tasks = $project->tasks()->latest()->get();

        return view('tasks.index', compact('project', 'tasks'));
    }

    public function create(Project $project): View
    {
        $users = User::all();

        return view('tasks.create', compact('project', 'users'));
    }

    public function store(Request $request, Project $project): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'string'],
            'priority' => ['required', 'integer'],
            'due_date' => ['nullable', 'date'],
            'assigned_to' => ['nullable', 'exists:users,id'],
        ]);

        $validated['project_id'] = $project->id;
        $validated['created_by'] = $request->user()->id;

        Task::create($validated);

        return redirect()
            ->route('projects.tasks.index', $project)
            ->with('success', 'Task created successfully.');
    }


    public function edit(Project $project, Task $task): View
    {
        $users = User::all();

        return view('tasks.edit', compact('project', 'task', 'users'));
    }

    public function update(Request $request, Project $project, Task $task): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'string'],
            'priority' => ['required', 'integer'],
            'due_date' => ['nullable', 'date'],
            'assigned_to' => ['nullable', 'exists:users,id'],
        ]);

        $task->update($validated);

        return redirect()
            ->route('projects.tasks.index', $project)
            ->with('success', 'Task updated successfully.');
    }

    public function destroy(Project $project, Task $task): RedirectResponse
    {
        $task->delete();

        return redirect()
            ->route('projects.tasks.index', $project)
            ->with('success', 'Task deleted successfully.');
    }

    public function myTasks(): View
    {
        $tasks = \App\Models\Task::where('assigned_to', auth()->id())
            ->latest()
            ->get();

        return view('tasks.my', compact('tasks'));
    }


}