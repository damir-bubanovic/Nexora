<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Edit Task</h2>
    </x-slot>

    <div class="p-6 max-w-xl">
        <form method="POST" action="{{ route('projects.tasks.update', [$project, $task]) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <input
                name="title"
                value="{{ old('title', $task->title) }}"
                class="w-full border rounded p-2"
                required
            >

            <textarea
                name="description"
                class="w-full border rounded p-2"
            >{{ old('description', $task->description) }}</textarea>

            <select name="status" class="w-full border rounded p-2">
                <option value="pending" {{ old('status', $task->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="active" {{ old('status', $task->status) === 'active' ? 'selected' : '' }}>Active</option>
                <option value="completed" {{ old('status', $task->status) === 'completed' ? 'selected' : '' }}>Completed</option>
            </select>

            <select name="assigned_to" class="w-full border rounded p-2">
                <option value="">Unassigned</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('assigned_to', $task->assigned_to) == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>

            <input
                type="number"
                name="priority"
                value="{{ old('priority', $task->priority) }}"
                class="w-full border rounded p-2"
            >

            <input
                type="date"
                name="due_date"
                value="{{ old('due_date', $task->due_date) }}"
                class="w-full border rounded p-2"
            >

            <input type="number" step="0.1" name="estimated_hours" value="{{ $task->estimated_hours }}">
            <input type="number" step="0.1" name="actual_hours" value="{{ $task->actual_hours }}">
            <input type="number" step="0.01" name="agreed_cost" value="{{ $task->agreed_cost }}">

            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Update Task
            </button>
        </form>
    </div>
</x-app-layout>