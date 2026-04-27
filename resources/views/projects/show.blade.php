<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs uppercase tracking-[0.3em] text-gray-500">Projects</p>
                <h2 class="mt-2 text-3xl font-black text-gray-950">
                    Project Details
                </h2>
            </div>

            <a href="{{ route('projects.index') }}"
               class="border border-gray-950 px-4 py-2 text-sm font-bold text-gray-950 hover:bg-gray-950 hover:text-white transition">
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <section class="bg-black border-2 border-white p-6">
                <p class="text-xs uppercase tracking-widest text-white">Project</p>

                <h1 class="mt-3 text-4xl font-black text-white">
                    {{ $project->name }}
                </h1>

                <p class="mt-4 text-white leading-relaxed">
                    {{ $project->description ?: 'No description provided.' }}
                </p>
            </section>

            <section class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div class="bg-white border border-gray-200 p-5">
                    <p class="text-xs uppercase tracking-widest text-gray-500">Status</p>
                    <div class="mt-3">
                        <x-status-badge :status="$project->status" />
                    </div>
                </div>

                <div class="bg-white border border-gray-200 p-5">
                    <p class="text-xs uppercase tracking-widest text-gray-500">Start Date</p>
                    <p class="mt-3 text-xl font-black text-gray-950">
                        {{ $project->start_date ?: '—' }}
                    </p>
                </div>

                <div class="bg-white border border-gray-200 p-5">
                    <p class="text-xs uppercase tracking-widest text-gray-500">End Date</p>
                    <p class="mt-3 text-xl font-black text-gray-950">
                        {{ $project->end_date ?: '—' }}
                    </p>
                </div>
            </section>

            <section class="bg-white border-2 border-gray-950 p-6">
                <p class="text-xs uppercase tracking-widest text-gray-500">Assigned Users</p>

                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-3">
                    @forelse($project->users as $user)
                        <div class="border border-gray-200 p-4">
                            <p class="font-black text-gray-950">
                                {{ $user->name }}
                            </p>
                            <p class="mt-1 text-sm text-gray-500">
                                {{ ucfirst($user->role) }}
                            </p>
                        </div>
                    @empty
                        <div class="border border-dashed border-gray-300 p-6 text-sm text-gray-500">
                            No users assigned.
                        </div>
                    @endforelse
                </div>
            </section>

            <section class="bg-white border-2 border-gray-950 p-6">
                <p class="text-xs uppercase tracking-widest text-gray-500 mb-4">Actions</p>

                <div class="flex flex-wrap items-center gap-3">
                    <a href="{{ route('projects.tasks.index', $project) }}"
                       class="bg-gray-950 text-white px-4 py-2 text-sm font-bold hover:bg-gray-800 transition">
                        View Tasks
                    </a>

                    <a href="{{ route('projects.edit', $project) }}"
                       class="border border-gray-950 px-4 py-2 text-sm font-bold text-gray-950 hover:bg-gray-950 hover:text-white transition">
                        Edit Project
                    </a>

                    @if(auth()->user()?->isAdmin())
                        <form method="POST"
                              action="{{ route('projects.destroy', $project) }}"
                              onsubmit="return confirm('Are you sure you want to delete this project?');">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="border border-red-600 px-4 py-2 text-sm font-bold text-red-600 hover:bg-red-600 hover:text-white transition">
                                Delete Project
                            </button>
                        </form>
                    @endif
                </div>
            </section>

        </div>
    </div>
</x-app-layout>