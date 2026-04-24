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
                <table class="min-w-full border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-3 py-2 text-left">Title</th>
                            <th class="border px-3 py-2 text-left">Status</th>
                            <th class="border px-3 py-2 text-left">Assigned</th>
                            <th class="border px-3 py-2 text-left">Priority</th>
                            <th class="border px-3 py-2 text-left">Due</th>
                            <th class="border px-3 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                            <tr>
                                <td class="border px-3 py-2">{{ $task->title }}</td>

                                <td class="border px-3 py-2">
                                    <x-status-badge :status="$task->status" />
                                </td>

                                <td class="border px-3 py-2">
                                    {{ $task->assignee?->name ?? '—' }}
                                </td>

                                <td class="border px-3 py-2">
                                    {{ $task->priority }}
                                </td>

                                <td class="border px-3 py-2">
                                    {{ $task->due_date ?: '—' }}
                                </td>

                                <td class="border px-3 py-2">
                                    <div class="flex items-center gap-3">

                                        <a href="{{ route('projects.tasks.reports.index', [$project, $task]) }}"
                                           class="text-gray-700 hover:underline text-sm">
                                            Reports
                                        </a>

                                        <a href="{{ route('projects.tasks.bugs.index', [$project, $task]) }}"
                                           class="text-red-600 hover:underline text-sm">
                                            Bugs
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