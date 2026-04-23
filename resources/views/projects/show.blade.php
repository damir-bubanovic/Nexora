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

                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Name</h3>
                        <p class="mt-1 text-lg font-semibold text-gray-900">{{ $project->name }}</p>
                    </div>

                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Description</h3>
                        <p class="mt-1 text-gray-700">
                            {{ $project->description ?: 'No description provided.' }}
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Status</h3>
                            <p class="mt-1">
                                @if ($project->status === 'active')
                                    <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                                        Active
                                    </span>
                                @elseif ($project->status === 'pending')
                                    <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Pending
                                    </span>
                                @elseif ($project->status === 'completed')
                                    <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-blue-100 text-blue-800">
                                        Completed
                                    </span>
                                @else
                                    <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-gray-100 text-gray-800">
                                        {{ ucfirst($project->status) }}
                                    </span>
                                @endif
                            </p>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Start Date</h3>
                            <p class="mt-1 text-gray-700">{{ $project->start_date ?: 'Not set' }}</p>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-gray-500">End Date</h3>
                            <p class="mt-1 text-gray-700">{{ $project->end_date ?: 'Not set' }}</p>
                        </div>
                    </div>

                    <div class="pt-4 flex items-center gap-4">
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