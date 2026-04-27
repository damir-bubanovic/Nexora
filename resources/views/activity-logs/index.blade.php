<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-xl text-gray-950">
            Activity Logs
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Filters -->
            <div class="bg-white border-2 border-gray-950 p-6">
                <form method="GET" action="{{ route('activity-logs.index') }}"
                      class="grid grid-cols-1 md:grid-cols-4 gap-4">

                    <div>
                        <label class="block text-xs uppercase tracking-widest text-gray-500 mb-1">User</label>
                        <select name="user_id"
                                class="w-full border border-gray-300 px-3 py-2 text-sm focus:border-gray-950 focus:ring-gray-950">
                            <option value="">All users</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" @selected(request('user_id') == $user->id)>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs uppercase tracking-widest text-gray-500 mb-1">Action</label>
                        <select name="action"
                                class="w-full border border-gray-300 px-3 py-2 text-sm focus:border-gray-950 focus:ring-gray-950">
                            <option value="">All actions</option>
                            @foreach ($actions as $action)
                                <option value="{{ $action }}" @selected(request('action') === $action)>
                                    {{ ucfirst($action) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs uppercase tracking-widest text-gray-500 mb-1">Type</label>
                        <select name="subject_type"
                                class="w-full border border-gray-300 px-3 py-2 text-sm focus:border-gray-950 focus:ring-gray-950">
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
                                class="bg-gray-950 text-white px-4 py-2 text-sm font-bold hover:bg-gray-800 transition">
                            Filter
                        </button>

                        <a href="{{ route('activity-logs.index') }}"
                           class="border border-gray-950 px-4 py-2 text-sm font-bold text-gray-950 hover:bg-gray-950 hover:text-white transition">
                            Reset
                        </a>
                    </div>

                </form>
            </div>

            <!-- Table -->
            <div class="bg-white border-2 border-gray-950">
                <div class="p-6">

                    @if ($activityLogs->isEmpty())
                        <p class="text-sm text-gray-500">No activity logs found.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm">

                                <thead>
                                    <tr class="text-left text-xs uppercase tracking-widest text-gray-500 border-b border-gray-200">
                                        <th class="py-3 pr-4">Date</th>
                                        <th class="py-3 pr-4">User</th>
                                        <th class="py-3 pr-4">Action</th>
                                        <th class="py-3 pr-4">Type</th>
                                        <th class="py-3 pr-4">ID</th>
                                        <th class="py-3 pr-4">Description</th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-100">
                                    @foreach ($activityLogs as $log)
                                        <tr class="hover:bg-gray-50">

                                            <td class="py-3 pr-4 text-gray-600">
                                                {{ $log->created_at->format('Y-m-d H:i') }}
                                            </td>

                                            <td class="py-3 pr-4 font-semibold text-gray-950">
                                                {{ $log->user?->name ?? 'System' }}
                                            </td>

                                            <td class="py-3 pr-4">
                                                <span class="text-xs font-bold border border-gray-300 px-2 py-1">
                                                    {{ $log->action }}
                                                </span>
                                            </td>

                                            <td class="py-3 pr-4 text-gray-700">
                                                {{ $log->subject_type }}
                                            </td>

                                            <td class="py-3 pr-4 text-gray-500">
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