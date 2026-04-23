<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">
                Export Reports for {{ $task->title }}
            </h2>

            <a href="{{ route('projects.tasks.reports.index', [$project, $task]) }}"
               class="text-sm text-gray-600 hover:underline">
                Back to Reports
            </a>
        </div>
    </x-slot>

    <div class="p-6">
        <div class="bg-white shadow-sm rounded-lg border p-6">
            <pre class="whitespace-pre-wrap text-sm text-gray-800 font-mono">
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
    </div>
</x-app-layout>