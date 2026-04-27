<section class="space-y-4">

    <!-- Header -->
    <div>
        <h3 class="text-lg font-semibold text-red-600">
            Delete Account
        </h3>

        <p class="mt-1 text-sm text-gray-600">
            Once your account is deleted, all data will be permanently removed. Make sure you have saved anything important before proceeding.
        </p>
    </div>

    <!-- Trigger Button -->
    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-red-600 text-white px-4 py-2 rounded text-sm hover:bg-red-700"
    >
        Delete Account
    </button>

    <!-- Modal -->
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="POST" action="{{ route('profile.destroy') }}" class="p-6 space-y-4">
            @csrf
            @method('DELETE')

            <h3 class="text-lg font-semibold text-gray-800">
                Confirm Account Deletion
            </h3>

            <p class="text-sm text-gray-600">
                Enter your password to permanently delete your account.
            </p>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">
                    Password
                </label>

                <input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full rounded border-gray-300 shadow-sm"
                    placeholder="Password"
                >

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-3 pt-4">
                <button
                    type="button"
                    x-on:click="$dispatch('close')"
                    class="bg-gray-200 text-gray-800 px-4 py-2 rounded text-sm hover:bg-gray-300"
                >
                    Cancel
                </button>

                <button
                    type="submit"
                    class="bg-red-600 text-white px-4 py-2 rounded text-sm hover:bg-red-700"
                >
                    Delete Account
                </button>
            </div>
        </form>
    </x-modal>

</section>