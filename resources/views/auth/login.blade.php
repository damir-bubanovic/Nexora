<x-guest-layout>
    <div class="w-full max-w-md bg-white border-2 border-gray-950 p-8">
        <div class="mb-8">
            <p class="text-xs uppercase tracking-[0.3em] text-gray-500">
                Nexora
            </p>

            <h1 class="mt-3 text-3xl font-black text-gray-950">
                Log in
            </h1>

            <p class="mt-3 text-sm text-gray-600">
                Access your project dashboard, tasks, reports, and activity.
            </p>
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email"
                              class="block mt-1 w-full border-gray-300 focus:border-gray-950 focus:ring-gray-950"
                              type="email"
                              name="email"
                              :value="old('email')"
                              required
                              autofocus
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
                              autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me"
                           type="checkbox"
                           class="rounded border-gray-300 text-gray-950 focus:ring-gray-950"
                           name="remember">
                    <span class="ms-2 text-sm text-gray-600">
                        {{ __('Remember me') }}
                    </span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm font-semibold text-gray-950 hover:underline"
                       href="{{ route('password.request') }}">
                        {{ __('Forgot?') }}
                    </a>
                @endif
            </div>

            <div>
                <button type="submit"
                        class="w-full bg-gray-950 text-white px-4 py-3 text-sm font-bold hover:bg-gray-800 transition">
                    Log in
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>