<x-guest-layout>
    <div class="w-full max-w-md bg-white border-2 border-gray-950 p-8">

        <div class="mb-6">
            <p class="text-xs uppercase tracking-[0.3em] text-gray-500">
                Security
            </p>

            <h1 class="mt-3 text-2xl font-black text-gray-950">
                Confirm password
            </h1>

            <p class="mt-2 text-sm text-gray-600">
                This is a secure area. Please confirm your password to continue.
            </p>
        </div>

        <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
            @csrf

            <div>
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password"
                              class="block mt-1 w-full border-gray-300 focus:border-gray-950 focus:ring-gray-950"
                              type="password"
                              name="password"
                              required
                              autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="pt-2">
                <button type="submit"
                        class="w-full bg-gray-950 text-white px-4 py-3 text-sm font-bold hover:bg-gray-800 transition">
                    Confirm
                </button>
            </div>
        </form>

    </div>
</x-guest-layout>