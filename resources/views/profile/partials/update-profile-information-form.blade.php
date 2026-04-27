<section>
    <div>
        <h3 class="text-lg font-semibold text-gray-950">
            Profile Information
        </h3>

        <p class="mt-1 text-sm text-gray-600">
            Update your account name and email address.
        </p>
    </div>

    <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="POST" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('PATCH')

        <div>
            <label for="name" class="block text-xs uppercase tracking-widest text-gray-500 mb-1">
                Name
            </label>

            <input id="name"
                   name="name"
                   type="text"
                   value="{{ old('name', $user->name) }}"
                   required
                   autofocus
                   autocomplete="name"
                   class="w-full border border-gray-300 px-3 py-2 text-sm focus:border-gray-950 focus:ring-gray-950">

            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <label for="email" class="block text-xs uppercase tracking-widest text-gray-500 mb-1">
                Email
            </label>

            <input id="email"
                   name="email"
                   type="email"
                   value="{{ old('email', $user->email) }}"
                   required
                   autocomplete="username"
                   class="w-full border border-gray-300 px-3 py-2 text-sm focus:border-gray-950 focus:ring-gray-950">

            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 border border-gray-300 p-4">
                    <p class="text-sm text-gray-700">
                        Your email address is unverified.
                    </p>

                    <button form="send-verification"
                            class="mt-2 text-sm font-bold text-gray-950 hover:underline">
                        Re-send verification email
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm font-semibold text-green-600">
                            A new verification link has been sent to your email address.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit"
                    class="bg-gray-950 text-white px-4 py-2 text-sm font-bold hover:bg-gray-800 transition">
                Save
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }"
                   x-show="show"
                   x-transition
                   x-init="setTimeout(() => show = false, 2000)"
                   class="text-sm font-semibold text-gray-600">
                    Saved.
                </p>
            @endif
        </div>
    </form>
</section>