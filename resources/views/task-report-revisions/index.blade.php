<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs uppercase tracking-[0.3em] text-gray-500">Revisions</p>
                <h2 class="mt-2 text-3xl font-black text-gray-950">
                    Report #{{ $report->id }}
                </h2>
            </div>

            <a href="{{ route('projects.tasks.reports.revisions.create', [$project, $task, $report]) }}"
               class="bg-gray-950 text-white px-4 py-2 text-sm font-bold hover:bg-gray-800 transition">
                New Revision
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="bg-white border-2 border-gray-950 px-4 py-3 text-sm font-semibold text-gray-950">
                    {{ session('success') }}
                </div>
            @endif

            @if($revisions->isEmpty())
                <section class="bg-white border-2 border-gray-950 p-10 text-center">
                    <p class="text-sm text-gray-500">No revisions yet.</p>
                </section>
            @else
                <div class="space-y-5">
                    @foreach($revisions as $revision)
                        <section class="bg-white border-2 border-gray-950 p-6">
                            <div class="flex items-center justify-between border-b border-gray-200 pb-4 mb-4">
                                <div>
                                    <p class="text-xs uppercase tracking-widest text-gray-500">
                                        Revision
                                    </p>
                                    <h3 class="mt-1 text-2xl font-black text-gray-950">
                                        #{{ $revision->revision_number }}
                                    </h3>
                                </div>

                                <x-status-badge :status="$revision->status" class="px-3 py-1 text-xs" />
                            </div>

                            <div class="space-y-4 text-sm">

                                <div>
                                    <p class="text-xs uppercase tracking-widest text-gray-500 mb-1">
                                        Notes
                                    </p>
                                    <p class="text-gray-700 leading-relaxed">
                                        {{ $revision->notes }}
                                    </p>
                                </div>

                                <div>
                                    <p class="text-xs uppercase tracking-widest text-gray-500 mb-1">
                                        Created At
                                    </p>
                                    <p class="text-gray-600">
                                        {{ $revision->created_at }}
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