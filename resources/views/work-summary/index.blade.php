<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs uppercase tracking-[0.3em] text-gray-500">Reports</p>
            <h2 class="mt-2 text-3xl font-black text-gray-950">
                Monthly Work Summary
            </h2>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <section class="bg-white border-2 border-gray-950">
                <div class="p-6">

                    @if($months->isEmpty())
                        <div class="border border-dashed border-gray-300 p-10 text-center">
                            <p class="text-sm text-gray-500">No data available yet.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm">
                                <thead>
                                    <tr class="text-left text-xs uppercase tracking-widest text-gray-500 border-b border-gray-200">
                                        <th class="py-3 pr-4">Month</th>
                                        <th class="py-3 pr-4">Completed Tasks</th>
                                        <th class="py-3 pr-4">Reports Created</th>
                                        <th class="py-3 pr-4">Hours Worked</th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-100">
                                    @foreach($months as $month)
                                        <tr class="hover:bg-gray-50">
                                            <td class="py-3 pr-4 font-semibold text-gray-950">
                                                {{ \Carbon\Carbon::createFromFormat('Y-m', $month)->format('F Y') }}
                                            </td>

                                            <td class="py-3 pr-4 text-gray-700">
                                                {{ $completedTasksByMonth[$month] ?? 0 }}
                                            </td>

                                            <td class="py-3 pr-4 text-gray-700">
                                                {{ $reportsByMonth[$month] ?? 0 }}
                                            </td>

                                            <td class="py-3 pr-4 text-gray-700">
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
            </section>

        </div>
    </div>
</x-app-layout>