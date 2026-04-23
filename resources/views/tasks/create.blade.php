<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Create Task for {{ $project->name }}</h2>
    </x-slot>

    <div class="p-6 max-w-xl">
        <form method="POST" action="{{ route('projects.tasks.store', $project) }}" class="space-y-4">
            @csrf

            <input name="title" placeholder="Title" class="w-full border rounded p-2" required>

            <textarea name="description" placeholder="Description" class="w-full border rounded p-2"></textarea>

            <select name="status" class="w-full border rounded p-2">
                <option value="pending">Pending</option>
                <option value="active">Active</option>
                <option value="completed">Completed</option>
            </select>

            <input type="number" name="priority" value="1" class="w-full border rounded p-2">

            <input type="date" name="due_date" class="w-full border rounded p-2">

            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Save Task
            </button>
        </form>
    </div>
</x-app-layout>