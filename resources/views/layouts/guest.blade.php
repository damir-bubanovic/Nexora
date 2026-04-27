<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Nexora') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,900&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-gray-950 bg-gray-50">
    <div class="min-h-screen flex flex-col items-center justify-center px-4">

        <!-- Logo -->
        <div class="mb-6">
            <a href="/">
                <img src="{{ asset('images/logo.svg') }}"
                     alt="Nexora"
                     class="w-14 h-14 object-contain">
            </a>
        </div>

        <!-- Card -->
        <div class="w-full max-w-md bg-white border border-gray-200 p-6">
            {{ $slot }}
        </div>

        <footer class="bg-black text-white text-center text-sm py-4 mt-10">
            © 2026, Damir Bubanović
        </footer>

    </div>
</body>
</html>