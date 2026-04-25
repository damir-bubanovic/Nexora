<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">
            Edit Bug
        </h2>
    </x-slot>

    <div class="p-6 max-w-xl">
        <form method="POST"
              action="{{ route('projects.tasks.bugs.update', [$project, $task, $bug]) }}"
              class="space-y-4">
            @csrf
            @method('PUT')

            <input name="title"
                   value="{{ old('title', $bug->title) }}"
                   class="w-full border rounded p-2"
                   required>

            <textarea name="description"
                      class="w-full border rounded p-2"
                      required>{{ old('description', $bug->description) }}</textarea>

            <select name="status" class="w-full border rounded p-2">

                <option value="open"
                    {{ $bug->status === 'open' ? 'selected' : '' }}>
                    Open
                </option>

                <option value="in_progress"
                    {{ $bug->status === 'in_progress' ? 'selected' : '' }}>
                    In Progress
                </option>

                <option value="resolved"
                    {{ $bug->status === 'resolved' ? 'selected' : '' }}
                    @if(!auth()->user()->isAdmin() && $bug->assigned_to !== auth()->id())
                        disabled
                    @endif
                >
                    Resolved
                </option>

            </select>

            <select name="assigned_to" class="w-full border rounded p-2">
                <option value="">Unassigned</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}"
                        {{ $bug->assigned_to == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Update Bug
            </button>
        </form>
    </div>
</x-app-layout>