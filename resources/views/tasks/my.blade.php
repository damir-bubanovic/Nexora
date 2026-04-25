<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            My Tasks
        </h2>
    </x-slot>

    <div class="p-6">
        @if($tasks->isEmpty())
            <p class="text-gray-600">No tasks assigned to you.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-3 py-2 text-left">Title</th>
                            <th class="border px-3 py-2 text-left">Project</th>
                            <th class="border px-3 py-2 text-left">Status</th>
                            <th class="border px-3 py-2 text-left">Priority</th>
                            <th class="border px-3 py-2 text-left">Due</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                            <tr>
                                <td class="border px-3 py-2">{{ $task->title }}</td>

                                <td class="border px-3 py-2">
                                    {{ $task->project?->name }}
                                </td>

                                <td class="border px-3 py-2">
                                    <x-status-badge :status="$task->status" />
                                </td>

                                <td class="border px-3 py-2">
                                    <span class="px-2 py-1 rounded text-xs font-semibold
                                        @if($task->priority >= 8) bg-red-100 text-red-800
                                        @elseif($task->priority >= 5) bg-yellow-100 text-yellow-800
                                        @else bg-gray-100 text-gray-800
                                        @endif
                                    ">
                                        {{ $task->priority }}
                                    </span>
                                </td>

                                <td class="border px-3 py-2">
                                    {{ $task->due_date ?: '—' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-layout>