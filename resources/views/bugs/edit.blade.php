<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs uppercase tracking-[0.3em] text-gray-500">Bugs</p>
            <h2 class="mt-2 text-3xl font-black text-gray-950">
                Edit Bug
            </h2>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <section class="bg-white border-2 border-gray-950">
                <div class="p-8">

                    <form method="POST"
                          action="{{ route('projects.tasks.bugs.update', [$project, $task, $bug]) }}"
                          class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-widest text-gray-500">
                                Title
                            </label>
                            <input name="title"
                                   value="{{ old('title', $bug->title) }}"
                                   class="mt-2 w-full border border-gray-300 px-3 py-2 focus:border-gray-950 focus:ring-0"
                                   required>
                            @error('title')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-widest text-gray-500">
                                Description
                            </label>
                            <textarea name="description"
                                      rows="4"
                                      class="mt-2 w-full border border-gray-300 px-3 py-2 focus:border-gray-950 focus:ring-0"
                                      required>{{ old('description', $bug->description) }}</textarea>
                            @error('description')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-widest text-gray-500">
                                Status
                            </label>
                            <select name="status"
                                    class="mt-2 w-full border border-gray-300 px-3 py-2 focus:border-gray-950 focus:ring-0">

                                <option value="open" {{ old('status', $bug->status) === 'open' ? 'selected' : '' }}>
                                    Open
                                </option>

                                <option value="in_progress" {{ old('status', $bug->status) === 'in_progress' ? 'selected' : '' }}>
                                    In Progress
                                </option>

                                <option value="resolved"
                                    {{ old('status', $bug->status) === 'resolved' ? 'selected' : '' }}
                                    @if(!auth()->user()->isAdmin() && $bug->assigned_to !== auth()->id())
                                        disabled
                                    @endif
                                >
                                    Resolved
                                </option>

                            </select>
                            @error('status')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Assign -->
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-widest text-gray-500">
                                Assign User
                            </label>
                            <select name="assigned_to"
                                    class="mt-2 w-full border border-gray-300 px-3 py-2 focus:border-gray-950 focus:ring-0">
                                <option value="">Unassigned</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ old('assigned_to', $bug->assigned_to) == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('assigned_to')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Actions -->
                        <div class="flex justify-end gap-3 pt-4">
                            <a href="{{ route('projects.tasks.bugs.index', [$project, $task]) }}"
                               class="px-4 py-2 text-sm font-bold text-gray-700 hover:underline">
                                Cancel
                            </a>

                            <button class="bg-gray-950 text-white px-5 py-2 text-sm font-bold hover:bg-gray-800 transition">
                                Update Bug
                            </button>
                        </div>

                    </form>

                </div>
            </section>

        </div>
    </div>
</x-app-layout>