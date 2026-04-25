<?php

namespace App\Http\Controllers;

use App\Models\Bug;
use App\Models\Project;
use App\Models\Task;
use App\Models\TaskReport;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

abstract class Controller
{
    protected function currentUser(): User
    {
        /** @var User|null $user */
        $user = Auth::user();

        if (! $user) {
            abort(403);
        }

        return $user;
    }

    protected function authorizeAdmin(): void
    {
        if (! $this->currentUser()->isAdmin()) {
            abort(403);
        }
    }

    protected function authorizeProjectAccess(Project $project): void
    {
        $user = $this->currentUser();

        if (! $user->isAdmin() && ! $project->users->contains($user->id)) {
            abort(403);
        }
    }

    protected function authorizeTaskAccess(Task $task): void
    {
        $user = $this->currentUser();

        if (! $user->isAdmin() && $task->assigned_to !== $user->id) {
            abort(403);
        }
    }

    protected function authorizeNestedTask(Project $project, Task $task): void
    {
        if ($task->project_id !== $project->id) {
            abort(404);
        }

        $this->authorizeProjectAccess($project);
    }

    protected function authorizeBugAccess(Task $task, Bug $bug): void
    {
        if ($bug->task_id !== $task->id) {
            abort(404);
        }

        $this->authorizeTaskAccess($task);
    }

    protected function authorizeReportAccess(Task $task, TaskReport $report): void
    {
        if ($report->task_id !== $task->id) {
            abort(404);
        }

        $this->authorizeTaskAccess($task);
    }
}