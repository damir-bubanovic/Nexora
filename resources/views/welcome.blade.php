<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Nexora') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,900&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-950 antialiased">
    <div class="min-h-screen flex flex-col">

        <header class="w-full border-b border-gray-200 bg-white">
            <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">
                <a href="/" class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.svg') }}"
                         alt="Nexora"
                         class="h-10 w-10 object-contain">

                    <span class="text-lg font-black tracking-tight">
                        Nexora
                    </span>
                </a>

                <nav class="flex items-center gap-3">
                    @auth
                        <a href="{{ route('dashboard') }}"
                           class="border border-gray-950 px-4 py-2 text-sm font-bold hover:bg-gray-950 hover:text-white transition">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="px-4 py-2 text-sm font-bold text-gray-950 hover:underline">
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="border border-gray-950 bg-gray-950 px-4 py-2 text-sm font-bold text-white hover:bg-white hover:text-gray-950 transition">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            </div>
        </header>

        <main class="flex-1">
            <section class="max-w-7xl mx-auto px-6 py-16 lg:py-24">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-stretch">

                    <div class="bg-white border-2 border-gray-950 p-8 lg:p-12">
                        <p class="text-xs uppercase tracking-[0.3em] text-gray-500">
                            Project control center
                        </p>

                        <h1 class="mt-5 text-5xl lg:text-6xl font-black leading-tight text-gray-950">
                            Manage projects, tasks, bugs and reports.
                        </h1>

                        <p class="mt-6 text-gray-600 leading-relaxed max-w-xl">
                            Nexora helps teams organize project work, track assigned tasks,
                            report bugs, write implementation notes, and review monthly progress.
                        </p>

                        <div class="mt-8 flex flex-wrap gap-3">
                            @auth
                                <a href="{{ route('dashboard') }}"
                                   class="bg-gray-950 text-white px-6 py-3 text-sm font-bold hover:bg-gray-800 transition">
                                    Open Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}"
                                   class="bg-gray-950 text-white px-6 py-3 text-sm font-bold hover:bg-gray-800 transition">
                                    Log in
                                </a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                       class="border border-gray-950 px-6 py-3 text-sm font-bold text-gray-950 hover:bg-gray-950 hover:text-white transition">
                                        Create Account
                                    </a>
                                @endif
                            @endauth
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-5">
                        <div class="bg-gray-950 border border-gray-950 p-6 text-white">
                            <p class="text-xs uppercase tracking-widest text-gray-400">Tasks</p>
                            <h2 class="mt-4 text-4xl font-black">Plan</h2>
                            <p class="mt-3 text-sm text-gray-400">
                                Assign work, track status, priority, deadlines and hours.
                            </p>
                        </div>

                        <div class="bg-white border border-gray-200 p-6">
                            <p class="text-xs uppercase tracking-widest text-gray-500">Bugs</p>
                            <h2 class="mt-4 text-4xl font-black">Review</h2>
                            <p class="mt-3 text-sm text-gray-600">
                                Report, assign and resolve bugs inside project tasks.
                            </p>
                        </div>

                        <div class="bg-white border border-gray-200 p-6">
                            <p class="text-xs uppercase tracking-widest text-gray-500">Reports</p>
                            <h2 class="mt-4 text-4xl font-black">Write</h2>
                            <p class="mt-3 text-sm text-gray-600">
                                Store summaries, changed files, SQL notes and testing notes.
                            </p>
                        </div>

                        <div class="bg-white border-2 border-gray-950 p-6">
                            <p class="text-xs uppercase tracking-widest text-gray-500">Audit</p>
                            <h2 class="mt-4 text-4xl font-black">Track</h2>
                            <p class="mt-3 text-sm text-gray-600">
                                View activity logs and monthly work summaries.
                            </p>
                        </div>
                    </div>

                </div>
            </section>
        </main>

        <footer class="border-t border-gray-200 bg-white">
            <div class="max-w-7xl mx-auto px-6 py-5 text-sm text-gray-500">
                Nexora — project workflow and reporting system.
            </div>
        </footer>

    </div>
</body>
</html>