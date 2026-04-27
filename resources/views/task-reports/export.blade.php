<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs uppercase tracking-[0.3em] text-gray-500">Export</p>
                <h2 class="mt-2 text-3xl font-black text-gray-950">
                    {{ $task->title }}
                </h2>
            </div>

            <a href="{{ route('projects.tasks.reports.index', [$project, $task]) }}"
               class="border border-gray-950 px-4 py-2 text-sm font-bold text-gray-950 hover:bg-gray-950 hover:text-white transition">
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <section class="bg-white border-2 border-gray-950">
                <div class="p-6">

                    <pre class="whitespace-pre-wrap text-sm font-mono text-gray-900 leading-relaxed">
# Task Report Export

## Project
{{ $project->name }}

## Task
{{ $task->title }}

## Total Reports
{{ $reports->count() }}

@foreach($reports as $report)
---

### Report #{{ $report->id }}

**Summary**
{{ $report->summary }}

**Changed Files**
{{ $report->changed_files ?: '—' }}

**Changed Lines**
{{ $report->changed_lines ?: '—' }}

**SQL Queries**
{{ $report->sql_queries ?: '—' }}

**Testing Notes**
{{ $report->testing_notes ?: '—' }}

**Created At**
{{ $report->created_at }}

@endforeach
                    </pre>

                </div>
            </section>

        </div>
    </div>
</x-app-layout>