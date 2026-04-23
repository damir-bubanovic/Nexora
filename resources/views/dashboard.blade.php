<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nexora Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Welcome Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-2">Welcome to Nexora</h3>
                    <p class="text-sm text-gray-600">
                        You are logged in. Use the modules below to manage projects, tasks, and reports.
                    </p>
                </div>
            </div>

            <!-- Modules Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- Projects -->
                <div class="bg-white shadow-sm sm:rounded-lg p-6 hover:shadow-md transition">
                    <h3 class="text-lg font-semibold mb-2">Projects</h3>
                    <p class="text-sm text-gray-600 mb-4">
                        Create and manage project workflows.
                    </p>
                    <a href="#" class="text-blue-600 hover:underline text-sm">
                        View Projects →
                    </a>
                </div>

                <!-- Tasks -->
                <div class="bg-white shadow-sm sm:rounded-lg p-6 hover:shadow-md transition">
                    <h3 class="text-lg font-semibold mb-2">Tasks</h3>
                    <p class="text-sm text-gray-600 mb-4">
                        Track sub-tasks, revisions, and progress.
                    </p>
                    <a href="#" class="text-blue-600 hover:underline text-sm">
                        View Tasks →
                    </a>
                </div>

                <!-- Reports -->
                <div class="bg-white shadow-sm sm:rounded-lg p-6 hover:shadow-md transition">
                    <h3 class="text-lg font-semibold mb-2">Reports</h3>
                    <p class="text-sm text-gray-600 mb-4">
                        Review code changes and SQL updates.
                    </p>
                    <a href="#" class="text-blue-600 hover:underline text-sm">
                        View Reports →
                    </a>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>