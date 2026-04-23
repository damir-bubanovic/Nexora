<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Project $project): View
    {
        $tasks = $project->tasks()->latest()->get();

        return view('tasks.index', compact('project', 'tasks'));
    }

    public function create(Project $project): View
    {
        return view('tasks.create', compact('project'));
    }

    public function store(Request $request, Project $project): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'string'],
            'priority' => ['required', 'integer'],
            'due_date' => ['nullable', 'date'],
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
        return view('tasks.edit', compact('project', 'task'));
    }

    public function update(Request $request, Project $project, Task $task): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'string'],
            'priority' => ['required', 'integer'],
            'due_date' => ['nullable', 'date'],
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


}