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
                        Overview of projects, tasks, and reports across the system.
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
                        Review project tasks through each project.
                    </p>
                    <a href="{{ route('projects.index') }}" class="text-blue-600 hover:underline text-sm">
                        Open Projects →
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
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Recent Activity</h3>

                    @if($recentActivities->isEmpty())
                        <p class="text-sm text-gray-600">No activity yet.</p>
                    @else
                        <div class="space-y-3">
                            @foreach($recentActivities as $activity)
                                <div class="border-b pb-2">
                                    <p class="text-sm text-gray-800">{{ $activity->description }}</p>
                                    <p class="text-xs text-gray-500">
                                        {{ $activity->created_at }} · User #{{ $activity->user_id }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>