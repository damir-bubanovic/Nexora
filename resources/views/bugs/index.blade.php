<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs uppercase tracking-[0.3em] text-gray-500">Bugs</p>
                <h2 class="mt-2 text-3xl font-black text-gray-950">
                    {{ $task->title }}
                </h2>
            </div>

            <a href="{{ route('projects.tasks.bugs.create', [$project, $task]) }}"
               class="bg-gray-950 text-white px-4 py-2 text-sm font-bold hover:bg-gray-800 transition">
                New Bug
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
                    @if($bugs->isEmpty())
                        <div class="border border-dashed border-gray-300 p-10 text-center">
                            <p class="text-sm text-gray-500">No bugs reported.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm">
                                <thead>
                                    <tr class="text-left text-xs uppercase tracking-widest text-gray-500 border-b border-gray-200">
                                        <th class="py-3 pr-4">Title</th>
                                        <th class="py-3 pr-4">Status</th>
                                        <th class="py-3 pr-4">Assigned</th>
                                        <th class="py-3 pr-4">Description</th>
                                        <th class="py-3 pr-4">Actions</th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-100">
                                    @foreach($bugs as $bug)
                                        <tr class="hover:bg-gray-50">
                                            <td class="py-3 pr-4 font-semibold text-gray-950">
                                                {{ $bug->title }}
                                            </td>

                                            <td class="py-3 pr-4">
                                                @php
                                                    $statusClass = match ($bug->status) {
                                                        'open' => 'border-red-600 text-red-600',
                                                        'in_progress' => 'border-gray-950 text-gray-950',
                                                        'resolved' => 'border-gray-300 text-gray-600',
                                                        default => 'border-gray-300 text-gray-600',
                                                    };
                                                @endphp

                                                <span class="inline-flex border px-2 py-1 text-xs font-bold {{ $statusClass }}">
                                                    {{ ucfirst(str_replace('_', ' ', $bug->status)) }}
                                                </span>
                                            </td>

                                            <td class="py-3 pr-4 text-gray-700">
                                                {{ $bug->assignee?->name ?? '—' }}
                                            </td>

                                            <td class="py-3 pr-4 text-gray-600">
                                                {{ $bug->description }}
                                            </td>

                                            <td class="py-3 pr-4">
                                                <div class="flex flex-wrap gap-3">
                                                    @if(auth()->user()?->isAdmin() || $bug->assigned_to === auth()->id())
                                                        <a href="{{ route('projects.tasks.bugs.edit', [$project, $task, $bug]) }}"
                                                           class="text-sm font-bold text-gray-950 hover:underline">
                                                            Edit
                                                        </a>

                                                        <form method="POST"
                                                              action="{{ route('projects.tasks.bugs.destroy', [$project, $task, $bug]) }}"
                                                              onsubmit="return confirm('Delete this bug?');">
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