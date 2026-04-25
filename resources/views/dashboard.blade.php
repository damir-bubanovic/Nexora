<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nexora Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-2">Welcome to Nexora</h3>
                    <p class="text-sm text-gray-600">
                        Overview of projects, tasks, reports, bugs, and current workload.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-sm font-medium text-gray-500">Total Projects</h3>
                    <p class="mt-2 text-3xl font-bold text-gray-900">{{ $totalProjects }}</p>
                </div>

                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-sm font-medium text-gray-500">Active Projects</h3>
                    <p class="mt-2 text-3xl font-bold text-green-600">{{ $activeProjects }}</p>
                </div>

                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-sm font-medium text-gray-500">Total Tasks</h3>
                    <p class="mt-2 text-3xl font-bold text-gray-900">{{ $totalTasks }}</p>
                </div>

                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-sm font-medium text-gray-500">Pending Tasks</h3>
                    <p class="mt-2 text-3xl font-bold text-yellow-600">{{ $pendingTasks }}</p>
                </div>

                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-sm font-medium text-gray-500">Completed Tasks</h3>
                    <p class="mt-2 text-3xl font-bold text-blue-600">{{ $completedTasks }}</p>
                </div>

                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-sm font-medium text-gray-500">Total Reports</h3>
                    <p class="mt-2 text-3xl font-bold text-gray-900">{{ $totalReports }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-white p-4 rounded shadow">
                    <h3 class="text-sm text-gray-500">Total Bugs</h3>
                    <p class="text-2xl font-bold">{{ $totalBugs }}</p>
                </div>

                <div class="bg-white p-4 rounded shadow">
                    <h3 class="text-sm text-gray-500">Open Bugs</h3>
                    <p class="text-2xl font-bold text-red-600">{{ $openBugs }}</p>
                </div>

                <div class="bg-white p-4 rounded shadow">
                    <h3 class="text-sm text-gray-500">In Progress Bugs</h3>
                    <p class="text-2xl font-bold text-yellow-600">{{ $inProgressBugs }}</p>
                </div>

                <div class="bg-white p-4 rounded shadow">
                    <h3 class="text-sm text-gray-500">Resolved Bugs</h3>
                    <p class="text-2xl font-bold text-green-600">{{ $resolvedBugs }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-white p-4 rounded shadow">
                    <h3 class="text-sm text-gray-500">My Tasks</h3>
                    <p class="text-2xl font-bold">{{ $myTasksCount }}</p>
                </div>

                <div class="bg-white p-4 rounded shadow">
                    <h3 class="text-sm text-gray-500">My Open Bugs</h3>
                    <p class="text-2xl font-bold text-red-600">{{ $myOpenBugs }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-2">Projects</h3>
                    <p class="text-sm text-gray-600 mb-4">
                        Manage and review all projects.
                    </p>
                    <a href="{{ route('projects.index') }}" class="text-blue-600 hover:underline text-sm">
                        View Projects →
                    </a>
                </div>

                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-2">Tasks</h3>
                    <p class="text-sm text-gray-600 mb-4">
                        Review your assigned work.
                    </p>
                    <a href="{{ route('tasks.my') }}" class="text-blue-600 hover:underline text-sm">
                        View My Tasks →
                    </a>
                </div>

                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-2">Reports</h3>
                    <p class="text-sm text-gray-600 mb-4">
                        Track work summaries, file changes, and SQL notes.
                    </p>
                    <a href="{{ route('projects.index') }}" class="text-blue-600 hover:underline text-sm">
                        Browse Work →
                    </a>
                </div>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Recent Activity</h3>

                @if($recentActivities->isEmpty())
                    <p class="text-sm text-gray-600">No activity yet.</p>
                @else
                    <ul class="space-y-3">
                        @foreach($recentActivities as $activity)
                            <li class="border-b pb-2 text-sm text-gray-700">
                                <strong>{{ ucfirst($activity->action) }}</strong>
                                {{ $activity->subject_type }}:
                                {{ $activity->description }}
                                <span class="text-gray-400 text-xs">
                                    ({{ $activity->created_at->diffForHumans() }})
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>