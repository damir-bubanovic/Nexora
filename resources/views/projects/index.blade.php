<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Projects') }}
            </h2>

            <a href="{{ route('projects.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm">
                New Project
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($projects->isEmpty())
                        <p class="text-gray-600">No projects found.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full border border-gray-200">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="px-4 py-2 border text-left">Name</th>
                                        <th class="px-4 py-2 border text-left">Status</th>
                                        <th class="px-4 py-2 border text-left">Start Date</th>
                                        <th class="px-4 py-2 border text-left">End Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($projects as $project)
                                        <tr>
                                            <td class="px-4 py-2 border">{{ $project->name }}</td>
                                            <td class="px-4 py-2 border">{{ $project->status }}</td>
                                            <td class="px-4 py-2 border">{{ $project->start_date }}</td>
                                            <td class="px-4 py-2 border">{{ $project->end_date }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>