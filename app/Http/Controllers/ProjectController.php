<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\ActivityLog;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(): View
    {
        /** @var User|null $user */
        $user = Auth::user();

        $query = Project::query();

        if (! $user || ! $user->isAdmin()) {
            $query->whereHas('users', function ($q) use ($user) {
                $q->where('users.id', $user?->id);
            });
        }

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
        $this->authorizeProjectAccess($project);

        return view('projects.show', compact('project'));
    }

    public function create(): View
    {
        $users = User::all();

        return view('projects.create', compact('users'));
    }

    public function store(StoreProjectRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['created_by'] = $request->user()->getAuthIdentifier();

        $project = Project::create($validated);

        $project->users()->sync($request->input('users', []));

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
        $this->authorizeProjectAccess($project);

        $users = User::all();

        return view('projects.edit', compact('project', 'users'));
    }

    public function update(UpdateProjectRequest $request, Project $project): RedirectResponse
    {
        $this->authorizeProjectAccess($project);

        $validated = $request->validated();

        $project->update($validated);

        $project->users()->sync($request->input('users', []));

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
        $this->authorizeAdmin();

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