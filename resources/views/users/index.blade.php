<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            User Management
        </h2>
    </x-slot>

    <div class="p-6 max-w-5xl">

        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="min-w-full border">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border text-left">Name</th>
                        <th class="px-4 py-2 border text-left">Email</th>
                        <th class="px-4 py-2 border text-left">Role</th>
                        <th class="px-4 py-2 border text-left">Change Role</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td class="px-4 py-2 border">{{ $user->name }}</td>
                            <td class="px-4 py-2 border">{{ $user->email }}</td>
                            <td class="px-4 py-2 border">
                                <span class="font-semibold">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="px-4 py-2 border">
                                <form method="POST" action="{{ route('users.updateRole', $user) }}">
                                    @csrf
                                    @method('PUT')

                                    <select name="role" class="border rounded p-1 text-sm">
                                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="developer" {{ $user->role === 'developer' ? 'selected' : '' }}>Developer</option>
                                        <option value="client" {{ $user->role === 'client' ? 'selected' : '' }}>Client</option>
                                    </select>

                                    <button class="ml-2 text-blue-600 text-sm">
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
</x-app-layout>