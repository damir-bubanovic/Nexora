<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\ActivityLog;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(): View
    {
        $query = Project::query();

        if (request('status')) {
            $query->where('status', request('status'));
        }

        if (request('search')) {
            $query->where('name', 'like', '%' . request('search') . '%');
        }

        $projects = $query
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('projects.index', compact('projects'));
    }

    public function show(Project $project): View
    {
        return view('projects.show', compact('project'));
    }

    public function create(): View
    {
        return view('projects.create');
    }

    public function store(StoreProjectRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['created_by'] = $request->user()->getAuthIdentifier();

        $project = Project::create($validated);

        ActivityLog::create([
            'user_id' => $request->user()->getAuthIdentifier(),
            'action' => 'create',
            'subject_type' => 'project',
            'subject_id' => $project->id,
            'description' => 'Created project: ' . $project->name,
        ]);

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project created successfully.');
    }

    public function edit(Project $project): View
    {
        return view('projects.edit', compact('project'));
    }

    public function update(UpdateProjectRequest $request, Project $project): RedirectResponse
    {
        $validated = $request->validated();

        $project->update($validated);

        ActivityLog::create([
            'user_id' => $request->user()->getAuthIdentifier(),
            'action' => 'update',
            'subject_type' => 'project',
            'subject_id' => $project->id,
            'description' => 'Updated project: ' . $project->name,
        ]);

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project): RedirectResponse
    {
        $projectName = $project->name;
        $projectId = $project->id;

        $project->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'delete',
            'subject_type' => 'project',
            'subject_id' => $projectId,
            'description' => 'Deleted project: ' . $projectName,
        ]);

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project deleted successfully.');
    }
}