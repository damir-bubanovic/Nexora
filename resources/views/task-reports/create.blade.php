<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs uppercase tracking-[0.3em] text-gray-500">Reports</p>
            <h2 class="mt-2 text-3xl font-black text-gray-950">
                Create Report
            </h2>
            <p class="mt-2 text-sm text-gray-500">
                Task: {{ $task->title }}
            </p>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <section class="bg-white border-2 border-gray-950 p-6">
                <form method="POST" action="{{ route('projects.tasks.reports.store', [$project, $task]) }}" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-xs uppercase tracking-widest text-gray-500 mb-1">
                            Summary
                        </label>
                        <textarea name="summary"
                                  rows="4"
                                  class="w-full border border-gray-300 px-3 py-2 text-sm focus:border-gray-950 focus:ring-gray-950"
                                  required>{{ old('summary') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-xs uppercase tracking-widest text-gray-500 mb-1">
                            Changed Files
                        </label>
                        <textarea name="changed_files"
                                  rows="3"
                                  class="w-full border border-gray-300 px-3 py-2 text-sm focus:border-gray-950 focus:ring-gray-950">{{ old('changed_files') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-xs uppercase tracking-widest text-gray-500 mb-1">
                            Changed Lines
                        </label>
                        <textarea name="changed_lines"
                                  rows="3"
                                  class="w-full border border-gray-300 px-3 py-2 text-sm focus:border-gray-950 focus:ring-gray-950">{{ old('changed_lines') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-xs uppercase tracking-widest text-gray-500 mb-1">
                            SQL Queries
                        </label>
                        <textarea name="sql_queries"
                                  rows="3"
                                  class="w-full border border-gray-300 px-3 py-2 text-sm focus:border-gray-950 focus:ring-gray-950">{{ old('sql_queries') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-xs uppercase tracking-widest text-gray-500 mb-1">
                            Testing Notes
                        </label>
                        <textarea name="testing_notes"
                                  rows="3"
                                  class="w-full border border-gray-300 px-3 py-2 text-sm focus:border-gray-950 focus:ring-gray-950">{{ old('testing_notes') }}</textarea>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200">
                        <a href="{{ route('projects.tasks.reports.index', [$project, $task]) }}"
                           class="border border-gray-950 px-4 py-2 text-sm font-bold text-gray-950 hover:bg-gray-950 hover:text-white transition">
                            Cancel
                        </a>

                        <button type="submit"
                                class="bg-gray-950 text-white px-4 py-2 text-sm font-bold hover:bg-gray-800 transition">
                            Save Report
                        </button>
                    </div>
                </form>
            </section>

        </div>
    </div>
</x-app-layout>