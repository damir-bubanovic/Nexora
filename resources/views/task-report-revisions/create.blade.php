<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Create Revision for Report #{{ $report->id }}
        </h2>
    </x-slot>

    <div class="p-6 max-w-3xl">
        <form method="POST" action="{{ route('projects.tasks.reports.revisions.store', [$project, $task, $report]) }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700">Revision Notes</label>
                <textarea name="notes" rows="5" class="w-full border rounded p-2" required>{{ old('notes') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" class="w-full border rounded p-2">
                    <option value="pending" {{ old('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Save Revision
            </button>
        </form>
    </div>
</x-app-layout>