<x-app-layout>
    <x-slot name="header">
        <div class="border-b border-gray-200 pb-4">
            <p class="text-xs uppercase tracking-[0.3em] text-gray-500">Nexora</p>
            <h2 class="mt-2 text-3xl font-black text-gray-950">
                Dashboard
            </h2>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Intro -->
            <section class="bg-white border border-gray-200 p-8">
                <div class="max-w-3xl">
                    <p class="text-sm font-semibold uppercase tracking-widest text-gray-500">
                        Project control center
                    </p>

                    <h1 class="mt-3 text-4xl font-black text-gray-950">
                        Welcome to Nexora
                    </h1>

                    <p class="mt-4 text-gray-600 leading-relaxed">
                        Monitor projects, tasks, bugs, reports, and team activity from one focused workspace.
                    </p>
                </div>
            </section>

            <!-- Stats -->
            <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                <div class="bg-white border border-gray-200 p-6">
                    <p class="text-xs uppercase tracking-widest text-gray-500">Projects</p>
                    <p class="mt-4 text-5xl font-black text-gray-950">{{ $totalProjects }}</p>
                    <p class="mt-2 text-sm text-gray-500">Total projects</p>
                </div>

                <div class="bg-white border border-gray-200 p-6">
                    <p class="text-xs uppercase tracking-widest text-gray-500">Active</p>
                    <p class="mt-4 text-5xl font-black text-gray-950">{{ $activeProjects }}</p>
                    <p class="mt-2 text-sm text-gray-500">Active projects</p>
                </div>

                <div class="bg-white border border-gray-200 p-6">
                    <p class="text-xs uppercase tracking-widest text-gray-500">Tasks</p>
                    <p class="mt-4 text-5xl font-black text-gray-950">{{ $totalTasks }}</p>
                    <p class="mt-2 text-sm text-gray-500">Total tasks</p>
                </div>

                <!-- Highlight: Pending -->
                <div class="bg-gray-950 border border-gray-950 p-6">
                    <p class="text-xs uppercase tracking-widest text-gray-400">Needs attention</p>
                    <p class="mt-4 text-5xl font-black text-white">{{ $pendingTasks }}</p>
                    <p class="mt-2 text-sm text-gray-400">Pending tasks</p>
                </div>

                <div class="bg-white border border-gray-200 p-6">
                    <p class="text-xs uppercase tracking-widest text-gray-500">Completed</p>
                    <p class="mt-4 text-5xl font-black text-gray-950">{{ $completedTasks }}</p>
                    <p class="mt-2 text-sm text-gray-500">Completed tasks</p>
                </div>

                <div class="bg-white border border-gray-200 p-6">
                    <p class="text-xs uppercase tracking-widest text-gray-500">Reports</p>
                    <p class="mt-4 text-5xl font-black text-gray-950">{{ $totalReports }}</p>
                    <p class="mt-2 text-sm text-gray-500">Task reports</p>
                </div>
            </section>

            <!-- Bugs + Workload -->
            <section class="grid grid-cols-1 lg:grid-cols-3 gap-5">

                <!-- Highlight: Bugs -->
                <div class="lg:col-span-2 bg-gray-950 border border-gray-950 p-6">
                    <div class="mb-6">
                        <p class="text-xs uppercase tracking-widest text-gray-400">Needs review</p>
                        <h3 class="mt-2 text-2xl font-black text-white">Bug Overview</h3>
                        <p class="mt-2 text-sm text-gray-400">
                            Open and in-progress bugs should be reviewed regularly.
                        </p>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="border border-gray-700 p-4">
                            <p class="text-3xl font-black text-white">{{ $totalBugs }}</p>
                            <p class="mt-1 text-sm text-gray-400">Total</p>
                        </div>

                        <div class="border border-gray-700 p-4">
                            <p class="text-3xl font-black text-white">{{ $openBugs }}</p>
                            <p class="mt-1 text-sm text-gray-400">Open</p>
                        </div>

                        <div class="border border-gray-700 p-4">
                            <p class="text-3xl font-black text-white">{{ $inProgressBugs }}</p>
                            <p class="mt-1 text-sm text-gray-400">In progress</p>
                        </div>

                        <div class="border border-gray-700 p-4">
                            <p class="text-3xl font-black text-white">{{ $resolvedBugs }}</p>
                            <p class="mt-1 text-sm text-gray-400">Resolved</p>
                        </div>
                    </div>
                </div>

                <!-- My Work -->
                <div class="bg-white border border-gray-200 p-6">
                    <p class="text-xs uppercase tracking-widest text-gray-500">My workload</p>
                    <h3 class="mt-2 text-2xl font-black text-gray-950">Assigned Work</h3>

                    <div class="mt-6 space-y-4">
                        <div class="border border-gray-200 p-4">
                            <p class="text-4xl font-black text-gray-950">{{ $myTasksCount }}</p>
                            <p class="mt-1 text-sm text-gray-500">My tasks</p>
                        </div>

                        <div class="border border-gray-200 p-4">
                            <p class="text-4xl font-black text-gray-950">{{ $myOpenBugs }}</p>
                            <p class="mt-1 text-sm text-gray-500">My open bugs</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Quick Navigation -->
            <section class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <a href="{{ route('projects.index') }}" class="block bg-white border border-gray-200 p-6 hover:border-gray-950 transition">
                    <p class="text-xs uppercase tracking-widest text-gray-500">Projects</p>
                    <h3 class="mt-3 text-2xl font-black text-gray-950">View Projects</h3>
                    <p class="mt-3 text-sm text-gray-600">Manage project scope and tasks.</p>
                    <p class="mt-6 text-sm font-bold text-gray-950">Open →</p>
                </a>

                <a href="{{ route('tasks.my') }}" class="block bg-white border border-gray-200 p-6 hover:border-gray-950 transition">
                    <p class="text-xs uppercase tracking-widest text-gray-500">Tasks</p>
                    <h3 class="mt-3 text-2xl font-black text-gray-950">My Tasks</h3>
                    <p class="mt-3 text-sm text-gray-600">Track your assigned work and deadlines.</p>
                    <p class="mt-6 text-sm font-bold text-gray-950">Open →</p>
                </a>

                <a href="{{ route('work-summary.index') }}" class="block bg-white border border-gray-200 p-6 hover:border-gray-950 transition">
                    <p class="text-xs uppercase tracking-widest text-gray-500">Summary</p>
                    <h3 class="mt-3 text-2xl font-black text-gray-950">Work Summary</h3>
                    <p class="mt-3 text-sm text-gray-600">View monthly productivity insights.</p>
                    <p class="mt-6 text-sm font-bold text-gray-950">Open →</p>
                </a>
            </section>

            <!-- Highlight: Activity -->
            <section class="bg-white border-2 border-gray-950 p-6">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <p class="text-xs uppercase tracking-widest text-gray-500">Latest system movement</p>
                        <h3 class="mt-2 text-2xl font-black text-gray-950">Recent Activity</h3>
                    </div>

                    @if(auth()->user()?->isAdmin())
                        <a href="{{ route('activity-logs.index') }}"
                           class="border border-gray-950 px-4 py-2 text-sm font-bold text-gray-950 hover:bg-gray-950 hover:text-white transition">
                            View All
                        </a>
                    @endif
                </div>

                @if($recentActivities->isEmpty())
                    <div class="border border-dashed border-gray-300 p-8 text-center text-gray-500">
                        No activity yet.
                    </div>
                @else
                    <div class="divide-y divide-gray-200">
                        @foreach($recentActivities as $activity)
                            <div class="py-4 flex flex-col md:flex-row md:items-center md:justify-between gap-2">
                                <div>
                                    <p class="text-sm text-gray-950">
                                        <span class="font-black uppercase">{{ $activity->action }}</span>
                                        <span class="text-gray-500">{{ $activity->subject_type }}</span>
                                    </p>

                                    <p class="mt-1 text-sm text-gray-600">
                                        {{ $activity->description }}
                                    </p>
                                </div>

                                <p class="text-xs text-gray-400 whitespace-nowrap">
                                    {{ $activity->created_at->diffForHumans() }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </section>

        </div>
    </div>
</x-app-layout>