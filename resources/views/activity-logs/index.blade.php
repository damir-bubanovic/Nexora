<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Activity Logs
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="GET" action="{{ route('activity-logs.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">User</label>
                        <select name="user_id" class="mt-1 block w-full rounded border-gray-300">
                            <option value="">All users</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" @selected(request('user_id') == $user->id)>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Action</label>
                        <select name="action" class="mt-1 block w-full rounded border-gray-300">
                            <option value="">All actions</option>
                            @foreach ($actions as $action)
                                <option value="{{ $action }}" @selected(request('action') === $action)>
                                    {{ ucfirst($action) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Type</label>
                        <select name="subject_type" class="mt-1 block w-full rounded border-gray-300">
                            <option value="">All types</option>
                            @foreach ($subjectTypes as $type)
                                <option value="{{ $type }}" @selected(request('subject_type') === $type)>
                                    {{ str_replace('_', ' ', ucfirst($type)) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-end gap-2">
                        <button type="submit"
                                class="bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700">
                            Filter
                        </button>

                        <a href="{{ route('activity-logs.index') }}"
                           class="bg-gray-200 text-gray-800 px-4 py-2 rounded text-sm hover:bg-gray-300">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if ($activityLogs->isEmpty())
                        <p class="text-gray-500 text-sm">No activity logs found.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 text-sm">
                                <thead>
                                    <tr class="text-left text-gray-600">
                                        <th class="py-3 pr-4">Date</th>
                                        <th class="py-3 pr-4">User</th>
                                        <th class="py-3 pr-4">Action</th>
                                        <th class="py-3 pr-4">Type</th>
                                        <th class="py-3 pr-4">Subject ID</th>
                                        <th class="py-3 pr-4">Description</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach ($activityLogs as $log)
                                        <tr>
                                            <td class="py-3 pr-4 text-gray-600">
                                                {{ $log->created_at->format('Y-m-d H:i') }}
                                            </td>
                                            <td class="py-3 pr-4">
                                                {{ $log->user?->name ?? 'System' }}
                                            </td>
                                            <td class="py-3 pr-4">
                                                <span class="px-2 py-1 rounded bg-gray-100 text-gray-800">
                                                    {{ $log->action }}
                                                </span>
                                            </td>
                                            <td class="py-3 pr-4">
                                                {{ $log->subject_type }}
                                            </td>
                                            <td class="py-3 pr-4 text-gray-600">
                                                {{ $log->subject_id }}
                                            </td>
                                            <td class="py-3 pr-4 text-gray-700">
                                                {{ $log->description }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-6">
                            {{ $activityLogs->links() }}
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>