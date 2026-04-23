<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">
                Revisions for Report #{{ $report->id }}
            </h2>

            <a href="{{ route('projects.tasks.reports.revisions.create', [$project, $task, $report]) }}"
               class="bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700">
                New Revision
            </a>
        </div>
    </x-slot>

    <div class="p-6">
        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if($revisions->isEmpty())
            <p class="text-gray-600">No revisions yet.</p>
        @else
            <div class="space-y-4">
                @foreach($revisions as $revision)
                    <div class="bg-white shadow-sm rounded-lg p-6 border">
                        <div class="flex justify-between items-center mb-3">
                            <h3 class="font-semibold text-lg">Revision # {{ $revision->revision_number }}</h3>
                            <x-status-badge :status="$revision->status" />
                        </div>

                        <div class="text-sm text-gray-700 space-y-2">
                            <div>
                                <strong>Notes:</strong>
                                <p>{{ $revision->notes }}</p>
                            </div>

                            <div>
                                <strong>Created At:</strong>
                                <p>{{ $revision->created_at }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>