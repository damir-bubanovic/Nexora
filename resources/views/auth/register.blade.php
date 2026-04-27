<x-guest-layout>
    <div class="w-full max-w-md bg-white border-2 border-gray-950 p-8">
        <div class="mb-8">
            <p class="text-xs uppercase tracking-[0.3em] text-gray-500">
                Nexora
            </p>

            <h1 class="mt-3 text-3xl font-black text-gray-950">
                Create account
            </h1>

            <p class="mt-3 text-sm text-gray-600">
                Join Nexora to manage projects, tasks, bugs, reports, and work summaries.
            </p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name"
                              class="block mt-1 w-full border-gray-300 focus:border-gray-950 focus:ring-gray-950"
                              type="text"
                              name="name"
                              :value="old('name')"
                              required
                              autofocus
                              autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email"
                              class="block mt-1 w-full border-gray-300 focus:border-gray-950 focus:ring-gray-950"
                              type="email"
                              name="email"
                              :value="old('email')"
                              required
                              autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password"
                              class="block mt-1 w-full border-gray-300 focus:border-gray-950 focus:ring-gray-950"
                              type="password"
                              name="password"
                              required
                              autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation"
                              class="block mt-1 w-full border-gray-300 focus:border-gray-950 focus:ring-gray-950"
                              type="password"
                              name="password_confirmation"
                              required
                              autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="pt-2">
                <button type="submit"
                        class="w-full bg-gray-950 text-white px-4 py-3 text-sm font-bold hover:bg-gray-800 transition">
                    Register
                </button>
            </div>

            <div class="text-center">
                <a href="{{ route('login') }}"
                   class="text-sm font-semibold text-gray-950 hover:underline">
                    Already registered? Log in
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>