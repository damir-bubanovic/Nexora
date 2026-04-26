<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Monthly Work Summary
        </h2>
    </x-slot>

    <div class="p-6">
        @if($months->isEmpty())
            <p class="text-gray-600">No data available yet.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200 text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-3 py-2 text-left">Month</th>
                            <th class="border px-3 py-2 text-left">Completed Tasks</th>
                            <th class="border px-3 py-2 text-left">Reports Created</th>
                            <th class="border px-3 py-2 text-left">Hours Worked</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($months as $month)
                            <tr>
                                <td class="border px-3 py-2">
                                    {{ \Carbon\Carbon::createFromFormat('Y-m', $month)->format('F Y') }}
                                </td>

                                <td class="border px-3 py-2">
                                    {{ $completedTasksByMonth[$month] ?? 0 }}
                                </td>

                                <td class="border px-3 py-2">
                                    {{ $reportsByMonth[$month] ?? 0 }}
                                </td>

                                <td class="border px-3 py-2">
                                    {{ isset($actualHoursByMonth[$month]) 
                                        ? number_format($actualHoursByMonth[$month], 1) . 'h' 
                                        : '—' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-layout>