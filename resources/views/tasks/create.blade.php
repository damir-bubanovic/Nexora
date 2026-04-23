<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Create Task for {{ $project->name }}</h2>
    </x-slot>

    <div class="p-6 max-w-xl">
        <form method="POST" action="{{ route('projects.tasks.store', $project) }}" class="space-y-4">
            @csrf

            <input
                name="title"
                placeholder="Title"
                value="{{ old('title') }}"
                class="w-full border rounded p-2"
                required
            >

            <textarea
                name="description"
                placeholder="Description"
                class="w-full border rounded p-2"
            >{{ old('description') }}</textarea>

            <select name="status" class="w-full border rounded p-2">
                <option value="pending" {{ old('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Active</option>
                <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>Completed</option>
            </select>

            <select name="assigned_to" class="w-full border rounded p-2">
                <option value="">Unassigned</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('assigned_to') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>

            <input
                type="number"
                name="priority"
                value="{{ old('priority', 1) }}"
                class="w-full border rounded p-2"
            >

            <input
                type="date"
                name="due_date"
                value="{{ old('due_date') }}"
                class="w-full border rounded p-2"
            >

            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Save Task
            </button>
        </form>
    </div>
</x-app-layout>