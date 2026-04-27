<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs uppercase tracking-[0.3em] text-gray-500">Nexora</p>
                <h2 class="mt-2 text-3xl font-black text-gray-950">
                    Projects
                </h2>
            </div>

            @if(auth()->user()?->isAdmin())
                <a href="{{ route('projects.create') }}"
                   class="bg-gray-950 text-white px-4 py-2 text-sm font-bold hover:bg-gray-800 transition">
                    New Project
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('success'))
                <div class="bg-white border-2 border-gray-950 px-4 py-3 text-sm font-semibold text-gray-950">
                    {{ session('success') }}
                </div>
            @endif

            <section class="bg-white border-2 border-gray-950 p-6">
                <form method="GET" action="{{ route('projects.index') }}"
                      class="grid grid-cols-1 md:grid-cols-4 gap-4">

                    <div class="md:col-span-2">
                        <label class="block text-xs uppercase tracking-widest text-gray-500 mb-1">
                            Search
                        </label>
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Search by project name"
                               class="w-full border border-gray-300 px-3 py-2 text-sm focus:border-gray-950 focus:ring-gray-950">
                    </div>

                    <div>
                        <label class="block text-xs uppercase tracking-widest text-gray-500 mb-1">
                            Status
                        </label>
                        <select name="status"
                                class="w-full border border-gray-300 px-3 py-2 text-sm focus:border-gray-950 focus:ring-gray-950">
                            <option value="">All Status</option>
                            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>

                    <div class="flex items-end gap-2">
                        <button type="submit"
                                class="bg-gray-950 text-white px-4 py-2 text-sm font-bold hover:bg-gray-800 transition">
                            Apply
                        </button>

                        <a href="{{ route('projects.index') }}"
                           class="border border-gray-950 px-4 py-2 text-sm font-bold text-gray-950 hover:bg-gray-950 hover:text-white transition">
                            Reset
                        </a>
                    </div>
                </form>
            </section>

            <section class="bg-white border-2 border-gray-950">
                <div class="p-6">
                    @if ($projects->isEmpty())
                        <div class="border border-dashed border-gray-300 p-10 text-center">
                            <p class="text-sm text-gray-500">No projects found.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm">
                                <thead>
                                    <tr class="text-left text-xs uppercase tracking-widest text-gray-500 border-b border-gray-200">
                                        <th class="py-3 pr-4">Name</th>
                                        <th class="py-3 pr-4">Status</th>
                                        <th class="py-3 pr-4">Start Date</th>
                                        <th class="py-3 pr-4">End Date</th>
                                        <th class="py-3 pr-4">Actions</th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-100">
                                    @foreach ($projects as $project)
                                        <tr class="hover:bg-gray-50">
                                            <td class="py-3 pr-4 font-semibold text-gray-950">
                                                {{ $project->name }}
                                            </td>

                                            <td class="py-3 pr-4">
                                                <x-status-badge :status="$project->status" />
                                            </td>

                                            <td class="py-3 pr-4 text-gray-600">
                                                {{ $project->start_date ?: '—' }}
                                            </td>

                                            <td class="py-3 pr-4 text-gray-600">
                                                {{ $project->end_date ?: '—' }}
                                            </td>

                                            <td class="py-3 pr-4">
                                                <div class="flex items-center gap-3">
                                                    <a href="{{ route('projects.show', $project) }}"
                                                       class="text-sm font-bold text-gray-950 hover:underline">
                                                        View
                                                    </a>

                                                    <a href="{{ route('projects.edit', $project) }}"
                                                       class="text-sm font-bold text-gray-700 hover:underline">
                                                        Edit
                                                    </a>

                                                    @if(auth()->user()?->isAdmin())
                                                        <form method="POST"
                                                              action="{{ route('projects.destroy', $project) }}"
                                                              onsubmit="return confirm('Delete this project?');">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button class="text-sm font-bold text-red-600 hover:underline">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-6">
                            {{ $projects->links() }}
                        </div>
                    @endif
                </div>
            </section>

        </div>
    </div>
</x-app-layout>