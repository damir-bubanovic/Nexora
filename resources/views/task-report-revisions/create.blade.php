<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs uppercase tracking-[0.3em] text-gray-500">Revisions</p>
            <h2 class="mt-2 text-3xl font-black text-gray-950">
                Create Revision
            </h2>
            <p class="mt-2 text-sm text-gray-500">
                Report #{{ $report->id }}
            </p>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <section class="bg-white border-2 border-gray-950 p-6">
                <form method="POST"
                      action="{{ route('projects.tasks.reports.revisions.store', [$project, $task, $report]) }}"
                      class="space-y-6">
                    @csrf

                    <!-- Notes -->
                    <div>
                        <label class="block text-xs uppercase tracking-widest text-gray-500 mb-1">
                            Revision Notes
                        </label>
                        <textarea name="notes"
                                  rows="5"
                                  class="w-full border border-gray-300 px-3 py-2 text-sm focus:border-gray-950 focus:ring-gray-950"
                                  required>{{ old('notes') }}</textarea>
                        @error('notes')
                            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-xs uppercase tracking-widest text-gray-500 mb-1">
                            Status
                        </label>
                        <select name="status"
                                class="w-full border border-gray-300 px-3 py-2 text-sm focus:border-gray-950 focus:ring-gray-950">
                            <option value="pending" {{ old('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                        @error('status')
                            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200">
                        <a href="{{ route('projects.tasks.reports.revisions.index', [$project, $task, $report]) }}"
                           class="border border-gray-950 px-4 py-2 text-sm font-bold text-gray-950 hover:bg-gray-950 hover:text-white transition">
                            Cancel
                        </a>

                        <button type="submit"
                                class="bg-gray-950 text-white px-4 py-2 text-sm font-bold hover:bg-gray-800 transition">
                            Save Revision
                        </button>
                    </div>

                </form>
            </section>

        </div>
    </div>
</x-app-layout>