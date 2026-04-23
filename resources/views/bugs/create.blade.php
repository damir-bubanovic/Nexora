<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Report Bug</h2>
    </x-slot>

    <div class="p-6 max-w-xl">
        <form method="POST" action="{{ route('projects.tasks.bugs.store', [$project, $task]) }}" class="space-y-4">
            @csrf

            <input name="title" placeholder="Bug title" class="w-full border p-2 rounded" required>

            <textarea name="description" placeholder="Describe the issue" class="w-full border p-2 rounded" required></textarea>

            <select name="status" class="w-full border p-2 rounded">
                <option value="open">Open</option>
                <option value="in_progress">In Progress</option>
                <option value="fixed">Fixed</option>
            </select>

            <select name="assigned_to" class="w-full border p-2 rounded">
                <option value="">Unassigned</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>

            <button class="bg-red-600 text-white px-4 py-2 rounded">
                Submit Bug
            </button>
        </form>
    </div>
</x-app-layout>