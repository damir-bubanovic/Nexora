<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs uppercase tracking-[0.3em] text-gray-500">Projects</p>
            <h2 class="mt-2 text-3xl font-black text-gray-950">
                Create Project
            </h2>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <section class="bg-white border-2 border-gray-950 p-6">
                <form method="POST" action="{{ route('projects.store') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="name" class="block text-xs uppercase tracking-widest text-gray-500 mb-1">
                            Project Name
                        </label>
                        <input type="text"
                               name="name"
                               id="name"
                               value="{{ old('name') }}"
                               class="w-full border border-gray-300 px-3 py-2 text-sm focus:border-gray-950 focus:ring-gray-950"
                               required>
                        @error('name')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-xs uppercase tracking-widest text-gray-500 mb-1">
                            Description
                        </label>
                        <textarea name="description"
                                  id="description"
                                  rows="4"
                                  class="w-full border border-gray-300 px-3 py-2 text-sm focus:border-gray-950 focus:ring-gray-950">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-xs uppercase tracking-widest text-gray-500 mb-1">
                            Status
                        </label>
                        <select name="status"
                                id="status"
                                class="w-full border border-gray-300 px-3 py-2 text-sm focus:border-gray-950 focus:ring-gray-950">
                            <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="pending" {{ old('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                        @error('status')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="start_date" class="block text-xs uppercase tracking-widest text-gray-500 mb-1">
                                Start Date
                            </label>
                            <input type="date"
                                   name="start_date"
                                   id="start_date"
                                   value="{{ old('start_date') }}"
                                   class="w-full border border-gray-300 px-3 py-2 text-sm focus:border-gray-950 focus:ring-gray-950">
                            @error('start_date')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="end_date" class="block text-xs uppercase tracking-widest text-gray-500 mb-1">
                                End Date
                            </label>
                            <input type="date"
                                   name="end_date"
                                   id="end_date"
                                   value="{{ old('end_date') }}"
                                   class="w-full border border-gray-300 px-3 py-2 text-sm focus:border-gray-950 focus:ring-gray-950">
                            @error('end_date')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs uppercase tracking-widest text-gray-500 mb-1">
                            Assign Users
                        </label>

                        <select name="users[]"
                                multiple
                                class="w-full border border-gray-300 px-3 py-2 text-sm focus:border-gray-950 focus:ring-gray-950">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}"
                                    {{ collect(old('users'))->contains($user->id) ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->role }})
                                </option>
                            @endforeach
                        </select>

                        <p class="mt-2 text-xs text-gray-500">
                            Hold Ctrl/Cmd to select multiple users.
                        </p>

                        @error('users')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200">
                        <a href="{{ route('projects.index') }}"
                           class="border border-gray-950 px-4 py-2 text-sm font-bold text-gray-950 hover:bg-gray-950 hover:text-white transition">
                            Cancel
                        </a>

                        <button type="submit"
                                class="bg-gray-950 text-white px-4 py-2 text-sm font-bold hover:bg-gray-800 transition">
                            Save Project
                        </button>
                    </div>
                </form>
            </section>

        </div>
    </div>
</x-app-layout>