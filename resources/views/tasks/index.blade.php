<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs uppercase tracking-[0.3em] text-gray-500">Tasks</p>
                <h2 class="mt-2 text-3xl font-black text-gray-950">
                    {{ $project->name }}
                </h2>
            </div>

            <a href="{{ route('projects.tasks.create', $project) }}"
               class="bg-gray-950 text-white px-4 py-2 text-sm font-bold hover:bg-gray-800 transition">
                New Task
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="bg-white border-2 border-gray-950 px-4 py-3 text-sm font-semibold text-gray-950">
                    {{ session('success') }}
                </div>
            @endif

            <section class="bg-white border-2 border-gray-950">
                <div class="p-6">
                    @if($tasks->isEmpty())
                        <div class="border border-dashed border-gray-300 p-10 text-center">
                            <p class="text-sm text-gray-500">No tasks yet.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm">
                                <thead>
                                    <tr class="text-left text-xs uppercase tracking-widest text-gray-500 border-b border-gray-200">
                                        <th class="py-3 pr-4">Title</th>
                                        <th class="py-3 pr-4">Status</th>
                                        <th class="py-3 pr-4">Assigned</th>
                                        <th class="py-3 pr-4">Priority</th>
                                        <th class="py-3 pr-4">Due</th>
                                        <th class="py-3 pr-4">Est.</th>
                                        <th class="py-3 pr-4">Actual</th>
                                        <th class="py-3 pr-4">Cost</th>
                                        <th class="py-3 pr-4">Actions</th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-100">
                                    @foreach($tasks as $task)
                                        <tr class="hover:bg-gray-50">
                                            <td class="py-3 pr-4 font-semibold text-gray-950">
                                                {{ $task->title }}
                                            </td>

                                            <td class="py-3 pr-4">
                                                <form method="POST" action="{{ route('projects.tasks.update', [$project, $task]) }}">
                                                    @csrf
                                                    @method('PUT')

                                                    <select name="status"
                                                            onchange="this.form.submit()"
                                                            class="border border-gray-300 px-2 py-1 text-xs focus:border-gray-950 focus:ring-gray-950">
                                                        <option value="pending" {{ $task->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                                        <option value="active" {{ $task->status === 'active' ? 'selected' : '' }}>Active</option>
                                                        <option value="completed" {{ $task->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                                    </select>
                                                </form>
                                            </td>

                                            <td class="py-3 pr-4 text-gray-700">
                                                {{ $task->assignee?->name ?? '—' }}
                                            </td>

                                            <td class="py-3 pr-4">
                                                @php
                                                    $priorityClass = match (true) {
                                                        $task->priority >= 8 => 'border-red-600 text-red-600',
                                                        $task->priority >= 5 => 'border-gray-950 text-gray-950',
                                                        default => 'border-gray-300 text-gray-600',
                                                    };
                                                @endphp

                                                <span class="inline-flex border px-2 py-1 text-xs font-bold {{ $priorityClass }}">
                                                    {{ $task->priority }}
                                                </span>
                                            </td>

                                            <td class="py-3 pr-4 text-gray-600">
                                                {{ $task->due_date ?: '—' }}
                                            </td>

                                            <td class="py-3 pr-4 text-gray-600">
                                                {{ $task->estimated_hours !== null ? number_format($task->estimated_hours, 1) . 'h' : '—' }}
                                            </td>

                                            <td class="py-3 pr-4 text-gray-600">
                                                {{ $task->actual_hours !== null ? number_format($task->actual_hours, 1) . 'h' : '—' }}
                                            </td>

                                            <td class="py-3 pr-4 text-gray-600">
                                                {{ $task->agreed_cost !== null ? number_format($task->agreed_cost, 2) . ' €' : '—' }}
                                            </td>

                                            <td class="py-3 pr-4">
                                                <div class="flex flex-wrap items-center gap-3">
                                                    <a href="{{ route('projects.tasks.bugs.index', [$project, $task]) }}"
                                                       class="text-sm font-bold text-gray-950 hover:underline">
                                                        Bugs
                                                    </a>

                                                    <a href="{{ route('projects.tasks.reports.index', [$project, $task]) }}"
                                                       class="text-sm font-bold text-gray-700 hover:underline">
                                                        Reports
                                                    </a>

                                                    @if(auth()->user()?->isAdmin() || $task->assigned_to === auth()->id())
                                                        <a href="{{ route('projects.tasks.edit', [$project, $task]) }}"
                                                           class="text-sm font-bold text-gray-700 hover:underline">
                                                            Edit
                                                        </a>

                                                        <form method="POST"
                                                              action="{{ route('projects.tasks.destroy', [$project, $task]) }}"
                                                              onsubmit="return confirm('Delete this task?');">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button class="text-sm font-bold text-red-600 hover:underline">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </section>

        </div>
    </div>
</x-app-layout>