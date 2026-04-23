<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">
                Tasks for {{ $project->name }}
            </h2>

            <a href="{{ route('projects.tasks.create', $project) }}"
               class="bg-blue-600 text-white px-4 py-2 rounded text-sm">
                New Task
            </a>
        </div>
    </x-slot>

    <div class="p-6">
        @if(session('success'))
            <div class="mb-4 text-green-700">{{ session('success') }}</div>
        @endif

        @if($tasks->isEmpty())
            <p>No tasks yet.</p>
        @else
            <table class="min-w-full border">
                <thead>
                    <tr>
                        <th class="border px-3 py-2">Title</th>
                        <th class="border px-3 py-2">Status</th>
                        <th class="border px-3 py-2">Priority</th>
                        <th class="border px-3 py-2">Due</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                        <tr>
                            <td class="border px-3 py-2">{{ $task->title }}</td>
                            <td class="border px-3 py-2">{{ $task->status }}</td>
                            <td class="border px-3 py-2">{{ $task->priority }}</td>
                            <td class="border px-3 py-2">{{ $task->due_date }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-app-layout>