<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs uppercase tracking-[0.3em] text-gray-500">Reports</p>
                <h2 class="mt-2 text-3xl font-black text-gray-950">
                    {{ $task->title }}
                </h2>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('projects.tasks.reports.export', [$project, $task]) }}"
                   class="border border-gray-950 px-4 py-2 text-sm font-bold text-gray-950 hover:bg-gray-950 hover:text-white transition">
                    Export
                </a>

                <a href="{{ route('projects.tasks.reports.download', [$project, $task]) }}"
                   class="border border-gray-950 px-4 py-2 text-sm font-bold text-gray-950 hover:bg-gray-950 hover:text-white transition">
                    Download .md
                </a>

                <a href="{{ route('projects.tasks.reports.create', [$project, $task]) }}"
                   class="bg-gray-950 text-white px-4 py-2 text-sm font-bold hover:bg-gray-800 transition">
                    New Report
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="bg-white border-2 border-gray-950 px-4 py-3 text-sm font-semibold text-gray-950">
                    {{ session('success') }}
                </div>
            @endif

            @if($reports->isEmpty())
                <section class="bg-white border-2 border-gray-950 p-10 text-center">
                    <p class="text-sm text-gray-500">No reports yet.</p>
                </section>
            @else
                <div class="space-y-5">
                    @foreach($reports as $report)
                        <section class="bg-white border-2 border-gray-950 p-6">
                            <div class="flex items-start justify-between gap-4 border-b border-gray-200 pb-4 mb-5">
                                <div>
                                    <p class="text-xs uppercase tracking-widest text-gray-500">
                                        Report
                                    </p>

                                    <h3 class="mt-2 text-2xl font-black text-gray-950">
                                        #{{ $report->id }}
                                    </h3>
                                </div>

                                <a href="{{ route('projects.tasks.reports.revisions.index', [$project, $task, $report]) }}"
                                   class="border border-gray-950 px-4 py-2 text-sm font-bold text-gray-950 hover:bg-gray-950 hover:text-white transition">
                                    Revisions
                                </a>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 text-sm">
                                <div class="md:col-span-2">
                                    <p class="text-xs uppercase tracking-widest text-gray-500 mb-1">
                                        Summary
                                    </p>
                                    <p class="text-gray-700 leading-relaxed">
                                        {{ $report->summary }}
                                    </p>
                                </div>

                                <div class="border border-gray-200 p-4">
                                    <p class="text-xs uppercase tracking-widest text-gray-500 mb-2">
                                        Changed Files
                                    </p>
                                    <p class="text-gray-700 whitespace-pre-line">
                                        {{ $report->changed_files ?: '—' }}
                                    </p>
                                </div>

                                <div class="border border-gray-200 p-4">
                                    <p class="text-xs uppercase tracking-widest text-gray-500 mb-2">
                                        Changed Lines
                                    </p>
                                    <p class="text-gray-700 whitespace-pre-line">
                                        {{ $report->changed_lines ?: '—' }}
                                    </p>
                                </div>

                                <div class="border border-gray-200 p-4">
                                    <p class="text-xs uppercase tracking-widest text-gray-500 mb-2">
                                        SQL Queries
                                    </p>
                                    <p class="text-gray-700 whitespace-pre-line">
                                        {{ $report->sql_queries ?: '—' }}
                                    </p>
                                </div>

                                <div class="border border-gray-200 p-4">
                                    <p class="text-xs uppercase tracking-widest text-gray-500 mb-2">
                                        Testing Notes
                                    </p>
                                    <p class="text-gray-700 whitespace-pre-line">
                                        {{ $report->testing_notes ?: '—' }}
                                    </p>
                                </div>
                            </div>
                        </section>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>