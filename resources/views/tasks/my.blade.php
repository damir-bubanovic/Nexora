<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs uppercase tracking-[0.3em] text-gray-500">Tasks</p>
            <h2 class="mt-2 text-3xl font-black text-gray-950">
                My Tasks
            </h2>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <section class="bg-white border-2 border-gray-950">
                <div class="p-6">
                    @if($tasks->isEmpty())
                        <div class="border border-dashed border-gray-300 p-10 text-center">
                            <p class="text-sm text-gray-500">No tasks assigned to you.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm">
                                <thead>
                                    <tr class="text-left text-xs uppercase tracking-widest text-gray-500 border-b border-gray-200">
                                        <th class="py-3 pr-4">Title</th>
                                        <th class="py-3 pr-4">Project</th>
                                        <th class="py-3 pr-4">Status</th>
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

                                            <td class="py-3 pr-4 text-gray-700">
                                                {{ $task->project?->name ?? '—' }}
                                            </td>

                                            <td class="py-3 pr-4">
                                                <x-status-badge :status="$task->status" />
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
                                                <a href="{{ route('projects.tasks.show', [$task->project, $task]) }}"
                                                   class="text-sm font-bold text-gray-950 hover:underline">
                                                    View
                                                </a>
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