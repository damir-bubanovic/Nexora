<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs uppercase tracking-[0.3em] text-gray-500">Tasks</p>
            <h2 class="mt-2 text-3xl font-black text-gray-950">
                Create Task
            </h2>
            <p class="mt-2 text-sm text-gray-500">
                Project: {{ $project->name }}
            </p>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            <section class="bg-white border-2 border-gray-950 p-6">
                <form method="POST" action="{{ route('projects.tasks.store', $project) }}" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-xs uppercase tracking-widest text-gray-500 mb-1">Title</label>
                        <input
                            name="title"
                            value="{{ old('title') }}"
                            class="w-full border border-gray-300 px-3 py-2 text-sm focus:border-gray-950 focus:ring-gray-950"
                            required
                        >
                    </div>

                    <div>
                        <label class="block text-xs uppercase tracking-widest text-gray-500 mb-1">Description</label>
                        <textarea
                            name="description"
                            rows="4"
                            class="w-full border border-gray-300 px-3 py-2 text-sm focus:border-gray-950 focus:ring-gray-950"
                        >{{ old('description') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-xs uppercase tracking-widest text-gray-500 mb-1">Status</label>
                        <select name="status"
                                class="w-full border border-gray-300 px-3 py-2 text-sm focus:border-gray-950 focus:ring-gray-950">
                            <option value="pending" {{ old('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs uppercase tracking-widest text-gray-500 mb-1">Assigned To</label>
                        <select name="assigned_to"
                                class="w-full border border-gray-300 px-3 py-2 text-sm focus:border-gray-950 focus:ring-gray-950">
                            <option value="">Unassigned</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('assigned_to') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs uppercase tracking-widest text-gray-500 mb-1">Priority</label>
                        <input
                            type="number"
                            name="priority"
                            value="{{ old('priority', 1) }}"
                            class="w-full border border-gray-300 px-3 py-2 text-sm focus:border-gray-950 focus:ring-gray-950"
                        >
                    </div>

                    <div>
                        <label class="block text-xs uppercase tracking-widest text-gray-500 mb-1">Due Date</label>
                        <input
                            type="date"
                            name="due_date"
                            value="{{ old('due_date') }}"
                            class="w-full border border-gray-300 px-3 py-2 text-sm focus:border-gray-950 focus:ring-gray-950"
                        >
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs uppercase tracking-widest text-gray-500 mb-1">
                                Estimated Hours
                            </label>
                            <input type="number"
                                   step="0.1"
                                   name="estimated_hours"
                                   value="{{ old('estimated_hours') }}"
                                   class="w-full border border-gray-300 px-3 py-2 text-sm focus:border-gray-950 focus:ring-gray-950">
                        </div>

                        <div>
                            <label class="block text-xs uppercase tracking-widest text-gray-500 mb-1">
                                Actual Hours
                            </label>
                            <input type="number"
                                   step="0.1"
                                   name="actual_hours"
                                   value="{{ old('actual_hours') }}"
                                   class="w-full border border-gray-300 px-3 py-2 text-sm focus:border-gray-950 focus:ring-gray-950">
                        </div>

                        <div>
                            <label class="block text-xs uppercase tracking-widest text-gray-500 mb-1">
                                Cost (€)
                            </label>
                            <input type="number"
                                   step="0.01"
                                   name="agreed_cost"
                                   value="{{ old('agreed_cost') }}"
                                   class="w-full border border-gray-300 px-3 py-2 text-sm focus:border-gray-950 focus:ring-gray-950">
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200">
                        <a href="{{ route('projects.tasks.index', $project) }}"
                           class="border border-gray-950 px-4 py-2 text-sm font-bold text-gray-950 hover:bg-gray-950 hover:text-white transition">
                            Cancel
                        </a>

                        <button
                            class="bg-gray-950 text-white px-4 py-2 text-sm font-bold hover:bg-gray-800 transition">
                            Save Task
                        </button>
                    </div>
                </form>
            </section>

        </div>
    </div>
</x-app-layout>