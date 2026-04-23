<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Project Details') }}
            </h2>

            <a href="{{ route('projects.index') }}"
               class="text-sm text-gray-600 hover:underline">
                Back to Projects
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 space-y-6">

                    <!-- Name -->
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Name</h3>
                        <p class="mt-1 text-lg font-semibold text-gray-900">
                            {{ $project->name }}
                        </p>
                    </div>

                    <!-- Description -->
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Description</h3>
                        <p class="mt-1 text-gray-700">
                            {{ $project->description ?: 'No description provided.' }}
                        </p>
                    </div>

                    <!-- Details -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                        <!-- Status -->
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Status</h3>
                            <p class="mt-1">
                                <x-status-badge :status="$project->status" class="px-3 py-1 text-sm" />
                            </p>
                        </div>

                        <!-- Start Date -->
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Start Date</h3>
                            <p class="mt-1 text-gray-700">
                                {{ $project->start_date ?: 'Not set' }}
                            </p>
                        </div>

                        <!-- End Date -->
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">End Date</h3>
                            <p class="mt-1 text-gray-700">
                                {{ $project->end_date ?: 'Not set' }}
                            </p>
                        </div>

                    </div>

                    <!-- Actions -->
                    <div class="pt-4 flex items-center gap-4">

                        <a href="{{ route('projects.tasks.index', $project) }}"
                           class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700 text-sm">
                            View Tasks
                        </a>

                        <a href="{{ route('projects.edit', $project) }}"
                           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm">
                            Edit Project
                        </a>

                        <form method="POST" action="{{ route('projects.destroy', $project) }}"
                              onsubmit="return confirm('Are you sure you want to delete this project?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 text-sm">
                                Delete Project
                            </button>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>