<x-guest-layout>
    <div class="w-full max-w-md bg-white border-2 border-gray-950 p-8">

        <div class="mb-6">
            <p class="text-xs uppercase tracking-[0.3em] text-gray-500">
                Verification
            </p>

            <h1 class="mt-3 text-2xl font-black text-gray-950">
                Verify email
            </h1>

            <p class="mt-2 text-sm text-gray-600">
                Check your email and click the verification link to activate your account.
                If you didn’t receive it, you can request another.
            </p>
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 text-sm font-semibold text-green-600">
                A new verification link has been sent to your email.
            </div>
        @endif

        <div class="space-y-4">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <button type="submit"
                        class="w-full bg-gray-950 text-white px-4 py-3 text-sm font-bold hover:bg-gray-800 transition">
                    Resend Verification Email
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                        class="w-full border border-gray-950 px-4 py-3 text-sm font-bold text-gray-950 hover:bg-gray-950 hover:text-white transition">
                    Log out
                </button>
            </form>
        </div>

    </div>
</x-guest-layout>