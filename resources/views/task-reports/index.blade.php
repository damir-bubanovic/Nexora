<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">
                Reports for {{ $task->title }}
            </h2>

            <a href="{{ route('projects.tasks.reports.create', [$project, $task]) }}"
               class="bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700">
                New Report
            </a>
        </div>
    </x-slot>

    <div class="p-6">
        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if($reports->isEmpty())
            <p class="text-gray-600">No reports yet.</p>
        @else
            <div class="space-y-4">
                @foreach($reports as $report)
                    <div class="bg-white shadow-sm rounded-lg p-6 border">
                        <h3 class="font-semibold text-lg mb-3">Report #{{ $report->id }}</h3>

                        <div class="space-y-3 text-sm text-gray-700">
                            <div>
                                <strong>Summary:</strong>
                                <p>{{ $report->summary }}</p>
                            </div>

                            <div>
                                <strong>Changed Files:</strong>
                                <p>{{ $report->changed_files ?: '—' }}</p>
                            </div>

                            <div>
                                <strong>Changed Lines:</strong>
                                <p>{{ $report->changed_lines ?: '—' }}</p>
                            </div>

                            <div>
                                <strong>SQL Queries:</strong>
                                <p>{{ $report->sql_queries ?: '—' }}</p>
                            </div>

                            <div>
                                <strong>Testing Notes:</strong>
                                <p>{{ $report->testing_notes ?: '—' }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>