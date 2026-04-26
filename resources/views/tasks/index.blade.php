<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">
                Tasks for {{ $project->name }}
            </h2>

            <a href="{{ route('projects.tasks.create', $project) }}"
               class="bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700">
                New Task
            </a>
        </div>
    </x-slot>

    <div class="p-6">
        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if($tasks->isEmpty())
            <p class="text-gray-600">No tasks yet.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200 text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-3 py-2 text-left">Title</th>
                            <th class="border px-3 py-2 text-left">Status</th>
                            <th class="border px-3 py-2 text-left">Assigned</th>
                            <th class="border px-3 py-2 text-left">Priority</th>
                            <th class="border px-3 py-2 text-left">Due</th>
                            <th class="border px-3 py-2 text-left">Est. Hours</th>
                            <th class="border px-3 py-2 text-left">Actual Hours</th>
                            <th class="border px-3 py-2 text-left">Cost</th>
                            <th class="border px-3 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                            <tr>
                                <td class="border px-3 py-2">{{ $task->title }}</td>

                                <td class="border px-3 py-2">
                                    <form method="POST" action="{{ route('projects.tasks.update', [$project, $task]) }}">
                                        @csrf
                                        @method('PUT')

                                        <select name="status" onchange="this.form.submit()"
                                                class="text-xs border rounded p-1">

                                            <option value="pending" {{ $task->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="active" {{ $task->status === 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="completed" {{ $task->status === 'completed' ? 'selected' : '' }}>Completed</option>

                                        </select>
                                    </form>
                                </td>

                                <td class="border px-3 py-2">
                                    {{ $task->assignee?->name ?? '—' }}
                                </td>

                                <td class="border px-3 py-2">
                                    @php
                                        $priorityClass = match (true) {
                                            $task->priority >= 8 => 'bg-red-100 text-red-800',
                                            $task->priority >= 5 => 'bg-yellow-100 text-yellow-800',
                                            default => 'bg-gray-100 text-gray-800',
                                        };
                                    @endphp

                                    <span class="inline-flex px-2 py-1 rounded text-xs font-semibold {{ $priorityClass }}">
                                        {{ $task->priority }}
                                    </span>
                                </td>

                                <td class="border px-3 py-2">
                                    {{ $task->due_date ?: '—' }}
                                </td>

                                <td class="border px-3 py-2">
                                    {{ $task->estimated_hours !== null ? number_format($task->estimated_hours, 1) . 'h' : '—' }}
                                </td>

                                <td class="border px-3 py-2">
                                    {{ $task->actual_hours !== null ? number_format($task->actual_hours, 1) . 'h' : '—' }}
                                </td>

                                <td class="border px-3 py-2">
                                    {{ $task->agreed_cost !== null ? number_format($task->agreed_cost, 2) . ' €' : '—' }}
                                </td>

                                <td class="border px-3 py-2">
                                    <div class="flex items-center gap-3">

                                        <a href="{{ route('projects.tasks.bugs.index', [$project, $task]) }}"
                                           class="text-red-600 hover:underline text-sm">
                                            Bugs
                                        </a>

                                        <a href="{{ route('projects.tasks.reports.index', [$project, $task]) }}"
                                           class="text-gray-700 hover:underline text-sm">
                                            Reports
                                        </a>

                                        @auth
                                            @if(auth()->user()->isAdmin() || $task->assigned_to === auth()->id())
                                                <a href="{{ route('projects.tasks.edit', [$project, $task]) }}"
                                                   class="text-blue-600 hover:underline text-sm">
                                                    Edit
                                                </a>

                                                <form method="POST"
                                                      action="{{ route('projects.tasks.destroy', [$project, $task]) }}"
                                                      onsubmit="return confirm('Delete this task?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="text-red-600 hover:underline text-sm">
                                                        Delete
                                                    </button>
                                                </form>
                                            @endif
                                        @endauth

                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-layout>