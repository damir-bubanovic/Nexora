<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">
            Create Bug
        </h2>
    </x-slot>

    <div class="p-6 max-w-xl">
        <form method="POST"
              action="{{ route('projects.tasks.bugs.store', [$project, $task]) }}"
              class="space-y-4">
            @csrf

            <input name="title"
                   placeholder="Title"
                   class="w-full border rounded p-2"
                   required>

            <textarea name="description"
                  placeholder="Description"
                  class="w-full border rounded p-2"
                  required></textarea>

            <select name="status" class="w-full border rounded p-2">
                <option value="open">Open</option>
                <option value="in_progress">In Progress</option>
                <option value="resolved">Resolved</option>
            </select>

            <select name="assigned_to" class="w-full border rounded p-2">
                <option value="">Unassigned</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Save Bug
            </button>
        </form>
    </div>
</x-app-layout>