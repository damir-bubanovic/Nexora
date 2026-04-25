<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">
                Bugs for {{ $task->title }}
            </h2>

            <a href="{{ route('projects.tasks.bugs.create', [$project, $task]) }}"
               class="bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700">
                New Bug
            </a>
        </div>
    </x-slot>

    <div class="p-6">
        @if(session('success'))
            <div class="mb-4 bg-green-100 text-green-800 p-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if($bugs->isEmpty())
            <p class="text-gray-600 italic">No bugs reported.</p>
        @else
            <table class="min-w-full border">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-3 py-2 border text-left">Title</th>
                        <th class="px-3 py-2 border text-left">Status</th>
                        <th class="px-3 py-2 border text-left">Assigned</th>
                        <th class="px-3 py-2 border text-left">Description</th>
                        <th class="px-3 py-2 border text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bugs as $bug)
                        <tr>
                            <td class="px-3 py-2 border">{{ $bug->title }}</td>

                            <td class="px-3 py-2 border">
                                <span class="px-2 py-1 text-xs font-semibold rounded
                                    @if($bug->status === 'open') bg-red-100 text-red-800
                                    @elseif($bug->status === 'in_progress') bg-yellow-100 text-yellow-800
                                    @elseif($bug->status === 'resolved') bg-green-100 text-green-800
                                    @endif
                                ">
                                    {{ ucfirst(str_replace('_', ' ', $bug->status)) }}
                                </span>
                            </td>

                            <td class="px-3 py-2 border">
                                {{ $bug->assignee?->name ?? '—' }}
                            </td>

                            <td class="px-3 py-2 border">
                                {{ $bug->description }}
                            </td>

                            <td class="px-3 py-2 border">
                                <div class="flex gap-3">
                                    @auth
                                        @if(auth()->user()->isAdmin() || $bug->assigned_to === auth()->id())
                                            <a href="{{ route('projects.tasks.bugs.edit', [$project, $task, $bug]) }}"
                                               class="text-blue-600 hover:underline text-sm">
                                                Edit
                                            </a>

                                            <form method="POST"
                                                  action="{{ route('projects.tasks.bugs.destroy', [$project, $task, $bug]) }}"
                                                  onsubmit="return confirm('Delete this bug?');">
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
        @endif
    </div>
</x-app-layout>