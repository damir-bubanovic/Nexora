<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Create Report for {{ $task->title }}
        </h2>
    </x-slot>

    <div class="p-6 max-w-3xl">
        <form method="POST" action="{{ route('projects.tasks.reports.store', [$project, $task]) }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700">Summary</label>
                <textarea name="summary" rows="4" class="w-full border rounded p-2" required>{{ old('summary') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Changed Files</label>
                <textarea name="changed_files" rows="3" class="w-full border rounded p-2">{{ old('changed_files') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Changed Lines</label>
                <textarea name="changed_lines" rows="3" class="w-full border rounded p-2">{{ old('changed_lines') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">SQL Queries</label>
                <textarea name="sql_queries" rows="3" class="w-full border rounded p-2">{{ old('sql_queries') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Testing Notes</label>
                <textarea name="testing_notes" rows="3" class="w-full border rounded p-2">{{ old('testing_notes') }}</textarea>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Save Report
            </button>
        </form>
    </div>
</x-app-layout>