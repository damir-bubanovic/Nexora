<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs uppercase tracking-[0.3em] text-gray-500">Admin</p>
            <h2 class="mt-2 text-3xl font-black text-gray-950">
                User Management
            </h2>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="bg-white border-2 border-gray-950 px-4 py-3 text-sm font-semibold text-gray-950">
                    {{ session('success') }}
                </div>
            @endif

            <section class="bg-white border-2 border-gray-950">
                <div class="p-6">

                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead>
                                <tr class="text-left text-xs uppercase tracking-widest text-gray-500 border-b border-gray-200">
                                    <th class="py-3 pr-4">Name</th>
                                    <th class="py-3 pr-4">Email</th>
                                    <th class="py-3 pr-4">Role</th>
                                    <th class="py-3 pr-4">Change Role</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100">
                                @foreach($users as $user)
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-3 pr-4 font-semibold text-gray-950">
                                            {{ $user->name }}
                                        </td>

                                        <td class="py-3 pr-4 text-gray-700">
                                            {{ $user->email }}
                                        </td>

                                        <td class="py-3 pr-4">
                                            <span class="inline-flex border px-2 py-1 text-xs font-bold border-gray-950 text-gray-950">
                                                {{ ucfirst($user->role) }}
                                            </span>
                                        </td>

                                        <td class="py-3 pr-4">
                                            <form method="POST" action="{{ route('users.updateRole', $user) }}"
                                                  class="flex items-center gap-2">
                                                @csrf
                                                @method('PUT')

                                                <select name="role"
                                                        class="border border-gray-300 px-2 py-1 text-xs focus:border-gray-950 focus:ring-0">
                                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                                    <option value="developer" {{ $user->role === 'developer' ? 'selected' : '' }}>Developer</option>
                                                    <option value="client" {{ $user->role === 'client' ? 'selected' : '' }}>Client</option>
                                                </select>

                                                <button class="text-xs font-bold text-gray-950 hover:underline">
                                                    Save
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </section>

        </div>
    </div>
</x-app-layout>