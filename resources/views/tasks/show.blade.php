<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs uppercase tracking-[0.3em] text-gray-500">Tasks</p>
            <h2 class="mt-2 text-3xl font-black text-gray-950">
                {{ $task->title }}
            </h2>
            <p class="mt-2 text-sm text-gray-500">
                Project: {{ $project->name }}
            </p>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <section class="bg-white border-2 border-gray-950 p-6">
                <p class="text-xs uppercase tracking-widest text-gray-500">Description</p>
                <p class="mt-3 text-gray-700 leading-relaxed">
                    {{ $task->description ?: '—' }}
                </p>
            </section>

            <section class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div class="bg-white border border-gray-200 p-5">
                    <p class="text-xs uppercase tracking-widest text-gray-500">Status</p>
                    <div class="mt-3">
                        <x-status-badge :status="$task->status" />
                    </div>
                </div>

                <div class="bg-white border border-gray-200 p-5">
                    <p class="text-xs uppercase tracking-widest text-gray-500">Priority</p>
                    <p class="mt-3 text-2xl font-black text-gray-950">
                        {{ $task->priority }}
                    </p>
                </div>

                <div class="bg-white border border-gray-200 p-5">
                    <p class="text-xs uppercase tracking-widest text-gray-500">Due Date</p>
                    <p class="mt-3 text-2xl font-black text-gray-950">
                        {{ $task->due_date ?: '—' }}
                    </p>
                </div>
            </section>

            <section class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div class="bg-white border border-gray-200 p-5">
                    <p class="text-xs uppercase tracking-widest text-gray-500">Estimated Hours</p>
                    <p class="mt-3 text-2xl font-black text-gray-950">
                        {{ $task->estimated_hours !== null ? number_format($task->estimated_hours, 1) . 'h' : '—' }}
                    </p>
                </div>

                <div class="bg-white border border-gray-200 p-5">
                    <p class="text-xs uppercase tracking-widest text-gray-500">Actual Hours</p>
                    <p class="mt-3 text-2xl font-black text-gray-950">
                        {{ $task->actual_hours !== null ? number_format($task->actual_hours, 1) . 'h' : '—' }}
                    </p>
                </div>

                <div class="bg-white border border-gray-200 p-5">
                    <p class="text-xs uppercase tracking-widest text-gray-500">Cost</p>
                    <p class="mt-3 text-2xl font-black text-gray-950">
                        {{ $task->agreed_cost !== null ? number_format($task->agreed_cost, 2) . ' €' : '—' }}
                    </p>
                </div>
            </section>

            <section class="bg-white border-2 border-gray-950 p-6">
                <p class="text-xs uppercase tracking-widest text-gray-500 mb-4">Actions</p>

                <div class="flex flex-wrap items-center gap-3">
                    <a href="{{ route('projects.tasks.index', $project) }}"
                       class="border border-gray-950 px-4 py-2 text-sm font-bold text-gray-950 hover:bg-gray-950 hover:text-white transition">
                        Back to Tasks
                    </a>

                    <a href="{{ route('projects.tasks.bugs.index', [$project, $task]) }}"
                       class="bg-gray-950 text-white px-4 py-2 text-sm font-bold hover:bg-gray-800 transition">
                        Bugs
                    </a>

                    <a href="{{ route('projects.tasks.reports.index', [$project, $task]) }}"
                       class="bg-gray-950 text-white px-4 py-2 text-sm font-bold hover:bg-gray-800 transition">
                        Reports
                    </a>

                    @if(auth()->user()?->isAdmin() || $task->assigned_to === auth()->id())
                        <a href="{{ route('projects.tasks.edit', [$project, $task]) }}"
                           class="border border-gray-950 px-4 py-2 text-sm font-bold text-gray-950 hover:bg-gray-950 hover:text-white transition">
                            Edit Task
                        </a>
                    @endif
                </div>
            </section>

        </div>
    </div>
</x-app-layout>