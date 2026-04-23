<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">
                Bugs for {{ $task->title }}
            </h2>

            <a href="{{ route('projects.tasks.bugs.create', [$project, $task]) }}"
               class="bg-red-600 text-white px-4 py-2 rounded text-sm">
                Report Bug
            </a>
        </div>
    </x-slot>

    <div class="p-6">
        @if($bugs->isEmpty())
            <p>No bugs reported.</p>
        @else
            <div class="space-y-4">
                @foreach($bugs as $bug)
                    <div class="bg-white shadow-sm rounded p-4 border">
                        <h3 class="font-semibold">{{ $bug->title }}</h3>
                        <p class="text-sm text-gray-600">{{ $bug->description }}</p>

                        <div class="mt-2 text-sm">
                            Status: <strong>{{ $bug->status }}</strong><br>
                            Assigned: {{ $bug->assignee?->name ?? '—' }}
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>