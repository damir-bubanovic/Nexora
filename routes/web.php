<?php

use App\Http\Controllers\BugController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskReportController;
use App\Http\Controllers\TaskReportRevisionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Models\Bug;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('projects', ProjectController::class);

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::put('/users/{user}/role', [UserController::class, 'updateRole'])->name('users.updateRole');
    Route::get('/my-tasks', [TaskController::class, 'myTasks'])->name('tasks.my');

    Route::get('/projects/{project}/tasks', [TaskController::class, 'index'])->name('projects.tasks.index');
    Route::get('/projects/{project}/tasks/create', [TaskController::class, 'create'])->name('projects.tasks.create');
    Route::post('/projects/{project}/tasks', [TaskController::class, 'store'])->name('projects.tasks.store');
    Route::get('/projects/{project}/tasks/{task}/edit', [TaskController::class, 'edit'])->name('projects.tasks.edit');
    Route::put('/projects/{project}/tasks/{task}', [TaskController::class, 'update'])->name('projects.tasks.update');
    Route::delete('/projects/{project}/tasks/{task}', [TaskController::class, 'destroy'])->name('projects.tasks.destroy');

    Route::get('/projects/{project}/tasks/{task}/reports', [TaskReportController::class, 'index'])->name('projects.tasks.reports.index');
    Route::get('/projects/{project}/tasks/{task}/reports/create', [TaskReportController::class, 'create'])->name('projects.tasks.reports.create');
    Route::post('/projects/{project}/tasks/{task}/reports', [TaskReportController::class, 'store'])->name('projects.tasks.reports.store');
    Route::get('/projects/{project}/tasks/{task}/reports/export', [TaskReportController::class, 'export'])->name('projects.tasks.reports.export');
    Route::get('projects/{project}/tasks/{task}/reports/download', [TaskReportController::class, 'download']
    )->name('projects.tasks.reports.download');

    Route::get('/projects/{project}/tasks/{task}/reports/{report}/revisions', [TaskReportRevisionController::class, 'index'])->name('projects.tasks.reports.revisions.index');
    Route::get('/projects/{project}/tasks/{task}/reports/{report}/revisions/create', [TaskReportRevisionController::class, 'create'])->name('projects.tasks.reports.revisions.create');
    Route::post('/projects/{project}/tasks/{task}/reports/{report}/revisions', [TaskReportRevisionController::class, 'store'])->name('projects.tasks.reports.revisions.store');

    Route::get('/projects/{project}/tasks/{task}/bugs', [BugController::class, 'index'])->name('projects.tasks.bugs.index');
    Route::get('/projects/{project}/tasks/{task}/bugs/create', [BugController::class, 'create'])->name('projects.tasks.bugs.create');
    Route::post('/projects/{project}/tasks/{task}/bugs', [BugController::class, 'store'])->name('projects.tasks.bugs.store');
    Route::get('/projects/{project}/tasks/{task}/bugs/{bug}/edit', [BugController::class, 'edit'])
    ->name('projects.tasks.bugs.edit');

    Route::put('/projects/{project}/tasks/{task}/bugs/{bug}', [BugController::class, 'update'])
        ->name('projects.tasks.bugs.update');

    Route::delete('/projects/{project}/tasks/{task}/bugs/{bug}', [BugController::class, 'destroy'])
        ->name('projects.tasks.bugs.destroy');

    
});

require __DIR__ . '/auth.php';