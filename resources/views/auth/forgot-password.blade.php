<x-guest-layout>
    <div class="w-full max-w-md bg-white border-2 border-gray-950 p-8">

        <div class="mb-6">
            <p class="text-xs uppercase tracking-[0.3em] text-gray-500">
                Recovery
            </p>

            <h1 class="mt-3 text-2xl font-black text-gray-950">
                Reset password
            </h1>

            <p class="mt-2 text-sm text-gray-600">
                Enter your email and we will send you a password reset link.
            </p>
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
            @csrf

            <div>
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email"
                              class="block mt-1 w-full border-gray-300 focus:border-gray-950 focus:ring-gray-950"
                              type="email"
                              name="email"
                              :value="old('email')"
                              required
                              autofocus />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="pt-2">
                <button type="submit"
                        class="w-full bg-gray-950 text-white px-4 py-3 text-sm font-bold hover:bg-gray-800 transition">
                    Email Password Reset Link
                </button>
            </div>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ route('login') }}"
               class="text-sm font-semibold text-gray-950 hover:underline">
                Back to login
            </a>
        </div>

    </div>
</x-guest-layout>